<?php

namespace App\Models;

use App\Models\Succursale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ami extends Model
{
    use HasFactory, SoftDeletes;

    public function succursales()
    {
        return $this->belongsTo(Succursale::class);
    }


}
