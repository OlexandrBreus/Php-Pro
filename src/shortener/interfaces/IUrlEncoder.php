<?php

namespace Slim\PhpPro\shortener\interfaces;

interface IUrlEncoder
{
    /**
     * @param string $url
     * @throws \InvalidArgumentException
     * @return string
     */
    public function encode(string $url): string;
}
