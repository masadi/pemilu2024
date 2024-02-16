<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;
    protected $table = 'tps';
    protected $guarded = [];
    
    public function wilayah()
    {
        return $this->hasOne(Wilayah::class, 'kode', 'id_wilayah');
    }
}
