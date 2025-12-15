<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Modelo extends Model {
    protected $table = 'modelos';

    protected $fillable = ['idmarca', 'nombre'];

    function marca(): BelongsTo {
        return $this->belongsTo('App\Models\Marca', 'idmarca');
    }

    function motos(): HasMany {
        return $this->hasMany('App\Models\Moto', 'idmodelo');
    }
}

