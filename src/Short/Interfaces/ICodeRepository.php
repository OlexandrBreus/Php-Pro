<?php

namespace Slim\PhpPro\Short\Interfaces;

use Exception;
use Slim\PhpPro\Short\Exceptions\DataNotFoundException;

interface ICodeRepository
{
    public function getAllData(): array;

    /**
     * @param string $url
     * @throws DataNotFoundException
     * @return string
     */
    public function getCodeByUrl(string $url): string;

    /**
     * @param string $code
     * @throws DataNotFoundException
     * @return string
     */
    public function getUrlByCode(string $code): string;

    public function checkCode(string $code): bool;

    /**
     * @param string $code
     * @param string $url
     * @throws Exception
     * @return bool
     */
    public function saveCodeAndUrl(string $code, string $url): bool;
}

