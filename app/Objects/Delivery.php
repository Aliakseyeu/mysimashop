<?php

namespace App\Objects;


class Delivery extends Base
{

    public function __construct($data = []){
        parent::__construct((object)$data);
    }

    public function __get($key){
        return (float) parent::__get($key);
    }

    public function renderPrice(): string{
        if(isset($this->data->cost)){
            return $this->data->cost;
        }
        return '?';
    }

    public function getPrice(): float
    {
        return (float) $this->cost;
    }
    
}
