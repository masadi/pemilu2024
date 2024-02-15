<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Absen_masuk extends Model
{
    use HasFactory, Uuid;
	public $incrementing = false;
    public $keyType = 'string';
	protected $primaryKey = 'absen_masuk_id';
    protected $table = 'absen_masuk';
	protected $guarded = [];
	public function absen(){
		return $this->hasOne(Absen::class, 'absen_id', 'absen_id');
	}
}
