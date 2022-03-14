<?php

namespace App\Http\Controllers;

use App\Models\Gincana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GincanaController extends Controller
{
    
    /* MOSTRAR GINCANAS */
    public function index(){
        //$gincanas=DB::table('tbl_gincana')->join('tbl_lugar','tbl_gincana.id_punto1_fk','=','tbl_lugar.nombre_lugar','tbl_gincana.id_punto2_fk','=','tbl_lugar.nombre_lugar','tbl_gincana.id_punto3_fk','=','tbl_lugar.nombre_lugar')->select('*')->get();
        $gincanas=DB::table('tbl_gincana')->select('*')->get();
        return view('gincana', compact('gincanas'));
    }
    
    /* CREAR GINCANA */
    public function crearGincana(){
        $gincana=DB::select('select * from tbl_gincana INNER JOIN tbl_lugar ON tbl_gincana.id_punto1_fk = tbl_lugar.id_lugar');
        $lugar=DB::select('select id_lugar, nombre_lugar from tbl_lugar');
        $lugar2=DB::select('select id_lugar, nombre_lugar from tbl_lugar');
        $lugar3=DB::select('select id_lugar, nombre_lugar from tbl_lugar');
        return view('crearGincana', compact('gincana','lugar','lugar2','lugar3'));

    }

    public function crearGincanaPost(Request  $request){
        $datos = $request->except('_token');
        //return $datos;
        $request->validate([
            'nombre_gincana'=>'required|string|max:100',
            'pista1_gincana'=>'required|string|max:200',
            'id_punto1_fk'=>'required',
            'pista2_gincana'=>'required|string|max:200',
            'id_punto2_fk'=>'required',
            'pista3_gincana'=>'required|string|max:200',
            'id_punto3_fk'=>'required'
        ]);

        try{
            DB::beginTransaction();
            DB::table('tbl_gincana')->insertGetId(["nombre_gincana"=>$datos['nombre_gincana'],"pista1_gincana"=>$datos['pista1_gincana'],"id_punto1_fk"=>$datos['id_punto1_fk'],"pista2_gincana"=>$datos['pista2_gincana'],"id_punto2_fk"=>$datos['id_punto2_fk'],"pista3_gincana"=>$datos['pista3_gincana'],"id_punto3_fk"=>$datos['id_punto3_fk']]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('gincanas');
    }

    /* AJAX MOSTRAR */
    public function leerController(){
        $gincanas=DB::select('select * from tbl_gincana');
        return response()->json($gincanas);
    }

    /* MODIFICAR GINCANA */
    public function modificarGincana($id){
        $gincana=DB::table('tbl_gincana')->select()->where('id_gincana','=',$id)->first();
        $lugar=DB::select('select id_lugar, nombre_lugar from tbl_lugar;');
        $lugar2=DB::select('select id_lugar, nombre_lugar from tbl_lugar');
        $lugar3=DB::select('select id_lugar, nombre_lugar from tbl_lugar');
        return view('modificarGincana', compact('gincana','lugar','lugar2','lugar3'));
    }

    public function modificarGincanaPut(Request $request){
        $datos=$request->except('_token','_method');    
        try {
            DB::beginTransaction();
            DB::table('tbl_gincana')->where('id_gincana','=',$datos['id_gincana'])->update($datos);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('gincanas');
    }

    /* ELIMINAR GINCANA */
    public function eliminarController($id_gincana)
    {
        try {
            DB::delete('delete from tbl_gincana where id_gincana=?',[$id_gincana]);
            //return redirect()->route('clientes.index');
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
}