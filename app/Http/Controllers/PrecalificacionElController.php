<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_el_precalificacione;
use Illuminate\Support\Facades\DB;

class PrecalificacionElController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //        
        DB::insert("insert into users (`id`, `name`, `email`, `email_verified_at`, `password`, `capacidadBandejaCasos`, `llaveRol_usuario`, `llave_estado`, `remember_token`, `created_at`, `updated_at` ) values (71, 'ALEJANDRO CARVAJAL', 'alejandro.carvajal@codess.org.co', NULL, '$2y$10$5dsF24CkbP1D3FtiUV3K9OKDAMKwkkSGYIdbyExm5b5xKUXrK9ome', 'SIN LIMITES', 19, 1, NULL, NULL, NULL)");
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {


        $preCalificacion = tbl_el_precalificacione::where('idElPrecalificacion', '=', $id)->firstOrFail();
        $preCalificacion->fill($request->all());
        $preCalificacion->save();
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
