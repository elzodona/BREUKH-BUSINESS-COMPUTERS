<?php

namespace App\Models;

use App\Models\Commande;
use App\Models\SuccProd;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ProduitCommande extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'prix', 'reduction', 'quantite', 'succ_prod_id', 'commande_id'
    ];

    public function succ_prods()
    {
        return $this->belongsTo(SuccProd::class);
    }

    public function commandes()
    {
        return $this->belongsTo(Commande::class);
    }

    
}

