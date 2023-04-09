<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_siniestro_pcl;
use App\tbl_recalificacion_pcl;
use App\tbl_cartas;
use App\tbl_afiliado;
use App\tbl_adicionpcl;

class FormatoNegacionAdicionController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $infoSiniestro = tbl_cartas::where('idCartas', '=', $id)
                ->join('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_cartas.llaveUnionRecalificacionCartas')
                ->join('tbl_adicionpcls as sa', 'sa.llaveReCalificacionAdicion', '=', 'rc.idRecalificacionPcls')
                ->join('tbl_siniestro_pcls as s', 's.idSiniestroPcl', '=', 'sa.llaveSiniestroAdicionPcl')
                ->join('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 's.llaveAfiliado')
                ->join('tbl_departamento', 'tbl_departamento.id_departamento', '=', 'tbl_afiliados.llaveDepartamento')
                ->join('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_afiliados.llaveCiudad')
                ->join('tbl_tipo_docuemtno', 'tbl_tipo_docuemtno.id_tipo_docuemtno', '=', 'tbl_afiliados.llaveTipoDocumento')
                ->join('users as u', 'u.id', '=', 'tbl_cartas.llaveQuienCreaCarta')
                ->select('*', \DB::raw('tbl_cartas.created_at as fechcrea'))
                ->firstOrFail();

        $cie = tbl_cartas::where('idCartas', '=', $id)
                ->join('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_cartas.llaveUnionRecalificacionCartas')
                ->join('tbl_adicionpcls as sa', 'sa.llaveReCalificacionAdicion', '=', 'rc.idRecalificacionPcls')
                ->leftjoin('tbl_cie_10_adicionados as a', 'a.llaveAdicionPcl', '=', 'sa.idAdicionPcl')
                ->leftjoin('tbl_cie_10 as c', 'c.id_cie_10', '=', 'a.llave_cie10_union')
                ->where('moduloDeDx', 'RECALIFICACION')
                ->get();


        $departamento = \DB::table('tbl_departamento')->get();


        // return view('pdf.cartaNegacion', compact('departamento', 'infoSiniestro', 'cie'));
        $pdf = \PDF::loadView('pdf.formatoNegacionAdiShow', compact('departamento', 'infoSiniestro', 'cie'));

        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

//        $infoSiniestro = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
//                ->leftjoin('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_siniestro_pcls.llaveAfiliado')
//                ->leftjoin('tbl_departamento', 'tbl_departamento.id_departamento', '=', 'tbl_afiliados.llaveDepartamento')
//                ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_afiliados.llaveCiudad')
//                ->leftjoin('tbl_tipo_docuemtno', 'tbl_tipo_docuemtno.id_tipo_docuemtno', '=', 'tbl_afiliados.llaveTipoDocumento')
//                ->leftjoin('tbl_empresas', 'tbl_empresas.id_empresa', '=', 'tbl_siniestro_pcls.llaveEmpresaPcl')
//                ->leftjoin('tbl_entrada', 'tbl_entrada.id_entrada', '=', 'tbl_siniestro_pcls.llaveCanalEntrada')
//                ->leftjoin('tbl_quien_solicita', 'tbl_quien_solicita.id_quien_solicita', '=', 'tbl_siniestro_pcls.llaveQuienSolicita')
//                ->leftjoin('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_siniestro_pcls.llaveTipoSolicitud')
//                ->leftjoin('tbl_tipo_evento', 'tbl_tipo_evento.id_tipo_evento', '=', 'tbl_siniestro_pcls.llaveTipoEvento')
//                ->leftjoin('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_siniestro_pcls.llaveRecalificacion')
//                ->leftjoin('users as u', 'u.id', '=', 'rc.llaveCalificadorRecalificacion')
//                ->firstOrFail();

        $infoSiniestro = tbl_adicionpcl::where('idAdicionPcl', '=', $id)
                ->leftjoin('tbl_siniestro_pcls', 'tbl_siniestro_pcls.idSiniestroPcl', '=', 'tbl_adicionpcls.llaveSiniestroAdicionPcl')
                ->leftjoin('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_siniestro_pcls.llaveAfiliado')
                ->leftjoin('tbl_departamento', 'tbl_departamento.id_departamento', '=', 'tbl_afiliados.llaveDepartamento')
                ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_afiliados.llaveCiudad')
                ->leftjoin('tbl_tipo_docuemtno', 'tbl_tipo_docuemtno.id_tipo_docuemtno', '=', 'tbl_afiliados.llaveTipoDocumento')
                ->leftjoin('tbl_empresas', 'tbl_empresas.id_empresa', '=', 'tbl_siniestro_pcls.llaveEmpresaPcl')
                ->leftjoin('tbl_entrada', 'tbl_entrada.id_entrada', '=', 'tbl_adicionpcls.llaveCanalEntradaAdiPcl')
                ->leftjoin('tbl_quien_solicita', 'tbl_quien_solicita.id_quien_solicita', '=', 'tbl_adicionpcls.LlaveQuienSoliAdiPcl')
                ->leftjoin('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_adicionpcls.LlavetipoSoliAdiPcl')
                ->leftjoin('tbl_tipo_evento', 'tbl_tipo_evento.id_tipo_evento', '=', 'tbl_adicionpcls.llaveTipoEventoAdiPcl')
                ->leftjoin('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_adicionpcls.llaveReCalificacionAdicion')
                ->leftjoin('users as u', 'u.id', '=', 'rc.llaveCalificadorRecalificacion')
                ->firstOrFail();

      
        $cie = tbl_cartanegaciones::where('idCartaNegaciones', '=', $id)
                ->join('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_cartanegaciones.llaveCartasnegacionRecalificacion')
                ->join('tbl_adicionpcls as sa', 'sa.llaveReCalificacionAdicion', '=', 'rc.idRecalificacionPcls')
                ->leftjoin('tbl_cie_10_adicionados as a', 'a.llaveAdicionPcl', '=', 'sa.idAdicionPcl')
                ->leftjoin('tbl_cie_10 as c', 'c.id_cie_10', '=', 'a.llave_cie10_union')
                ->where('moduloDeDx', 'RECALIFICACION')
                ->get();



        $siAdicion = 'SIAdicion';
        //return view('pdf.certificacionArl', compact('infoSiniestro', 'cie'));
        //$pdf = \PDF::loadView('pdf.formatoNegacion', compact('infoSiniestro', 'cie'));
        //return $pdf->stream();
        //return $pdf->download('CERTIFICACIÓN DE AFILIACIÓN A RIESGOS LABORALES  CC ' . $id . '.pdf');
        return view('pdf.formatoNegacionAdicion', compact('infoSiniestro', 'cie', 'siAdicion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $infoSiniestro = tbl_adicionpcl::where('idAdicionPcl', '=', $id)
                ->leftjoin('tbl_siniestro_pcls', 'tbl_siniestro_pcls.idSiniestroPcl', '=', 'tbl_adicionpcls.llaveSiniestroAdicionPcl')
                ->leftjoin('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_siniestro_pcls.llaveAfiliado')
                ->leftjoin('tbl_departamento', 'tbl_departamento.id_departamento', '=', 'tbl_afiliados.llaveDepartamento')
                ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_afiliados.llaveCiudad')
                ->leftjoin('tbl_tipo_docuemtno', 'tbl_tipo_docuemtno.id_tipo_docuemtno', '=', 'tbl_afiliados.llaveTipoDocumento')
                ->leftjoin('tbl_empresas', 'tbl_empresas.id_empresa', '=', 'tbl_siniestro_pcls.llaveEmpresaPcl')
                ->leftjoin('tbl_entrada', 'tbl_entrada.id_entrada', '=', 'tbl_adicionpcls.llaveCanalEntradaAdiPcl')
                ->leftjoin('tbl_quien_solicita', 'tbl_quien_solicita.id_quien_solicita', '=', 'tbl_adicionpcls.LlaveQuienSoliAdiPcl')
                ->leftjoin('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_adicionpcls.LlavetipoSoliAdiPcl')
                ->leftjoin('tbl_tipo_evento', 'tbl_tipo_evento.id_tipo_evento', '=', 'tbl_adicionpcls.llaveTipoEventoAdiPcl')
                ->leftjoin('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_adicionpcls.llaveReCalificacionAdicion')
                ->leftjoin('users as u', 'u.id', '=', 'rc.llaveCalificadorRecalificacion')
                ->firstOrFail();

      
        $cie = tbl_cartanegaciones::where('idCartaNegaciones', '=', $id)
                ->join('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_cartanegaciones.llaveCartasnegacionRecalificacion')
                ->join('tbl_adicionpcls as sa', 'sa.llaveReCalificacionAdicion', '=', 'rc.idRecalificacionPcls')
                ->leftjoin('tbl_cie_10_adicionados as a', 'a.llaveAdicionPcl', '=', 'sa.idAdicionPcl')
                ->leftjoin('tbl_cie_10 as c', 'c.id_cie_10', '=', 'a.llave_cie10_union')
                ->where('moduloDeDx', 'RECALIFICACION')
                ->get();





        $TxtFecha = $request->input('fechaNacimiento');
        $TxtGenero = $request->input('Genero');
        $TxtEstadoCivil = $request->input('estadoCivil');
        $TxtEscolaridad = $request->input('escolaridad');
        $TxtNombreEmpresa = $request->input('TxtNombreEmpresa');
        $TxtCargo = $request->input('TxtCargo');
        $TxtAntiguedadEmpresa = $request->input('TxtAntiguedadEmpresa');
        $TxtHistoriaClinica = $request->input('TxtHistoriaClinica');
        $TxtEstudios = $request->input('TxtEstudios');
        $TxtResumen = $request->input('TxtResumen');
        $TxtId = $request->input('TxtId');
        $TxtTipoExamen = $request->input('TxtTipoExamen');
        $TxtultimoResultado = $request->input('TxtultimoResultado');
        $TxtConclusion = $request->input('TxtConclusion');
        $TxtMedico = $request->input('TxtMedico');
        $TxtRm = $request->input('TxtRm');
        $cc = $request->input('cc');



        $cumpleanos = new \DateTime($TxtFecha);
        $hoy = new \DateTime();
        $annos = $hoy->diff($cumpleanos);
        $edad = ($annos->y);

        $IdRecalificacion = $request->input('IdRecalificacion');

        $reCalificacion = tbl_recalificacion_pcl::where('idRecalificacionPcls', '=', $IdRecalificacion)->firstOrFail();
        $reCalificacion->fill($request->all());
        $reCalificacion->formatoNegacionRecalificacion = 'GENERADA';
        $reCalificacion->save();




        $cartas = new tbl_cartas();

        $cartas->nombreEmpresa = $request->input('TxtNombreEmpresa');
        $cartas->antiguedad = $request->input('TxtAntiguedadEmpresa');
        $cartas->cargo = $request->input('TxtCargo');
        $cartas->historiaClinica = $request->input('TxtHistoriaClinica');
        $cartas->Estudios = $request->input('TxtEstudios');
        $cartas->resumenClinico = $request->input('TxtResumen');
        $cartas->id = $request->input('TxtId');
        $cartas->tipoExamen = $request->input('TxtTipoExamen');
        $cartas->ultimoResultado = $request->input('TxtultimoResultado');
        $cartas->concluciones = $request->input('TxtConclusion');
        $cartas->llaveUnionRecalificacionCartas = $IdRecalificacion;
        $cartas->llaveQuienCreaCarta = $request->input('idUsuarioCreador');

        $cartas->save();

        $idAfiliado = $request->input('idAfiliado');

        /* ================Actualizar afiliado================== */

        $datosBasicoAfiliado = tbl_afiliado::where('idAfiliado', '=', $idAfiliado)->firstOrFail();
        $datosBasicoAfiliado->fill($request->all());
        $datosBasicoAfiliado->save();



        //return view('pdf.ultimaArl', compact('infoSiniestro', 'cie'));
        $pdf = \PDF::loadView('pdf.formatoNegacionAdicionPdf', compact('edad', 'cc', 'TxtRm', 'TxtMedico', 'TxtConclusion', 'TxtultimoResultado', 'TxtTipoExamen', 'TxtId', 'TxtResumen', 'TxtEstudios', 'TxtHistoriaClinica', 'TxtAntiguedadEmpresa', 'TxtCargo', 'TxtNombreEmpresa', 'TxtFecha', 'TxtGenero', 'TxtEstadoCivil', 'TxtEscolaridad', 'infoSiniestro', 'cie'));
        //return $pdf->stream();
        return $pdf->download('FORMATO NEGACIÓN A SOLICITUD DE RECALIFICACIÓN PERDIDAD DE CAPACIDAD LABORAL  CC ' . $cc . '.pdf');
        // return redirect('/Siniestro/' . $idSiniestroPcl . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
