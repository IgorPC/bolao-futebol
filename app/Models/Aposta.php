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
        $query = $this->query();

        $data = $query -> leftJoin('status_jogo', 'apostas.status_jogo_id', '=', 'status_jogo.id')
                       -> select('apostas.id as id', 'apostas.nome as  nome', 'apostas.data_jogo as data', 'status_jogo.value as status')
                       -> orderBy('apostas.data_jogo', 'desc')
                       -> get();

        return $data;
    }

    public function getOne()
    {
        $query = $this->query();

        $data = $query  -> leftJoin('status_jogo', 'apostas.status_jogo_id', '=', 'status_jogo.id')
                        -> select('apostas.id as id', 'apostas.nome as  nome', 'apostas.data_jogo as data', 'status_jogo.value as status')
                        -> orderBy('apostas.data_jogo', 'desc')
                        -> where('apostas.id', $this->id)
                        -> first();
        $dt = new \DateTime($data->data);
        $data->data = $dt;
        return $data;
    }
}
