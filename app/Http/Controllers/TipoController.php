<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TipoController extends Controller
{
       /* MOSTRAR TIPOS */
       public function index()
       {
           $tipos=DB::table('tbl_tipo')->select('*')->get();
           return view('tipo', compact('tipos'));
       }
   
   
   
       /* CREAR TIPO */
       public function crearTipo(){
           return view('crearTipo');
       }
   
       public function crearTipoPost(Request  $request){
           $datos = $request->except('_token');
           
           $request->validate([
               'nombre_tipo'=>'required|string|max:20',
               'icono_tipo'=>'required|string|max:150',
           ]);
   
           try{
               DB::beginTransaction();
               $datos=DB::table('tbl_tipo')->insertGetId(["nombre_tipo"=>$datos['nombre_tipo'],"icono_tipo"=>$datos['icono_tipo']]);
               DB::commit();
           }catch(\Exception $e){
               DB::rollBack();
               return $e->getMessage();
           }
           return redirect('tipos');
       }
   
   
       /* AJAX MOSTRAR */
       public function leerController(){
           $tipos=DB::select('select * from tbl_tipo');
           return response()->json($tipos);
       }
   
   
       /* MODIFICAR TIPO */
       public function modificarTipo($id){
           $tipos=DB::table('tbl_tipo')->select()->where('id_tipo','=',$id)->first();
           return view('modificarTipo', compact('tipos'));
       }
   
       public function modificarTipoPut(Request $request){
           $datos=$request->except('_token','_method');
           try {
               DB::beginTransaction();
               DB::table('tbl_tipo')->where('id_tipo','=',$datos['id_tipo'])->update($datos);
               DB::commit();
           } catch (\Exception $e) {
               DB::rollBack();
               return $e->getMessage();
           }
           return redirect('tipos');
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
   