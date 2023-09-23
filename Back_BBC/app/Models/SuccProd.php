<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SuccProd extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'succursale_id',
        'produit_id',
    ];

    public function succursales()
    {
        return $this->belongsTo(Succursale::class);
    }

    public function produits()
    {
        return $this->belongsTo(Produit::class);
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'produit_commandes', 'succ_prod_id', 'commande_id')
                    ->withPivot('prix', 'quantite', 'reduction');
    }

    
}

