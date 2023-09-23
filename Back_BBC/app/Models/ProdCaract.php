<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProdCaract extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description', 'valeur', 'unite_id', 'produit_id', 'caracteristique_id'
    ];

    public function produits()
    {
        return $this->belongsTo(Produit::class);
    }

    public function caracteristiques()
    {
        return $this->belongsTo(Caracteristique::class);
    }

    public function unites()
    {
        return $this->belongsTo(Unite::class);
    }

}
