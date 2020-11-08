<?php

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header("HTTP/1.0 404 Not Found");
        echo '{"status": "error", "message": "Route Not Found"}';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        header("HTTP/1.0 405 Method Not Allowed");
        echo '{"status": "error", "message": "Method Not Allowed"}';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        try {
            $result = call_user_func_array($handler, $vars);
            if ($result === null) {
                header("HTTP/1.0 404 Not Found");
                echo '{"status": "ok", "message": "Not Found"}';
                return;
            }
        } catch (Exception $e) {
            if ($e->getCode() == 403) {
                header("HTTP/1.0 403 Forbidden");
                $response = [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                    'data' => $e->getMessage(),
                ];
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                return;
            }
            if ($e->getCode() == 404) {
                header("HTTP/1.0 404 Not Found");
                $response = [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                    'data' => $e->getMessage(),
                ];
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                return;
            }
            echo '{"status": "error", "message":"' . $e->getMessage() . '"}';
            return;
        }
        echo json_encode($result);
        break;
}
