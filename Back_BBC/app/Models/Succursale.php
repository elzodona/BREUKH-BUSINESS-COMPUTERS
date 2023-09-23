<?php

namespace App\Models;

use App\Models\Ami;
use App\Models\Succursale;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Succursale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nom', 'adresse', 'telephone'] ;

    public function utilisateurs()
    {
        return $this->hasMany(Utilisateur::class, 'succursale_id');
    }

    // public function amis()
    // {
    //     return $this->belongsToMany(Succursale::class, 'amis', 'friendA', 'friendB')
    //                 ->withPivot('accepted');
    // }

    // public function friends(Builder $builder, $id)
    // {
    //     return $builder->query('Select * from amis');
    // }

    public function friends(Builder $builder, $id)
    {
        return $builder->from('amis')
                        ->where('accepted',1)
                        ->where('friendA', $id)
                        ->orWhere('friendB', $id)
                        ->select('id', 'friendA', 'friendB')
                        ->get();
    }

    public function noFriends(Builder $builder, $id)
    {
        $mein = $this->friends(Ami::query(), $id);
        $ifFriends = [];
        foreach ($mein as $item) {
            if ($item['friendA'] != 1) {
                $ifFriends[] = $item['friendA'];
            }
            if ($item['friendB'] != 1) {
                $ifFriends[] = $item['friendB'];
            }
        }
        //return $ifFriends;
        $hop = $builder->from('succursales')->get()->pluck('id');
        //return $hop;
        $hum = array_diff($ifFriends, $hop);
        // return $hum;
    }

    public function waitFriends(Builder $builder, $id)
    {
        return $builder->from('amis')
                        ->where('accepted',0)
                        ->where('friendB', $id)
                        ->select('id', 'friendA', 'friendB', 'accepted')
                        ->get();
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'succ_prods', 'succursale_id', 'produit_id')
                    ->withPivot('quantite', 'prix_unitaire', 'prix_en_gros');
    }
    

}

