<?php

namespace App\Http\Services;
use App\Http\Services\HashIdService;
use App\Models\Link;
use Illuminate\Support\Facades\Redis;

class UrlShortnerService
{
    protected $hashIdService;
    protected $id;

    public function __construct() {
        $this->hashIdService = new HashIdService();
        $this->id = Redis::incr('shortner_count');
    }

    public function saveShortnedUrl($request){
        $shortCode = $this->hashIdService->encode($this->id); 

        $link = Link::create([
            'original_url'=>$request->original_url,
            'short_code'=>$shortCode
        ]);

        return $link;
    }
}