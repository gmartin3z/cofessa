<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmenuDocumento extends Model
{
    protected $table = 'submenu_documentos';
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

    public function menu_documento()
    {
        return $this->belongsTo('App\MenuDocumento', 'menu_id', 'menu_id');
    }
}
