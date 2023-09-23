<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Unite extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'libelle'
    ];

    public function prod_cars()
    {
        return $this->hasMany(ProdCaract::class);
    }

}
