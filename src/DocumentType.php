<?php
/**
 * Created by PhpStorm.
 * User: mnv
 * Date: 18.01.17
 * Time: 23:42
 */

namespace Mnvx\Lowrapper;


class DocumentType
{
    const WRITER = 'writer';
    const CALC = 'calc';
    const DRAW = 'draw';
    const IMPRESS = 'impress';
    const BASE = 'base';
    const MATH = 'math';
    const GLOBAL = 'global';
    const WEB = 'web';

    protected static $values = [
        self::WRITER,
        self::CALC,
        self::DRAW,
        self::IMPRESS,
        self::BASE,
        self::MATH,
        self::GLOBAL,
        self::WEB,
    ];

    /**
     * List of available document types
     * @return string[]
     */
    public static function getAvailableValues()
    {
        return static::$values;
    }

}