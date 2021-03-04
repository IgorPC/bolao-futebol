<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aposta extends Model
{
    use HasFactory;

    protected $table = 'apostas';
    protected $fillable = ['user_id', 'nome', 'data_jogo', 'status_jogo_id', 'jogo_index'];
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

    public function getIndex()
    {
        $query = $this->query();

        $data = $query  -> leftJoin('status_jogo', 'apostas.status_jogo_id', '=', 'status_jogo.id')
                        -> select('apostas.id as id', 'apostas.nome as  nome', 'apostas.data_jogo as data', 'status_jogo.value as status')
                        -> orderBy('apostas.data_jogo', 'desc')
                        -> where('jogo_index', 1)
                        -> first();
        $dt = new \DateTime($data->data);
        $data->data = $dt;
        return $data;
    }

    public function publish()
    {
        if ($this->status_jogo_id != 4){
            return false;
        }
        if(!$this->unsetIndex()){
            return false;
        }

        $jogosAposta = new ApostaJogos();
        if(!$jogosAposta->publish($this)){
            return false;
        }

        if(!$this->setIndexAndPublish()){
            return false;
        }

        return true;
    }

    private function setIndexAndPublish()
    {
        try {
            DB::select("UPDATE apostas SET jogo_index = 1, status_jogo_id = 1 WHERE id = {$this->id}");
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function unsetIndex()
    {
        $apostas = $this->where('jogo_index', 1)->get('id');
        if(count($apostas) >= 1){
            try {
                foreach ($apostas as $aposta){
                    DB::select("UPDATE apostas SET jogo_index = 0 WHERE id = {$aposta->id}");
                }
                return true;
            }catch (\Exception $e){
                return false;
            }
        }else{
            return true;
        }
    }
}
