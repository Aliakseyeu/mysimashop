<?php

namespace App\Repositories;

use Ixudra\Curl\Facades\Curl;
use App\Objects\{Deliveries, Delivery};
use App\Exceptions\NotFoundException;

class DeliveryRepository extends Repository
{

    public function getDeliveryPrice(int $id, int $qty): Delivery {
        $data = [
            $this->getItemData($id, $qty)
        ];
        $delivery = $this->sendDeliveryQuery($this->getDeliveryData($data));
        return new Delivery($delivery->$id);
    }
    
    public function getDeliveryPrices(array $data): Deliveries
    {
        $delivery = $this->sendDeliveryQuery($this->getDeliveryData($data));
        $delivery = $this->addQtyToDelivery($delivery, $data);
        $deliveries = new Deliveries();
        $deliveries->addAll($delivery);
        return $deliveries;
    }

    protected function addQtyToDelivery(object $deliveries, array $data): object
    {
        foreach ($data as $d){
            if(empty($deliveries->{$d['sid']})){
                continue;
            }
            $deliveries->{$d['sid']}->qty = $d['qty'];
        }
        return $deliveries;
    }
    
    protected function sendDeliveryQuery(array $data) {
        return Curl::to($this->getDeliveryPriceUrl())
            ->withData($data)
            ->asJson()
            ->post();
    }

    protected function getDeliveryData(array $data): array {
        return [
            'settlement_id' => 193824312,
            'items' => $data,
        ];
    }
    
    public function getItemData(int $sid, int $qty): array
    {
        return ['sid' => $sid, 'qty' => $qty];
    }

    protected function getDeliveryPriceUrl(): string {
        return config('api.url').'/delivery-calc/?expand=qty';
    }

    public function getDeliveryUser() {
        $user = Curl::to($this->getDeliveryAddressUrl())
            ->withContentType('application/json')
            ->withOption('USERPWD', config('api.login').':'.config('api.pass'))
            ->asJson()
            ->get();
        try {
            dd($user);
            return $user->items[0];
        } catch (\Exception $e){
            throw new NotFoundException('user');
        }
    }

    protected function getDeliveryAddressUrl(): string {
        return config('api.url').'/user-delivery-address/';
    }

}
