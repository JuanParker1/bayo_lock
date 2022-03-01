<?php

namespace App\Services;

Class ApiServices{
    private $secretKey;

    public function __construct($secretKey,){
        $this->secretKey = $secretKey;
    }

    public function createSignature($payload,$algo = 'sha256'){
        return hash_hmac($algo, $payload, $this->secretKey);
    }

    public function getMillisecondsTimestamp()
    {
        $mt = explode(' ', microtime());
        return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
    }
}
