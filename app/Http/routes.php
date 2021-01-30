<?php

/*
*
* Rutas de aplicación
*
*/

use Mews\Captcha\Captcha;

// Sección principal
Route::group(['middleware' => ['activated']], function () {
    Route::get('/', [
        'as' => 'index',
        'uses' => 'InicioController@index'
        ]);

    Route::get('inicio', [
        'as' => 'inicio',
        'uses' => 'InicioController@index'
        ]);

    Route::get('empresa', [
        'as' => 'empresa',
        'uses' => 'EmpresaController@index'
        ]);

    Route::get('quienes-somos', [
        'as' => 'quienes_somos',
        'uses' => 'QuienesSomosController@index'
        ]);

    Route::get('servicios', [
        'as' => 'servicios',
        'uses' => 'ServiciosController@index'
        ]);

    Route::get('contacto', [
        'as' => 'contacto',
        'uses' => 'ContactoController@index'
        ]);

    Route::post('contacto/guardar-solicitud', [
        'as' => 'contacto.guardar_solicitud',
        'uses' => 'ContactoController@guardarSolicitud'
        ]);

    Route::get('ayuda', function () {
        return view('ayuda.index');
    });
});

// Sección contacto
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('contacto/administrar', [
        'as' => 'contacto.manage',
        'uses' => 'ContactoController@manage'
        ]);

    Route::get('contacto/administrar/mostrar-solicitud={correo_id}', [
        'as' => 'contacto.administrar.mostrar_solicitud',
        'uses' => 'ContactoController@mostrarSolicitud'
        ])->where(['correo_id' => '[\d]+']);

    Route::delete('contacto/administrar/borrar-solicitud={correo_id}', [
        'as' => 'contacto.administrar.borrar_solicitud',
        'uses' => 'ContactoController@borrarSolicitud'
        ])->where(['correo_id' => '[\d]+']);
});

// Sección administrar
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar', [
        'as' => 'inicio.manage',
        'uses' => 'InicioController@manage'
        ]);
});

// Sección noticias
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar/noticias', [
        'as' => 'inicio.administrar.noticias',
        'uses' => 'InicioController@noticias'
        ]);

    Route::get('inicio/administrar/crear-noticia', [
        'as' => 'inicio.administrar.crear_noticia',
        'uses' => 'InicioController@crearNoticia'
        ]);

    Route::post('inicio/administrar/guardar-noticia', [
        'as' => 'inicio.administrar.guardar_noticia',
        'uses' => 'InicioController@guardarNoticia'
        ]);

    Route::get('inicio/administrar/mostrar-noticia={noticia_id}', [
        'as' => 'inicio.administrar.mostrar_noticia',
        'uses' => 'InicioController@mostrarNoticia'
        ])->where(['noticia_id' => '[\d]+']);

    Route::get('inicio/administrar/editar-noticia={noticia_id}', [
        'as' => 'inicio.administrar.editar_noticia',
        'uses' => 'InicioController@editarNoticia'
        ])->where(['noticia_id' => '[\d]+']);

    Route::put('inicio/administrar/actualizar-noticia={noticia_id}', [
        'as' => 'inicio.administrar.actualizar_noticia',
        'uses' => 'InicioController@actualizarNoticia'
        ])->where(['noticia_id' => '[\d]+']);

    Route::delete('inicio/administrar/borrar-noticia={noticia_id}', [
        'as' => 'inicio.administrar.borrar_noticia',
        'uses' => 'InicioController@borrarNoticia'
        ])->where(['noticia_id' => '[\d]+']);
});

