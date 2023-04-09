<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\tbl_horas_citas;
use App\tbl_horario_atencion_medico;
use App\tbl_union_horas_citas;

class UsuariosController extends Controller {

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
        $infoMedicoAgendas = \DB::table('users as u')
                ->where('llaveRol_usuario', '=', '15')
                ->orwhere('llaveRol_usuario', '=', '12')
                ->where('llave_estado', '=', '1')
                ->get();

        return view('gestionUsuarios.gestionUsuarios', compact('infoMedicoAgendas'));
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

        $medicoInfo = User::where('id', '=', $id)
                ->join('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                ->firstOrFail();

        $horario = tbl_horas_citas::where('idHorasCitas', '=', function($query) use ($id) {
                    $query
                            ->select(\DB::raw("min(idHorasCitas) as idHorasCitas"))
                            ->from('users')
                            ->join('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                            ->where('id', '=', $id);
                })->first();

        $horarioMax = tbl_horas_citas::where('idHorasCitas', '=', function($query) use ($id) {
                    $query
                            ->select(\DB::raw("max(idHorasCitas) as idHorasCitas"))
                            ->from('users')
                            ->join('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                            ->where('id', '=', $id);
                })->first();

        $horas = \DB::table('tbl_horas_citas')->get();

        return view('gestionUsuarios.usuario', compact('medicoInfo', 'horas', 'horario', 'horarioMax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {


        $usuario = User::where('id', '=', $id)->firstOrFail();
        $usuario->fill($request->all());
        $usuario->save();

        return redirect('/GestionUsuarios/' . $id . '/edit');
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
