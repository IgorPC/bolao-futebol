<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Integer;

class Time extends Model
{
    use HasFactory;

    protected $table = 'times';
    protected $fillable = ['nome', 'sigla', 'imagem', 'status_id'];
    public $timestamps = true;

    public function getAllTimes(Int $perPage)
    {
        return $this->paginate($perPage);
    }

    public function verifySigla(String $sigla)
    {
        $exist = $this->where('sigla', $sigla)->first();
        if($exist){
            return true;
        }else{
            return false;
        }
    }

    public function findBySigla(String $sigla)
    {
        $time = $this->where('SIGLA', $sigla)->first();
        if($time){
            return $time;
        }else{
            return false;
        }
    }
}
