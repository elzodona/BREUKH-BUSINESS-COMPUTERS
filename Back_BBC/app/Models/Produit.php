<?php

namespace App\Models;

use App\Models\Marque;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Produit extends Model
{
    use HasFactory, SoftDeletes;

      protected $guarded = [];

      public function categorie()
      {
        return $this->belongsTo(Categorie::class);
      }

      public function marque()
      {
        return $this->belongsTo(Marque::class);
      }

      public function succursales()
      {
        return $this->belongsToMany(Succursale::class, 'succ_prods', 'produit_id', 'succursale_id')
                    ->withPivot('id', 'quantite', 'prix_unitaire', 'prix_en_gros');
      }

      public function caracteristiques()
      {
        return $this->belongsToMany(Caracteristiques::class, 'prod_cars', 'produit_id', 'caracteristique_id')
                    ->withPivot('id', 'description', 'unite_id', 'valeur');
      }


}

