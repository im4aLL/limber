<?php
namespace Limber;

class Router
{
    private $routes = [];
    private $urlParams = [];
    private $validator;
    private $requestType;
    private $requestUrlParam;
    private $matchedRoute;

    /**
     * Router constructor.
     * @param array $routes
     */
    public function __construct($routes = [])
    {
        $this->routes = $routes;
        $this->validator = new Validator();
    }

    /**
     * Parse view
     *
     * @return bool|mixed
     * @throws \Exception
     */
    public function run()
    {
        $this->getUrlParam();
        $this->getRequestMethod();
        $this->getMatchedRoute();

        if(is_array($this->matchedRoute)) {
            if(!class_exists($this->matchedRoute['action'])) {
                throw new \Exception('Action not found!');
            }

            try {
                $action = new $this->matchedRoute['action'];
                return call_user_func($action, $this);
            } catch(\Exception $e) {
                throw new \Exception('Action is not callable');
            }
        }
        else {
            $header = new Header();
            $header->setResponseCode(404)->setResponseTypeHtml();

            return $this->view('404');
        }

        return false;
    }

    /**
     * Get current url param
     *
     * @return array
     */
    public function getUrlParam()
    {
        $url = rtrim(str_replace(config()->baseUrl, '', $this->getFullUrl()), '/');
        $url = ltrim($url, '/');

        $urlArray = explode('/', $url);
        $this->urlParams = array_map([$this->validator, 'sanitizeUrlString'], $urlArray);

        $this->requestUrlParam = '/'.implode('/', $this->urlParams);

        return $this->urlParams;
    }

    /**
     * Get current full url
     *
     * @return string
     */
    public function getFullUrl()
    {
        return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    /**
     * Get request method
     *
     * @return mixed
     */
    public function getRequestMethod()
    {
        $this->requestType = $_SERVER['REQUEST_METHOD'];

        return $this->requestType;
    }

    /**
     * Get matched route
     *
     * @return bool|mixed
     */
    public function getMatchedRoute()
    {
        if(count($this->routes) == 0) {
            return false;
        }

        foreach ($this->routes as $route) {
            if(strtolower($route['type']) == strtolower($this->requestType)
            && $route['url'] == $this->requestUrlParam) {
                $this->matchedRoute = $route;

                return $route;
            }
        }

        return false;
    }

    /**
     * Get all routes
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Get view
     *
     * @param int $fileName
     * @param array $data
     * @return string
     */
    protected function view($fileName = 404, $data = []) {
        if (is_array($data) && count($data) > 0) {
            extract($data);
        }

        ob_start();
        include VIEW_DIR . '/'.$fileName.'.php';
        return ob_get_clean();
    }
}