<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    /* MOSTRAR TAGS */
    public function index()
    {
        $tags=DB::table('tbl_tags')->select('*')->get();
        return view('tags', compact('tags'));
    }


    /* CREAR TAGS */
    public function crearTag(){
        return view('crearTag');
    }

    public function crearTagPost(Request  $request){
        $datos = $request->except('_token');
        
        $request->validate([
            'nombre_tag'=>'required|string|max:20',
            'icono_tag'=>'required|string|max:150',
        ]);

        try{
            DB::beginTransaction();
            $datos=DB::table('tbl_tags')->insertGetId(["nombre_tag"=>$datos['nombre_tag'],"icono_tag"=>$datos['icono_tag']]);
            DB::commit();
            //JSON
            $tagJSON=DB::select('select * from tbl_tags');
            $collectionTag = collect([$tagJSON]);
            Storage::disk('public')->put('tag.json', $collectionTag);
            //return response()->json($tagJSON, 200, []);
            //JSON
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('tags');
    }

    public function creartagusuController(Request $request){
        try {
            if (session()->has('id_usuario_tag')) {
                $id_usuario_tag = session()->get('id_usuario_tag');
            }
            DB::insert('insert into tbl_tags_usuario (nombre_tag_usuario, id_usu_tag_usuario) values (?,?)',[$request->input('nombre'),$id_usuario_tag]);
            
            //JSON TAG PERSONAL
            $nombre_usuario = session()->get('nombre_usuario');
            $telf_usuario = session()->get('telf_usuario');
            $enlace=($nombre_usuario.$telf_usuario.".json");
            $tagJSON=DB::select('select nombre_tag_usuario, ubicacion_tag_usuario from tbl_tags_usuario WHERE id_usu_tag_usuario = '.$id_usuario_tag.'');
            $collectionTag = collect([$tagJSON]);
            Storage::disk('userJSON')->put($enlace, $collectionTag);
            //JSON TAG PERSONAL
            return response()->json(array('resultado'=> 'OK'));

        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }



    /* AJAX MOSTRAR */
    public function leerController(){
        $tags=DB::select('select * from tbl_tags');
        return response()->json($tags);
    }

    /* MODIFICAR TAG */
    public function modificarTag($id){
        $tags=DB::table('tbl_tags')->select()->where('id_tag','=',$id)->first();
        return view('modificarTag', compact('tags'));
    }

    public function modificarTagPut(Request $request){
        $datos=$request->except('_token','_method');
        try {
            DB::beginTransaction();
            DB::table('tbl_tags')->where('id_tag','=',$datos['id_tag'])->update($datos);
            DB::commit();
            //JSON
            $tagJSON=DB::select('select * from tbl_tags');
            $collectionTag = collect([$tagJSON]);
            Storage::disk('public')->put('tag.json', $collectionTag);
            //return response()->json($tagJSON, 200, []);
            //JSON
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('tags');
    }


    /* ELIMINAR TAGS */
    public function eliminarTagController($id_tag){
        try {
            DB::delete('delete from tbl_tags where id_tag=?',[$id_tag]);
            //JSON
            $tagJSON=DB::select('select * from tbl_tags');
            $collectionTag = collect([$tagJSON]);
            Storage::disk('public')->put('tag.json', $collectionTag);
            //return response()->json($tagJSON, 200, []);
            //JSON
            return response()->json(array('resultado'=> 'OK'));
        }catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    /* ELIMINAR TIPO */
    public function eliminarTipoController($id_tipo){
        try {
            DB::delete('delete from tbl_tipo where id_tipo=?',[$id_tipo]);
            return response()->json(array('resultado'=> 'OK'));
        }catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

}
