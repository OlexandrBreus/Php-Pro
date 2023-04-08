<?php

namespace Slim\PhpPro\Short;

use Slim\PhpPro\Short\Exceptions\DataNotFoundException;
use Slim\PhpPro\Short\Interfaces\ICodeRepository;

class Repository implements ICodeRepository
{
    protected array $entity = [];

    public function __construct(protected string $filePath)
    {
        $this->getAllData();
    }


    public function getAllData(): array
    {
        if (file_exists($this->filePath)) {
            $content = file_get_contents($this->filePath);
            $this->entity = (array)json_decode($content, true);
        }
        return $this->entity;
    }

    public function getCodeByUrl(string $url): string
    {
        if (!$code = array_search($url, $this->entity)) {
            throw new DataNotFoundException();
        }
        return $code;
    }

    public function getUrlByCode(string $code): string
    {
        if (!$this->checkCode($code)) {
            throw new DataNotFoundException();
        }
        return $this->entity[$code];
    }

    public function checkCode(string $code): bool
    {
        return isset($this->entity[$code]);
    }

    public function saveCodeAndUrl(string $code, string $url): bool
    {
        $this->entity[$code] = $url;
        return file_put_contents($this->filePath, json_encode($this->entity));
    }
}