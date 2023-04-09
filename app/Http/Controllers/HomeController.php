<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_afiliado;
use App\tbl_calendarios;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $entradaPcl = \DB::table('tbl_entrada')
                        ->where('procesoEntrada', 'PCL')->get();
        $tipoSolicitud = \DB::table('tbl_solicitud')
                        ->where('procesoSolicitud', 'PCL')->get();
        $tipoEvento = \DB::table('tbl_tipo_evento')
                        ->where('tipo_evento', '<>', 'PCL')->get();
        $tipoDocumentoAfiliado = \DB::table('tbl_tipo_docuemtno')->get();
        $departamento = \DB::table('tbl_departamento')->get();
        $subEstadoSeguimiento = \DB::table('tbl_sub_estado_seguimientos')->get();
        $usuarios = \DB::table('users')
                ->leftjoin('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                ->where('rol', '=', 'COORDINADOR')
                ->orWhere('rol', '=', 'CALIFICADOR')
                ->orWhere('rol', '=', 'PROFESIONAL')
                ->orWhere('rol', '=', 'AUXILIAR_ADMINISTRATIVO')
                ->orWhere('rol', '=', 'CALIFICADOR_ADSCRITO')
                ->orderBy('name')
                ->get();

        $medico = \DB::table('users')
                        ->join('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                        ->leftjoin('tbl_horario_atencion_medicos', 'tbl_horario_atencion_medicos.llaveMedicoHorario', '=', 'users.id')
                        ->join('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_horario_atencion_medicos.llaveCiudadAtencionMedico')
                        ->orderBy('name')
                        ->where('rol', '=', 'CALIFICADOR_ADSCRITO')->get();

        $profesionalAsignar = \DB::table('users')
                        ->join('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                        ->orderBy('name')
                        ->where('rol', '=', 'PROFESIONAL')->get();

        $medicoAsignar = \App\User::where('rol', '!=', 'COORDINADOR')
                        ->join('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                        ->orderBy('name')
                        ->where('rol', '!=', 'AUXILIAR_ADMINISTRATIVO')
                        ->where('rol', '!=', 'PROFESIONAL')->get();


        $calendario = tbl_calendarios::orderBy('idcalendario', 'DESC')
                ->join('users', 'users.id', '=', 'tbl_calendarios.llaveMedico')
                ->join('tbl_horas_citas', 'tbl_horas_citas.idHorasCitas', '=', 'tbl_calendarios.llaveHoraCita')
                ->join('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_calendarios.llaveAfiliadoAgenda')
                ->join('tbl_horario_atencion_medicos', 'tbl_horario_atencion_medicos.llaveMedicoHorario', '=', 'users.id')
                ->join('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_horario_atencion_medicos.llaveCiudadAtencionMedico')
                ->join('tbl_tipo_consulta', 'tbl_tipo_consulta.idTipoConsulta', '=', 'tbl_calendarios.llaveTipoConsulta')
                ->get();


        $a = auth()->user()->id;

        $research = \DB::table('users')
                        ->join('tbl_estado_usuario', 'tbl_estado_usuario.id_estado_usuario', '=', 'users.llave_estado')
                        ->select('estado_usuario', 'llaveRol_usuario')
                        ->where('id', $a)->get();

        $tipoConsultas = \DB::table('tbl_tipo_consulta')->get();
        /* ===================================Listas El ========================================= */
        $entradaPclEl = \DB::table('tbl_entrada')
                        ->where('procesoEntrada', 'EL')->get();

        $tipoSolicitudEl = \DB::table('tbl_solicitud')
                        ->where('procesoSolicitud', 'El')->get();
        $covid = \DB::table('tbl_covid')->get();

        $usuariosEl = \DB::table('users')
                ->leftjoin('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                ->where('rol', '=', 'CALIFICADOR_EL')
                ->orderBy('name')
                ->get();

        $cobertura = \DB::table('tbl_cobertura')->get();
        $revicionCoberturas = \DB::table('tbl_revision_cobertura')->get();
        $afiliado = \DB::table('tbl_afiliacion')->get();
        $creado = \DB::table('tbl_creado')->get();
        $estadoIniciail = \DB::table('tbl_estado_siniestro')
                        ->where('filtro', 'INICIAL_EL')->get();
        $estadoTramite = \DB::table('tbl_estado_siniestro')
                        ->where('filtro', 'TRAMITEL_EL')->get();
        $estadoFinal = \DB::table('tbl_estado_siniestro')
                        ->where('filtro', 'FINAL_EL')->get();
        $gestionRealizar = \DB::table('tbl_gestion_realizar')->get();

        $eps = \DB::table('tbl_eps')->get();
        $genero = \DB::table('tbl_genero')
                ->get();
        $cobertura = \DB::table('tbl_cobertura')
                ->get();

        $revicionCoberturas = \DB::table('tbl_revision_cobertura')
                ->get();

        foreach ($research as $key) {
            $estatus = $key->estado_usuario;
            $rol = $key->llaveRol_usuario;
        }
        if ($estatus == 'ACTIVO') {
            // return view('consulta.consulta', compact('tipoSolicitud', 'tipoConsultas', 'calendario', 'profesionalAsignar', 'medicoAsignar', 'medico', 'entradaPcl', 'tipoEvento', 'tipoDocumentoAfiliado', 'departamento', 'subEstadoSeguimiento', 'usuarios'));


            switch ($rol) {
                /* ==============================Modulo PCL ================================================ */

                case 11:
                    return view('consulta.consulta', compact('tipoSolicitud', 'tipoConsultas', 'calendario', 'profesionalAsignar', 'medicoAsignar', 'medico', 'entradaPcl', 'tipoEvento', 'tipoDocumentoAfiliado', 'departamento', 'subEstadoSeguimiento', 'usuarios'));
                    break;
                case 12:
                    return view('consulta.consulta', compact('tipoSolicitud', 'tipoConsultas', 'calendario', 'profesionalAsignar', 'medicoAsignar', 'medico', 'entradaPcl', 'tipoEvento', 'tipoDocumentoAfiliado', 'departamento', 'subEstadoSeguimiento', 'usuarios'));
                    break;
                case 13:
                    return view('consulta.consulta', compact('tipoSolicitud', 'tipoConsultas', 'calendario', 'profesionalAsignar', 'medicoAsignar', 'medico', 'entradaPcl', 'tipoEvento', 'tipoDocumentoAfiliado', 'departamento', 'subEstadoSeguimiento', 'usuarios'));
                    break;
                case 14:
                    return view('consulta.consulta', compact('tipoSolicitud', 'tipoConsultas', 'calendario', 'profesionalAsignar', 'medicoAsignar', 'medico', 'entradaPcl', 'tipoEvento', 'tipoDocumentoAfiliado', 'departamento', 'subEstadoSeguimiento', 'usuarios'));
                    break;
                case 15:
                    return view('consulta.consulta', compact('tipoSolicitud', 'tipoConsultas', 'calendario', 'profesionalAsignar', 'medicoAsignar', 'medico', 'entradaPcl', 'tipoEvento', 'tipoDocumentoAfiliado', 'departamento', 'subEstadoSeguimiento', 'usuarios'));
                    break;
                case 16:
                    return view('consulta.consulta', compact('tipoSolicitud', 'tipoConsultas', 'calendario', 'profesionalAsignar', 'medicoAsignar', 'medico', 'entradaPcl', 'tipoEvento', 'tipoDocumentoAfiliado', 'departamento', 'subEstadoSeguimiento', 'usuarios'));
                    break;
                case 17:
                    return view('consulta.consulta', compact('tipoSolicitud', 'tipoConsultas', 'calendario', 'profesionalAsignar', 'medicoAsignar', 'medico', 'entradaPcl', 'tipoEvento', 'tipoDocumentoAfiliado', 'departamento', 'subEstadoSeguimiento', 'usuarios'));
                    break;
                case 18:
                    return view('consulta.consulta', compact('tipoSolicitud', 'tipoConsultas', 'calendario', 'profesionalAsignar', 'medicoAsignar', 'medico', 'entradaPcl', 'tipoEvento', 'tipoDocumentoAfiliado', 'departamento', 'subEstadoSeguimiento', 'usuarios'));
                    break;
                /* ==============================Modulo EL ================================================ */
                case 19:
                    return view('moduloEl.admin.CrearSiniestro.consultaEl', compact('cobertura','revicionCoberturas','genero', 'eps', 'gestionRealizar', 'revicionCoberturas', 'estadoIniciail', 'estadoTramite', 'estadoFinal', 'creado', 'tipoDocumentoAfiliado', 'entradaPclEl', 'tipoSolicitudEl', 'covid', 'departamento', 'usuariosEl', 'cobertura', 'afiliado'));
                    break;

                default:
                    break;
            }
        } else {

            //  return view('auth.login');
        }
    }

}
