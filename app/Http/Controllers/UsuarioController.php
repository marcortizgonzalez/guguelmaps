<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function secciones()
    {
        return view('secciones');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios=DB::table('tbl_usuario')->join('tbl_rol','tbl_usuario.id_rol_fk','=','tbl_rol.id')->join('tbl_grupo','tbl_usuario.id_grupo_fk','=','tbl_grupo.id')->select('*')->get();
        return view('usuarios', compact('usuarios'));
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
            DB::insert('insert into tbl_usuario (nombre_usuario,email_usuario,contra_usuario,telf_usuario,foto_usuario) values (?,?,?,?,?)',[$request->input('nombre_usuario')],[$request->input('email_usuario')],[$request->input('contra_usuario')],[$request->input('telf_usuario')],[$request->input('foto_usuario')]);
            DB::insert('insert into tbl_rol (nombre_rol) values (?)',[$request->input('nombre_rol')]);
            return response()->json(array('resultado'=> 'OK'));
        }catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /* $usuario=DB::table('tbl_usuario')->join('tbl_rol','tbl_usuario.id_rol_fk','=','tbl_rol.id')->join('tbl_grupo','tbl_usuario.id_grupo_fk','=','tbl_grupo.id')->select('*')->where('nombre_usuario like ?',['%'.$request->input('nombre_usuario').'%']); */
        $usuario=DB::select('select * from tbl_usuario INNER JOIN tbl_rol ON tbl_usuario.id_rol_fk = tbl_rol.id INNER JOIN tbl_grupo ON tbl_usuario.id_grupo_fk = tbl_grupo.id WHERE nombre_usuario like ?',['%'.$request->input('nombre_usuario').'%']);
        return response()->json($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::update('update tbl_usuario set nombre_usuario=? email_usuario=? contra_usuario=? telf_usuario=? foto_usuario=? where id=?',[$request->input('nombre_usuario'),$request->input('email_usuario'),$request->input('contra_usuario'),$request->input('telf_usuario'),$request->input('foto_usuario'),$request->input('id')]);
            DB::update('update tbl_rol set nombre_rol=? where id=?',[$request->input('nombre_rol'),$request->input('id')]);
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::delete('delete from tbl_usuario where id=?',[$id]);
            DB::delete('delete from tbl_rol where id=?',[$id]);
            DB::delete('delete from tbl_grupo where id=?',[$id]);
            //return redirect()->route('clientes.index');
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
}