// Sección indicadores
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar/indicadores', [
        'as' => 'inicio.administrar.indicadores',
        'uses' => 'InicioController@indicadores'
        ]);

    Route::get('inicio/administrar/crear-indicador', [
        'as' => 'inicio.administrar.crear_indicador',
        'uses' => 'InicioController@crearIndicador'
        ]);

    Route::post('inicio/administrar/guardar-indicador', [
        'as' => 'inicio.administrar.guardar_indicador',
        'uses' => 'InicioController@guardarIndicador'
        ]);

    Route::get('inicio/administrar/editar-indicador={indicador_id}', [
        'as' => 'inicio.administrar.editar_indicador',
        'uses' => 'InicioController@editarIndicador'
        ])->where(['indicador_id' => '[\d]+']);

    Route::put('inicio/administrar/actualizar-indicador={indicador_id}', [
        'as' => 'inicio.administrar.actualizar_indicador',
        'uses' => 'InicioController@actualizarIndicador'
        ])->where(['indicador_id' => '[\d]+']);

    Route::delete('inicio/administrar/borrar-indicador={indicador_id}', [
        'as' => 'inicio.administrar.borrar_indicador',
        'uses' => 'InicioController@borrarIndicador'
        ])->where(['indicador_id' => '[\d]+']);
});

// Sección datos
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar/datos', [
        'as' => 'inicio.administrar.datos',
        'uses' => 'InicioController@datos'
        ]);

    Route::get('inicio/administrar/crear-dato', [
        'as' => 'inicio.administrar.crear_dato',
        'uses' => 'InicioController@crearDato'
        ]);

    Route::post('inicio/administrar/guardar-dato', [
        'as' => 'inicio.administrar.guardar_dato',
        'uses' => 'InicioController@guardarDato'
        ]);

    Route::get('inicio/administrar/editar-dato={dato_id}', [
        'as' => 'inicio.administrar.editar_dato',
        'uses' => 'InicioController@editarDato'
        ])->where(['dato_id' => '[\d]+']);

    Route::put('inicio/administrar/actualizar-dato={dato_id}', [
        'as' => 'inicio.administrar.actualizar_dato',
        'uses' => 'InicioController@actualizarDato'
        ])->where(['dato_id' => '[\d]+']);

    Route::delete('inicio/administrar/borrar-dato={dato_id}', [
        'as' => 'inicio.administrar.borrar_dato',
        'uses' => 'InicioController@borrarDato'
        ])->where(['dato_id' => '[\d]+']);
});

// Sección salarios
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar/salarios', [
        'as' => 'inicio.administrar.salarios',
        'uses' => 'InicioController@salarios'
        ]);

    Route::get('inicio/administrar/crear-salario', [
        'as' => 'inicio.administrar.crear_salario',
        'uses' => 'InicioController@crearSalario'
        ]);

    Route::post('inicio/administrar/guardar-salario', [
        'as' => 'inicio.administrar.guardar_salario',
        'uses' => 'InicioController@guardarSalario'
        ]);

    Route::get('inicio/administrar/editar-salario={salario_id}', [
        'as' => 'inicio.administrar.editar_salario',
        'uses' => 'InicioController@editarSalario'
        ])->where(['salario_id' => '[\d]+']);

    Route::put('inicio/administrar/actualizar-salario={salario_id}', [
        'as' => 'inicio.administrar.actualizar_salario',
        'uses' => 'InicioController@actualizarSalario'
        ])->where(['salario_id' => '[\d]+']);

    Route::delete('inicio/administrar/borrar-salario={salario_id}', [
        'as' => 'inicio.administrar.borrar_salario',
        'uses' => 'InicioController@borrarSalario'
        ])->where(['salario_id' => '[\d]+']);
});

// Sección servicios principales
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar/servicios', [
        'as' => 'inicio.administrar.servicios',
        'uses' => 'InicioController@servicios'
        ]);

    Route::get('inicio/administrar/crear-servicio', [
        'as' => 'inicio.administrar.crear_servicio',
        'uses' => 'InicioController@crearServicio'
        ]);

    Route::post('inicio/administrar/guardar-servicio', [
        'as' => 'inicio.administrar.guardar_servicio',
        'uses' => 'InicioController@guardarServicio'
        ]);

    Route::get('inicio/administrar/mostrar-servicio={servicio_id}', [
        'as' => 'inicio.administrar.mostrar_servicio',
        'uses' => 'InicioController@mostrarServicio'
        ])->where(['servicio_id' => '[\d]+']);

    Route::get('inicio/administrar/editar-servicio={servicio_id}', [
        'as' => 'inicio.administrar.editar_servicio',
        'uses' => 'InicioController@editarServicio'
        ])->where(['servicio_id' => '[\d]+']);

    Route::put('inicio/administrar/actualizar-servicio={servicio_id}', [
        'as' => 'inicio.administrar.actualizar_servicio',
        'uses' => 'InicioController@actualizarServicio'
        ])->where(['servicio_id' => '[\d]+']);

    Route::delete('inicio/administrar/borrar-servicio={servicio_id}', [
        'as' => 'inicio.administrar.borrar_servicio',
        'uses' => 'InicioController@borrarServicio'
        ])->where(['servicio_id' => '[\d]+']);
});

