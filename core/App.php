<?php

class App {
    
    protected $controller;
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Get controller. If none specified, return 400.
        if (isset($url[0])) {
            // Check controller exists.
            if(file_exists($_ENV['dir_controllers'].$url[0].'.php')) {
                $this->controller = $url[0];
                unset($url[0]);
                require_once $_ENV['dir_controllers'].$this->controller.'.php';
            } else {
                http_response_code(400);
                return;
            }
        } else {
            http_response_code(400);
            return;
        }
        $this->controller = new $this->controller;
        
        // Get method if specified.
        if (isset($url[1])) {
            // Check method exists.
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Get parameters if specified, else empty array.
        $this->params = $url ? array_values($url) : [];

        // Call specified method on specified controller.
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    public static function validateGoogleIdToken($id_token) {
        require_once 'vendor/autoload.php';

        $client = new Google_Client(['client_id' => $_ENV['google_client_id']]);
        try {
            $payload = $client->verifyIdToken($id_token);
        } catch (UnexpectedValueException $e) {
            echo 'Google OAuth2.0 error: ' . $e->getMessage();
            return null;
        }

        if ($payload) {
            return $payload;
        } else {
            return null;
        }
    }
}