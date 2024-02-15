<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Semester;
use App\Models\Nama_hari;
use App\Models\Jenis_keluar;
class Generate_Ref extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:ref';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /*$nama_hari = collect(["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"]);
        foreach($nama_hari as $hari){
            Nama_hari::updateOrCreate(['nama' => $hari]);
        }
        $this->info('Nama hari berhasil diproses');
        $jenis_keluar = ['Lulus', 'Mutasi', 'Dikeluarkan', 'Mengundurkan diri', 'Putus Sekolah', 'Wafat', 'Hilang'];
        foreach($jenis_keluar as $jenis){
            Jenis_keluar::firstOrCreate([
                'nama' => $jenis
            ]);
        }/*
        /*Semester::updateOrCreate([
            'semester_id' => 20231,
            'nama' => '2023/2024 Ganjil',
            'semester' => 1,
            'periode_aktif' => 0,
        ]);*/
        $data = [
            [
                'semester_id' => 20231,
                'nama' => '2023/2024 Ganjil',
                'semester' => 1,
                'periode_aktif' => 0,
                'tahun_ajaran_id' => 2023,
                'tanggal_mulai' => '2023-07-01',
                'tanggal_selesai' => '2023-12-31',
            ],
            [
                'semester_id' => 20232,
                'nama' => '2023/2024 Genap',
                'semester' => 2,
                'periode_aktif' => 1,
                'tahun_ajaran_id' => 2023,
                'tanggal_mulai' => '2024-01-01',
                'tanggal_selesai' => '2024-06-30',
            ],
        ];
        foreach($data as $d){
            Semester::updateOrCreate($d);
        }
        return Command::SUCCESS;
    }
}
