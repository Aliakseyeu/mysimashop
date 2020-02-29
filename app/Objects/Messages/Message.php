<?php

namespace App\Objects\Messages;

class Message {

    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;

    protected $text = [];
    protected $gender = Message::GENDER_MALE;

    public function __toString(): string
    {
        return implode(' ', $this->text).'.';
    }

}