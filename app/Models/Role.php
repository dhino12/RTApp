<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role AS RoleSpatie;

class Role extends RoleSpatie
{
    use HasFactory;
}
