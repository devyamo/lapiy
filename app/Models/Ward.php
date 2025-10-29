<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = ['lga_id', 'name', 'code'];

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }
}