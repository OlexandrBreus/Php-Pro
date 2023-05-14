<?php

namespace Slim\PhpPro\Short;

use Slim\PhpPro\Short\Exceptions\DataNotFoundException;
use Slim\PhpPro\Short\Interfaces\ICodeRepository;
use Slim\PhpPro\ORM\ActiveRecord\Models\UrlCode;

class DBRepository implements ICodeRepository
{

    public function getAllData(): array
    {
        $res = (array)UrlCode::all();
        return $res;
    }

    /**
     * @inheritDoc
     */
    public function getCodeByUrl(string $url): string
    {
        $res = UrlCode::query()
            ->where('url', '=', $url)
            ->first();
        if (is_null($res)){
            throw new DataNotFoundException('Code not found');
        }
        return $res->code;
    }

    /**
     * @inheritDoc
     */
    public function getUrlByCode(string $code): string
    {
        $res = UrlCode::query()
            ->where('code', '=', $code)
            ->first();
        if (is_null($res)){
            throw new DataNotFoundException('Url not found');
        }
        return $res->url;
    }

    public function checkCode(string $code): bool
    {
        return (bool)UrlCode::query()
            ->where('code', '=', $code)
            ->count();
    }

    /**
     * @inheritDoc
     */
    public function saveCodeAndUrl(string $code, string $url): bool
    {
        $urlCode = new UrlCode();
        $urlCode->url = $url;
        $urlCode->code = $code;
        return $urlCode->save();
    }
}