// Sección actualidades
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar/actualidades', [
        'as' => 'inicio.administrar.actualidades',
        'uses' => 'InicioController@actualidades'
        ]);

    Route::get('inicio/administrar/crear-actualidad', [
        'as' => 'inicio.administrar.crear_actualidad',
        'uses' => 'InicioController@crearActualidad'
        ]);

    Route::post('inicio/administrar/guardar-actualidad', [
        'as' => 'inicio.administrar.guardar_actualidad',
        'uses' => 'InicioController@guardarActualidad'
        ]);

    Route::get('inicio/administrar/editar-actualidad={actualidad_id}', [
        'as' => 'inicio.administrar.editar_actualidad',
        'uses' => 'InicioController@editarActualidad'
        ])->where(['actualidad_id' => '[\d]+']);

    Route::put('inicio/administrar/actualizar-actualidad={actualidad_id}', [
        'as' => 'inicio.administrar.actualizar_actualidad',
        'uses' => 'InicioController@actualizarActualidad'
        ])->where(['actualidad_id' => '[\d]+']);

    Route::delete('inicio/administrar/borrar-actualidad={actualidad_id}', [
        'as' => 'inicio.administrar.borrar_actualidad',
        'uses' => 'InicioController@borrarActualidad'
        ])->where(['actualidad_id' => '[\d]+']);
});

// Sección publicaciones
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar/publicaciones', [
        'as' => 'inicio.administrar.publicaciones',
        'uses' => 'InicioController@publicaciones'
        ]);

    Route::get('inicio/administrar/crear-publicacion', [
        'as' => 'inicio.administrar.crear_publicacion',
        'uses' => 'InicioController@crearPublicacion'
        ]);

    Route::post('inicio/administrar/guardar-publicacion', [
        'as' => 'inicio.administrar.guardar_publicacion',
        'uses' => 'InicioController@guardarPublicacion'
        ]);

    Route::get('inicio/administrar/editar-publicacion={publicacion_id}', [
        'as' => 'inicio.administrar.editar_publicacion',
        'uses' => 'InicioController@editarPublicacion'
        ])->where(['publicacion_id' => '[\d]+']);

    Route::put('inicio/administrar/actualizar-publicacion={publicacion_id}', [
        'as' => 'inicio.administrar.actualizar_publicacion',
        'uses' => 'InicioController@actualizarPublicacion'
        ])->where(['publicacion_id' => '[\d]+']);

    Route::delete('inicio/administrar/borrar-publicacion={publicacion_id}', [
        'as' => 'inicio.administrar.borrar_publicacion',
        'uses' => 'InicioController@borrarPublicacion'
        ])->where(['publicacion_id' => '[\d]+']);
});

// Sección publicaciones dof
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar/publicaciones-dof', [
        'as' => 'inicio.administrar.publicaciones-dof',
        'uses' => 'InicioController@publicacionesDof'
        ]);

    Route::get('inicio/administrar/crear-publicacion-dof', [
        'as' => 'inicio.administrar.crear_publicacion_dof',
        'uses' => 'InicioController@crearPublicacionDof'
        ]);

    Route::post('inicio/administrar/guardar-publicacion-dof', [
        'as' => 'inicio.administrar.guardar_publicacion_dof',
        'uses' => 'InicioController@guardarPublicacionDof'
        ]);

    Route::get('inicio/administrar/editar-publicacion-dof={publicacion_dof_id}', [
        'as' => 'inicio.administrar.editar_publicacion_dof',
        'uses' => 'InicioController@editarPublicacionDof'
        ])->where(['publicacion_dof_id' => '[\d]+']);

    Route::put('inicio/administrar/actualizar-publicacion-dof={publicacion_dof_id}', [
        'as' => 'inicio.administrar.actualizar_publicacion_dof',
        'uses' => 'InicioController@actualizarPublicacionDof'
        ])->where(['publicacion_dof_id' => '[\d]+']);

    Route::delete('inicio/administrar/borrar-publicacion-dof={publicacion_dof_id}', [
        'as' => 'inicio.administrar.borrar_publicacion_dof',
        'uses' => 'InicioController@borrarPublicacionDof'
        ])->where(['publicacion_dof_id' => '[\d]+']);
});

