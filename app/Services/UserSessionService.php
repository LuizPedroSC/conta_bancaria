<?php

namespace App\Services;
use Illuminate\Support\Facades\Session;

class UserSessionService
{
    const SESSION_NAME = 'user';

    public function getId(){
        return Session::get(self::SESSION_NAME)['id'] ?? 0;
    }

    public function getName(){
        return Session::get(self::SESSION_NAME)['name'] ?? '';
    }

    public function getEmail(){
        return Session::get(self::SESSION_NAME)['email'] ?? '';
    }

    public function isUser(int $id){
        return $this->getId() == $id;
    }
}