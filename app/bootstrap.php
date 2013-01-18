<?php

require_once __DIR__.'/../vendor/autoload.php';

//Crée une nouvelle application
$app = new Silex\Application();

//Affiche les bugs
$app['debug']=true;

//Mise en route de twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

//Mise en route de propel
$app->register(new Propel\Silex\PropelServiceProvider(), array(
    'propel.config_file' => __DIR__ . '/../config/tarot-conf.php',
    'propel.model_path'  => __DIR__ . '/../src',
));
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));

//Mise en route du service formulaire
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new Silex\Provider\SwiftmailerServiceProvider());

/*
$app['swiftmailer.options'] = array(
	'host' => $app['mailer.host'],
	'port' => $app['mailer.port']
);
*/

$app->register(new Knp\Provider\ConsoleServiceProvider(), array(
	'console.name'              => 'Tarot',
	'console.version'           => '1.0.0',
	'console.project_directory' => __DIR__.'/..'
));

return $app;

?>