<?php

namespace Slim\PhpPro\Short;

use Exception;
use InvalidArgumentException;
use Slim\PhpPro\Short\Interfaces\ICodeRepository;
use Slim\PhpPro\Short\Interfaces\IUrlEncoder;

class UrlEncoder implements IUrlEncoder
{
    const CODE_CHAIRS = '0123456789abcdefghijklmnopqrstuvwxyz';
    protected int $codeLength = 8;

    public function __construct(protected ICodeRepository $repository)
    {

    }

    /**
     * @inheritDoc
     */
    public function encode(string $url): string
    {
        $this->validateUrl($url);
        $code = $this->generateUniqueCode();
        try {
            $this->repository->saveCodeAndUrl($code, $url);
        } catch (Exception $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
        return $code;
    }


    protected function validateUrl(string $url): bool
    {
        if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)){
            throw new InvalidArgumentException('Url is broken');
        }
        return true;
    }

    protected function generateUniqueCode(): string
    {
        $date = new \DateTime();
        $str = static::CODE_CHAIRS . mb_strtoupper(static::CODE_CHAIRS) . $date->getTimestamp();
        return substr(str_shuffle($str), 0, $this->codeLength);
    }
}