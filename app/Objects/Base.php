<?php

namespace App\Objects;

class Base
{
    
	protected $data = [];
	protected $error = false;
	
	public function __construct($data = []){
		$this->data = (object)$data;
	}
	
	public function __get($key){
		return isset($this->data->$key) ? $this->data->$key : '';
	}

	public function __toString(): string {
        return json_encode($this->data);
	}

	public function empty(): bool{
		return !count((array)$this->data) > 0;
	}

	public function isError(): bool{
		return $this->error;
	}

	public function setError(){
		$this->error = true;
	}

	public function getData(){
		return $this->data;
	}
	
}