// Sección menú documentos y formatos
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar/seccion-documentos', [
        'as' => 'inicio.administrar.seccion_documentos',
        'uses' => 'InicioController@seccionDocumentos'
        ]);

    Route::get('inicio/administrar/crear-seccion-documentos', [
        'as' => 'inicio.administrar.crear_seccion_documentos',
        'uses' => 'InicioController@crearSeccionDocumentos'
        ]);

    Route::post('inicio/administrar/guardar-seccion-documentos', [
        'as' => 'inicio.administrar.guardar_seccion_documentos',
        'uses' => 'InicioController@guardarSeccionDocumentos'
        ]);

    Route::get('inicio/administrar/editar-seccion-documentos={menu_id}', [
        'as' => 'inicio.administrar.editar_seccion_documentos',
        'uses' => 'InicioController@editarSeccionDocumentos'
        ])->where(['menu_id' => '[\d]+']);

    Route::put('inicio/administrar/actualizar-seccion-documentos={menu_id}', [
        'as' => 'inicio.administrar.actualizar_seccion_documentos',
        'uses' => 'InicioController@actualizarSeccionDocumentos'
        ])->where(['menu_id' => '[\d]+']);

    Route::delete('inicio/administrar/borrar-seccion-documentos={menu_id}', [
        'as' => 'inicio.administrar.borrar_seccion_documentos',
        'uses' => 'InicioController@borrarSeccionDocumentos'
        ])->where(['menu_id' => '[\d]+']);
});

// Sección enlaces documentos
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar/menu={menu_id}/seccion-enlaces-documentos', [
        'as' => 'inicio.administrar.seccion_enlaces_documentos',
        'uses' => 'InicioController@seccionEnlacesDocumentos'
        ])->where(['menu_id' => '[\d]+']);

    Route::get('inicio/administrar/menu={menu_id}/crear-enlace-documentos', [
        'as' => 'inicio.administrar.crear_enlace_documentos',
        'uses' => 'InicioController@crearEnlaceDocumentos'
        ])->where(['menu_id' => '[\d]+']);

    Route::post('inicio/administrar/menu={menu_id}/guardar-enlace-documentos', [
        'as' => 'inicio.administrar.guardar_enlace_documentos',
        'uses' => 'InicioController@guardarEnlaceDocumentos'
        ]);

    Route::get('inicio/administrar/menu={menu_id}/editar-enlace-documentos={submenu_id}', [
        'as' => 'inicio.administrar.editar_enlace_documentos',
        'uses' => 'InicioController@editarEnlaceDocumentos'
        ])->where(['menu_id' => '[\d]+', 'submenu_id' => '[\d]+']);

    Route::put('inicio/administrar/menu={menu_id}/actualizar-enlace-documentos={submenu_id}', [
        'as' => 'inicio.administrar.actualizar_enlace_documentos',
        'uses' => 'InicioController@actualizarEnlaceDocumentos'
        ])->where(['menu_id' => '[\d]+', 'submenu_id' => '[\d]+']);

    Route::delete('inicio/administrar/menu={menu_id}/borrar-enlace-documentos{submenu_id}', [
        'as' => 'inicio.administrar.borrar_enlace_documentos',
        'uses' => 'InicioController@borrarEnlaceDocumentos'
        ])->where(['menu_id' => '[\d]+', 'submenu_id' => '[\d]+']);
});

