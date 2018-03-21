<?php
namespace App\Responder\Example;

use App\Responder\BaseResponder;

class ExampleIndexResponder extends BaseResponder
{
    protected $template = 'welcome';
    protected $type = 'html';
}