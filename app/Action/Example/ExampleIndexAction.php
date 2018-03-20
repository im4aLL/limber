<?php
namespace App\Action\Example;

use App\Domain\ExampleDomain;
use App\Responder\Example\ExampleIndexResponder;

class ExampleIndexAction
{
    public $exampleDomain;
    public $exampleIndexResponder;

    public function __construct()
    {
        $this->exampleDomain = new ExampleDomain();
        $this->exampleIndexResponder = new ExampleIndexResponder();
    }

    public function __invoke()
    {
        $sports = $this->exampleDomain->all();

        return $this->exampleIndexResponder->send(compact('sports'));
    }
}