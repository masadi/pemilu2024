<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $abilities = [
            [
                'role' => 'administrator',
                'display_name' => 'Administrator',
                'akses' => ['Web', 'Front'],
                'action' => 'read',
            ],
            [
                'role' => 'sekolah',
                'display_name' => 'Admin Sekolah',
                'akses' => ['Web', 'Front'],
                'action' => 'read',
            ],
            [
                'role' => 'ptk',
                'display_name' => 'PTK',
                'akses' => ['Web', 'Front'],
                'action' => 'read',
            ],
            [
                'role' => 'walas',
                'display_name' => 'Wali Kelas',
                'akses' => ['Web', 'Front'],
                'action' => 'read',
            ],
            [
                'role' => 'pd',
                'display_name' => 'Peserta Didik',
                'akses' => ['Web', 'Front'],
                'action' => 'read',
            ],
        ];
        Permission::truncate();
        foreach($abilities as $ab){
            $r = Role::firstOrCreate(
                [
                    'name' => $ab['role'],
                ],
                [
                    'display_name' => $ab['display_name'],
                    'description' => $ab['display_name'],
                ]
            );
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
        $user = User::firstOrCreate(
            [
                'email' => 'masadi.com@gmail.com'
            ],
            [
                'name' => 'Achmadi',
                'password' => bcrypt('5C4F:>BjCM:kGg%'),
                'email_verified_at' => now(),
            ]
        );
        if(!$user->hasRole('administrator')){
            $user->attachRole('administrator');
        }
    }
}
