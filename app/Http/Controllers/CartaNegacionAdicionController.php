<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_siniestro_pcl;
use App\tbl_recalificacion_pcl;
use App\tbl_cartas;
use App\tbl_afiliado;
use App\tbl_adicionpcl;
use App\tbl_cartanegaciones;

class CartaNegacionAdicionController extends Controller {

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

        $infoSiniestro = tbl_cartanegaciones::where('idCartaNegaciones', '=', $id)
                ->join('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_cartanegaciones.llaveCartasnegacionRecalificacion')
                ->join('tbl_adicionpcls as sa', 'sa.llaveReCalificacionAdicion', '=', 'rc.idRecalificacionPcls')
                ->join('tbl_siniestro_pcls as s', 's.idSiniestroPcl', '=', 'sa.llaveSiniestroAdicionPcl')
                ->join('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 's.llaveAfiliado')
                ->join('tbl_departamento', 'tbl_departamento.id_departamento', '=', 'tbl_afiliados.llaveDepartamento')
                ->join('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_afiliados.llaveCiudad')
                ->join('tbl_tipo_docuemtno', 'tbl_tipo_docuemtno.id_tipo_docuemtno', '=', 'tbl_afiliados.llaveTipoDocumento')
                ->join('users as u', 'u.id', '=', 'tbl_cartanegaciones.llaveQuienCreaCartaNega')
                ->firstOrFail();


        $cie = tbl_cartanegaciones::where('idCartaNegaciones', '=', $id)
                ->join('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_cartanegaciones.llaveCartasnegacionRecalificacion')
                ->join('tbl_adicionpcls as sa', 'sa.llaveReCalificacionAdicion', '=', 'rc.idRecalificacionPcls')
                ->leftjoin('tbl_cie_10_adicionados as a', 'a.llaveAdicionPcl', '=', 'sa.idAdicionPcl')
                ->leftjoin('tbl_cie_10 as c', 'c.id_cie_10', '=', 'a.llave_cie10_union')
                ->where('moduloDeDx', 'RECALIFICACION')
                ->get();


        $departamento = \DB::table('tbl_departamento')->get();


        // return view('pdf.cartaNegacion', compact('departamento', 'infoSiniestro', 'cie'));
        $pdf = \PDF::loadView('pdf.cartaNegacionAdicionShow', compact('departamento', 'infoSiniestro', 'cie'));

        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

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



        $departamento = \DB::table('tbl_departamento')->get();


        return view('pdf.cartaNegacionADicion', compact('departamento', 'infoSiniestro', 'cie'));
        //$pdf = \PDF::loadView('pdf.ultimaArl', compact('infoSiniestro', 'cie'));
        //return $pdf->stream();
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



        $departamento = \DB::table('tbl_departamento')->get();

        $folio = $request->input('folio');
        $direccionResi = $request->input('direccionResi');
        $telefono = $request->input('telefono');
        $llaveDepartamento = $request->input('llaveDepartamento');
        $llaveCiudad = $request->input('llaveCiudad');
        $idUsuarioCreador = $request->input('idUsuarioCreador');
        $cc = $request->input('cc');
        $IdRecalificacion = $request->input('IdRecalificacion');
        $idAfiliado = $request->input('idAfiliado');

        /* ================Estado carta Recalificacion=================== */

        $reCalificacion = tbl_recalificacion_pcl::where('idRecalificacionPcls', '=', $IdRecalificacion)->firstOrFail();
        $reCalificacion->fill($request->all());
        $reCalificacion->cartaNegacionRecalificacion = 'GENERADA';
        $reCalificacion->save();

        /* ================Crear carta historial================== */

        $carta = new tbl_cartanegaciones();
        $carta->anexosCarta = $request->input('folio');
        $carta->llaveCartasnegacionRecalificacion = $IdRecalificacion;
        $carta->llaveQuienCreaCartaNega = $request->input('idUsuarioCreador');
        $carta->save();

        /* ================Actualizar afiliado================== */

        $datosBasicoAfiliado = tbl_afiliado::where('idAfiliado', '=', $idAfiliado)->firstOrFail();
        $datosBasicoAfiliado->fill($request->all());
        $datosBasicoAfiliado->save();


        $pdf = \PDF::loadView('pdf.cartaNegacionAdicionPdf', compact('llaveCiudad', 'llaveDepartamento', 'telefono', 'direccionResi', 'departamento', 'infoSiniestro', 'cie', 'folio'));
        //return $pdf->stream();
        return $pdf->download('CARTA NEGACION RECALIFICACION CC ' . $cc . '.pdf');

        // return redirect('FormatoNegacion/' . $id . '/edit');
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
