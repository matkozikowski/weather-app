<?php

declare(strict_types=1);

namespace App\Infrastructure\Client;

use App\Infrastructure\Enum\WeatherStackEnum;

class WeatherStackClient extends ClientAbstract implements ClientInterface
{
    public function getResponse(string $city, string $country): ?float
    {
        $params = [
            'query' => [
                'query' => sprintf('%s, %s', $city, $country),
                'access_key' => $this->apiKey,
            ]
        ];

        $response = $this->getRequest(WeatherStackEnum::WEATHER_ENDPOINT, $params);

        if (200 == $response->getStatusCode()) {
            $result = json_decode($response->getBody()->getContents(), true);

            if (isset($result[WeatherStackEnum::RESPONSE_MAIN_INDEX][WeatherStackEnum::RESPONSE_TEMP_INDEX])) {
                return $result[WeatherStackEnum::RESPONSE_MAIN_INDEX][WeatherStackEnum::RESPONSE_TEMP_INDEX];
            }
        }
    }
}
