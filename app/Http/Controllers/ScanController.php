<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Barcode;
use App\Models\Absen;
use App\Models\Absen_masuk;
use App\Models\Absen_pulang;
use App\Events\PresensiEvent;
use File;

class ScanController extends Controller
{
    public function index(Request $request){
        $user = auth()->user();
        $id = Str::random(10);
        $success = FALSE;
        $text = '';
        if(request()->data == 'statis'){
            $success = FALSE;
            $text = 'ID tidak ditemukan';
        } else {
            $barcode = Barcode::where('nama', $request->barcode)->whereStatus(1)->first();
            if($barcode){
                $absen = Absen::updateOrCreate([
                    'user_id' => $user->user_id,
                    'tanggal' => now()->format('Y-m-d'),
                ]);
                if(request()->jenis == 'masuk'){
                    Absen_masuk::updateOrCreate([
                        'absen_id' => $absen->absen_id,
                        'terlambat' => 0,
                    ]);
                } else {
                    Absen_pulang::updateOrCreate([
                        'absen_id' => $absen->absen_id,
                        'pulang_cepat' => 0,
                    ]);
                }
                $barcode->status = 0;
                $barcode->save();
                $success = TRUE;
                $text = (request()->jenis == 'masuk') ? 'Scan Masuk Berhasil' : 'Scan Pulang Berhasil';
            } else {
                $text = (request()->jenis == 'masuk') ? 'Scan Masuk Gagal' : 'Scan Pulang Gagal';
            }
            Barcode::truncate();
            QrCode::backgroundColor(255,255,255)->size(500)->generate($id, storage_path('app/public/qrcodes/'.$id.'.svg'));
            Barcode::create([
                'nama' => $id,
                'status' => 1,
            ]);
        }
        $data = [
            'success' => $success,
            'request' => $request->all(),
            'user' => $user,
            'text' => $text,
            'qrcode' => $id,
            //url('storage/qrcodes/'.$id.'.svg'),
        ];
        event(new PresensiEvent($data));
        return $data;
    }
    public function get_qrcode(){
        $folder = storage_path('app/public/qrcodes');
        if (!File::isDirectory($folder)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($folder, 0777, true, true);
        }
        $id = Str::random(10);
        QrCode::backgroundColor(255,255,255)->size(500)->generate($id, storage_path('app/public/qrcodes/'.$id.'.svg'));
        $barcode = Barcode::updateOrCreate([
            'status' => 1,
            'nama' => $id,
        ]);
        return $barcode;
    }
}
