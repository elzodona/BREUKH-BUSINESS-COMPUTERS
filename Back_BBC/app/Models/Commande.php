<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Commande extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date_comm', 'reduction', 'client_id', 'utilisateur_id'
    ];

    protected $hidden = [
        "created_at", "updated_at",
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function succ_prods()
    {
        return $this->belongsToMany(SuccProd::class, 'produit_commandes', 'commande_id', 'succ_prod_id')
                    ->withPivot('id', 'prix', 'quantite', 'reduction');
    }
    
}
