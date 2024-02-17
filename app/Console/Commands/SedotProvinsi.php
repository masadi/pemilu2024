<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Wilayah;
use App\Models\Tps;

class SedotProvinsi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sedot:provinsi';

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
        if (Storage::disk('public')->exists('0.json')) {
            $contents = Storage::disk('public')->get('0.json');
            $data = json_decode($contents);
            $this->insert_data($data);
        } else {
            $response = Http::get($this->base_url.'/0.json');
            $data = $response->object();
            Storage::disk('public')->put('0.json', json_encode($data));
            $this->insert_data($data);
        }
        return Command::SUCCESS;
    }
    private function insert_data($data){
        foreach($data as $d){
            Wilayah::updateOrCreate([
                'nama' => $d->nama,
                'kode' => $d->kode,
                'tingkat' => $d->tingkat,
            ]);
            $this->info('PROVINSI: '.$d->nama.':'.$d->kode);
        }
    }
}
