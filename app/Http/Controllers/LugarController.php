<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LugarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lugares=DB::table('tbl_lugar')->join('tbl_tipo','tbl_lugar.id_tipo_fk','=','tbl_tipo.id_tipo')->join('tbl_tags','tbl_lugar.id_tag_fk','=','tbl_tags.id_tag')->select('*')->get();
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
    public function crearLugar(){
        $lugar=DB::select('select * from tbl_lugar INNER JOIN tbl_tipo ON tbl_lugar.id_tipo_fk = tbl_tipo.id_tipo INNER JOIN tbl_tags ON tbl_lugar.id_tag_fk = tbl_tags.id_tag');
        $tipo=DB::select('select id_tipo, nombre_tipo from tbl_tipo');
        $tag=DB::select('select id_tag, nombre_tag from tbl_tags');
        return view('crearLugar', compact('lugar','tipo','tag'));
    }

    public function crearLugarPost(Request  $request){
        $datos = $request->except('_token');
        $request->validate([
            'nombre_lugar'=>'required|string|max:30',
            'ubi_lugar'=>'required|string|max:150',
            'descripcion_lugar'=>'required|string|max:300',
            'foto_lugar'=>'required|mimes:jpg,png,jpeg,webp,svg,gif',
            'id_tipo_fk'=>'required',
            'id_tag_fk'=>'required'
        ]);
        if($request->hasFile('foto_lugar')){
            $datos['foto_lugar'] = $request->file('foto_lugar')->store('public');
        }else{
            $datos['foto_lugar'] = NULL;
        }

        try{
            DB::beginTransaction();
            DB::table('tbl_lugar')->insertGetId(["nombre_lugar"=>$datos['nombre_lugar'],"ubi_lugar"=>$datos['ubi_lugar'],"descripcion_lugar"=>$datos['descripcion_lugar'],"foto_lugar"=>$datos['foto_lugar'],"id_tipo_fk"=>$datos['id_tipo_fk'],"id_tag_fk"=>$datos['id_tag_fk']]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('lugares');
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
        $lugar=DB::select('select * from tbl_lugar INNER JOIN tbl_tipo ON tbl_lugar.id_tipo_fk = tbl_tipo.id_tipo INNER JOIN tbl_tags ON tbl_lugar.id_tag_fk = tbl_tags.id_tag WHERE nombre_lugar like ?',['%'.$request->input('nombre_lugar').'%']);
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
    public function modificarLugar($id){
        $lugar=DB::table('tbl_lugar')->select()->where('id_lugar','=',$id)->first();
        $tipo=DB::select('select id_tipo, nombre_tipo from tbl_tipo;');
        $tag=DB::select('select id_tag, nombre_tag from tbl_tags;');
        return view('modificarLugar', compact('lugar','tipo','tag'));
    }

    public function modificarLugarPut(Request $request){
        $datos=$request->except('_token','_method');
        if ($request->hasFile('foto_lugar')) {
            $foto = DB::table('tbl_lugar')->select('foto_lugar')->where('id_lugar','=',$request['id_lugar'])->first();
            if ($foto->foto_lugar != null) {
                Storage::delete('public/'.$foto->foto_lugar);
            }
            $datos['foto_lugar'] = $request->file('foto_lugar')->store('lugar','public');
        }else{
            $foto = DB::table('tbl_lugar')->select('foto_lugar')->where('id_lugar','=',$request['id_lugar'])->first();
            $datos['foto_lugar'] = $foto->foto_lugar;
        }
        
        try {
            DB::beginTransaction();
            DB::table('tbl_lugar')->where('id','=',$datos['id'])->update($datos);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('lugares');
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
