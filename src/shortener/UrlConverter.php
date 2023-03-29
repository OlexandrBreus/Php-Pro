<?php

namespace Slim\PhpPro\shortener;

use InvalidArgumentException;
use Slim\PhpPro\shortener\interfaces\{IUrlDecoder, IUrlEncoder, IUrlValidator, ICodeRepository};
use Slim\PhpPro\shortener\valueObjects\UrlCodePair;
use Slim\PhpPro\shortener\exceptions\DataNotFoundException;

class UrlConverter implements IUrlEncoder, IUrlDecoder
{
    const CODE_LENGTH = 6;
    const CODE_CHAIRS = '0123456789abcdefghijklmnopqrstuvwxyz';

    protected ICodeRepository $repository;
    protected int $codelength;
    protected IUrlValidator $validator;

    /**
     * @param ICodeRepository $repository
     * @param int $codelength
     * @param IUrlValidator $validator
     */
    public function __construct(
        ICodeRepository $repository,
        IUrlValidator   $validator,
        int             $codelength = self::CODE_LENGTH
        )
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->codelength = $codelength;
    }

    /**
     * @param string $url
     * @throws \InvalidArgumentException
     * @return string
     */
    public function encode(string $url): string
    {
        $this->validateUrl($url);
        try {
            $code = $this->repository->getCodeByUrl($url);
        } catch (DataNotFoundException $e) {
            $code = $this->generateAndSaveCode($url);
        }
        return $code;
    }

    /**
     * @param string $code
     * @throws \InvalidArgumentException
     * @return string
     */
    public function decode(string $code): string
    {
        try {
            $code = $this->repository->getUrlByCode($code);
        } catch (DataNotFoundException $e) {
            throw new InvalidArgumentException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
        }
        return $code;
    }

    /**
     * @description
     * @param string $url
     * @return string
     */
    protected function generateAndSaveCode(string $url): string
    {
        $code = $this->generateUniqueCode();
        $this->repository->saveEntity(new UrlCodePair($code, $url));
        return $code;
    }

    protected function validateUrl(string $url): bool
    {
        $result = $this->validator->validateUrl($url);
        $this->validator->checkRealUrl($url);
        return $result;
    }

    protected function generateUniqueCode(): string
    {
        $date = new \DateTime();
        $str = static::CODE_CHAIRS . mb_strtoupper(static::CODE_CHAIRS) . $date->getTimestamp();
        return substr(str_shuffle($str), 0, $this->codelength);
    }
}
