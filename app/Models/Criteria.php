<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'bobot', 'tipe'];

    public function alternativeScores()
    {
        return $this->hasMany(AlternativeScore::class);
    }

    public function isBenefit()
    {
        return $this->tipe === 'benefit';
    }
}