<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Wilayah;
use App\Models\Tps;

class SedotKpu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sedot:kpu {kode}';

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
    public $base_url = 'https://sirekap-obj-data.kpu.go.id/wilayah/pemilu/ppwp';
    public $base_suara = 'https://sirekap-obj-data.kpu.go.id/pemilu/hhcw/ppwp';
    public function handle()
    {
        $this->start($this->argument('kode'));
        return Command::SUCCESS;
    }
    private function start($kode){
        if (Storage::disk('public')->exists('kabupaten/'.$kode.'.json')) {
            $contents = Storage::disk('public')->get('kabupaten/'.$kode.'.json');
            $data = json_decode($contents);
            $this->insert_kabupaten($data, $kode);
        } else {
            $get_kabupaten = Http::get($this->base_url.'/'.$kode.'.json');
            $kabupaten = $get_kabupaten->object();
            Storage::disk('public')->put('kabupaten/'.$kode.'.json', json_encode($kabupaten));
            $this->insert_kabupaten($kabupaten, $kode);
        }
    }
    private function cek_array($array, $id){
        $data = NULL;
        if(isset($array['chart'][$id])){
            $data = $array['chart'][$id];
        }
        return $data;
    }
    
    private function insert_kabupaten($kabupaten, $kode){
        foreach($kabupaten as $kab){
            $this->info('KABUPATEN: '.$kab->nama.':'.$kab->kode);
            Wilayah::updateOrCreate([
                'nama' => $kab->nama,
                'kode' => $kab->kode,
                'id_wilayah' => $kode,
                'tingkat' => $kab->tingkat,
            ]);
            if (Storage::disk('public')->exists('kecamatan/'.$kab->kode.'.json')) {
                $this->info('kecamatan file ada');
                $contents = Storage::disk('public')->get('kecamatan/'.$kab->kode.'.json');
                $kecamatan = json_decode($contents);
                $this->insert_kecamatan($kecamatan, $kode, $kab);
            } else {
                $get_kecamatan = Http::get($this->base_url.'/'.$kode.'/'.$kab->kode.'.json');
                $kecamatan = $get_kecamatan->object();
                Storage::disk('public')->put('kecamatan/'.$kab->kode.'.json', json_encode($kecamatan));
                $this->insert_kecamatan($kecamatan, $kode, $kab);
            }
        }
    }
    private function insert_kecamatan($kecamatan, $kode, $kab){
        foreach($kecamatan as $kec){
            $this->info('Kecamatan: '.$kec->nama.':'.$kec->kode);
            Wilayah::updateOrCreate([
                'nama' => $kec->nama,
                'kode' => $kec->kode,
                'id_wilayah' => $kab->kode,
                'tingkat' => $kec->tingkat,
            ]);
            if (Storage::disk('public')->exists('desa/'.$kec->kode.'.json')) {
                $this->info('desa file ada');
                $contents = Storage::disk('public')->get('desa/'.$kec->kode.'.json');
                $desa = json_decode($contents);
                $this->insert_desa($desa, $kode, $kab, $kec);
            } else {
                $get_desa = Http::get($this->base_url.'/'.$kode.'/'.$kab->kode.'/'.$kec->kode.'.json');
                $desa = $get_desa->object();
                Storage::disk('public')->put('desa/'.$kab->kode.'.json', json_encode($desa));
                $this->insert_desa($desa, $kode, $kab, $kec);
            }
        }
    }
    private function insert_desa($desa, $kode, $kab, $kec){
        foreach($desa as $des){
            $this->info('desa: '.$des->nama.':'.$des->kode);
            Wilayah::updateOrCreate([
                'nama' => $des->nama,
                'kode' => $des->kode,
                'id_wilayah' => $kec->kode,
                'tingkat' => $des->tingkat,
            ]);
            if (Storage::disk('public')->exists('tps/'.$des->kode.'.json')) {
                $this->info('tps file ada');
                $contents = Storage::disk('public')->get('tps/'.$des->kode.'.json');
                $data_tps = json_decode($contents);
                $this->insert_tps($data_tps, $kode, $kab, $kec, $des);
            } else {
                $get_tps = Http::get($this->base_url.'/'.$kode.'/'.$kab->kode.'/'.$kec->kode.'/'.$des->kode.'.json');
                $data_tps = $get_tps->object();
                Storage::disk('public')->put('tps/'.$des->kode.'.json', json_encode($data_tps));
                $this->insert_tps($data_tps, $kode, $kab, $kec, $des);
            }
        }
    }
    private function insert_tps($data_tps, $kode, $kab, $kec, $des){
        if($data_tps){
            foreach($data_tps as $tps){
                $this->info('TPS: '.$tps->nama.':'.$tps->kode);
                $get_suara = Http::get($this->base_suara.'/'.$kode.'/'.$kab->kode.'/'.$kec->kode.'/'.$des->kode.'/'.$tps->kode.'.json');
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
