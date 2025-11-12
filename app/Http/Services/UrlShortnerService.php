<?php

namespace App\Http\Services;
use App\Http\Services\HashIdService;
use App\Models\Link;
use Exception;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class UrlShortnerService
{
    protected $hashIdService;
    
    public function __construct() {
        $this->hashIdService = new HashIdService();
    }

    public function saveShortnedUrl($request){
        $shortCode = $this->hashIdService->encode(Redis::incr('shortner_count')); 

        $link = Link::create([
            'original_url'=>$request->original_url,
            'short_code'=>$shortCode
        ]);

        Cache::set($link->short_code,$link->original_url);

        return $link;
    }

    public function redirect($short_code){
        $original_url = Cache::remember($short_code,now()->addYear(1),function() use ($short_code){
            $link = Link::where('short_code',$short_code)->first();

            if(!$link){
                throw new Exception('Url não encontrada');
            }

            return $link->original_url;
        });


        return $original_url;
    }
}