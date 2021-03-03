<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAposta extends Model
{
    use HasFactory;

    protected $table = 'status_aposta';
    protected $fillable = ['id', 'value'];
    public $timestamps = true;
}
