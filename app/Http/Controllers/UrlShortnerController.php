<?php

namespace App\Http\Controllers;

use App\Http\Services\UrlShortnerService;
use App\Models\Link;
use Exception;
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
        try{
            $new_url = $this->UrlShortnerService->redirect($url);
            return redirect()->away($new_url);
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()]);
        }
    }
}
