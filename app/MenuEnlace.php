<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuEnlace extends Model
{
    protected $table = 'menu_enlaces_interes';
    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'descripcion'
    ];

    protected $dates = [
        'creacion',
        'actualizacion'
    ];

    public $timestamps = false;

    public function submenu_enlace()
    {
        return $this->hasMany('App\SubmenuEnlace', 'menu_id', 'menu_id');
    }
}
