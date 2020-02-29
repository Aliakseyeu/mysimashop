<?php

namespace App\Objects;

use Illuminate\Support\Collection;

class Deliveries {

    protected $deliveries;

    public function __construct() {
        $this->deliveries = collect();
    }

    public function add(Delivery $delivery, string $key = 'sid') {
        $this->deliveries->put($delivery->$key, $delivery);
    }

    public function addAll($deliveries, string $key = 'sid'): void {
        if (count((array)$deliveries) <= 0) {
            return;
        }
        foreach ($deliveries as $delivery) {
            $this->add(new Delivery($delivery), $key);
        }
    }

    public function all() {
        return $this->deliveries;
    }
    
    public function set(Collection $deliveries): void
    {
        $this->deliveries = $deliveries;
    }

    public function get(string $key): Delivery {
        return $this->deliveries->has($key) ? $this->deliveries->get($key) : new Delivery;
    }

}
