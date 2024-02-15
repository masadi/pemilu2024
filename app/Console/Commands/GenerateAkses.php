<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Role;
use App\Models\Permission;

class GenerateAkses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:akses';

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
        $abilities = [
            [
                'role' => 'administrator',
                'akses' => ['Web', 'Front', 'Beranda', 'Profile', 'Sekolah', 'PTK', 'Peserta_Didik', 'Rombel', 'Users'],
                'action' => 'read',
            ],
            [
                'role' => 'sekolah',
                'akses' => ['Web', 'Front', 'Beranda', 'Profile', 'PTK', 'Peserta_Didik', 'Rombel', 'Laporan', 'Rekapitulasi', 'Users', 'Pengaturan'],
                'action' => 'read',
            ],
            [
                'role' => 'ptk',
                'akses' => ['Web', 'Front', 'Beranda', 'Profile', 'Presensi'],
                'action' => 'read',
            ],
            [
                'role' => 'walas',
                'akses' => ['Laporan', 'Rekapitulasi'],
                'action' => 'read',
            ],
            [
                'role' => 'pd',
                'akses' => ['Web', 'Front', 'Beranda', 'Profile', 'Presensi'],
                'action' => 'read',
            ],
        ];
        Permission::truncate();
        foreach($abilities as $ab){
            $r = Role::where('name', $ab['role'])->first();
            foreach($ab['akses'] as $perm){
                $permission = Permission::updateOrCreate([
                    'name' => $perm,
                    'display_name' => $perm,
                    'description' => 'read',
                ]);
                if(!$r->hasPermission($permission->name)){
                    $r->attachPermission($permission);
                }
            }
            
        }
        return Command::SUCCESS;
    }
}
