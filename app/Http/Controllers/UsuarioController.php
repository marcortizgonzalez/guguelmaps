<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{

    /* SECCIONES */
    public function secciones()
    {
        return view('secciones');
    }
    
    /* MOSTRAR USUARIOS */
    public function index()
    {
        $usuarios=DB::table('tbl_usuario')->join('tbl_rol','tbl_usuario.id_rol_fk','=','tbl_rol.id_rol')->select('*')->get();
        return view('usuarios', compact('usuarios'));
    }


    /* CREAR USUARIO */
    public function crearUsuario(){
        return view('crearUser');
    }

    public function crearUsuarioPost(Request  $request){
        $datos = $request->except('_token');
        
        $request->validate([
            'nombre_usuario'=>'required|string|max:30',
            'email_usuario'=>'required|string|min:10|max:150',
            'contra_usuario'=>'required|string|min:4|max:50',
            'telf_usuario'=>'required|string|min:9|max:9',
            'foto_usuario'=>'required|mimes:jpg,png,jpeg,webp,svg,gif,jfif',
            'id_rol_fk'=>'required|'
        ]);
        if($request->hasFile('foto_usuario')){
            $datos['foto_usuario'] = substr($request->file('foto_usuario')->store('usuarios','public'),9);
        }else{
            $datos['foto_usuario'] = NULL;
        }

        try{
            DB::beginTransaction();
            $datos=DB::table('tbl_usuario')->insertGetId(["nombre_usuario"=>$datos['nombre_usuario'],"email_usuario"=>$datos['email_usuario'],"contra_usuario"=>MD5($datos['contra_usuario']),"telf_usuario"=>$datos['telf_usuario'],"foto_usuario"=>$datos['foto_usuario'],"id_rol_fk"=>$datos['id_rol_fk']]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('usuarios');
    }

    /* AJAX MOSTRAR */
    public function leerController(){
        /* $usuario=DB::table('tbl_usuario')->join('tbl_rol','tbl_usuario.id_rol_fk','=','tbl_rol.id')->join('tbl_grupo','tbl_usuario.id_grupo_fk','=','tbl_grupo.id')->select('*')->where('nombre_usuario like ?',['%'.$request->input('nombre_usuario').'%']); */
        $usuarios=DB::select('select * from tbl_usuario INNER JOIN tbl_rol ON tbl_usuario.id_rol_fk=tbl_rol.id_rol');
        return response()->json($usuarios);
    }

    /* MODIFICAR USUARIO */
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

    /* ELIMINAR USUARIO */
    public function eliminarController($id_usuario){
        try {
            $foto_usuario = DB::select('select foto_usuario from tbl_usuario where id_usuario=?',[$id_usuario]);
            if ($foto_usuario[0]->foto_usuario != null) {
                Storage::delete('public/storage/usuarios/'.$foto_usuario[0]->foto_usuario); 
            }
            DB::delete('delete from tbl_usuario where id_usuario=?',[$id_usuario]);
            return response()->json(array('resultado'=> 'OK'));
        }catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
        //return redirect('usuarios');
    }

}
