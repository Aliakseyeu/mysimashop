<?php

namespace App\Objects;

class Items {

    protected $items;

    public function __construct() {
        $this->items = collect();
    }

    public function add(Item $item, string $key = 'sid') {
        $this->items->put($item->$key, $item);
    }

    public function addAll(array $items, string $key = 'id'): void {
        if (count($items) <= 0) {
            return;
        }
        foreach ($items as $item) {
            $this->add(new Item($item), $key);
        }
    }

    public function all() {
        return $this->items;
    }

    public function get(string $key): Item {
        return $this->items->has($key) ? $this->items->get($key) : new Item;
    }

}
