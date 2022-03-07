<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LugarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lugares=DB::table('tbl_lugar')->join('tbl_tipo','tbl_lugar.id_tipo_fk','=','tbl_tipo.id')->join('tbl_tags','tbl_lugar.id_tag_fk','=','tbl_tags.id')->select('*')->get();
        return view('lugares', compact('lugares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::insert('insert into tbl_lugar (nombre_lugar,ubi_lugar,telf_lugar,descripcion_lugar,foto_lugar) values (?,?,?,?,?)',[$request->input('nombre_lugar')],[$request->input('ubi_lugar')],[$request->input('telf_lugar')],[$request->input('descripcion_lugar')],[$request->input('foto_lugar')]);
            DB::insert('insert into tbl_tipo (nombre_tipo) values (?)',[$request->input('nombre_tipo')]);
            return response()->json(array('resultado'=> 'OK'));
        }catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lugar  $lugar
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /* $lugar=DB::table('tbl_lugar')->join('tbl_tipo','tbl_lugar.id_tipo_fk','=','tbl_tipo.id')->join('tbl_tags','tbl_lugar.id_tag_fk','=','tbl_tags.id')->select('*')->where('nombre_lugar like ?',['%'.$request->input('nombre_lugar').'%']); */
        $lugar=DB::select('select * from tbl_lugar INNER JOIN tbl_tipo ON tbl_lugar.id_tipo_fk = tbl_tipo.id INNER JOIN tbl_tags ON tbl_lugar.id_tag_fk = tbl_tags.id WHERE nombre_lugar like ?',['%'.$request->input('nombre_lugar').'%']);
        return response()->json($lugar);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lugar  $lugar
     * @return \Illuminate\Http\Response
     */
    public function edit(Lugar $lugar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lugar  $lugar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::update('update tbl_usuario set nombre_lugar=? ubi_lugar=? telf_lugar=? descripcion_lugar=? foto_lugar=? where id=?',[$request->input('nombre_lugar')],[$request->input('ubi_lugar')],[$request->input('telf_lugar')],[$request->input('descripcion_lugar')],[$request->input('foto_lugar'),$request->input('id')]);
            DB::update('update tbl_tipo set nombre_tipo=? where id=?',[$request->input('nombre_tipo'),$request->input('id')]);
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lugar  $lugar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::delete('delete from tbl_lugar where id=?',[$id]);
            DB::delete('delete from tbl_tipo where id=?',[$id]);
            //return redirect()->route('clientes.index');
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
}
