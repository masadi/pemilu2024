<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tps;

class KpuController extends Controller
{
    public function index(){
        $data = Tps::where(function($query){
            if(request()->luar){
                $query->whereHas('wilayah', function($query){
                    $query->whereHas('parent', function($query){
                        $query->whereHas('parent', function($query){
                            $query->where('id_wilayah', '99');   
                        });
                    });
                });
            } else {
                $query->whereHas('wilayah', function($query){
                    $query->whereHas('parent', function($query){
                        $query->whereHas('parent', function($query){
                            $query->where('id_wilayah', '<>', '99');   
                        });
                    });
                });
            }
        })->with(['wilayah' => function($query){
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
    public function update_suara(){
        if(request()->token == 'bismillah'){
            $find = Tps::find(request()->id);
            $find->paslon_1 = request()->paslon_1;
            $find->paslon_2 = request()->paslon_2;
            $find->paslon_3 = request()->paslon_3;
            $find->save();
        }
    }
}
