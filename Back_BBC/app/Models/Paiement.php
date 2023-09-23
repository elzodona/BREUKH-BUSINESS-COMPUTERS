<?php

namespace App\Models;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Paiement extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function utilisateurs()
    {
        return $this->belongsTo(Utilisateur::class);
    }


}
