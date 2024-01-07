<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CensusPopulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
use SplTempFileObject;

class DashboardConsensusPopulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('read dashboard/consensus');
        return view("/dashboard/pages/consensus", [
            "consensus" => CensusPopulation::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create dashboard/consensus');
        return view("/dashboard/pages/form-post-consensus");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create dashboard/consensus');
        $rules = [
            "male" => ["required", "max:255"],
            "female" => ["required", "max:255"],
            "total_population" => ["required", "max:255"],
            "total_family" => ["required", "max:255"],
        ];
        $validatedData = $request->validate($rules);
        $validatedData["user_id"] = auth()->user()->id;
        CensusPopulation::create($validatedData);
        return redirect('/dashboard/consensus')->with("success", "Census has been added");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CensusPopulation $consensu)
    {
        $this->authorize('update dashboard/consensus');
        return view("/dashboard/pages/form-edit-consensus", [
            "post" => $consensu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CensusPopulation $consensu, Request $request)
    {
        $this->authorize('update dashboard/consensus');
        $rules = [
            "male" => ["required", "max:255"],
            "female" => ["required", "max:255"],
            "total_population" => ["required", "max:255"],
            "total_family" => ["required", "max:255"],
        ];
        $validatedData = $request->validate($rules);
        $result = CensusPopulation::where("id", $consensu->id)->update($validatedData);
        return redirect('/dashboard/consensus')->with("success", "Consensus has been updated");
    }

    public function import(Request $request)
    {
        $file = $request->file('csv_file');
        if ($file->getClientOriginalName() == null) {
            return redirect('/dashboard/consensus')->with("error", "Terdapat masalah pastikan sudah memilih file .csv");
        }

        $filePath = $file->storeAs('csv_imports', $file->getClientOriginalName());
        $csv = Reader::createFromPath(storage_path('app/public/' . $filePath), 'r');
        $csv->setHeaderOffset(0);
        $afterReverse = array_reverse(iterator_to_array($csv));
        // DB::beginTransaction();
        foreach ($afterReverse as $offset => $record) {
            if (
                (int)($record['laki-laki'] ?? 0) &&
                (int)($record["perempuan"] ?? 0) &&
                (int)($record["total-warga"] ?? 0) &&
                (int)($record["keluarga"] ?? 0)
            ) {
                CensusPopulation::create([
                    "male" => $record["laki-laki"],
                    "female" => $record["perempuan"],
                    "total_population" => $record["total-warga"],
                    "total_family" => $record["keluarga"],
                    "user_id" => auth()->user()->id,
                ]);
            } else {
                DB::rollBack();
                Storage::delete(storage_path('app/public/' . $filePath));
                return redirect('/dashboard/consensus')->with("error", "Terdapat masalah saat import setelah baris " . $offset . ", pastikan value tidak 0, atau column sesuai format");
            }
        }
        
        DB::commit();
        Storage::delete(storage_path('app/public/' . $filePath));
        return redirect('/dashboard/consensus')->with("success", "Success imported");
    }

    public function export(Request $request)
    {
        $csv = Writer::createFromFileObject(new SplTempFileObject());
        // Define the excluded columns
        $excludedColumns = ['id', 'user_id', 'updated_at'];
        $header = ["laki-laki", "perempuan", "total-warga", "keluarga", "created_at"];
        $csv->insertOne($header);

        $consensus = CensusPopulation::latest()->get();
        
        // Insert data into the CSV
        foreach ($consensus as $row) {
            $filteredRow = array_diff_key($row->toArray(), array_flip($excludedColumns));
            $csv->insertOne($filteredRow);
        }
        
        // Set HTTP headers for download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="consensus_data.csv"');

        // Output the CSV to the browser
        $csv->output();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CensusPopulation $consensu, Request $request)
    {
        $this->authorize('delete dashboard/consensus');
        CensusPopulation::destroy($consensu->id);
        return redirect('/dashboard/consensus')->with("success", "Data has been deleted");
    }
}
