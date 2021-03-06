<?php

declare(strict_types=1);

namespace App\Infrastructure\Client;

use App\Infrastructure\Enum\OwcEnum;
use App\Infrastructure\Factory\TemperatureFactory;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;

use function sprintf;

class OWClient extends ClientAbstract implements ClientInterface
{
    /**
     * @var TemperatureFactory
     */
    private $temperatureFactory;

    public function __construct(string $apiKey, GuzzleClientInterface $httpClient, TemperatureFactory $temperatureFactory)
    {
        parent::__construct($apiKey, $httpClient);

        $this->temperatureFactory = $temperatureFactory;
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
                $temperature = $result[OwcEnum::RESPONSE_MAIN_INDEX][OwcEnum::RESPONSE_TEMP_INDEX];

                return $this->temperatureFactory->create($temperature);
            }
        }

        return null;
    }
}
