<?php
namespace App\Responder;

use Limber\Header;
use Limber\Minify;

abstract class BaseResponder
{
    protected $template = null;
    protected $type = 'html';
    protected $additionalHeaders = [];

    private $data = [];
    private $header;
    private $outputType = '';

    /**
     * BaseResponder constructor.
     */
    public function __construct()
    {
        $this->header = new Header($this->additionalHeaders);

        $this->outputType = config()->outputType;
    }

    /**
     * Determine what type of data browser will show
     *
     * @param array $data
     * @return string|void
     */
    public function send($data = [])
    {
        $this->data = $data;

        if($this->type == 'html') {
            return $this->render();
        }
        elseif($this->type == 'json') {
            return $this->renderJson();
        }

        return $this->render();
    }

    /**
     * Render html
     *
     * @return string
     */
    private function render()
    {
        $this->header->setResponseTypeHtml();

        if (is_array($this->data) && count($this->data) > 0) {
            extract($this->data);
        }

        if(!$this->templateExists()) {
            $this->template = 'default';
        }

        switch ($this->outputType) {
            case 'compress':
                ob_start('ob_gzhandler');
                include VIEW_DIR . '/'.$this->getTemplate().'.php';
                $output = ob_get_contents();
                $output = Minify::html($output);
                ob_end_clean();

                return $output;
            break;

            case 'compact';
                ob_start('ob_gzhandler');
                include VIEW_DIR . '/'.$this->getTemplate().'.php';
                $output = ob_get_contents();
                $output = Minify::html($output);
                ob_end_clean();

                return $output;
            break;

            default:
                ob_start('ob_gzhandler');
                include VIEW_DIR . '/'.$this->getTemplate().'.php';
                return ob_get_clean();
            break;
        }


    }

    /**
     * Render JSON
     */
    private function renderJson()
    {
        $this->header->setResponseTypeJson();

        echo json_encode($this->data);

        return;
    }

    /**
     * Get template file name
     *
     * @return null|string|string[]
     */
    private function getTemplate()
    {
        if(!$this->template) {
            $currentRoute = currentRoute();

            $this->template = stringToSlug($currentRoute['url']);
        }

        return $this->template;
    }

    /**
     * If template file exists
     *
     * @return bool
     */
    private function templateExists()
    {
        return file_exists(VIEW_DIR . '/'.$this->getTemplate().'.php');
    }
}