<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmenuEnlace extends Model
{
    protected $table = 'submenu_enlaces_interes';
    protected $primaryKey = 'submenu_id';

    protected $fillable = [
        'descripcion',
        'url'
    ];

    protected $dates = [
        'creacion',
        'actualizacion'
    ];

    public $timestamps = false;

    public function menu_enlace()
    {
        return $this->belongsTo('App\MenuEnlace', 'menu_id', 'menu_id');
    }
}
