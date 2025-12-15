<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Moto extends Model {
    protected $table = 'motos';

    protected $fillable = ['idmodelo', 'year', 'cilindrada', 'idtipo', 'descripcion', 'imagen', 'precio'];

    function modelo(): BelongsTo {
        return $this->BelongsTo('App\Models\Modelo', 'idmodelo');
    }

    function tipo(): BelongsTo {
        return $this->BelongsTo('App\Models\Tipo', 'idtipo');
    }

    function getImagenUrlAttribute() {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('assets/img/moto-default.png');
    }


    function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
