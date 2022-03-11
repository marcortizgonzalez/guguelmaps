<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $usuarios=DB::table('tbl_usuario')->join('tbl_rol','tbl_usuario.id_rol_fk','=','tbl_rol.id_rol')->join('tbl_grupo','tbl_usuario.id_grupo_fk','=','tbl_grupo.id_grupo')->select('*')->get();
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
    public function crearUsuario(){
        $grupo=DB::select('select * from tbl_grupo');
        return view('crearUser', compact('grupo'));
    }

    public function crearUsuarioPost(Request  $request){
        $datos = $request->except('_token');
        $request->validate([
            'nombre_usuario'=>'required|string|max:30',
            'email_usuario'=>'required|string|min:10|max:150',
            'contra_usuario'=>'required|string|min:4|max:50',
            'telf_usuario'=>'required|string|min:9|max:9',
            'foto_usuario'=>'required|mimes:jpg,png,jpeg,webp,svg,gif',
            'id_rol_fk'=>'required|'
        ]);
        if($request->hasFile('foto_usuario')){
            $datos['foto_usuario'] = substr($request->file('foto_usuario')->store('usuarios','public'),9);
        }else{
            $datos['foto_usuario'] = NULL;
        }

        try{
            DB::beginTransaction();
            DB::table('tbl_usuario')->insertGetId(["nombre_usuario"=>$datos['nombre_usuario'],"email_usuario"=>$datos['email_usuario'],"contra_usuario"=>MD5($datos['contra_usuario']),"telf_usuario"=>$datos['telf_usuario'],"foto_usuario"=>$datos['foto_usuario'],"id_rol_fk"=>$datos['id_rol_fk'],"id_grupo_fk"=>$datos['id_grupo_fk']]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        /* $usuario=DB::table('tbl_usuario')->join('tbl_rol','tbl_usuario.id_rol_fk','=','tbl_rol.id')->join('tbl_grupo','tbl_usuario.id_grupo_fk','=','tbl_grupo.id')->select('*')->where('nombre_usuario like ?',['%'.$request->input('nombre_usuario').'%']); */
        $usuarios=DB::select('select * from tbl_usuario INNER JOIN tbl_rol ON tbl_usuario.id_rol_fk=tbl_rol.id_rol INNER JOIN tbl_grupo ON tbl_usuario.id_grupo_fk=tbl_grupo.id_grupo');
        return response()->json($usuarios);
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
    public function modificarUsuario($id){
        $usuario=DB::table('tbl_usuario')->select()->where('id_usuario','=',$id)->first();
        $rol=DB::select('select id_rol, nombre_rol from tbl_rol;');
        return view('modificarUsuario', compact('usuario','rol'));
    }

    public function modificarUsuarioPut(Request $request){
        $datos=$request->except('_token','_method');
        if ($request->hasFile('foto_usuario')) {
            $foto = DB::table('tbl_usuario')->select('foto_usuario')->where('id_usuario','=',$request['id_usuario'])->first();
            Storage::delete('public/'.$foto->foto_usuario);
            $datos['foto_usuario'] = substr($request->file('foto_usuario')->store('usuarios','public'),9);
        }
        
        try {
            DB::beginTransaction();
            DB::table('tbl_usuario')->where('id_usuario','=',$datos['id_usuario'])->update($datos);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('usuarios');
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
            //return redirect()->route('clientes.index');
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
}
