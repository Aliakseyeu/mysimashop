<?php

namespace App\Objects\Messages;

class Created extends Message {

    public function __construct()
    {
        $this->text = __('messages.created');
    }

}