<?php

namespace App\Services;

use App\{Group, Item, Order};
use App\Exceptions\NotFoundException;
use App\Repositories\{DeliveryRepository, ItemRepository};
use App\Objects\{Deliveries, Delivery, Items};

class GroupRefreshService extends GroupService
{

    protected $deliveryRepository;
    protected $itemRepository;
    protected $item;

    public function __construct(DeliveryRepository $deliveryRepository, ItemRepository $itemRepository, Item $item)
    {
        $this->itemRepository = $itemRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->item = $item;
    }

    public function refreshPricesAndDeliveries(Group $group)
    {
        $ids = $this->getItemsIds($group);
        $items = $this->itemRepository->findAll($ids);
        
        $data = $this->getDeliveriesData($group);
        $deliveries = $this->getDeliveriesPrices($data);
        
        return $this->refreshPrices($group, $items, $deliveries);
    }

    protected function getItemsIds(Group $group): string
    {
        $this->checkOrdersCount($group);

        $ids = [];
        foreach($group->orders as $order){
            if(empty($pid = $order->item->pid)){
                continue;
            }
            $ids[] = $pid;
        }
        return implode(',', $ids);
    }

    protected function refreshPrices(Group $group, Items $items, Deliveries $deliveries): bool
    {
        $this->checkOrdersCount($group);
        
        $result = false;
        foreach($group->orders as $order){
            if(empty($pid = $order->item->pid) || empty($item = $items->get($pid)) || (int)$item->id <= 0){
                continue;
            }
            if($order->item->update($order->item->getUpdateData($item))){
                $result = true;
            }
            if($order->users->count() <= 0){
                continue;
            }
            foreach($order->users as $user){
                $pivot = $user->pivot;
                $delivery = $this->findDelivery($deliveries, $order->item->sid, $qty = $pivot->qty);
                if(!$delivery){
                    continue;
                }
                $pivot->fill($order->getOrderUserData($qty, $delivery));
                if($pivot->save()){
                    $result = true;
                }
            }
        }
        return $result;
    }
        
    protected function getDeliveriesPrices(array $data) {
        $deliveries = new Deliveries;
        $temp = collect();
        foreach($data as $d){
            $temp = $temp->merge($this->deliveryRepository->getDeliveryPrices($d)->all()->values());
        }
        $deliveries->set($temp);
        return $deliveries;
    }
    
    protected function getDeliveriesData(Group $group): array
    {
        $this->checkOrdersCount($group);
        
        $data = [];        
        foreach($group->orders as $order){
            $data[] = $this->usersCounter($order);
        }
        $data = $this->deliveriesReverse($data);
        return $data;
    }
    
    protected function usersCounter(Order $order): array
    {
        $result = [];
        if(!$order->item->sid || $order->users->count() <= 0){
            return $result;
        }
        foreach($order->users as $user){
            $delivery = $this->deliveryRepository->getItemData($order->item->sid, $user->pivot->qty);
            if($this->isArrayUnique($result, $delivery)){
                $result[] = $delivery;
            }
        }
        return $result;
    }
    
    protected function isArrayUnique(array $data, array $delivery): bool 
    {
        if(count($data) <= 0){
            return true;
        }
        foreach($data as $item){
            $compare = array_uintersect($item, $delivery, "strcasecmp");
            if(!empty($compare['qty'])){
                return false;                
            }
        }
        return true;
    }
    
    protected function deliveriesReverse(array $data) {
        $result = [];
        foreach ($data as $okey => $order){
            foreach ($order as $ukey => $user){
                $result[$ukey][$okey] = $user;
            }
        }
        return $result;
    }
    
    protected function findDelivery(Deliveries $deliveries, int $sid, int $qty): ?Delivery{
        foreach($deliveries->all() as $key => $delivery){
            if($delivery->sid == $sid && $delivery->qty == $qty){
                return $delivery;
            }
        }
        return null;
    }

    private function checkOrdersCount(Group $group): void
    {
        if($group->orders->count() <= 0){
            throw new NotFoundException('order'); 
        }
    }

}