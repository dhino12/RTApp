<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        });
    }

    public function blogs() {
        return $this->hasMany(Blogs::class, 'category_id', 'id');
    }

    public function galleries() {
        return $this->hasMany(GalleryActivities::class, 'category_id', 'id');;
    }
}
