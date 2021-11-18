<?php 

// define('ROOT', dirname(__DIR__));
require_once __DIR__ . '/vendor/autoload.php';

use cinema\controllers\FrontController;
use cinema\controllers\BackController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/src/views');
$twig = new Environment($loader, ['cache' => false, 'debug' => true ]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$fc = new FrontController($twig);
$bc = new BackController($twig);

function m($v){
    echo "<hr><br><pre>";print_r($v); echo "</pre><hr>";die(); 
}

$base  = dirname($_SERVER['PHP_SELF']);

if(ltrim($base, '/')){ 
    $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($base));
}

$klein = new \Klein\Klein();

function montreMoi($cetteFuckingVariable) {
    echo "<pre>" ;
    print_r($cetteFuckingVariable) ;
    echo "</pre>" ;
    }

$klein->respond("GET", '/', function() use ($fc) {
    $fc->index();
});

$klein->respond ("GET", '/genres', function() use ($fc) {    
    $fc->genres();
});

$klein->respond ("GET", '/actors', function() use ($fc) {    
    $fc->actors();
});

$klein->respond ("GET", '/directors', function() use ($fc) {    
    $fc->directors();
});

$klein->respond ("GET", '/movies', function() use ($fc) {    
    $fc->movies();
});

$klein->respond ("GET", '/movie/[:id]', function($request) use ($fc) {
    $fc->movie($request->id);
});

$klein->respond ("GET", '/addmovie', function() use ($fc) {
    $fc->addmovie();
});

$klein->respond ("GET", '/addgenre', function() use ($fc) {
    $fc->addgenre();
});


$klein->respond ("GET", '/adddirector', function() use ($fc) {
    $fc->adddirector();
});

$klein->respond ("GET", '/addactor', function() use ($fc) {
    $fc->addactor();
});

$klein->respond('POST','/addgenre', function($request, $post) use($bc) {
    $bc->addGenre($request->paramsPost());
});

$klein->respond('POST','/adddirector', function($request, $post) use($bc) {
    $bc->addDirector($request->paramsPost());
});

$klein->respond('POST','/addactor', function($request, $post) use($bc) {
    $bc->addactor($request->paramsPost());
});

$klein->respond('POST','/addmovie', function($request, $post) use($bc) {
    $bc->addMovie($request->paramsPost());
});



$klein->dispatch();

?>