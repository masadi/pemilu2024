<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Carbon\Carbon;

class Absen extends Model
{
    use HasFactory, Uuid;
	public $incrementing = false;
    public $keyType = 'string';
	protected $primaryKey = 'absen_id';
    protected $table = 'absen';
	protected $guarded = [];
	public $appends = ['tanggal_scan', 'tanggal_scan_str', 'jam_masuk', 'jam_pulang', 'menit_masuk', 'menit_pulang'];
	public function absen_masuk(){
		return $this->hasOne(Absen_masuk::class, 'absen_id', 'absen_id');
	}
	public function absen_pulang(){
		return $this->hasOne(Absen_pulang::class, 'absen_id', 'absen_id');
	}
	public function izin(){
		return $this->hasOne(Izin::class, 'absen_id', 'absen_id');
	}
	public function ptk(){
		return $this->hasOne(Ptk::class, 'ptk_id', 'ptk_id');
	}
	public function pd(){
		return $this->hasOne(Peserta_didik::class, 'peserta_didik_id', 'peserta_didik_id');
	}
	public function peserta_didik(){
		return $this->hasOne(Peserta_didik::class, 'peserta_didik_id', 'peserta_didik_id');
	}
	public function getCreatedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('Y-m-d H:i:s');
    }
	public function getUpdatedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'])->format('d/m/Y H:i:s');
    }
	public function getTanggalScanAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d/m/Y');
    }
	public function getTanggalScanStrAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->translatedFormat('d F Y');
    }
	public function getJamMasukAttribute()
    {
		return ($this->absen_masuk) ? Carbon::createFromFormat('Y-m-d H:i:s', $this->absen_masuk->created_at)->format('H:i:s') : '-';
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('H:i:s');
    }
	public function getJamPulangAttribute()
    {
        return ($this->absen_pulang) ? Carbon::createFromFormat('Y-m-d H:i:s', $this->absen_pulang->created_at)->format('H:i:s') : '-';
    }
	public function getMenitMasukAttribute()
    {
		return ($this->absen_masuk) ? Carbon::createFromFormat('Y-m-d H:i:s', $this->absen_masuk->created_at)->format('H:i:s') : '-';
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('H:i:s');
    }
	public function getmenitPulangAttribute()
    {
        return ($this->absen_pulang) ? Carbon::createFromFormat('Y-m-d H:i:s', $this->absen_pulang->created_at)->format('H:i:s') : '-';
    }
}
