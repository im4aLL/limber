<?php
namespace Limber;

class Header
{
    public $responseCode = 200;
    public $addtionalHeaders = [];

    public function __construct($additionalHeaders = [])
    {
        $this->addtionalHeaders = $additionalHeaders;
    }

    /**
     * Set response type
     *
     * @param $contentType
     * @return Header
     */
    public function setResponseType($contentType)
    {
        header($contentType);

        if(count($this->addtionalHeaders) > 0) {
            foreach ($this->addtionalHeaders as $addtionalHeaderKey => $addtionalHeaderValue) {
                header("{$addtionalHeaderKey}: {$addtionalHeaderValue}");
            }
        }

        http_response_code($this->responseCode);

        return $this;
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