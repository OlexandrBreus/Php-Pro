<?php

namespace Slim\PhpPro\Short;

use InvalidArgumentException;
use Slim\PhpPro\Short\Exceptions\DataNotFoundException;
use Slim\PhpPro\Short\Interfaces\ICodeRepository;

class UrlDecoder implements Interfaces\IUrlDecoder
{
    public function __construct(protected ICodeRepository $repository)
    {

    }

    /**
     * @inheritDoc
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
}