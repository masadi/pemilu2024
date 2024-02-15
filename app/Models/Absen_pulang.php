<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Absen_pulang extends Model
{
    use HasFactory, Uuid;
	public $incrementing = false;
    public $keyType = 'string';
	protected $primaryKey = 'absen_pulang_id';
    protected $table = 'absen_pulang';
	protected $guarded = [];
	public function absen(){
		return $this->hasOne(Absen::class, 'absen_id', 'absen_id');
	}
}
