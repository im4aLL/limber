<?php
namespace Limber;

class Header
{
    public $responseCode = 200;

    /**
     * Set response type
     *
     * @param $contentType
     */
    public function setResponseType($contentType)
    {
        header($contentType);
        http_response_code($this->responseCode);
    }

    /**
     * Set response type to HTML
     */
    public function setResponseTypeHtml()
    {
        return $this->setResponseType('Content-Type: text/html;charset=utf-8');
    }

    /**
     * Set response type to JSON
     */
    public function setResponseTypeJson()
    {
        return $this->setResponseType('Content-Type: application/json;charset=utf-8');
    }

    /**
     * Set http response code
     *
     * @param $responseCode
     * @return $this
     */
    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;

        return $this;
    }
}