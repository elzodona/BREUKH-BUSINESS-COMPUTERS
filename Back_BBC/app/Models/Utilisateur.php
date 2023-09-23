<?php

namespace App\Models;

use App\Models\Commande;
use App\Models\Paiement;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Utilisateur extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'nomComplet',
        'telephone',
        'login',
        'password',
        'adresse',
        'role',
        'succursale_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function succursale()
    {
        return $this->belongsTo(Succursale::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }


}

