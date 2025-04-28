<?php
namespace App\Http\Service\System;

class GetUserCountry
{
    public function getUserCountry($ip = null)
    {
        if (! $ip) {

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
                '0.0.0.0',
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
        // Используем локальную базу данных MaxMind GeoIP2
        try {
            // Путь к базе данных GeoLite2-Country.mmdb, которую нужно скачать
            $databasePath = storage_path('app/geoip/GeoLite2-City.mmdb');

            // Создаем ридер для работы с базой данных
            $reader = new \GeoIp2\Database\Reader($databasePath);

            // Получаем информацию о городе
            $record = $reader->city($ip);

            $countryCode = $record->country->isoCode;
            $flag        = $this->getCountryFlag($countryCode);

            return [
                'country' => $record->country->name,
                'city'    => $record->city->name,
                'region'  => $record->mostSpecificSubdivision->name,
                'ip'      => $ip,
                'flag'    => $flag,
            ];
        } catch (\Exception $e) {
            // Если не удалось определить местоположение, возвращаем базовые данные
            return response()->json([
                'message' => 'Error getting IP info',
                'error'   => $e->getMessage(),
            ], 500);
            return [
                'country' => 'Unknown',
                'city'    => 'Unknown',
                'region'  => 'Unknown',
                'ip'      => $ip,
                'flag'    => null,
            ];
        }
    }

    private function getCountryFlag($countryCode)
    {
        if (! $countryCode) {
            return null;
        }

        $countryCode = strtoupper($countryCode);
        $flag        = '';

        for ($i = 0; $i < 2; $i++) {
            $flag .= mb_chr(ord($countryCode[$i]) + 127397);
        }

        return $flag;
    }
}
