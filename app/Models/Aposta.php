<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aposta extends Model
{
    use HasFactory;

    protected $table = 'apostas';
    protected $fillable = ['user_id', 'nome', 'data_jogo', 'status_jogo_id'];
    public $timestamps = true;

    public function getAll()
    {
        return $this->all();
    }
}
