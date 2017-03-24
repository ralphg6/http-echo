<?php
// composer autoloader for required packages and dependencies
require_once('vendor/autoload.php');

/** @var \Base $f3 */
@$f3 = \Base::instance();

$f3->route('GET /',
    function() {
        echo 'Hello, world!';
    }
);

$f3->route("POST /*",function(){
  $get_string = file_get_contents('php://input');
  file_put_contents ("/var/lib/http-echo/data{$_SERVER['REQUEST_URI']}.txt" , $get_string);
});

$f3->route("GET /*",function(){
  echo file_get_contents ("/var/lib/http-echo/data{$_SERVER['REQUEST_URI']}.txt");
});

$f3->run();
