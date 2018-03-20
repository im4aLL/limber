<?php
namespace App\Responder\Example;

class ExampleIndexResponder
{
    public function send($data)
    {
        extract($data);

        ob_start();
        include( VIEW_DIR . '/welcome.php');
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}