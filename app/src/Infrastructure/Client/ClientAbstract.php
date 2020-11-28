<?php

declare(strict_types=1);

namespace App\Infrastructure\Client;

use GuzzleHttp\ClientInterface;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Psr7\Response;

abstract class ClientAbstract
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    protected function getRequest(string $url, array $params = []): Response
    {
        return $this->httpClient->request(Request::METHOD_GET, $url, $params);
    }
}
