<?php

require_once "Request.php";
require_once "Response.php";
require_once "model/Auth.php";
require_once "vendor\autoload.php";

//Autoload rules
spl_autoload_register('apiAutoload');
function apiAutoload($classname)
{
    $res = false;

    //If the class name ends in "Controller", then try to locate the class in the controller directory to include it (require_once)
    if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
        if (file_exists(__DIR__ . '/controller/' . $classname . '.php')) {
//            echo "cargamos clase: " . __DIR__ . '/controller/' . $classname . '.php';
            require_once __DIR__ . '/controller/' . $classname . '.php';
            $res = true;
        }
    } elseif (preg_match('/[a-zA-Z]+Model$/', $classname)) {
        if (file_exists(__DIR__ . '/model/' . $classname . '.php')) {
//            echo "<br/>cargamos clase: " . __DIR__ . '/model/' . $classname . '.php';
            require_once __DIR__ . '/model/' . $classname . '.php';
//            echo "clase cargada.......................";
            $res = true;
        }
    }
    //Instead of having Views, like in a Model-View-Controller project,
    //we will have a Response class. So we don't need the following.
    //Although we could have different classes to generate the output,
    //for example: JsonView, XmlView, HtmlView... I think in our case
    //it will be better to have asingle class to generate the output (Response class)
    //elseif (preg_match('/[a-zA-Z]+View$/', $classname)) {
    //    require_once __DIR__ . '/views/' . $classname . '.php';
    //    $res = true;
    //}
    return $res;
}


//Let's retrieve all the information from the request
$verb = $_SERVER['REQUEST_METHOD'];
//IMPORTANT: WITH CGI OR FASTCGI, PATH_INFO WILL NOT BE AVAILABLE!!!
//SO WE NEED FPM OR PHP AS APACHE MODULE (UNSECURE, DEPRECATED) INSTEAD OF CGI OR FASTCGI
$path_info = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
$url_elements = explode('/', $path_info);
//$url_elements = explode('/', $_SERVER['PATH_INFO']);
$query_string = null;
if (isset($_SERVER['QUERY_STRING'])) {
    parse_str($_SERVER['QUERY_STRING'], $query_string);
}
$body = file_get_contents("php://input");
if ($body === false) {
    $body = null;
}
$content_type = null;
if (isset($_SERVER['CONTENT_TYPE'])) {
    $content_type = $_SERVER['CONTENT_TYPE'];
}
$accept = null;
if (isset($_SERVER['HTTP_ACCEPT'])) {
    $accept = $_SERVER['HTTP_ACCEPT'];
}

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
{
    $user = $_SERVER['PHP_AUTH_USER'];
    $pass = $_SERVER['PHP_AUTH_PW'];
}


$req = new Request($verb, $url_elements, $query_string, $body, $content_type, $accept);


// route the request to the right place
$controller_name = ucfirst($url_elements[1]) . 'Controller';
if (class_exists($controller_name)) {
    $controller = new $controller_name();
    $userHandler = new UserHandlerModel();
    $action_name = 'manage' . ucfirst(strtolower($verb)) . 'Verb';


    if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
    {
        if ($userHandler->verifyPassword($user, $pass))
        {
            $controller->$action_name($req);
        }
    }

    else
    {
        if (getBearerToken() != null)
        {
            Auth::Check(getBearerToken());
            $controller->$action_name($req);
        }

        else
        {
            echo 'Lo siento, pero eres un poco tonto.';
        }
    }
    //$result = $controller->$action_name($req);
    //print_r($result);
} //If class does not exist, we will send the request to NotFoundController
else {
    $controller = new NotFoundController();
    $controller->manage($req); //We don't care about the HTTP verb
}

function getAuthorizationHeader(){
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}

function getBearerToken() {
    $headers = getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}

//DEBUG / TESTING:
//echo "<br/>URL_ELEMENTS:" ;
//print_r ($req->getUrlElements());
//echo "<br/>VERB:" ;
//print_r ($req->getVerb());
//echo "<br/>QUERY_STRING:" ;
//print_r ($req->getQueryString());
//echo "<br/>BODY_PARAMS:" ;
//print_r ($req->getBodyParameters());

