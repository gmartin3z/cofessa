<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use File;
use Image;
use App\MenuDocumento;
use App\SubmenuDocumento;
use App\MenuEnlace;
use App\SubmenuEnlace;

class InicioController extends Controller
{
    public function index()
    {
        $noticias = DB::table('noticias')
            ->select(
                'noticias.titulo',
                'noticias.resumen',
                'noticias.url',
                'noticias.imagen'
            )
            ->whereNotNull('noticias.noticia_id')
            ->orderBy('noticias.noticia_id', 'desc')
            ->limit(10)
            ->get();

        $indicadores = DB::table('tbl_indicadores')
            ->select(
                'tbl_indicadores.indicador_id',
                'tbl_indicadores.descripcion',
                'tbl_indicadores.valor'
            )
            ->whereNotNull('tbl_indicadores.indicador_id')
            ->orderBy('tbl_indicadores.indicador_id', 'asc')
            ->limit(10)
            ->get();

        $datos = DB::table('tbl_datos')
            ->select(
                'tbl_datos.dato_id',
                'tbl_datos.descripcion',
                'tbl_datos.publicacion',
                'tbl_datos.valor'
            )
            ->whereNotNull('tbl_datos.dato_id')
            ->orderBy('tbl_datos.dato_id', 'asc')
            ->limit(10)
            ->get();

        $salarios = DB::table('tbl_salarios')
            ->select(
                'tbl_salarios.salario_id',
                'tbl_salarios.vigencia',
                'tbl_salarios.valor_a',
                'tbl_salarios.valor_b'
            )
            ->whereNotNull('tbl_salarios.salario_id')
            ->orderBy('tbl_salarios.salario_id', 'asc')
            ->limit(10)
            ->get();

        $servicios = DB::table('servicios')
            ->select(
                'servicios.resumen',
                'servicios.url',
                'servicios.imagen'
            )
            ->whereNotNull('servicios.servicio_id')
            ->orderBy('servicios.servicio_id', 'desc')
            ->limit(10)
            ->get();

        $actualidades = DB::table('urls_actualidades')
            ->select(
                'urls_actualidades.actualidad_id',
                'urls_actualidades.descripcion',
                'urls_actualidades.url'
            )
            ->whereNotNull('urls_actualidades.actualidad_id')
            ->orderBy('urls_actualidades.actualidad_id', 'asc')
            ->limit(5)
            ->get();

        $publicaciones = DB::table('urls_publicaciones')
            ->select(
                'urls_publicaciones.publicacion_id',
                'urls_publicaciones.descripcion',
                'urls_publicaciones.url'
            )
            ->whereNotNull('urls_publicaciones.publicacion_id')
            ->orderBy('urls_publicaciones.publicacion_id', 'asc')
            ->limit(5)
            ->get();

        $publicaciones_dof = DB::table('urls_publicaciones_dof')
            ->select(
                'urls_publicaciones_dof.publicacion_dof_id',
                'urls_publicaciones_dof.descripcion',
                'urls_publicaciones_dof.url'
            )
            ->whereNotNull('urls_publicaciones_dof.publicacion_dof_id')
            ->orderBy('urls_publicaciones_dof.publicacion_dof_id', 'asc')
            ->limit(5)
            ->get();

        $menu_documentos = MenuDocumento::select(
            'menu_documentos.menu_id',
            'menu_documentos.descripcion'
        )
        ->with(
            ['submenu_documento' => function ($query) {
                $query->select(
                    'submenu_documentos.menu_id',
                    'submenu_documentos.descripcion',
                    'submenu_documentos.url'
                );
            }]
        )
        ->orderBy('menu_documentos.menu_id', 'asc')
        ->get();

        $menu_enlaces = MenuEnlace::select(
            'menu_enlaces_interes.menu_id',
            'menu_enlaces_interes.descripcion'
        )
        ->with(
            ['submenu_enlace' => function ($query) {
                $query->select(
                    'submenu_enlaces_interes.menu_id',
                    'submenu_enlaces_interes.descripcion',
                    'submenu_enlaces_interes.url'
                );
            }]
        )
        ->orderBy('menu_enlaces_interes.menu_id', 'asc')
        ->get();

        return View(
            'inicio.index',
            compact(
                'noticias',
                'indicadores',
                'datos',
                'salarios',
                'servicios',
                'actualidades',
                'publicaciones',
                'publicaciones_dof',
                'menu_documentos',
                'menu_enlaces'
            )
        );
    }

    public function manage()
    {
        return View('inicio.manage');
    }

    public function noticias()
    {
        $noticias = DB::table('noticias')
            ->select(
                'noticias.noticia_id',
                'noticias.titulo',
                'noticias.resumen',
                'noticias.url'
            )
            ->whereNotNull('noticias.noticia_id')
            ->orderBy('noticias.noticia_id', 'desc')
            ->paginate(10);

        return View(
            'inicio.administrar_noticias',
            compact(
                'noticias'
            )
        );
    }

    public function crearNoticia()
    {
        return View('inicio.crear_noticia');
    }

