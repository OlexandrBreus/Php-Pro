<?php

namespace Slim\PhpPro\shortener\interfaces;

use Slim\PhpPro\shortener\exceptions\DataNotFoundException;
use Slim\PhpPro\shortener\valueObjects\UrlCodePair;

interface ICodeRepository
{
    /**
     * @param UrlCodePair $urlUrlCodePair
     * @return bool
     */
    public function saveEntity(UrlCodePair $urlUrlCodePair): bool;

    /**
     * @param string $code
     * @return bool
     */
    public function codeIsset(string $code): bool;

    /**
     * @param string $code
     * @throws DataNotFoundException
     * @return string url
     */
    public function getUrlByCode(string $code): string;

    /**
     * @param string $url
     * @throws DataNotFoundException
     * @return string code
     */

    public function getCodeByUrl(string $url): string;
}
