<?php
/**
 * Console log
 *
 * @param $data
 * @param bool $exit
 */
function dd($data, $exit = true) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if($exit) {
        exit();
    }
}

/**
 * Get config
 *
 * @return object
 */
function config() {
    global $config;

    return (object) $config;
}

/**
 * Parse named route to url
 *
 * @param null $name
 * @return string
 * @throws Exception
 */
function route($name = null) {
    if(!$name) {
        return config()->baseUrl;
    }

    global $app;

    $routes = $app->getRoutes();
    if(is_array($routes) && count($routes) > 0) {
        foreach ($routes as $route) {
            if(isset($route['name']) && $route['name'] == $name) {
                if($route['url'] == '/') {
                    return config()->baseUrl;
                }

                return config()->baseUrl.$route['url'];
            }
        }

        throw new Exception('No route found with name: '. $name);
    }
    else {
        throw new Exception('Route not defined');
    }
}

/**
 * Get current route
 *
 * @return mixed
 */
function currentRoute() {
    global $app;

    return $app->router->getMatchedRoute();
}

/**
 * String to slug
 *
 * @param $text
 * @return null|string|string[]
 */
function stringToSlug($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);

    if (empty($text)) {
        return 'error';
    }

    return $text;
}