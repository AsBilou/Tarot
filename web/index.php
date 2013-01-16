<?php
// web/index.php

//Include toutes les dépendances
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
$app->register(new Propel\Silex\PropelServiceProvider());

//Appel le fichier twig en fonction de la page
$app->get('/{name}', function ($name) use ($app) {
    try{
        return $app['twig']->render('template/'.$name.'.twig', array(
            'name' => $name,
            'page'=>'page'.$name,
        ));
    }catch(Exception $e){
        if('Twig_Error_Loader'==get_class($e)){
            $app->abort(404,'Twig template does not exist.');
        }
        else
        {
            throw $e;
        }
    }
})->value('name', 'index');

$app->run();

?>