<?php
namespace Limber;

class Validator
{
    /**
     * Sanitize URL string
     *
     * @param $string
     * @return null|string|string[]
     */
    public function sanitizeUrlString($string)
    {
        return preg_replace("/[^a-zA-Z0-9-._]+/", "", $string);
    }
}