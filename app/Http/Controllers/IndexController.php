<?php

namespace App\Http\Controllers;

use App\{Item, Notification, Order, Repositories\DeliveryRepository, Repositories\ItemRepository, Status};
use App\Objects\Messages\Order as Message;

class IndexController extends Controller
{
    
    protected $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function index(Status $status)
    {
        $groups = $status->new()->groups()->paginate(1);
        $news = $this->notification->actual();
        return view('index.index', compact('groups', 'news'));
    }

    public function test(){
        // echo trans_choice('Яблоко|Яблока|Яблок', 0);
        // echo trans_choice('Создан|Создана', 10);
        echo(new Message);
    }

}
