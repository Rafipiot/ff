<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'jenis_kelamin', 'lama_bekerja'];

    public function getLamaBekerjaLabelAttribute()
    {
        if ($this->lama_bekerja === null) {
            return null;
        }

        return $this->lama_bekerja . ' Tahun';
    }

    public function scores()
    {
        return $this->hasMany(AlternativeScore::class);
    }
}