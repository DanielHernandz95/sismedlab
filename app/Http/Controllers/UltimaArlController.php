<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_siniestro_pcl;

class UltimaArlController extends Controller {

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
        $pdf = \PDF::loadView('pdf.ultimaArl');
        return $pdf->stream();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $infoSiniestro = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
                ->leftjoin('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_siniestro_pcls.llaveAfiliado')
                ->leftjoin('tbl_departamento', 'tbl_departamento.id_departamento', '=', 'tbl_afiliados.llaveDepartamento')
                ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_afiliados.llaveCiudad')
                ->leftjoin('tbl_tipo_docuemtno', 'tbl_tipo_docuemtno.id_tipo_docuemtno', '=', 'tbl_afiliados.llaveTipoDocumento')
                ->leftjoin('tbl_empresas', 'tbl_empresas.id_empresa', '=', 'tbl_siniestro_pcls.llaveEmpresaPcl')
                ->leftjoin('tbl_entrada', 'tbl_entrada.id_entrada', '=', 'tbl_siniestro_pcls.llaveCanalEntrada')
                ->leftjoin('tbl_quien_solicita', 'tbl_quien_solicita.id_quien_solicita', '=', 'tbl_siniestro_pcls.llaveQuienSolicita')
                ->leftjoin('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_siniestro_pcls.llaveTipoSolicitud')
                ->leftjoin('tbl_tipo_evento', 'tbl_tipo_evento.id_tipo_evento', '=', 'tbl_siniestro_pcls.llaveTipoEvento')
                ->leftjoin('tbl_seguimientos', 'tbl_seguimientos.llaveSiniestroPcl', '=', 'tbl_siniestro_pcls.idSiniestroPcl')
                ->leftjoin('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_siniestro_pcls.llaveRecalificacion')
                ->leftjoin('users as u', 'u.id', '=', 'rc.llaveCalificadorRecalificacion')
                ->firstOrFail();

        $cie = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
                ->leftjoin('tbl_cie_10_adicionados as a', 'a.llaveSiniestroPclDiagnostico', '=', 'tbl_siniestro_pcls.idSiniestroPcl')
                ->leftjoin('tbl_cie_10 as c', 'c.id_cie_10', '=', 'a.llave_cie10_union')
                ->get();

        //return view('pdf.certificacionArl', compact('infoSiniestro', 'cie'));
        $pdf = \PDF::loadView('pdf.certificacionArl', compact('infoSiniestro', 'cie'));
        //return $pdf->stream();
        return $pdf->download('CERTIFICACIÓN DE AFILIACIÓN A RIESGOS LABORALES  CC ' . $id . '.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $infoSiniestro = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
                ->leftjoin('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_siniestro_pcls.llaveAfiliado')
                ->leftjoin('tbl_departamento', 'tbl_departamento.id_departamento', '=', 'tbl_afiliados.llaveDepartamento')
                ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_afiliados.llaveCiudad')
                ->leftjoin('tbl_tipo_docuemtno', 'tbl_tipo_docuemtno.id_tipo_docuemtno', '=', 'tbl_afiliados.llaveTipoDocumento')
                ->leftjoin('tbl_empresas', 'tbl_empresas.id_empresa', '=', 'tbl_siniestro_pcls.llaveEmpresaPcl')
                ->leftjoin('tbl_entrada', 'tbl_entrada.id_entrada', '=', 'tbl_siniestro_pcls.llaveCanalEntrada')
                ->leftjoin('tbl_quien_solicita', 'tbl_quien_solicita.id_quien_solicita', '=', 'tbl_siniestro_pcls.llaveQuienSolicita')
                ->leftjoin('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_siniestro_pcls.llaveTipoSolicitud')
                ->leftjoin('tbl_tipo_evento', 'tbl_tipo_evento.id_tipo_evento', '=', 'tbl_siniestro_pcls.llaveTipoEvento')
                ->leftjoin('tbl_seguimientos', 'tbl_seguimientos.llaveSiniestroPcl', '=', 'tbl_siniestro_pcls.idSiniestroPcl')
                ->leftjoin('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_siniestro_pcls.llaveRecalificacion')
                ->leftjoin('users as u', 'u.id', '=', 'rc.llaveCalificadorRecalificacion')
                ->firstOrFail();

        $cie = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
                ->leftjoin('tbl_cie_10_adicionados as a', 'a.llaveSiniestroPclDiagnostico', '=', 'tbl_siniestro_pcls.idSiniestroPcl')
                ->leftjoin('tbl_cie_10 as c', 'c.id_cie_10', '=', 'a.llave_cie10_union')
                ->get();

        $folio = $request->input('folio');
        $cc = $request->input('cc');

        //return view('pdf.ultimaArl', compact('infoSiniestro', 'cie'));
        $pdf = \PDF::loadView('pdf.certificacionArlPdf', compact('infoSiniestro', 'cie', 'folio'));
        //return $pdf->stream();
        return $pdf->download('CERTIFICACIÓN DE AFILIACIÓN A RIESGOS LABORALES  CC ' . $cc . '.pdf');
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
