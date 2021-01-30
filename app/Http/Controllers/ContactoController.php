<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use DB;
use Mail;

class ContactoController extends Controller
{
    public function index()
    {
        return View('contacto.index');
    }

    public function guardarSolicitud(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detalle_nombre' => 'required|min:6|max:50',
            'detalle_correo' => 'required|max:50',
            'detalle_motivo' => 'required|min:5|max:60',
            'detalle_mensaje' => 'required|max:2000',
            'detalle_captcha' => 'required|captcha|min:6|max:8'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $envio = date("Y-m-d H:i:s");

        $operacion = DB::table('correos')
            ->insert([
                'nombre' => $request->detalle_nombre,
                'correo' => $request->detalle_correo,
                'motivo' => $request->detalle_motivo,
                'mensaje' => $request->detalle_mensaje,
                'envio' => $envio
            ]);

        $datos = array(
            'nombre' => $request->detalle_nombre,
            'correo' => $request->detalle_correo,
            'motivo' => $request->detalle_motivo,
            'mensaje' => $request->detalle_mensaje,
            'envio' => $envio
        );

        Mail::send('correos.consulta', $datos, function ($message) use ($datos) {
            $message->from('no-responder@cofessa.com.mx', 'Contacto Cofessa');
            $message->to($datos['correo'], $datos['nombre']);
            $message->bcc('cofessa@cofessa.com.mx', 'Cofessa');
            $message->subject($datos['motivo']);
        });

        return redirect()
            ->route('contacto')
            ->with('success', 'Datos enviados correctamente');
    }

    public function manage()
    {
        $correos = DB::table('correos')
            ->select(
                'correos.correo_id',
                'correos.nombre',
                'correos.correo',
                'correos.motivo',
                'correos.envio'
            )
            ->whereNotNull('correos.correo_id')
            ->orderBy('correos.correo_id', 'desc')
            ->paginate(10);

        return View('contacto.manage', compact('correos'));
    }

    public function mostrarSolicitud($correo_id)
    {
        $correo = DB::table('correos')
            ->select(
                'correos.correo_id',
                'correos.nombre',
                'correos.correo',
                'correos.motivo',
                'correos.mensaje',
                'correos.envio'
            )
            ->where('correos.correo_id', $correo_id)
            ->whereNotNull('correos.correo_id')
            ->orderBy('correos.correo_id', 'desc')
            ->first();

        return View('contacto.mostrar_solicitud', compact('correo'));
    }

    public function borrarSolicitud($correo_id)
    {
        $operacion = DB::table('correos')
            ->where('correo_id', $correo_id)
            ->delete();

        return redirect()
            ->route('contacto.manage')
            ->with('success', 'Datos borrados correctamente');
    }
}