// Sección enlaces de interés
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar/seccion-enlaces', [
        'as' => 'inicio.administrar.seccion_enlaces',
        'uses' => 'InicioController@seccionEnlaces'
        ]);

    Route::get('inicio/administrar/crear-seccion-enlaces', [
        'as' => 'inicio.administrar.crear_seccion_enlaces',
        'uses' => 'InicioController@crearSeccionEnlaces'
        ]);

    Route::post('inicio/administrar/guardar-seccion-enlaces', [
        'as' => 'inicio.administrar.guardar_seccion_enlaces',
        'uses' => 'InicioController@guardarSeccionEnlaces'
        ]);

    Route::get('inicio/administrar/editar-seccion_enlaces={menu_id}', [
        'as' => 'inicio.administrar.editar_seccion_enlaces',
        'uses' => 'InicioController@editarSeccionEnlaces'
        ])->where(['menu_id' => '[\d]+']);

    Route::put('inicio/administrar/actualizar-seccion_enlaces={menu_id}', [
        'as' => 'inicio.administrar.actualizar_seccion_enlaces',
        'uses' => 'InicioController@actualizarSeccionEnlaces'
        ])->where(['menu_id' => '[\d]+']);

    Route::delete('inicio/administrar/borrar-seccion_enlaces={menu_id}', [
        'as' => 'inicio.administrar.borrar_seccion_enlaces',
        'uses' => 'InicioController@borrarSeccionEnlaces'
        ])->where(['menu_id' => '[\d]+']);
});

// Sección submenú enlaces de interés
Route::group(['middleware' => ['auth', 'activated']], function () {
    Route::get('inicio/administrar/menu={menu_id}/enlaces', [
        'as' => 'inicio.administrar.enlaces',
        'uses' => 'InicioController@enlaces'
        ])->where(['menu_id' => '[\d]+']);

    Route::get('inicio/administrar/menu={menu_id}/crear-enlace', [
        'as' => 'inicio.administrar.crear_enlace',
        'uses' => 'InicioController@crearEnlace'
        ])->where(['menu_id' => '[\d]+']);

    Route::post('inicio/administrar/menu={menu_id}/guardar-enlace', [
        'as' => 'inicio.administrar.guardar_enlace',
        'uses' => 'InicioController@guardarEnlace'
        ]);

    Route::get('inicio/administrar/menu={menu_id}/editar-enlace={submenu_id}', [
        'as' => 'inicio.administrar.editar_enlace',
        'uses' => 'InicioController@editarEnlace'
        ])->where(['menu_id' => '[\d]+', 'submenu_id' => '[\d]+']);

    Route::put('inicio/administrar/menu={menu_id}/actualizar-enlace={submenu_id}', [
        'as' => 'inicio.administrar.actualizar_enlace',
        'uses' => 'InicioController@actualizarEnlace'
        ])->where(['menu_id' => '[\d]+', 'submenu_id' => '[\d]+']);

    Route::delete('inicio/administrar/menu={menu_id}/borrar-enlace={submenu_id}', [
        'as' => 'inicio.administrar.borrar_enlace',
        'uses' => 'InicioController@borrarEnlace'
        ])->where(['menu_id' => '[\d]+', 'submenu_id' => '[\d]+']);
});

// Sección ingreso, registro y recuperación
Route::get('ingresar', [
    'as' => 'ingresar.mostrar_frm_login',
    'uses' => 'Auth\AuthController@showLoginForm'
    ]);

Route::post('ingresar', [
    'as' => 'ingresar.realizar_login',
    'uses' => 'Auth\AuthController@login'
    ]);

Route::get('perfil/salir', [
    'as' => 'salir',
    'uses' => 'Auth\AuthController@logout'
    ]);

// Bloqueo registro
if (env('ALLOW_USER_REGISTRATION', true)) {
    Route::get('registro', [
        'as' => 'registro.mostrar_frm_registro',
        'uses' => 'Auth\AuthController@showRegistrationForm'
        ]);

    Route::post('registro', [
        'as' => 'registro.realizar_registro',
        'uses' => 'Auth\AuthController@register'
        ]);
} else {
    Route::match(['get','post'], 'registro', function () {
        return view('errors.404');
    });
}

