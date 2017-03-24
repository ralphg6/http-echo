<?php
// composer autoloader for required packages and dependencies
require_once('vendor/autoload.php');

/** @var \Base $f3 */
@$f3 = \Base::instance();

function resolvePath($filename){
  return "/var/lib/http-echo/data{$_SERVER['REQUEST_URI']}.txt";
}

$f3->route('GET /',
    function() {
        echo 'Hello, world!';
    }
);

$f3->route("POST /*", function($f3){
  $path = resolvePath($_SERVER['REQUEST_URI']);

  file_put_contents ($path, file_get_contents('php://input'));
});

$f3->route("GET /*", function($f3){
  $path = resolvePath($_SERVER['REQUEST_URI']);

  if(!file_exists($path)){
    $f3->error(404, 'path not registred');
    return;
  }

  echo file_get_contents ($path);
});

$f3->run();
