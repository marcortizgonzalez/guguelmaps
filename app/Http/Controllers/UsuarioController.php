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
        $enlace=($datos['nombre_usuario'].$datos['telf_usuario'].".json");
        //return $enlace;
        try{
            DB::beginTransaction();
            $datos=DB::table('tbl_usuario')->insertGetId(["nombre_usuario"=>$datos['nombre_usuario'],"email_usuario"=>$datos['email_usuario'],"contra_usuario"=>MD5($datos['contra_usuario']),"telf_usuario"=>$datos['telf_usuario'],"foto_usuario"=>$datos['foto_usuario'],"json_usuario"=>$enlace,"id_rol_fk"=>$datos['id_rol_fk']]);
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
    }



    //Registro vista
    public function register(){
        return view('register');
    }
    public function registerPost(Request $request){
        $datos = $request->except('_token');
        $request-> validate([
            'nombre_usuario'=>'required|string|max:30',
            'email_usuario'=>'required|string|min:10|max:150',
            'contra_usuario'=>'required|string|min:4|max:50',
            'telf_usuario'=>'required|string|min:9|max:9',
            'foto_usuario'=>'required|mimes:jpg,png,jpeg,webp,svg,gif,jfif'
        ]);
        if($request->hasFile('foto_usuario')){
            $datos['foto_usuario'] = substr($request->file('foto_usuario')->store('usuarios','public'),9);
        }else{
            $datos['foto_usuario'] = NULL;
        }

        //Comprobamos si existe el email que ha introducido en la base de datos
        //$existmail=DB::select('select email from tbl_usuario where email=?',[$request->input('email')]);
        //Si el resultado es menor a uno hacemos el registro
        /* if (count($existmail) < 1) { */
            try {
                //Encriptamos la contraseña a sha1
                $password = MD5($request->input('contra_usuario'));
                DB::insert('insert into tbl_usuario (nombre_usuario,email_usuario,contra_usuario,telf_usuario,foto_usuario,id_rol_fk) values (?,?,?,?,?,"2")',[$request->input('nombre_usuario'),$request->input('email_usuario'),$password,$request->input('telf_usuario'),$datos['foto_usuario']]);
                //Le metemos la variable de session con el nombre email
                $request->session()->put('email_usuario',$request->email);
                return redirect("mapaLog");
            } catch (\Throwable $th) {
                return redirect("register");
            }
        /* }else{
            return redirect("register");
        } */
    }


    //Función con redirección a la vista de Login
    public function login(){
        try {
            return view("login");
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    //Proceso de verificación de usuarios + redirección a la ruta correspondiente
    public function loginProc(Request $request){
        //recogemos los datos, teniendo exepciones, como el token que utiliza laravel y el método
        $datas = $request->except('_token', '_method');
        //Validación datos por parte del server, es necesario aunque pase por JS 
        $request->validate([
            'email_usuario' => 'required|string|max:60',
            'contra_usuario' => 'required|string|max:255'
        ]);

        try {
            //Hacemos la consulta con la DB, la cual contará nuestros resultados 1-0
            $queryId = DB::table('tbl_usuario')->where('email_usuario', '=', $datas['email_usuario'])->where('contra_usuario', '=', MD5($datas['contra_usuario']))->count();
            //Obtenemos todos los resultados de la DB, posteiriormente cogeremos un campo en concreto, obtenemos el primer resultado
            $userId = DB::table('tbl_usuario')->where('email_usuario', '=', $datas['email_usuario'])->where('contra_usuario', '=', MD5($datas['contra_usuario']))->first();
            //De los datos obtenidos consultamos el campo en concreto
            $rolUser = $userId->id_rol_fk;
            $id_usuario_tag = $userId->id_usuario;
            $nombre_usuario = $userId->nombre_usuario;
            $telf_usuario = $userId->telf_usuario;
            $enlace=($nombre_usuario.$telf_usuario.".json");
            //En caso de que la query $queryId devuelva como resultado 1(Coincidenci de datos haz...)
            if ($queryId == 1){
                //Establecemos sesión, solcitando el dato a Request
                $request->session()->put('email_usuario', $request->email_usuario);
                if($rolUser == '1'){
                    $request->session()->put('id_rol_fk', $rolUser);
                    return redirect("secciones");
                }else{
                    $request->session()->put('id_rol_fk', $rolUser);
                    
                    //JSON
                    $tagJSON=DB::select('select nombre_tag_usuario, ubicacion_tag_usuario from tbl_tags_usuario WHERE id_usu_tag_usuario = '.$id_usuario_tag.'');
                    $collectionTag = collect([$tagJSON]);
                    Storage::disk('userJSON')->put($enlace, $collectionTag);
                    //JSON

                    return redirect("mapaLog");
                    $usuario=DB::table('tbl_usuario')->select()->where('id_usuario','=',$id_usuario_tag)->first();
                    return view('mapaLog', compact('usuario'));
                }
                /* return redirect('home'); */
            }else{
                //No establecemos sesión y lo devolvemos a login
                return redirect('login');
            }
        } catch (\Throwable $e) {
            //En caso de error impredecible obtendremos el mismo error mediante $e
            //return $e->getMessage();
            return redirect('login');
        }
    }
    //logout
    public function logout(Request $request){
        //Eliminar todas las variables de sesion
        $request->session()->flush();
        return redirect('');
    }
}
