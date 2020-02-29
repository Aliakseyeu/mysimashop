<?php

namespace Tests\Support;

use Mockery;
use Ixudra\Curl\Facades\Curl;
use App\Item;
use App\Repositories\{DeliveryRepository, ItemRepository};
use App\Objects\{Delivery, Item as ItemObj};

trait ItemTrait
{

    private $actualItem;

    // private $item;
    // private $count;

    // public function itemTrait(): void
    // {
    //     $this->item = Item::first();
    //     $this->count = $this->getActualItemsCount();
    // }

    // public function getActualItemsCount(): int
    // {
    //     return Item::count();
    // }

    // public function getItemById(int $id): Item
    // {
    //     return Item::findOrFail($id);
    // }

    public function mockDelivery(): void {
        $repository = Mockery::mock(DeliveryRepository::class);
        $repository->shouldReceive('getDeliveryPrice')->once()->andReturn($this->getDeliveryObject());
        $this->app->instance(DeliveryRepository::class, $repository);
    }

    protected function getDeliveryObject(): Delivery {
        return new Delivery([
            'cost' => 5
        ]);
    }

    public function mockItemFinding(Item $item): void {
        $repository = Mockery::mock(ItemRepository::class);
        $repository->allows([
            'find' => $this->getItemObject($item),
            'where' => $this->getItemObject($item)
        ]);
        // $repository->shouldReceive('find')->once()->andReturn($this->getItemObject($item));
        $this->app->instance(ItemRepository::class, $repository);
    }

    protected function getItemObject(Item $item): ItemObj {
        return new ItemObj([
            'id' => $item->pid,
            'pid' => $item->pid,
            'sid' => $item->sid, 
        ]);
    }

    public function getActualItem(): object
    {
        $item = Item::latest()->first();
        Item::destroy($item->id);
        return $item;
        if(!$this->actualItem){
            $this->actualItem = Curl::to(config('api.url').'/item/?per_page=1')
            ->withContentType('application/json')
            ->asJson()
            ->get()
            ->items[0];
        }
        return $this->actualItem;
    }

    // public function getItemsCount(): int
    // {
    //     return $this->count;
    // }

    // public function getItem(): Item
    // {
    //     return $this->item;
    // }
    
}