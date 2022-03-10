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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //Para pasar el tipo
        $tipolist = DB::select("SELECT *
        FROM tbl_tipo");
        //Para pasar el tag
        $taglist = DB::select("SELECT *
        FROM tbl_tags");
        return view("index",compact("tipolist","taglist"));
    }
}
