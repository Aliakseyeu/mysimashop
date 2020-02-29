<?php

namespace App\Http\Controllers;

use App\{Group, Item};
use App\Http\Requests\SearchItemRequest;
use App\Repositories\ItemRepository;

class ItemController extends Controller
{
    
    protected $group;
    protected $item;
    protected $itemRepository;

    public function __construct(Group $group, Item $item, ItemRepository $itemRepository)
    {
        $this->group = $group;
        $this->item = $item;
        $this->itemRepository = $itemRepository;
    }

    public function create(int $group)
    {
        $group = $this->group->findOrFail($group);
        return view('item.create', compact('group'));
    }

    public function show(SearchItemRequest $request)
    {
        $group = $this->group->findOrFail($request->group);
        $item = $this->item->getByGroupAndSid($group->id, $sid = $request->sid);
        $send = ['page' => $request->page];
        if($item){
            $users = $item->order->users;
            return view('item.show-exists', array_merge($send, compact('group', 'item', 'users')));
        }
        $item = $this->itemRepository->where('sid', $sid);
        return view('item.show-new', array_merge($send, compact('group', 'item')));
    }

    public function update(int $id)
    {
        $item = $this->item->findOrFail($id);
        $info = $this->itemRepository->find($item->pid);
        if($item->update($this->item->getUpdateData($info))){
            return back()->withSuccess([__('messages.updated', ['name'=>__('messages.item')])]);
        }
        return back()->withErrors([__('messages.error.updated')]);
    }


}
