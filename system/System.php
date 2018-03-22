<?php
namespace Limber;

class System
{
    private $routes;
    public $router;

    /**
     * System constructor.
     */
    public function __construct()
    {
    }

    /**
     * Set routes
     *
     * @param array $array
     * @return $this
     */
    public function route($array = [])
    {
        $this->routes = $array;

        $this->router = new Router($this->routes);

        return $this;
    }

    /**
     * Get routes
     *
     * @return mixed
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Run app
     */
    public function run()
    {
        echo $this->router->run();

        // exit();
    }
}