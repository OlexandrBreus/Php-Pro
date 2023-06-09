<?php

namespace Slim\PhpPro\shortener\helpers;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use InvalidArgumentException;
use Slim\PhpPro\shortener\interfaces\IUrlValidator;

class UrlValidator implements IUrlValidator
{

    /**
     * @param ClientInterface $client
     */
    public function __construct(protected ClientInterface $client)
    {
    }

    /**
     * @inheritDoc
     */
    public function validateUrl(string $url): bool
    {
        if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)){
            throw new InvalidArgumentException('Url is broken');
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function checkRealUrl(string $url): bool
    {
        $allowCodes = [
            200, 201, 301, 302
        ];
        try {
            $response = $this->client->request('GET', $url);
            return (!empty($response->getStatusCode()) && in_array($response->getStatusCode(), $allowCodes));
        } catch (ConnectException $exception) {
            throw new InvalidArgumentException($exception->getMessage(), $exception->getCode());
        }
    }
}


