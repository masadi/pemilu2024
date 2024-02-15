<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Wilayah;

class SedotKpu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sedot:kpu';

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
        $this->start();
        return Command::SUCCESS;
    }
    private function start(){
        $base_url = 'https://sirekap-obj-data.kpu.go.id/wilayah/pemilu/ppwp';
        $response = Http::get($base_url.'/0.json');
        $data = $response->object();
        foreach($data as $d){
            Wilayah::updateOrCreate([
                'nama' => $d->nama,
                'kode' => $d->kode,
                'tingkat' => $d->tingkat,
            ]);
            dd($d);
        }
    }
}
