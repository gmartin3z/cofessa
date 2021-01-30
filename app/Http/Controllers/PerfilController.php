<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Auth;
use Hash;
use Mail;
use App\Usuario;
use App\Operacion;

class PerfilController extends Controller
{
    public function index()
    {
        return View('perfil.index');
    }

    public function editarAlias()
    {
        return View('perfil.editar_alias');
    }

    public function actualizarAlias(Request $request)
    {
        $rules = [
            'alias' => 'required|unique:usuarios|min:3|max:50|regex:/^[A-Za-z][A-Za-zÑñ0-9]+$/'
        ];

        $validation = Validator::make($request->all(), $rules);
        
        if ($validation->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation);
        } else {
            $usuario = Usuario::select(
                'usuarios.usuario_id'
            )
            ->where('usuarios.usuario_id', Auth::user()->usuario_id)
            ->orderBy('usuarios.usuario_id', 'asc')
            ->first();

            if ($usuario == null) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors('Registro no encontrado');
            }

            $usuario->alias = $request->alias;
            $usuario->fecha_modificacion = date("Y-m-d H:i:s");
            $usuario->save();

            return redirect()
                ->route('perfil.index')
                ->with('success', 'Registro actualizado con éxito');
        }
    }

    public function editarCorreo()
    {
        return View('perfil.editar_correo');
    }

    public function guardarOpActualizarCorreo(Request $request)
    {
        $rules = [
            'correo' => 'required|email|max:50|unique:usuarios',
            'contra' => 'required|min:6|max:64|same:confirmar_contra',
            'confirmar_contra' => 'required|min:6|max:64'
        ];

        $validation = Validator::make($request->all(), $rules);
        
        if ($validation->fails()) {
            return redirect()
                ->back()
                ->withInput($request->except('contra', 'confirmar_contra'))
                ->withErrors($validation);
        } else {
            if ((!Auth::user()->usuario_id) || (!Hash::check($request->contra, Auth::user()->contra))) {
                return redirect()
                    ->back()
                    ->withInput($request->except('contra', 'confirmar_contra'))
                    ->with(
                        'error',
                        'Datos erróneos, reintente nuevamente ' .
                        'o si el problema persiste consulte a soporte'
                    );
            }

            $operacion = Operacion::select(
                'operaciones.operacion_id',
                'operaciones.usuario_id',
                'operaciones.tipo_operacion_id'
            )
            ->where('operaciones.usuario_id', Auth::user()->usuario_id)
            ->orderBy('operaciones.operacion_id', 'asc')
            ->first();

            $token = str_random(35);
            $fecha_expiracion = date("Y-m-d H:i:s", strtotime('+30 minutes'));

            if ($operacion == null) {
                $operacion = new Operacion();
                $operacion->usuario_id = Auth::user()->usuario_id;
                $operacion->tipo_operacion_id = 1;
                $operacion->correo = $request->correo;
                $operacion->token = $token;
                $operacion->fecha_expiracion = $fecha_expiracion;
                $operacion->save();
            } else {
                $operacion->usuario_id = Auth::user()->usuario_id;
                $operacion->tipo_operacion_id = 1;
                $operacion->correo = $request->correo;
                $operacion->token = $token;
                $operacion->fecha_expiracion = $fecha_expiracion;
                $operacion->save();
            }

            $datos = array(
                'alias' => Auth::user()->alias,
                'usuario_id' => Auth::user()->usuario_id,
                'tipo_operacion_id' => 1,
                'correo' => $request->correo,
                'token' => $token
            );

            Mail::send('correos.actualizar_correo', $datos, function ($message) use ($datos) {
                $message->from('no-responder@cofessa.com.mx', 'Contacto Cofessa');
                $message->to($datos['correo'], $datos['alias']);
                $message->subject('Actualizar correo');
            });

            return redirect()
                ->route('perfil.index')
                ->with(
                    'success',
                    'Revise su bandeja de correo o spam. ' .
                    'Tiene 30 minutos para validar sus cambios o se perderán'
                );
        }
    }

    public function actualizarCorreo(Request $request)
    {
        $usuario_id = $request->usuario_id;
        $correo = $request->correo;
        $tipo_operacion_id = $request->tipo_operacion_id;
        $token = $request->token;

        $operacion = Operacion::select(
            'operaciones.operacion_id',
            'operaciones.tipo_operacion_id',
            'operaciones.fecha_expiracion'
        )
        ->where('operaciones.usuario_id', $usuario_id)
        ->where('operaciones.correo', $correo)
        ->where('operaciones.tipo_operacion_id', $tipo_operacion_id)
        ->where('operaciones.token', $token)
        ->orderBy('operaciones.operacion_id', 'asc')
        ->first();

        if ($operacion == null) {
            abort(404);
        } else {
            $fecha_actual = date("Y-m-d H:i:s");
            $fecha_expiracion = $operacion->fecha_expiracion;

            if ($fecha_actual > $fecha_expiracion) {
                $operacion->delete();
                abort(404);
            } elseif ($operacion->tipo_operacion_id != 1) {
                abort(404);
            } else {
                $operacion->delete();
            }
        }
            
        $usuario = Usuario::select(
            'usuarios.usuario_id',
            'usuarios.fecha_activacion'
        )
        ->where('usuarios.usuario_id', $usuario_id)
        ->orderBy('usuarios.usuario_id', 'asc')
        ->first();

        if ($usuario == null) {
            return redirect()
                ->route('perfil.index')
                ->with('error', 'Registro no encontrado');
        } elseif ($usuario != null && $usuario->fecha_activacion == null) {
            $usuario->correo = $correo;
            $usuario->fecha_activacion = date("Y-m-d H:i:s");
            $usuario->fecha_modificacion = date("Y-m-d H:i:s");
            $usuario->save();

            return redirect()
                ->route('perfil.index')
                ->with('success', 'Registro actualizado con éxito');
        } else {
            $usuario->correo = $correo;
            $usuario->fecha_modificacion = date("Y-m-d H:i:s");
            $usuario->save();

            return redirect()
                ->route('perfil.index')
                ->with('success', 'Registro actualizado con éxito');
        }
    }

    public function editarContrasenia()
    {
        return view('perfil.editar_contrasenia');
    }

    public function guardarOpActualizarContrasenia(Request $request)
    {
        $rules = [
            'contra' => 'required|min:6|max:64|same:confirmar_contra',
            'confirmar_contra' => 'required|min:6|max:64'
        ];

        $validation = Validator::make($request->all(), $rules);
        
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            if ((!Auth::user()->usuario_id) || (!Hash::check($request->contra, Auth::user()->contra))) {
                return redirect()
                    ->back()
                    ->withInput($request->except('contra', 'confirmar_contra'))
                    ->with('error', 'Datos erróneos, reintente nuevamente o si el problema persiste consulte a soporte');
            }

            $operacion = Operacion::select(
                'operaciones.operacion_id',
                'operaciones.usuario_id',
                'operaciones.tipo_operacion_id'
            )
            ->where('operaciones.usuario_id', Auth::user()->usuario_id)
            ->orderBy('operaciones.operacion_id', 'asc')
            ->first();

            $token = str_random(35);
            $fecha_expiracion = date("Y-m-d H:i:s", strtotime('+30 minutes'));

            if ($operacion == null) {
                $operacion = new Operacion();
                $operacion->usuario_id = Auth::user()->usuario_id;
                $operacion->tipo_operacion_id = 2;
                $operacion->correo = Auth::user()->correo;
                $operacion->token = $token;
                $operacion->fecha_expiracion = $fecha_expiracion;
                $operacion->save();
            } else {
                $operacion->usuario_id = Auth::user()->usuario_id;
                $operacion->tipo_operacion_id = 2;
                $operacion->correo = Auth::user()->correo;
                $operacion->token = $token;
                $operacion->fecha_expiracion = $fecha_expiracion;
                $operacion->save();
            }

            $datos = array(
                'alias' => Auth::user()->alias,
                'usuario_id' => Auth::user()->usuario_id,
                'tipo_operacion_id' => 2,
                'correo' => Auth::user()->correo,
                'token' => $token
            );

            Mail::send('correos.confirmar_contrasenia', $datos, function ($message) use ($datos) {
                $message->from('no-responder@cofessa.com.mx', 'Contacto Cofessa');
                $message->to($datos['correo'], $datos['alias']);
                $message->subject('Confirmar contraseña');
            });

            return redirect()
                ->route('perfil.index')
                ->with(
                    'success',
                    'Revise su bandeja de correo o spam.' .
                    'Tiene 30 minutos para validar sus cambios o se perderán'
                );
        }
    }

    public function confirmarContrasenia(Request $request)
    {
        $usuario_id = $request->usuario_id;
        $correo = $request->correo;
        $tipo_operacion_id = $request->tipo_operacion_id;
        $token = $request->token;

        $operacion = Operacion::select(
            'operaciones.operacion_id',
            'operaciones.tipo_operacion_id',
            'operaciones.fecha_expiracion'
        )
        ->where('operaciones.usuario_id', $usuario_id)
        ->where('operaciones.correo', $correo)
        ->where('operaciones.tipo_operacion_id', $tipo_operacion_id)
        ->where('operaciones.token', $token)
        ->orderBy('operaciones.operacion_id', 'asc')
        ->first();

        if ($operacion == null) {
            abort(404);
        } else {
            $fecha_actual = date("Y-m-d H:i:s");
            $fecha_expiracion = $operacion->fecha_expiracion;

            if ($fecha_actual > $fecha_expiracion) {
                $operacion->delete();
                abort(404);
            } elseif ($operacion->tipo_operacion_id != 2) {
                abort(404);
            } else {
                // no hagas nada
            }
        }

        return view('perfil.confirmar_contrasenia');
    }

    public function actualizarContrasenia(Request $request)
    {
        $rules = [
            'contra' => 'required|min:6|max:64|same:confirmar_contra',
            'confirmar_contra' => 'required|min:6|max:64'
        ];

        $validation = Validator::make($request->all(), $rules);
        
        if ($validation->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation);
        }

        $operacion = Operacion::select(
            'operaciones.operacion_id',
            'operaciones.tipo_operacion_id',
            'operaciones.fecha_expiracion'
        )
        ->where('operaciones.usuario_id', Auth::user()->usuario_id)
        ->where('operaciones.correo', Auth::user()->correo)
        ->where('operaciones.tipo_operacion_id', 2)
        ->orderBy('operaciones.operacion_id', 'asc')
        ->first();

        if ($operacion == null) {
            abort(404);
        } else {
            $operacion->delete();
        }

        $usuario = Usuario::select(
            'usuarios.usuario_id',
            'usuarios.fecha_activacion'
        )
        ->where('usuarios.usuario_id', Auth::user()->usuario_id)
        ->orderBy('usuarios.usuario_id', 'asc')
        ->first();

        if ($usuario == null) {
            return redirect()
                ->route('perfil.index')
                ->with('error', 'Registro no encontrado');
        } elseif ($usuario != null && $usuario->fecha_activacion == null) {
            $usuario->contra = Hash::make($request->contra);
            $usuario->fecha_activacion = date("Y-m-d H:i:s");
            $usuario->fecha_modificacion = date("Y-m-d H:i:s");
            $usuario->save();

            return redirect()
                ->route('perfil.index')
                ->with('success', 'Registro actualizado con éxito');
        } else {
            $usuario->contra = Hash::make($request->contra);
            $usuario->fecha_modificacion = date("Y-m-d H:i:s");
            $usuario->save();

            return redirect()
                ->route('perfil.index')
                ->with('success', 'Registro actualizado con éxito');
        }
    }

    public function borrarUsuario()
    {
        return view('perfil.borrar_usuario');
    }

    public function guardarOpEliminarUsuario(Request $request)
    {
        $rules = [
            'contra' => 'required|min:6|max:64|same:confirmar_contra',
            'confirmar_contra' => 'required|min:6|max:64'
        ];

        $validation = Validator::make($request->all(), $rules);
        
        if ($validation->fails()) {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validation);
        } else {
            if ((!Auth::user()->usuario_id) || (!Hash::check($request->contra, Auth::user()->contra))) {
                return redirect()
                    ->back()
                    ->withInput($request->except('contra', 'confirmar_contra'))
                    ->with(
                        'error', 
                        'Datos erróneos, reintente nuevamente' .
                        'o si el problema persiste consulte a soporte'
                    );
            }

            $operacion = Operacion::select(
                'operaciones.operacion_id',
                'operaciones.usuario_id',
                'operaciones.tipo_operacion_id'
            )
            ->where('operaciones.usuario_id', Auth::user()->usuario_id)
            ->orderBy('operaciones.operacion_id', 'asc')
            ->first();

            $token = str_random(35);
            $fecha_expiracion = date("Y-m-d H:i:s", strtotime('+30 minutes'));

            if ($operacion == null) {
                $operacion = new Operacion();
                $operacion->usuario_id = Auth::user()->usuario_id;
                $operacion->tipo_operacion_id = 3;
                $operacion->correo = Auth::user()->correo;
                $operacion->token = $token;
                $operacion->fecha_expiracion = $fecha_expiracion;
                $operacion->save();
            } else {
                $operacion->usuario_id = Auth::user()->usuario_id;
                $operacion->tipo_operacion_id = 3;
                $operacion->correo = Auth::user()->correo;
                $operacion->token = $token;
                $operacion->fecha_expiracion = $fecha_expiracion;
                $operacion->save();
            }

            $datos = array(
                'alias' => Auth::user()->alias,
                'usuario_id' => Auth::user()->usuario_id,
                'tipo_operacion_id' => 3,
                'correo' => Auth::user()->correo,
                'token' => $token
            );

            Mail::send('correos.borrar_cuenta', $datos, function ($message) use ($datos) {
                $message->from('no-responder@cofessa.com.mx', 'Contacto Cofessa');
                $message->to($datos['correo'], $datos['alias']);
                $message->subject('Borrar cuenta');
            });

            return redirect()
                ->route('perfil.index')
                ->with(
                    'success',
                    'Revise su bandeja de correo o spam. ' .
                    'Tiene 30 minutos para validar sus cambios o se perderán'
                );
        }
    }

    public function eliminarUsuario(Request $request)
    {
        $usuario_id = $request->usuario_id;
        $correo = $request->correo;
        $tipo_operacion_id = $request->tipo_operacion_id;
        $token = $request->token;

        $operacion = Operacion::select(
            'operaciones.operacion_id',
            'operaciones.tipo_operacion_id',
            'operaciones.fecha_expiracion'
        )
        ->where('operaciones.usuario_id', $usuario_id)
        ->where('operaciones.correo', $correo)
        ->where('operaciones.tipo_operacion_id', $tipo_operacion_id)
        ->where('operaciones.token', $token)
        ->orderBy('operaciones.operacion_id', 'asc')
        ->first();

        if ($operacion == null) {
            abort(404);
        } else {
            $fecha_actual = date("Y-m-d H:i:s");
            $fecha_expiracion = $operacion->fecha_expiracion;

            if ($fecha_actual > $fecha_expiracion) {
                $operacion->delete();
                abort(404);
            } elseif ($operacion->tipo_operacion_id != 3) {
                abort(404);
            } else {
                $operacion->delete();
            }
        }
            
        $usuario = Usuario::select(
            'usuarios.usuario_id'
        )
        ->where('usuarios.usuario_id', $usuario_id)
        ->orderBy('usuarios.usuario_id', 'asc')
        ->first();

        if ($usuario == null) {
            return redirect()
                ->route('perfil.index')
                ->with('error', 'Registro no encontrado');
        } else {
            $usuario->alias = '-----';
            $usuario->correo = '-----';
            $usuario->contra = '-----';
            $usuario->token_sesion = '-----';
            $usuario->save();

            // $usuario->delete();
            Auth::logout();

            return redirect()
                ->route('inicio')
                ->with('success', 'Registro borrado con éxito');
        }
    }

    public function reestablecerUsuario(Request $request)
    {
        return view('perfil.reestablecer_usuario');
    }

    public function guardarOpRecuperarUsuario(Request $request)
    {
        $rules = [
            'correo' => 'required|email|min:6|max:50',
            'detalle_captcha' => 'required|captcha|min:6|max:8'
        ];

        $validation = Validator::make($request->all(), $rules);
        
        if ($validation->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation);
        } else {
            $usuario = Usuario::select(
                'usuarios.usuario_id',
                'usuarios.alias',
                'usuarios.correo'
            )
            ->where('usuarios.correo', $request->correo)
            ->orderBy('usuarios.usuario_id', 'asc')
            ->first();

            if ($usuario == null) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Registro no encontrado, reintente nuevamente ' .
                        'o si el problema persiste consulte a soporte'
                    );
            }

            $operacion = Operacion::select(
                'operaciones.operacion_id',
                'operaciones.usuario_id',
                'operaciones.tipo_operacion_id'
            )
            ->where('operaciones.usuario_id', $usuario->usuario_id)
            ->where('operaciones.correo', $usuario->correo)
            ->orderBy('operaciones.operacion_id', 'asc')
            ->first();

            $token = str_random(35);
            $fecha_expiracion = date("Y-m-d H:i:s", strtotime('+30 minutes'));

            if ($operacion == null) {
                $operacion = new Operacion();
                $operacion->usuario_id = $usuario->usuario_id;
                $operacion->tipo_operacion_id = 4;
                $operacion->correo = $request->correo;
                $operacion->token = $token;
                $operacion->fecha_expiracion = $fecha_expiracion;
                $operacion->save();
            } else {
                $operacion->usuario_id = $usuario->usuario_id;
                $operacion->tipo_operacion_id = 4;
                $operacion->correo = $request->correo;
                $operacion->token = $token;
                $operacion->fecha_expiracion = $fecha_expiracion;
                $operacion->save();
            }

            $datos = array(
                'alias' => $usuario->alias,
                'usuario_id' => $usuario->usuario_id,
                'tipo_operacion_id' => 4,
                'correo' => $usuario->correo,
                'token' => $token
            );

            Mail::send('correos.recuperar_cuenta', $datos, function ($message) use ($datos) {
                $message->from('no-responder@cofessa.com.mx', 'Contacto Cofessa');
                $message->to($datos['correo'], $datos['alias']);
                $message->subject('Recuperar cuenta');
            });

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Revise su bandeja de correo o spam. ' .
                    'Tiene 30 minutos para validar sus cambios o se perderán'
                );
        }
    }

    public function mostrarFrmRecuperarCuenta(Request $request)
    {
        $usuario_id = $request->usuario_id;
        $correo = $request->correo;
        $tipo_operacion_id = $request->tipo_operacion_id;
        $token_operacion = $request->token;

        $operacion = Operacion::select(
            'operaciones.operacion_id',
            'operaciones.tipo_operacion_id',
            'operaciones.fecha_expiracion'
        )
        ->where('operaciones.usuario_id', $usuario_id)
        ->where('operaciones.correo', $correo)
        ->where('operaciones.tipo_operacion_id', $tipo_operacion_id)
        ->where('operaciones.token', $token_operacion)
        ->orderBy('operaciones.operacion_id', 'asc')
        ->first();

        if ($operacion == null) {
            abort(404);
        } else {
            $fecha_actual = date("Y-m-d H:i:s");
            $fecha_expiracion = $operacion->fecha_expiracion;

            if ($fecha_actual > $fecha_expiracion) {
                $operacion->delete();
                abort(404);
            } elseif ($operacion->tipo_operacion_id != 4) {
                abort(404);
            } else {
                // no hagas nada
            }
        }

        return view('perfil.recuperar_usuario')
            ->with(
                compact(
                    'usuario_id',
                    'correo',
                    'tipo_operacion_id',
                    'token_operacion'
                )
            );
    }

    public function recuperarUsuario(Request $request)
    {
        $rules = [
            'usuario_id' => 'required',
            'correo' => 'required',
            'tipo_operacion_id' => 'required',
            'token_operacion' => 'required',
            'contra' => 'required|min:6|max:64|same:confirmar_contra',
            'confirmar_contra' => 'required|min:6|max:64'
        ];

        $validation = Validator::make($request->all(), $rules);
        
        if ($validation->fails()) {
            return redirect()
                ->back()
                ->withInput($request->except('contra', 'confirmar_contra'))
                ->withErrors($validation);
        }

        $usuario_id = $request->usuario_id;
        $correo = $request->correo;
        $tipo_operacion_id = $request->tipo_operacion_id;
        $token_operacion = $request->token_operacion;
        $contra = $request->token_operacion;
        $confirmar_contra = $request->confirmar_contra;

        $operacion = Operacion::select(
            'operaciones.operacion_id',
            'operaciones.tipo_operacion_id',
            'operaciones.fecha_expiracion'
        )
        ->where('operaciones.usuario_id', $usuario_id)
        ->where('operaciones.correo', $correo)
        ->where('operaciones.tipo_operacion_id', 4)
        ->where('operaciones.token', $token_operacion)
        ->orderBy('operaciones.operacion_id', 'asc')
        ->first();

        if ($operacion == null) {
            abort(404);
        } else {
            $operacion->delete();
        }

        $usuario = Usuario::select(
            'usuarios.usuario_id',
            'usuarios.fecha_activacion'
        )
        ->where('usuarios.usuario_id', $usuario_id)
        ->orderBy('usuarios.usuario_id', 'asc')
        ->first();

        if ($usuario == null) {
            return redirect()
                ->back('perfil.index')
                ->with('error', 'Registro no encontrado');
        } elseif ($usuario != null && $usuario->fecha_activacion == null) {
            $usuario->correo = $correo;
            $usuario->contra = Hash::make($request->contra);
            $usuario->fecha_activacion = date("Y-m-d H:i:s");
            $usuario->fecha_modificacion = date("Y-m-d H:i:s");
            $usuario->save();

            return redirect()
                ->route('ingresar.mostrar_frm_login')
                ->with('success', 'Registro actualizado con éxito');
        } else {
            $usuario->correo = $correo;
            $usuario->contra = Hash::make($request->contra);
            $usuario->fecha_modificacion = date("Y-m-d H:i:s");
            $usuario->save();

            return redirect()
                ->route('ingresar.mostrar_frm_login')
                ->with('success', 'Registro actualizado con éxito');
        }
    }

    public function guardarOpConfirmarCorreo()
    {
        $operacion = Operacion::select(
            'operaciones.operacion_id',
            'operaciones.usuario_id',
            'operaciones.tipo_operacion_id'
        )
        ->where('operaciones.usuario_id', Auth::user()->usuario_id)
        ->orderBy('operaciones.operacion_id', 'asc')
        ->first();

        $token = str_random(35);
        $fecha_expiracion = date("Y-m-d H:i:s", strtotime('+30 minutes'));

        if ($operacion == null) {
            $operacion = new Operacion();
            $operacion->usuario_id = Auth::user()->usuario_id;
            $operacion->tipo_operacion_id = 1;
            $operacion->correo = Auth::user()->correo;
            $operacion->token = $token;
            $operacion->fecha_expiracion = $fecha_expiracion;
            $operacion->save();
        } else {
            $operacion->usuario_id = Auth::user()->usuario_id;
            $operacion->tipo_operacion_id = 1;
            $operacion->correo = Auth::user()->correo;
            $operacion->token = $token;
            $operacion->fecha_expiracion = $fecha_expiracion;
            $operacion->save();
        }

        $datos = array(
            'alias' => Auth::user()->alias,
            'usuario_id' => Auth::user()->usuario_id,
            'tipo_operacion_id' => 1,
            'correo' => Auth::user()->correo,
            'token' => $token
        );

        Mail::send('correos.confirmar_correo', $datos, function ($message) use ($datos) {
            $message->from('no-responder@cofessa.com.mx', 'Contacto Cofessa');
            $message->to($datos['correo'], $datos['alias']);
            $message->subject('Confirmar correo');
        });

        return redirect()
            ->route('perfil.index')
            ->with(
                'success',
                'Revise su bandeja de correo o spam. ' .
                'Tiene 30 minutos para validar sus cambios o se perderán'
            );
    }

    public function confirmarCorreo(Request $request)
    {
        $usuario_id = $request->usuario_id;
        $correo = $request->correo;
        $tipo_operacion_id = $request->tipo_operacion_id;
        $token = $request->token;

        $operacion = Operacion::select(
            'operaciones.operacion_id',
            'operaciones.tipo_operacion_id',
            'operaciones.fecha_expiracion'
        )
        ->where('operaciones.usuario_id', $usuario_id)
        ->where('operaciones.correo', $correo)
        ->where('operaciones.tipo_operacion_id', $tipo_operacion_id)
        ->where('operaciones.token', $token)
        ->orderBy('operaciones.operacion_id', 'asc')
        ->first();

        if ($operacion == null) {
            abort(404);
        } else {
            $fecha_actual = date("Y-m-d H:i:s");
            $fecha_expiracion = $operacion->fecha_expiracion;

            if ($fecha_actual > $fecha_expiracion) {
                $operacion->delete();
                abort(404);
            } elseif ($operacion->tipo_operacion_id != 1) {
                abort(404);
            } else {
                $operacion->delete();
            }
        }
            
        $usuario = Usuario::select(
            'usuarios.usuario_id',
            'usuarios.fecha_activacion'
        )
        ->where('usuarios.usuario_id', $usuario_id)
        ->orderBy('usuarios.usuario_id', 'asc')
        ->first();

        if ($usuario == null) {
            return redirect()
                ->route('perfil.index')
                ->with('error', 'Registro no encontrado');
        } else {
            $usuario->correo = $correo;
            $usuario->fecha_activacion = date("Y-m-d H:i:s");
            $usuario->save();

            return redirect()
                ->route('perfil.index')
                ->with('success', 'Registro actualizado con éxito');
        }
    }
}