    public function guardarNoticia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detalle_titulo' => 'required|min:6|max:200',
            'detalle_resumen' => 'required|max:2000',
            'detalle_url' => 'required|url|min:14|max:255',
            'detalle_imagen' => 'required|image'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        if ($request->hasFile('detalle_imagen')) {
            $dir_original = public_path('uploads/imgs_noticias/');
            $dir_greyscale_original = public_path('uploads/imgs_noticias/greyscale/');

            $imagen_nueva = $request->file('detalle_imagen');
            $nombre = '1-'.time().'.'.$imagen_nueva->getClientOriginalExtension();
            $destino = $dir_original;
            $imagen_nueva->move($destino, $nombre);

            $img = Image::make($dir_original.$nombre);
            $img->greyscale();
            $img->brightness(60);
            $img->save($dir_greyscale_original.$nombre);
        }

        $operacion = DB::table('noticias')
            ->insert([
                'titulo' => $request->detalle_titulo,
                'resumen' => $request->detalle_resumen,
                'url' => $request->detalle_url,
                'imagen' => $nombre,
                'creacion' => date("Y-m-d H:i:s"),
                'creado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.noticias')
            ->with('success', 'Registro guardado correctamente');
    }

    public function mostrarNoticia($noticia_id)
    {
        $noticia = DB::table('noticias')
            ->select(
                'noticias.noticia_id',
                'noticias.titulo',
                'noticias.resumen',
                'noticias.url',
                'noticias.imagen'
            )
            ->where('noticias.noticia_id', $noticia_id)
            ->whereNotNull('noticias.noticia_id')
            ->orderBy('noticias.noticia_id', 'asc')
            ->first();

        return View(
            'inicio.mostrar_noticia',
            compact(
                'noticia'
            )
        );
    }

    public function editarNoticia($noticia_id)
    {
        $noticia = DB::table('noticias')
            ->select(
                'noticias.noticia_id',
                'noticias.titulo',
                'noticias.resumen',
                'noticias.url',
                'noticias.imagen'
            )
            ->where('noticias.noticia_id', $noticia_id)
            ->whereNotNull('noticias.noticia_id')
            ->orderBy('noticias.noticia_id', 'asc')
            ->first();

        return View(
            'inicio.editar_noticia',
            compact(
                'noticia'
            )
        );
    }

