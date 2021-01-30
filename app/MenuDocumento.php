<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuDocumento extends Model
{
    protected $table = 'menu_documentos';
    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'descripcion'
    ];

    protected $dates = [
        'creacion',
        'actualizacion'
    ];

    public $timestamps = false;

    public function submenu_documento()
    {
        return $this->hasMany('App\SubmenuDocumento', 'menu_id', 'menu_id');
    }
}
