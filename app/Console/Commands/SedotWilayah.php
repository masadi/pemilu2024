<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Wilayah;
use App\Models\Tps;

class SedotWilayah extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sedot:wilayah';

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
        $this->get_wilayah();
        //$this->start();
        return Command::SUCCESS;
    }
    private function get_wilayah(){
        $base_url = 'https://sirekap-obj-data.kpu.go.id/wilayah/pemilu/ppwp';
        $base_suara = 'https://sirekap-obj-data.kpu.go.id/pemilu/hhcw/ppwp';
        $response = Http::get($base_url.'/0.json');
        $data = $response->object();
        foreach($data as $d){
            Wilayah::updateOrCreate([
                'nama' => $d->nama,
                'kode' => $d->kode,
                'tingkat' => $d->tingkat,
            ]);
            $this->info('PROVINSI: '.$d->nama.':'.$d->kode);
            $get_kabupaten = Http::get($base_url.'/'.$d->kode.'.json');
            $kabupaten = $get_kabupaten->object();
            foreach($kabupaten as $kab){
                $this->info('KABUPATEN: '.$kab->nama.':'.$kab->kode);
                Wilayah::updateOrCreate([
                    'nama' => $kab->nama,
                    'kode' => $kab->kode,
                    'id_wilayah' => $d->kode,
                    'tingkat' => $kab->tingkat,
                ]);
                $get_kecamatan = Http::get($base_url.'/'.$d->kode.'/'.$kab->kode.'.json');
                $kecamatan = $get_kecamatan->object();
                foreach($kecamatan as $kec){
                    $this->info('Kecamatan: '.$kec->nama.':'.$kec->kode);
                    Wilayah::updateOrCreate([
                        'nama' => $kec->nama,
                        'kode' => $kec->kode,
                        'id_wilayah' => $kab->kode,
                        'tingkat' => $kec->tingkat,
                    ]);
                    $get_desa = Http::get($base_url.'/'.$d->kode.'/'.$kab->kode.'/'.$kec->kode.'.json');
                    $desa = $get_desa->object();
                    foreach($desa as $des){
                        $this->info('desa: '.$des->nama.':'.$des->kode);
                        Wilayah::updateOrCreate([
                            'nama' => $des->nama,
                            'kode' => $des->kode,
                            'id_wilayah' => $kec->kode,
                            'tingkat' => $des->tingkat,
                        ]);
                        $get_tps = Http::get($base_url.'/'.$d->kode.'/'.$kab->kode.'/'.$kec->kode.'/'.$des->kode.'.json');
                        $data_tps = $get_tps->object();
                        foreach($data_tps as $tps){
                            $this->info('TPS: '.$tps->nama.':'.$tps->kode);
                            $get_suara = Http::get($base_suara.'/'.$d->kode.'/'.$kab->kode.'/'.$kec->kode.'/'.$des->kode.'/'.$tps->kode.'.json');
                            $data_suara = $get_suara->collect();
                            Tps::updateOrCreate(
                                [
                                    'nama' => $tps->nama,
                                    'kode' => $tps->kode,
                                    'id_wilayah' => $des->kode,
                                ],
                                [
                                    'paslon_1' => ($data_suara['chart']) ? $this->cek_array($data_suara, 100025) : NULL,
                                    'paslon_2' => ($data_suara['chart']) ? $this->cek_array($data_suara, 100026) : NULL,
                                    'paslon_3' => ($data_suara['chart']) ? $this->cek_array($data_suara, 100027) : NULL,
                                    'images' => ($data_suara['chart']) ? json_encode($data_suara['images']) : NULL,
                                ]
                            );
                        }
                    }
                }
            }
        }
    }
    private function cek_array($array, $id){
        $data = NULL;
        if(isset($array['chart'][$id])){
            $data = $array['chart'][$id];
        }
        return $data;
    }
}
