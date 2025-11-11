<?php

namespace App\Http\Services;

use Hashids\Hashids;

class HashIdService
{
    protected $hashid;

    public function __construct() {
        $this->hashid = new Hashids('iepg82Hsd',6);
    }

    public function encode($id){
       return $this->hashid->encode($id);
    }
}