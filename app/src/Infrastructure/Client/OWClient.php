<?php

declare(strict_types=1);

namespace App\Infrastructure\Client;

use App\Infrastructure\Enum\OwcEnum;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;

use function sprintf;

class OWClient extends ClientAbstract implements ClientInterface
{
    private $apiKey;

    public function __construct(GuzzleClientInterface $httpClient, string $apiKey)
    {
        parent::__construct($httpClient);

        $this->apiKey = $apiKey;
    }

    public function getResponse(string $city, string $country): ?float
    {
        $params = [
            'query' => [
                'q' => sprintf('%s, %s', $city, $country),
                'appid' => $this->apiKey,
            ]
        ];

        $response = $this->getRequest(OwcEnum::WEATHER_ENDPOINT, $params);

        if (200 == $response->getStatusCode()) {
            $result = json_decode($response->getBody()->getContents(), true);

            if (isset($result[OwcEnum::RESPONSE_MAIN_INDEX][OwcEnum::RESPONSE_TEMP_INDEX])) {
                return $result[OwcEnum::RESPONSE_MAIN_INDEX][OwcEnum::RESPONSE_TEMP_INDEX];
            }
        }

        return null;
    }
}
