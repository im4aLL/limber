<?php
namespace Limber;

class Validator
{
    public function sanitizeUrlString($string)
    {
        return preg_replace("/[^a-zA-Z0-9-._]+/", "", $string);
    }
}