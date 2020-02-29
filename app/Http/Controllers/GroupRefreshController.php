<?php

namespace App\Http\Controllers;

use App\Services\{GroupRefreshService};

class GroupRefreshController extends GroupController
{

    public function refresh(int $id, GroupRefreshService $groupRefreshService)
    {
        $group = $this->status->new()->groups()->findOrFail($id);
        if($groupRefreshService->refreshPricesAndDeliveries($group)){
            return back()->withSuccess([__('messages.updated', ['name'=>__('messages.group')])]);
        }
        return back()->withErrors([__('messages.error.updated')]);
        
    }

}