// Sección perfil
Route::group(['middleware' => ['auth', 'activated']], function () {
    // Inicio
    Route::get('perfil', [
        'as' => 'perfil.index',
        'uses' => 'PerfilController@index'
    ]);

    // Alias
    Route::get('perfil/editar-alias', [
        'as' => 'perfil.editarAlias',
        'uses' => 'PerfilController@editarAlias'
    ]);

    Route::post('perfil/actualizar-alias', [
        'as' => 'perfil.actualizarAlias',
        'uses' => 'PerfilController@actualizarAlias'
    ]);

    // Correo
    Route::get('perfil/editar-correo', [
        'as' => 'perfil.editarCorreo',
        'uses' => 'PerfilController@editarCorreo'
    ]);

    Route::post('perfil/guardar-op-actualizar-correo', [
        'as' => 'perfil.guardarOpActualizarCorreo',
        'uses' => 'PerfilController@guardarOpActualizarCorreo'
    ]);

    Route::get('perfil/actualizar-correo/usuario={usuario_id}/correo={correo}/op={tipo_operacion_id}/token={token}', [
        'as' => 'perfil.actualizarCorreo',
        'uses' => 'PerfilController@actualizarCorreo'
    ]);

    // Contraseña
    Route::get('perfil/editar-contrasenia', [
        'as' => 'perfil.editarContrasenia',
        'uses' => 'PerfilController@editarContrasenia'
    ]);

    Route::post('perfil/guardar-op-actualizar-contrasenia', [
        'as' => 'perfil.guardarOpActualizarContrasenia',
        'uses' => 'PerfilController@guardarOpActualizarContrasenia'
    ]);

    Route::get('perfil/confirmar-contrasenia/usuario={usuario_id}/correo={correo}/op={tipo_operacion_id}/token={token}', [
        'as' => 'perfil.confirmarContrasenia',
        'uses' => 'PerfilController@confirmarContrasenia'
    ]);

    Route::post('perfil/actualizar-contrasenia', [
        'as' => 'perfil.actualizarContrasenia',
        'uses' => 'PerfilController@actualizarContrasenia'
    ]);

    // Borrado
    Route::get('perfil/borrar-usuario', [
        'as' => 'perfil.borrarUsuario',
        'uses' => 'PerfilController@borrarUsuario'
    ]);

    Route::post('perfil/guardar-op-eliminar-usuario', [
        'as' => 'perfil.guardarOpEliminarUsuario',
        'uses' => 'PerfilController@guardarOpEliminarUsuario'
    ]);

    Route::get('/perfil/borrar-cuenta/usuario={usuario_id}/correo={correo}/op={tipo_operacion_id}/token={token}', [
        'as' => 'perfil.eliminarUsuario',
        'uses' => 'PerfilController@eliminarUsuario'
    ]);

    // Confirmación usuario
    Route::get('perfil/guardar-op-confirmar-correo', [
        'as' => 'perfil.guardarOpConfirmarCorreo',
        'uses' => 'PerfilController@guardarOpConfirmarCorreo'
    ]);

    Route::get('perfil/confirmar-correo/usuario={usuario_id}/correo={correo}/op={tipo_operacion_id}/token={token}', [
        'as' => 'perfil.confirmarCorreo',
        'uses' => 'PerfilController@confirmarCorreo'
    ]);
});

// Reestablecer usuario
Route::get('perfil/reestablecer-usuario', [
    'as' => 'perfil.reestablecerUsuario',
    'uses' => 'PerfilController@reestablecerUsuario'
]);

Route::post('perfil/guardar-op-recuperar-usuario', [
    'as' => 'perfil.guardarOpRecuperarUsuario',
    'uses' => 'PerfilController@guardarOpRecuperarUsuario'
]);

Route::get('/perfil/recuperar-cuenta/usuario={usuario_id}/correo={correo}/op={tipo_operacion_id}/token={token}', [
    'as' => 'perfil.mostrarFrmRecuperarCuenta',
    'uses' => 'PerfilController@mostrarFrmrecuperarCuenta'
]);

Route::post('perfil/recuperar-usuario', [
    'as' => 'perfil.recuperarUsuario',
    'uses' => 'PerfilController@recuperarUsuario'
]);

// Captcha
Route::get('generar-captcha/{config?}', 
    function (Captcha $captcha, $config = 'inverse') {
        return $captcha->src($config);
    }
);