    public function actualizarNoticia(Request $request, $noticia_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_titulo' => 'required|min:6|max:200',
            'detalle_resumen' => 'required|max:200',
            'detalle_url' => 'required|url|min:14|max:255',
            'detalle_imagen' => 'image'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $imagen_previa = DB::table('noticias')
            ->select(
                'noticias.noticia_id',
                'noticias.imagen'
            )
            ->where('noticias.noticia_id', $noticia_id)
            ->whereNotNull('noticias.noticia_id')
            ->orderBy('noticias.noticia_id', 'asc')
            ->first();

        if ($request->hasFile('detalle_imagen')) {
            $dir_original = public_path('uploads/imgs_noticias/');
            $dir_greyscale_original = public_path('uploads/imgs_noticias/greyscale/');

            if ($imagen_previa->imagen != '' && File::exists($dir_original.$imagen_previa->imagen)) {
                File::delete($dir_original.$imagen_previa->imagen);
                File::delete($dir_greyscale_original.$imagen_previa->imagen);
            }

            $imagen_nueva = $request->file('detalle_imagen');
            $nombre = '1-'.time().'.'.$imagen_nueva->getClientOriginalExtension();
            $destino = $dir_original;
            $imagen_nueva->move($destino, $nombre);

            $img = Image::make($dir_original.$nombre);
            $img->greyscale();
            $img->brightness(60);
            $img->save($dir_greyscale_original.$nombre);
        } else {
            $nombre = $imagen_previa->imagen;
        }

        $operacion = DB::table('noticias')
            ->where('noticia_id', $imagen_previa->noticia_id)
            ->update([
                'titulo' => $request->detalle_titulo,
                'resumen' => $request->detalle_resumen,
                'url' => $request->detalle_url,
                'imagen' => $nombre,
                'actualizacion' => date("Y-m-d H:i:s"),
                'actualizado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.noticias')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function borrarNoticia($noticia_id)
    {
        $imagen_previa = DB::table('noticias')
            ->select(
                'noticias.noticia_id',
                'noticias.imagen'
            )
            ->where('noticias.noticia_id', $noticia_id)
            ->whereNotNull('noticias.noticia_id')
            ->orderBy('noticias.noticia_id', 'asc')
            ->first();

        $dir_original = public_path('uploads/imgs_noticias/');
        $dir_greyscale_original = public_path('uploads/imgs_noticias/greyscale/');

        if ($imagen_previa->imagen != '' && File::exists($dir_original.$imagen_previa->imagen)) {
            File::delete($dir_original.$imagen_previa->imagen);
            File::delete($dir_greyscale_original.$imagen_previa->imagen);
        }

        $operacion = DB::table('noticias')
            ->where('noticias.noticia_id', $imagen_previa->noticia_id)
            ->delete();

        return redirect()
            ->route('inicio.administrar.noticias')
            ->with('success', 'Registro borrado correctamente');
    }

    public function indicadores()
    {
        $indicadores = DB::table('tbl_indicadores')
            ->select(
                'tbl_indicadores.indicador_id',
                'tbl_indicadores.descripcion',
                'tbl_indicadores.valor'
            )
            ->whereNotNull('tbl_indicadores.indicador_id')
            ->orderBy('tbl_indicadores.indicador_id', 'desc')
            ->paginate(10);

        return View(
            'inicio.administrar_indicadores',
            compact(
                'indicadores'
            )
        );
    }

    public function crearIndicador()
    {
        return View('inicio.crear_indicador');
    }

    public function guardarIndicador(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_valor' => 'required|max:200'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('tbl_indicadores')
            ->insert([
                'descripcion' => $request->detalle_descripcion,
                'valor' => $request->detalle_valor,
                'creacion' => date("Y-m-d H:i:s"),
                'creado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.indicadores')
            ->with('success', 'Registro guardado correctamente');
    }

    public function editarIndicador($indicador_id)
    {
        $indicador = DB::table('tbl_indicadores')
            ->select(
                'tbl_indicadores.indicador_id',
                'tbl_indicadores.descripcion',
                'tbl_indicadores.valor'
            )
            ->where('tbl_indicadores.indicador_id', $indicador_id)
            ->whereNotNull('tbl_indicadores.indicador_id')
            ->orderBy('tbl_indicadores.indicador_id', 'asc')
            ->first();

        return View(
            'inicio.editar_indicador',
            compact(
                'indicador'
            )
        );
    }

    public function actualizarIndicador(Request $request, $indicador_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_valor' => 'required|max:200'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('tbl_indicadores')
            ->where('tbl_indicadores.indicador_id', $indicador_id)
            ->update([
                'descripcion' => $request->detalle_descripcion,
                'valor' => $request->detalle_valor,
                'actualizacion' => date("Y-m-d H:i:s"),
                'actualizado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.indicadores')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function borrarIndicador($indicador_id)
    {
        $operacion = DB::table('tbl_indicadores')
            ->where('indicador_id', $indicador_id)
            ->delete();

        return redirect()
            ->route('inicio.administrar.indicadores')
            ->with('success', 'Registro borrado correctamente');
    }

    public function datos()
    {
        $datos = DB::table('tbl_datos')
            ->select(
                'tbl_datos.dato_id',
                'tbl_datos.descripcion',
                'tbl_datos.publicacion',
                'tbl_datos.valor'
            )
            ->whereNotNull('tbl_datos.dato_id')
            ->orderBy('tbl_datos.dato_id', 'desc')
            ->paginate(10);

        return View(
            'inicio.administrar_datos',
            compact(
                'datos'
            )
        );
    }

    public function crearDato()
    {
        return View('inicio.crear_dato');
    }

    public function guardarDato(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_valor' => 'required|max:200',
            'detalle_publicacion' => 'required|max:200'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('tbl_datos')
            ->insert([
                'descripcion' => $request->detalle_descripcion,
                'valor' => $request->detalle_valor,
                'publicacion' => $request->detalle_publicacion,
                'creacion' => date("Y-m-d H:i:s"),
                'creado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.datos')
            ->with('success', 'Registro guardado correctamente');
    }

    public function editarDato($dato_id)
    {
        $dato = DB::table('tbl_datos')
            ->select(
                'tbl_datos.dato_id',
                'tbl_datos.descripcion',
                'tbl_datos.valor',
                'tbl_datos.publicacion'
            )
            ->where('tbl_datos.dato_id', $dato_id)
            ->whereNotNull('tbl_datos.dato_id')
            ->orderBy('tbl_datos.dato_id', 'asc')
            ->first();

        return View(
            'inicio.editar_dato',
            compact(
                'dato'
            )
        );
    }

    public function actualizarDato(Request $request, $dato_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_valor' => 'required|max:200',
            'detalle_publicacion' => 'required|max:200'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('tbl_datos')
            ->where('tbl_datos.dato_id', $dato_id)
            ->update([
                'descripcion' => $request->detalle_descripcion,
                'valor' => $request->detalle_valor,
                'publicacion' => $request->detalle_publicacion,
                'actualizacion' => date("Y-m-d H:i:s"),
                'actualizado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.datos')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function borrarDato($dato_id)
    {
        $operacion = DB::table('tbl_datos')
            ->where('tbl_datos.dato_id', $dato_id)
            ->delete();

        return redirect()
            ->route('inicio.administrar.datos')
            ->with('success', 'Registro borrado correctamente');
    }

    public function salarios()
    {
        $salarios = DB::table('tbl_salarios')
            ->select(
                'tbl_salarios.salario_id',
                'tbl_salarios.vigencia',
                'tbl_salarios.valor_a',
                'tbl_salarios.valor_b'
            )
            ->whereNotNull('tbl_salarios.salario_id')
            ->orderBy('tbl_salarios.salario_id', 'desc')
            ->paginate(10);

        return View(
            'inicio.administrar_salarios',
            compact(
                'salarios'
            )
        );
    }

    public function crearSalario()
    {
        return View('inicio.crear_salario');
    }

    public function guardarSalario(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detalle_vigencia' => 'required|min:6|max:20',
            'detalle_valor_a' => 'required|max:20',
            'detalle_valor_b' => 'required|max:20'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('tbl_salarios')
            ->insert([
                'vigencia' => $request->detalle_vigencia,
                'valor_a' => $request->detalle_valor_a,
                'valor_b' => $request->detalle_valor_b,
                'creacion' => date("Y-m-d H:i:s"),
                'creado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.salarios')
            ->with('success', 'Registro guardado correctamente');
    }

    public function editarSalario($salario_id)
    {
        $salario = DB::table('tbl_salarios')
            ->select(
                'tbl_salarios.salario_id',
                'tbl_salarios.vigencia',
                'tbl_salarios.valor_a',
                'tbl_salarios.valor_b'
            )
            ->where('tbl_salarios.salario_id', $salario_id)
            ->whereNotNull('tbl_salarios.salario_id')
            ->orderBy('tbl_salarios.salario_id', 'asc')
            ->first();

        return View(
            'inicio.editar_salario',
            compact(
                'salario'
            )
        );
    }

    public function actualizarSalario(Request $request, $salario_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_vigencia' => 'required|min:6|max:20',
            'detalle_valor_a' => 'required|max:20',
            'detalle_valor_b' => 'required|max:20'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('tbl_salarios')
            ->where('tbl_salarios.salario_id', $salario_id)
            ->update([
                'vigencia' => $request->detalle_vigencia,
                'valor_a' => $request->detalle_valor_a,
                'valor_b' => $request->detalle_valor_b,
                'actualizacion' => date("Y-m-d H:i:s"),
                'actualizado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.salarios')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function borrarSalario($salario_id)
    {
        $operacion = DB::table('tbl_salarios')
            ->where('tbl_salarios.salario_id', $salario_id)
            ->delete();

        return redirect()
            ->route('inicio.administrar.salarios')
            ->with('success', 'Registro borrado correctamente');
    }

    public function servicios()
    {
        $servicios = DB::table('servicios')
            ->select(
                'servicios.servicio_id',
                'servicios.resumen',
                'servicios.url'
            )
            ->whereNotNull('servicios.servicio_id')
            ->orderBy('servicios.servicio_id', 'desc')
            ->paginate(10);

        return View(
            'inicio.administrar_servicios',
            compact(
                'servicios'
            )
        );
    }

    public function crearServicio()
    {
        return View('inicio.crear_servicio');
    }

    public function guardarServicio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detalle_resumen' => 'required|max:100',
            'detalle_url' => 'required|url|min:14|max:255',
            'detalle_imagen' => 'required|image'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        if ($request->hasFile('detalle_imagen')) {
            $dir_imgs_servicios = public_path('uploads/imgs_servicios/');

            $imagen_nueva = $request->file('detalle_imagen');
            $nombre = '1-'.time().'.'.$imagen_nueva->getClientOriginalExtension();
            $destino = $dir_imgs_servicios;
            $imagen_nueva->move($destino, $nombre);
        }

        $operacion = DB::table('servicios')
            ->insert([
                'resumen' => $request->detalle_resumen,
                'url' => $request->detalle_url,
                'imagen' => $nombre,
                'creacion' => date("Y-m-d H:i:s"),
                'creado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.servicios')
            ->with('success', 'Registro guardado correctamente');
    }

    public function mostrarServicio($servicio_id)
    {
        $servicio = DB::table('servicios')
            ->select(
                'servicios.servicio_id',
                'servicios.resumen',
                'servicios.url',
                'servicios.imagen'
            )
            ->where('servicios.servicio_id', $servicio_id)
            ->whereNotNull('servicios.servicio_id')
            ->orderBy('servicios.servicio_id', 'asc')
            ->first();

        return View(
            'inicio.mostrar_servicio',
            compact(
                'servicio'
            )
        );
    }

    public function editarServicio($servicio_id)
    {
        $servicio = DB::table('servicios')
            ->select(
                'servicios.servicio_id',
                'servicios.resumen',
                'servicios.url',
                'servicios.imagen'
            )
            ->where('servicios.servicio_id', $servicio_id)
            ->whereNotNull('servicios.servicio_id')
            ->orderBy('servicios.servicio_id', 'asc')
            ->first();

        return View(
            'inicio.editar_servicio',
            compact(
                'servicio'
            )
        );
    }

    public function actualizarServicio(Request $request, $servicio_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_resumen' => 'required|max:100',
            'detalle_url' => 'required|url|min:14|max:255',
            'detalle_imagen' => 'image'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $imagen_previa = DB::table('servicios')
            ->select(
                'servicios.servicio_id',
                'servicios.imagen'
            )
            ->where('servicios.servicio_id', $servicio_id)
            ->whereNotNull('servicios.servicio_id')
            ->orderBy('servicios.servicio_id', 'desc')
            ->first();

        if ($request->hasFile('detalle_imagen')) {
            $dir_original = public_path('uploads/imgs_servicios/');

            if ($imagen_previa->imagen != '' && File::exists($dir_original.$imagen_previa->imagen)) {
                File::delete($dir_original.$imagen_previa->imagen);
            }

            $imagen_nueva = $request->file('detalle_imagen');
            $nombre = '1-'.time().'.'.$imagen_nueva->getClientOriginalExtension();
            $destino = $dir_original;
            $imagen_nueva->move($destino, $nombre);
        } else {
            $nombre = $imagen_previa->imagen;
        }

        $operacion = DB::table('servicios')
            ->where('servicio_id', $imagen_previa->servicio_id)
            ->update([
                'resumen' => $request->detalle_resumen,
                'url' => $request->detalle_url,
                'imagen' => $nombre,
                'actualizacion' => date("Y-m-d H:i:s"),
                'actualizado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.servicios')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function borrarServicio($servicio_id)
    {
        $imagen_previa = DB::table('servicios')
            ->select(
                'servicios.servicio_id',
                'servicios.imagen'
            )
            ->where('servicios.servicio_id', $servicio_id)
            ->whereNotNull('servicios.servicio_id')
            ->orderBy('servicios.servicio_id', 'desc')
            ->first();

        $dir_original = public_path('uploads/imgs_servicios/');

        if ($imagen_previa->imagen != '' && File::exists($dir_original.$imagen_previa->imagen)) {
            File::delete($dir_original.$imagen_previa->imagen);
        }

        $operacion = DB::table('servicios')
            ->where('servicios.servicio_id', $imagen_previa->servicio_id)
            ->delete();

        return redirect()
            ->route('inicio.administrar.servicios')
            ->with('success', 'Registro borrado correctamente');
    }

    public function actualidades()
    {
        $actualidades = DB::table('urls_actualidades')
            ->select(
                'urls_actualidades.actualidad_id',
                'urls_actualidades.descripcion',
                'urls_actualidades.url'
            )
            ->whereNotNull('urls_actualidades.actualidad_id')
            ->orderBy('urls_actualidades.actualidad_id', 'desc')
            ->paginate(10);

        return View(
            'inicio.administrar_actualidades',
            compact(
                'actualidades'
            )
        );
    }

    public function crearActualidad()
    {
        return View('inicio.crear_actualidad');
    }

    public function guardarActualidad(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('urls_actualidades')
            ->insert([
                'descripcion' => $request->detalle_descripcion,
                'url' => $request->detalle_url,
                'creacion' => date("Y-m-d H:i:s"),
                'creado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.actualidades')
            ->with('success', 'Registro guardado correctamente');
    }

    public function editarActualidad($actualidad_id)
    {
        $actualidad = DB::table('urls_actualidades')
            ->select(
                'urls_actualidades.actualidad_id',
                'urls_actualidades.descripcion',
                'urls_actualidades.url'
            )
            ->where('urls_actualidades.actualidad_id', $actualidad_id)
            ->whereNotNull('urls_actualidades.actualidad_id')
            ->orderBy('urls_actualidades.actualidad_id', 'asc')
            ->first();

        return View(
            'inicio.editar_actualidad',
            compact(
                'actualidad'
            )
        );
    }

    public function actualizarActualidad(Request $request, $actualidad_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('urls_actualidades')
            ->where('urls_actualidades.actualidad_id', $actualidad_id)
            ->update([
                'descripcion' => $request->detalle_descripcion,
                'url' => $request->detalle_url,
                'actualizacion' => date("Y-m-d H:i:s"),
                'actualizado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.actualidades')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function borrarActualidad($actualidad_id)
    {
        $operacion = DB::table('urls_actualidades')
            ->where('urls_actualidades.actualidad_id', $actualidad_id)
            ->delete();

        return redirect()
            ->route('inicio.administrar.actualidades')
            ->with('success', 'Registro borrado correctamente');
    }

    public function publicaciones()
    {
        $publicaciones = DB::table('urls_publicaciones')
            ->select(
                'urls_publicaciones.publicacion_id',
                'urls_publicaciones.descripcion',
                'urls_publicaciones.url'
            )
            ->whereNotNull('urls_publicaciones.publicacion_id')
            ->orderBy('urls_publicaciones.publicacion_id', 'desc')
            ->paginate(10);
            
        return View(
            'inicio.administrar_publicaciones',
            compact(
                'publicaciones'
            )
        );
    }

    public function crearPublicacion()
    {
        return View('inicio.crear_publicacion');
    }

    public function guardarPublicacion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('urls_publicaciones')
            ->insert([
                'descripcion' => $request->detalle_descripcion,
                'url' => $request->detalle_url,
                'creacion' => date("Y-m-d H:i:s"),
                'creado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.publicaciones')
            ->with('success', 'Registro guardado correctamente');
    }

    public function editarPublicacion($publicacion_id)
    {
        $publicacion = DB::table('urls_publicaciones')
            ->select(
                'urls_publicaciones.publicacion_id',
                'urls_publicaciones.descripcion',
                'urls_publicaciones.url'
            )
            ->where('urls_publicaciones.publicacion_id', $publicacion_id)
            ->whereNotNull('urls_publicaciones.publicacion_id')
            ->orderBy('urls_publicaciones.publicacion_id', 'asc')
            ->first();

        return View(
            'inicio.editar_publicacion',
            compact(
                'publicacion'
            )
        );
    }

    public function actualizarPublicacion(Request $request, $publicacion_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('urls_publicaciones')
            ->where('urls_publicaciones.publicacion_id', $publicacion_id)
            ->update([
                'descripcion' => $request->detalle_descripcion,
                'url' => $request->detalle_url,
                'actualizacion' => date("Y-m-d H:i:s"),
                'actualizado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.publicaciones')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function borrarPublicacion($publicacion_id)
    {
        $operacion = DB::table('urls_publicaciones')
            ->where('urls_publicaciones.publicacion_id', $publicacion_id)
            ->delete();

        return redirect()
            ->route('inicio.administrar.publicaciones')
            ->with('success', 'Registro borrado correctamente');
    }

    public function publicacionesDof()
    {
        $publicaciones_dof = DB::table('urls_publicaciones_dof')
            ->select(
                'urls_publicaciones_dof.publicacion_dof_id',
                'urls_publicaciones_dof.descripcion',
                'urls_publicaciones_dof.url'
            )
            ->whereNotNull('urls_publicaciones_dof.publicacion_dof_id')
            ->orderBy('urls_publicaciones_dof.publicacion_dof_id', 'desc')
            ->paginate(10);

        return View(
            'inicio.administrar_publicaciones_dof',
            compact(
                'publicaciones_dof'
            )
        );
    }

    public function crearPublicacionDof()
    {
        return View('inicio.crear_publicacion_dof');
    }

    public function guardarPublicacionDof(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('urls_publicaciones_dof')
            ->insert([
                'descripcion' => $request->detalle_descripcion,
                'url' => $request->detalle_url,
                'creacion' => date("Y-m-d H:i:s"),
                'creado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.publicaciones-dof')
            ->with('success', 'Registro guardado correctamente');
    }

    public function editarPublicacionDof($publicacion_dof_id)
    {
        $publicacion_dof = DB::table('urls_publicaciones_dof')
            ->select(
                'urls_publicaciones_dof.publicacion_dof_id',
                'urls_publicaciones_dof.descripcion',
                'urls_publicaciones_dof.url'
            )
            ->where('urls_publicaciones_dof.publicacion_dof_id', $publicacion_dof_id)
            ->whereNotNull('urls_publicaciones_dof.publicacion_dof_id')
            ->orderBy('urls_publicaciones_dof.publicacion_dof_id', 'asc')
            ->first();

        return View(
            'inicio.editar_publicacion_dof',
            compact(
                'publicacion_dof'
            )
        );
    }

    public function actualizarPublicacionDof(Request $request, $publicacion_dof_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('urls_publicaciones_dof')
            ->where('urls_publicaciones_dof.publicacion_dof_id', $publicacion_dof_id)
            ->update([
                'descripcion' => $request->detalle_descripcion,
                'url' => $request->detalle_url,
                'actualizacion' => date("Y-m-d H:i:s"),
                'actualizado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.publicaciones-dof')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function borrarPublicacionDof($publicacion_dof_id)
    {
        $operacion = DB::table('urls_publicaciones_dof')
            ->where('urls_publicaciones_dof.publicacion_dof_id', $publicacion_dof_id)
            ->delete();

        return redirect()
            ->route('inicio.administrar.publicaciones-dof')
            ->with('success', 'Registro borrado correctamente');
    }

    public function seccionDocumentos()
    {
        $menu_documentos = DB::table('menu_documentos')
            ->select(
                'menu_documentos.menu_id',
                'menu_documentos.descripcion'
            )
            ->whereNotNull('menu_documentos.menu_id')
            ->orderBy('menu_documentos.menu_id', 'desc')
            ->paginate(10);

        return View(
            'inicio.administrar_seccion_documentos',
            compact(
                'menu_documentos'
            )
        );
    }

    public function crearSeccionDocumentos()
    {
        return View('inicio.crear_seccion_documentos');
    }

    public function guardarSeccionDocumentos(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('menu_documentos')
            ->insert([
                'descripcion' => $request->detalle_descripcion,
                'creacion' => date("Y-m-d H:i:s"),
                'creado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.seccion_documentos')
            ->with('success', 'Registro guardado correctamente');
    }

    public function editarSeccionDocumentos($menu_id)
    {
        $menu_documento = DB::table('menu_documentos')
            ->select(
                'menu_documentos.menu_id',
                'menu_documentos.descripcion'
            )
            ->where('menu_documentos.menu_id', $menu_id)
            ->whereNotNull('menu_documentos.menu_id')
            ->orderBy('menu_documentos.menu_id', 'asc')
            ->first();

        return View(
            'inicio.editar_seccion_documentos',
            compact(
                'menu_documento'
            )
        );
    }

    public function actualizarSeccionDocumentos(Request $request, $menu_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('menu_documentos')
            ->where('menu_documentos.menu_id', $menu_id)
            ->update([
                'descripcion' => $request->detalle_descripcion,
                'actualizacion' => date("Y-m-d H:i:s"),
                'actualizado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.seccion_documentos')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function borrarSeccionDocumentos($menu_id)
    {
        $enlaces = DB::table('submenu_documentos')
            ->where('submenu_documentos.menu_id', $menu_id)
            ->count();

        if ($enlaces >= 1) {
            return redirect()
                ->route('inicio.administrar.seccion_documentos')
                ->with('warning', 'Primero borre los enlaces de ese menú y luego reintente');
        }

        $operacion = DB::table('menu_documentos')
            ->where('menu_documentos.menu_id', $menu_id)
            ->delete();

        return redirect()
            ->route('inicio.administrar.seccion_documentos')
            ->with('success', 'Registro borrado correctamente');
    }

    public function seccionEnlacesDocumentos($menu_id)
    {
        $submenu_documentos = DB::table('menu_documentos')
            ->select(
                'submenu_documentos.submenu_id',
                'menu_documentos.menu_id',
                'submenu_documentos.descripcion as submenu_descripcion',
                'submenu_documentos.url',
                'menu_documentos.descripcion as menu_descripcion'
            )
            ->leftJoin(
                'submenu_documentos',
                'menu_documentos.menu_id',
                '=',
                'submenu_documentos.menu_id'
            )
            ->whereNotNull('menu_documentos.menu_id')
            ->where('menu_documentos.menu_id', $menu_id)
            ->orderBy('submenu_documentos.submenu_id', 'desc')
            ->paginate(10);

        $menu_documento = $submenu_documentos->first();
        // se accede igual de este modo
        // $menu_documento = $submenu_documentos->first()->submenu_id;

        return View(
            'inicio.administrar_enlaces_documentos',
            compact(
                'submenu_documentos',
                'menu_documento'
            )
        );
    }

    public function crearEnlaceDocumentos($menu_id)
    {
        $menu_documentos_id = $menu_id;

        return View(
            'inicio.crear_enlace_documentos',
            compact(
                'menu_documentos_id'
            )
        );
    }

    public function guardarEnlaceDocumentos(Request $request, $menu_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('submenu_documentos')
            ->insert([
                'menu_id' => $menu_id,
                'descripcion' => $request->detalle_descripcion,
                'url' => $request->detalle_url,
                'creacion' => date("Y-m-d H:i:s"),
                'creado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route(
                'inicio.administrar.seccion_enlaces_documentos',
                compact(
                    'menu_id'
                )
            )
            ->with('success', 'Registro guardado correctamente');
    }

    public function editarEnlaceDocumentos($menu_id, $submenu_id)
    {
        $submenu_documento = DB::table('submenu_documentos')
            ->select(
                'submenu_documentos.submenu_id',
                'submenu_documentos.menu_id',
                'submenu_documentos.descripcion as submenu_descripcion',
                'submenu_documentos.url',
                'menu_documentos.descripcion as menu_descripcion'
            )
            ->join(
                'menu_documentos',
                'submenu_documentos.menu_id',
                '=',
                'menu_documentos.menu_id'
            )
            ->where('submenu_documentos.submenu_id', $submenu_id)
            ->where('submenu_documentos.menu_id', $menu_id)
            ->whereNotNull('submenu_documentos.menu_id')
            ->orderBy('submenu_documentos.menu_id', 'asc')
            ->first();

        return View(
            'inicio.editar_enlace_documentos',
            compact(
                'submenu_documento'
            )
        );
    }

    public function actualizarEnlaceDocumentos(Request $request, $menu_id, $submenu_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('submenu_documentos')
            ->where('submenu_documentos.submenu_id', $submenu_id)
            ->update([
                'descripcion' => $request->detalle_descripcion,
                'url' => $request->detalle_url,
                'actualizacion' => date("Y-m-d H:i:s"),
                'actualizado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route(
                'inicio.administrar.seccion_enlaces_documentos',
                compact(
                    'menu_id'
                )
            )
            ->with('success', 'Registro actualizado correctamente');
    }

    public function borrarEnlaceDocumentos($menu_id, $submenu_id)
    {
        $operacion = DB::table('submenu_documentos')
            ->where('submenu_documentos.menu_id', $menu_id)
            ->where('submenu_documentos.submenu_id', $submenu_id)
            ->delete();

        return redirect()
            ->route(
                'inicio.administrar.seccion_enlaces_documentos',
                compact(
                    'menu_id'
                )
            )
            ->with('success', 'Registro borrado correctamente');
    }

    public function seccionEnlaces()
    {
        $menu_enlaces = DB::table('menu_enlaces_interes')
            ->select(
                'menu_enlaces_interes.menu_id',
                'menu_enlaces_interes.descripcion'
            )
            ->whereNotNull('menu_enlaces_interes.menu_id')
            ->orderBy('menu_enlaces_interes.menu_id', 'desc')
            ->paginate(10);

        return View(
            'inicio.administrar_seccion_enlaces',
            compact(
                'menu_enlaces'
            )
        );
    }

    public function crearSeccionEnlaces()
    {
        return View('inicio.crear_seccion_enlaces');
    }

    public function guardarSeccionEnlaces(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('menu_enlaces_interes')
            ->insert([
                'descripcion' => $request->detalle_descripcion,
                'creacion' => date("Y-m-d H:i:s"),
                'creado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.seccion_enlaces')
            ->with('success', 'Registro guardado correctamente');
    }

    public function editarSeccionEnlaces($menu_id)
    {
        $menu_enlace = DB::table('menu_enlaces_interes')
            ->select(
                'menu_enlaces_interes.menu_id',
                'menu_enlaces_interes.descripcion'
            )
            ->where('menu_enlaces_interes.menu_id', $menu_id)
            ->whereNotNull('menu_enlaces_interes.menu_id')
            ->orderBy('menu_enlaces_interes.menu_id', 'asc')
            ->first();

        return View(
            'inicio.editar_seccion_enlaces',
            compact(
                'menu_enlace'
            )
        );
    }

    public function actualizarSeccionEnlaces(Request $request, $menu_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('menu_enlaces_interes')
            ->where('menu_enlaces_interes.menu_id', $menu_id)
            ->update([
                'descripcion' => $request->detalle_descripcion,
                'actualizacion' => date("Y-m-d H:i:s"),
                'actualizado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route('inicio.administrar.seccion_enlaces')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function borrarSeccionEnlaces($menu_id)
    {
        $enlaces = DB::table('submenu_enlaces_interes')
            ->where('submenu_enlaces_interes.menu_id', $menu_id)
            ->count();

        if ($enlaces >= 1) {
            return redirect()
                ->route('inicio.administrar.seccion_enlaces')
                ->with('warning', 'Primero borre los enlaces de ese menú y luego reintente');
        }

        $operacion = DB::table('menu_enlaces_interes')
            ->where('menu_enlaces_interes.menu_id', $menu_id)
            ->delete();

        return redirect()
            ->route('inicio.administrar.seccion_enlaces')
            ->with('success', 'Registro borrado correctamente');
    }

    public function enlaces($menu_id)
    {
        $submenu_enlaces = DB::table('menu_enlaces_interes')
            ->select(
                'submenu_enlaces_interes.submenu_id',
                'menu_enlaces_interes.menu_id',
                'submenu_enlaces_interes.descripcion as submenu_descripcion',
                'submenu_enlaces_interes.url',
                'menu_enlaces_interes.descripcion as menu_descripcion'
            )
            ->leftJoin(
                'submenu_enlaces_interes',
                'menu_enlaces_interes.menu_id',
                '=',
                'submenu_enlaces_interes.menu_id'
            )
            ->whereNotNull('menu_enlaces_interes.menu_id')
            ->where('menu_enlaces_interes.menu_id', $menu_id)
            ->orderBy('submenu_enlaces_interes.submenu_id', 'desc')
            ->paginate(10);

        $menu_enlace = $submenu_enlaces->first();

        return View(
            'inicio.administrar_enlaces',
            compact(
                'submenu_enlaces',
                'menu_enlace'
            )
        );
    }

    public function crearEnlace($menu_id)
    {
        $submenu_enlaces_id = $menu_id;

        return View(
            'inicio.crear_enlace',
            compact(
                'submenu_enlaces_id'
            )
        );
    }

    public function guardarEnlace(Request $request, $menu_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('submenu_enlaces_interes')
            ->insert([
                'menu_id' => $menu_id,
                'descripcion' => $request->detalle_descripcion,
                'url' => $request->detalle_url,
                'creacion' => date("Y-m-d H:i:s"),
                'creado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route(
                'inicio.administrar.enlaces',
                compact(
                    'menu_id'
                )
            )
            ->with('success', 'Registro guardado correctamente');
    }

    public function editarEnlace($menu_id, $submenu_id)
    {
        $submenu_enlace = DB::table('submenu_enlaces_interes')
            ->select(
                'submenu_enlaces_interes.submenu_id',
                'submenu_enlaces_interes.menu_id',
                'submenu_enlaces_interes.descripcion as submenu_descripcion',
                'submenu_enlaces_interes.url',
                'menu_enlaces_interes.descripcion as menu_descripcion'
            )
            ->join(
                'menu_enlaces_interes',
                'submenu_enlaces_interes.menu_id',
                '=',
                'menu_enlaces_interes.menu_id'
            )
            ->where('submenu_enlaces_interes.submenu_id', $submenu_id)
            ->where('submenu_enlaces_interes.menu_id', $menu_id)
            ->whereNotNull('submenu_enlaces_interes.menu_id')
            ->orderBy('submenu_enlaces_interes.menu_id', 'asc')
            ->first();

        return View(
            'inicio.editar_enlace',
            compact(
                'submenu_enlace'
            )
        );
    }

    public function actualizarEnlace(Request $request, $menu_id, $submenu_id)
    {
        $validator = Validator::make($request->all(), [
            'detalle_descripcion' => 'required|min:6|max:40',
            'detalle_url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $operacion = DB::table('submenu_enlaces_interes')
            ->where('submenu_enlaces_interes.submenu_id', $submenu_id)
            ->update([
                'descripcion' => $request->detalle_descripcion,
                'url' => $request->detalle_url,
                'actualizacion' => date("Y-m-d H:i:s"),
                'actualizado_por' => Auth::user()->usuario_id
            ]);

        return redirect()
            ->route(
                'inicio.administrar.enlaces',
                compact(
                    'menu_id'
                )
            )
            ->with('success', 'Registro actualizado correctamente');
    }

    public function borrarEnlace($menu_id, $submenu_id)
    {
        $operacion = DB::table('submenu_enlaces_interes')
            ->where('submenu_enlaces_interes.menu_id', $menu_id)
            ->where('submenu_enlaces_interes.submenu_id', $submenu_id)
            ->delete();

        return redirect()
            ->route(
                'inicio.administrar.enlaces',
                compact(
                    'menu_id'
                )
            )
            ->with('success', 'Registro borrado correctamente');
    }
}
