<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusJogo extends Model
{
    use HasFactory;

    protected $table = 'status_jogo';
    protected $fillable = ['id', 'value'];
    public $timestamps = true;
}
