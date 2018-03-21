<?php
namespace App\Responder;

use Limber\Header;

abstract class BaseResponder
{
    protected $template = null;
    protected $type = 'html';

    private $data = [];
    private $header;

    /**
     * BaseResponder constructor.
     */
    public function __construct()
    {
        $this->header = new Header();
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

        ob_start();
        include VIEW_DIR . '/'.$this->getTemplate().'.php';
        return ob_get_clean();
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