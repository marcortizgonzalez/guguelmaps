<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\MAIL;


class LugarController extends Controller
{

    public function index2()
    {
        //Para pasar el tipo
        $tipolist = DB::select("SELECT *
        FROM tbl_tipo");
        //Para pasar el tag
        $taglist = DB::select("SELECT *
        FROM tbl_tags");
        return view("index",compact("tipolist","taglist"));
    }

    public function index3()
    {   
        if (session()->has('id_usuario_tag')) {
            $id_usuario_tag = session()->get('id_usuario_tag');
        }

        //Para pasar foto usuario
        $fotolist = DB::select("SELECT foto_usuario
        FROM tbl_usuario WHERE id_usuario=$id_usuario_tag");
        //Para pasar el tipo
        $tipolist = DB::select("SELECT *
        FROM tbl_tipo");
        //Para pasar el tag
        $taglist = DB::select("SELECT *
        FROM tbl_tags");
        //Para pasar el tag personalizado
        $tagusulist = DB::select("SELECT *
        FROM tbl_tags_usuario WHERE id_usu_tag_usuario=$id_usuario_tag");
        return view("indexLog",compact("fotolist","tipolist","taglist","tagusulist"));
    }

        /* MOSTRAR LUGARES */
        public function index(){
            $lugares=DB::table('tbl_lugar')->join('tbl_tipo','tbl_lugar.id_tipo_fk','=','tbl_tipo.id_tipo')->join('tbl_tags','tbl_lugar.id_tag_fk','=','tbl_tags.id_tag')->select('*')->get();
            return view('lugares', compact('lugares'));
        }
        
        /* CREAR LUGAR */
        public function crearLugar(){
            $lugar=DB::select('select * from tbl_lugar INNER JOIN tbl_tipo ON tbl_lugar.id_tipo_fk = tbl_tipo.id_tipo INNER JOIN tbl_tags ON tbl_lugar.id_tag_fk = tbl_tags.id_tag');
            $tipo=DB::select('select * from tbl_tipo');
            $tag=DB::select('select id_tag, nombre_tag from tbl_tags');
            return view('crearLugar', compact('lugar','tipo','tag'));
        }
    
        public function crearLugarPost(Request  $request){
            $datos = $request->except('_token');
            $request->validate([
                'nombre_lugar'=>'required|string|max:30',
                'coordenadas_lugar'=>'required|string|max:150',
                'direccion_lugar'=>'required|string|max:300',
                'telf_lugar'=>'nullable|string|min:9|max:9',
                'descripcion_lugar'=>'nullable|string|max:300',
                'foto_lugar'=>'required|mimes:jpg,png,jpeg,webp,svg,gif,jfif',
                'id_tipo_fk'=>'required',
                'id_tag_fk'=>'required'
            ]);
            if($request->hasFile('foto_lugar')){
                $datos['foto_lugar'] = substr($request->file('foto_lugar')->store('lugar','public'),6);
            }else{
                $datos['foto_lugar'] = NULL;
            }
    
            try{
                DB::beginTransaction();
                DB::table('tbl_lugar')->insertGetId(["nombre_lugar"=>$datos['nombre_lugar'],"coordenadas_lugar"=>$datos['coordenadas_lugar'],"direccion_lugar"=>$datos['direccion_lugar'],"telf_lugar"=>$datos['telf_lugar'],"descripcion_lugar"=>$datos['descripcion_lugar'],"foto_lugar"=>$datos['foto_lugar'],"id_tipo_fk"=>$datos['id_tipo_fk'],"id_tag_fk"=>$datos['id_tag_fk']]);
                DB::commit();

                //JSON
                $lugarJSON=DB::select('select * from tbl_lugar');
                $collectionLugar = collect([$lugarJSON]);
                Storage::disk('public')->put('lugares.json', $collectionLugar);
                //return response()->json($lugarJSON, 200, []);
                //JSON

            }catch(\Exception $e){
                DB::rollBack();
                return $e->getMessage();
            }
            return redirect('lugares');
        }
    
        /* AJAX MOSTRAR */
        public function leerController(){
            /* $lugar=DB::table('tbl_lugar')->join('tbl_tipo','tbl_lugar.id_tipo_fk','=','tbl_tipo.id')->join('tbl_tags','tbl_lugar.id_tag_fk','=','tbl_tags.id')->select('*')->where('nombre_lugar like ?',['%'.$request->input('nombre_lugar').'%']); */
            $lugares=DB::select('select * from tbl_lugar INNER JOIN tbl_tipo ON tbl_lugar.id_tipo_fk = tbl_tipo.id_tipo INNER JOIN tbl_tags ON tbl_lugar.id_tag_fk = tbl_tags.id_tag');
            return response()->json($lugares);
        }

        /* AJAX MOSTRAR TAG USER */
        public function leerController2(){
            if (session()->has('id_usuario_tag')) {
                $id_usuario_tag = session()->get('id_usuario_tag');
            }
            /* $lugar=DB::table('tbl_lugar')->join('tbl_tipo','tbl_lugar.id_tipo_fk','=','tbl_tipo.id')->join('tbl_tags','tbl_lugar.id_tag_fk','=','tbl_tags.id')->select('*')->where('nombre_lugar like ?',['%'.$request->input('nombre_lugar').'%']); */
            $tagusulist = DB::select("SELECT nombre_tag_usuario FROM tbl_tags_usuario WHERE id_usu_tag_usuario=$id_usuario_tag");
            return response()->json($tagusulist);
        }
    
        /* MODIFICAR LUGAR */
        public function modificarLugar($id){
            $lugar=DB::table('tbl_lugar')->select()->where('id_lugar','=',$id)->first();
            $tipo=DB::select('select * from tbl_tipo;');
            $tag=DB::select('select id_tag, nombre_tag from tbl_tags;');
            return view('modificarLugar', compact('lugar','tipo','tag'));
        }
    
        public function modificarLugarPut(Request $request){
            $datos=$request->except('_token','_method');
            if ($request->hasFile('foto_lugar')) {
                $foto = DB::table('tbl_lugar')->select('foto_lugar')->where('id_lugar','=',$request['id_lugar'])->first();
                Storage::delete('public/'.$foto->foto_lugar);
                $datos['foto_lugar'] = substr($request->file('foto_lugar')->store('lugar','public'),6);
            }
            
            try {
                DB::beginTransaction();
                DB::table('tbl_lugar')->where('id_lugar','=',$datos['id_lugar'])->update($datos);
                DB::commit();

                //JSON
                $lugarJSON=DB::select('select * from tbl_lugar');
                $collectionLugar = collect([$lugarJSON]);
                Storage::disk('public')->put('lugares.json', $collectionLugar);
                //return response()->json($lugarJSON, 200, []);
                //JSON

            } catch (\Exception $e) {
                DB::rollBack();
                return $e->getMessage();
            }
            return redirect('lugares');
        }
    
        /* ELIMINAR LUGAR */
        public function eliminarController($id_lugar)
        {
            try {
                $foto_lugar = DB::select('select foto_lugar from tbl_lugar where id_lugar=?',[$id_lugar]);
                if ($foto_lugar[0]->foto_lugar != null) {
                    Storage::delete('public/storage/lugar/'.$foto_lugar[0]->foto_lugar);
                }
                DB::delete('delete from tbl_lugar where id_lugar=?',[$id_lugar]);
                
                //JSON
                $lugarJSON=DB::select('select * from tbl_lugar');
                $collectionLugar = collect([$lugarJSON]);
                Storage::disk('public')->put('lugares.json', $collectionLugar);
                //return response()->json($lugarJSON, 200, []);
                //JSON

                //return redirect()->route('clientes.index');
                return response()->json(array('resultado'=> 'OK'));
            } catch (\Throwable $th) {
                return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
            }
        }

        /* JSON LUGAR */
        public function CrearJson(){
            $lugarJSON=DB::select('select * from tbl_lugar');
            $collectionLugar = collect([$lugarJSON]);
            Storage::disk('public')->put('lugares.json', $collectionLugar);
            return response()->json($lugarJSON, 200, []);
        }
    }
    
