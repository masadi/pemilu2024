<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absen;

class RekapController extends Controller
{
    public function index(Request $request, User $user)
    {
        return Absen::with(['absen_masuk', 'absen_pulang'])->where('user_id', $request->user()->user_id)->whereHas('absen_masuk')->orderBy('created_at', 'DESC')->limit(20)->get();
        return [
            'data' => [
                [
                    'tanggal' => 'tanggal',
                    'menit_masuk' => 'menit_masuk',
                    'menit_pulang' => NULL,
                ]
            ],
            //
        ];
    }
}
