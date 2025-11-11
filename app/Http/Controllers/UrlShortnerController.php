<?php

namespace App\Http\Controllers;

use App\Http\Services\UrlShortnerService;
use App\Models\Link;
use GuzzleHttp\Psr7\Header;
use Illuminate\Http\Request;

class UrlShortnerController extends Controller
{
    protected $UrlShortnerService;

    public function __construct() {
        $this->UrlShortnerService = new UrlShortnerService();
    }

    public function save(Request $request){
        $response = $this->UrlShortnerService->saveShortnedUrl($request);

        return response()->json($response);
    }

    public function redirect($url){
        $url_origin = Link::where('short_code',$url)->first();

        if(!$url_origin){
            return response()->json(['message'=>'url nao encontrada'],404);
        }

        return redirect()->away($url_origin->original_url);
    }
}
