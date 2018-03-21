<?php
namespace App\Action\Example;

use App\Responder\Example\ExampleAnotherResponder;

class ExampleAnotherAction
{
    public $exampleAnotherResponder;

    public function __construct()
    {
        $this->exampleAnotherResponder = new ExampleAnotherResponder();
    }

    public function __invoke($route)
    {
        return $this->exampleAnotherResponder->send();
    }
}