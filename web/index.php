<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Reigster the Twig templating engine
$app->register(new Silex/Provider/TwigServiceProvider(), array(
	'twig.path' => __DIR__.'/../views',
));

$app->get('/twig/{name}', function ($name) user ($app) {
	return $app['twig']->render('index.twig', array(
		'name' => $name,
	))
});

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return "Hello Friends";
  //return str_repeat('Hello', getenv('TIMES'));
});

$app->run();
