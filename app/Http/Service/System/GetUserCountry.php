<?php

namespace App\Http\Service\System;

use Illuminate\Support\Facades\Http;

class GetUserCountry
{
    public function getUserCountry($ip = null)
    {   
        if(!$ip){

            $cfIp = request()->header('CF-Connecting-IP');

            if ($cfIp) {
                return $cfIp;
            }
    
            $forwardedIp = request()->header('X-Forwarded-For');
            if ($forwardedIp) {
                $ips = explode(',', $forwardedIp);
                return trim($ips[0]);
            }
    
            $ip = request()->ip();
    
            $localIps = [
                '127.0.0.1',
                '::1',
                'localhost',
                '0.0.0.0'
            ];
    
            if (in_array($ip, $localIps)) {
                return null;
            }
        }

        $ipInfo = $this->getIpInfo($ip);

        if ($ipInfo) {
            return $ipInfo;
        }

        return null;
    }

    private function getIpInfo($ip)
    {

        $response = Http::get("http://ip-api.com/json/{$ip}");

        if ($response->successful()) {
            $data = $response->json();

            $flag = $this->getCountryFlag($data['countryCode'] ?? null);



            return [
                'country' => $data['country'] ?? null,
                'city' => $data['city'] ?? null,
                'region' => $data['regionName'] ?? null,
                'ip' => $ip,
                'flag' => $flag
            ];
        }
        return null;
    }

    private function getCountryFlag($countryCode)
    {
        if (!$countryCode) return null;

        $countryCode = strtoupper($countryCode);
        $flag = '';

        for ($i = 0; $i < 2; $i++) {
            $flag .= mb_chr(ord($countryCode[$i]) + 127397);
        }

        return $flag;
    }
}
