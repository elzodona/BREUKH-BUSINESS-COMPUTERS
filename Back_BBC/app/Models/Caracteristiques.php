<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Caracteristiques extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'libelle'
    ];

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'prod_cars', 'produit_id', 'caracteristique_id')
                    ->withPivot('id', 'description', 'valeur', 'unite_id');
    }
    
}
