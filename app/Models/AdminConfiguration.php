<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminConfiguration extends Model
{
    protected $table = 'configs';
    public $timestamps = false;

    public function getConfigurations(){
        $configurations = new \stdClass();
        $configurations->roulette = json_decode($this->roulette,true);
        $configurations->polls = json_decode($this->polls,true);
        $configurations->codes = json_decode($this->codes,true);
        $configurations->messages = json_decode($this->messages,true);
        return $configurations;
    }

}