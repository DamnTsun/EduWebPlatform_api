<?php

class App {

    const ADD_KEYWORD = 'add';
    const DELETE_KEYWORD = 'delete';

    /*
    Param 1 is controller.
    Param 2 is value, such as subjectName / userID.
    Param 3 is method for controller.
    Only param 1 is required, though params 2 / 3 are necessary for most functionality.
    */
    private $router;
    protected $controller;
    protected $controllerValue;
    protected $method = 'index';
    protected $methodValue;
    protected $params = [];


    /**
     * Entry point for app once all pre-init stuff has happened in index.php.
     */
    public function __construct() {
        // Create router instance.
        $this->router = new Router();
        
        // Parse url, getting rid of all the bad things...
        $urlFragments = $this->parseUrl();
        // Return BAD REQUEST if url is just base directory.
        if (!isset($urlFragments)) {
            http_response_code(400); return;
        }

        // Reconstruct url with slashes using sanitized fragments.
        $url = '';
        foreach ($urlFragments as $frag) {
            $url = $url . '/' . $frag;
        }
        
        // Attempt to match a route.
        $this->router->checkRoutes($url, $urlFragments);
    }

    /**
     * Parses url get parameter. Parameter is provided by URL writing in .htaccess.
     */
    protected function parseUrl() {
        if (isset($_GET['url'])) {
            // Replace spaces with '+' since FILTER_SANITIZE_URL would remove them.
            $url = str_replace(' ', '+', $_GET['url']);
            $url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));

            // Convert '+' back into spaces.
            for ($i = 0; $i < count($url); $i++) {
                $url[$i] = str_replace('+', ' ', $url[$i]);
            }
            return $url;
        }
    }





    /**
     * Gets GET parameter corresponding to given value. If GET parameter is not set, the given default value is returned.
     * @param paramName - String index of GET parameter in $_GET array.
     * @param defaultValue - Value to be returned if $_GET[$paramName] is not set.
     * @param isInt - Whether retrieved value should be an integer.
     */
    public static function getGETParameter($paramName, $defaultValue, $isInt = false) {
        // If valid parameter name given, and it is set in $_GET, and the value is an integer
        if (isset($paramName) &&
            isset($_GET[$paramName])) {
                // If value should be an int, check it and return it if it is an int.
                if ($isInt) {
                    if (App::stringIsInt($_GET[$paramName])) {
                        return (int)$_GET[$paramName];
                    }
                // Otherwise just return value.
                } else {
                    return $_GET[$paramName];
                }
        }
        // Validation failed. Return default value.
        return $defaultValue;
    }





    /**
     * Returns whether the given string is an integer.
     * Returns true is a int is given.
     * Returns false if non-string given.
     * Returns false if the given value is numeric but has decimal places.
     * @param value - input string.
     */
    public static function stringIsInt($value) {
        // Check if already an int.
        if (is_integer($value)) { return true; }
        // Check it is a string.
        if (!is_string($value)) { return false; }
        // Check it only contains numbers. (0 - 9)
        return preg_match('/^[0123456789]+$/', $value) == 1;
    }

}