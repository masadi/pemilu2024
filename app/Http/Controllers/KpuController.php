<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tps;

class KpuController extends Controller
{
    public function index(){
        $data = Tps::with(['wilayah' => function($query){
            $query->with(['parrentRecursive']);
        }])->orderBy(request()->sortby, request()->sortbydesc)
        ->when(request()->q, function($query) {
            $query->where('nama', 'ILIKE', '%' . request()->q . '%');
            $query->orWhereHas('wilayah', function($query){
                $query->where('nama', 'ILIKE', '%' . request()->q . '%');
                $query->orWhereHas('parrentRecursive', function($query){
                    $query->where('nama', 'ILIKE', '%' . request()->q . '%');
                });
            });
        })->when(request()->opsi, function($query) {
            $query->where('paslon_1', '>', '300');
            $query->orWhere('paslon_2', '>', '300');
            $query->orWhere('paslon_3', '>', '300');
        })->paginate(request()->per_page);
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
