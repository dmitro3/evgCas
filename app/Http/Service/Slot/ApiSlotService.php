<?php

namespace App\Http\Service\Slot;

use Illuminate\Support\Facades\Http;

class ApiSlotService
{
    private $url;

    public function __construct()
    {
        $this->url = config('app.url_slot');
    }
    public function createSession($request)
    {
        $response = Http::post($this->url . '/api/session/create', $request);
        return $response;
    }

    public function getGameService($request)
    {
        $response = Http::post($this->url . '/api/slots/gs2c_/gameService', $request);
        return $response;
    }

    public function getStats($request)
    {
        $response = Http::post($this->url . '/api/slots/gs2c/stats.do', $request);
        return $response;
    }

    public function saveSettings($request)
    {
        $response = Http::post($this->url . '/api/slots/gs2c/saveSettings.do', $request);
        return $response;
    }
}