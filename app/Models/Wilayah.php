<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;
    protected $table = 'wilayah';
    protected $guarded = [];
    public function parent()
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah', 'kode');
    }
    public function parrentRecursive()
    {
        return $this->parent()->with('parrentRecursive');
    }
}
