<?php
// web/index.php
use Silex\Provider\FormServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

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
$app->register(new Propel\Silex\PropelServiceProvider(), array(
    'propel.config_file' => __DIR__ . '/../config/tarot-conf.php',
    'propel.model_path'  => __DIR__ . '/../src',
));
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));

//Mise en route du service formulaire
$app->register(new FormServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());


//Appel le fichier twig en fonction de la page
$app->get('/', function () use ($app) {
    //Affiche tous les tournois actif
    $tournaments = TournamentQuery::create()
        ->filterByActive(true)
        ->find();
    
    //Récuperer tous les tournois
    
    //var_dump($tournaments);

    try{
        return $app['twig']->render('template/index.twig', array(
            'tournaments' => $tournaments,
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
});

$app->get('/tournament', function () use ($app) {
//Affiche tous les tournois actif
$tournaments = TournamentQuery::create()
    ->find();
    
    //var_dump($tournaments);

    try{
        return $app['twig']->render('template/tournament.twig', array(
            'tournaments' => $tournaments,
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
});

$app->get('/tournament/create', function () use ($app) {
    //Insert un nouveau tournoi
    $tournament = new Tournament();
    $tournament->setActive(false);
    $tournament->setDatestart(time());
    $tournament->save();
    try{
        return $app['twig']->render('template/tournamentCreate.twig');
    }catch(Exception $e){
        if('Twig_Error_Loader'==get_class($e)){
            $app->abort(404,'Twig template does not exist.');
        }
        else
        {
            throw $e;
        }
    }
});

$app->get('/player', function () use ($app) {
//Affiche tous les tournois actif
    $players = PlayerQuery::create()
        ->find();
        
        return $app['twig']->render('template/player.twig', array(
            'players' => $players,
        ));
});

/*
$app->get('/player/create', function () use ($app) {
    //Insert un nouveau tournoi
    $player = new Player();
    $player->setNameplayer('Aurelien');
    $player->setMailplayer('aurelien@yopmail.com');
    $player->save();
    try{
        return $app['twig']->render('template/playerCreate.twig');
    }catch(Exception $e){
        if('Twig_Error_Loader'==get_class($e)){
            $app->abort(404,'Twig template does not exist.');
        }
        else
        {
            throw $e;
        }
    }
});
*/

$app->match('/addPlayer', function (Request $request) use ($app) {
    // some default data for when the form is displayed the first time
    
    $form = $app['form.factory']->createBuilder('form')
        ->add('name')
        ->add('email', 'email', array(
            'label' => 'Your Email',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(array('message' => 'Don\'t leave blank')),
                new Assert\Email(array('message' => 'Invalid email address'))
            ),
            'attr' => array(
            'placeholder' => 'email@example.com'
            )
        ))
        ->getForm();
        
        if ('POST' == $request->getMethod()) {
        $form->bind($request);
        
        if ($form->isValid()) {
            $data = $form->getData();
            
            var_dump($data);
            // do something with the data
            $player = new Player();
            $player->setNameplayer($data['name']);
            $player->setMailplayer($data['email']);
            $player->save();
            // redirect somewhere
            return $app->redirect($app['url_generator']->generate('form_send'));
        }
    }

    
    // display the form
    return $app['twig']->render('template/form.twig', array('form' => $form->createView()));
})
->bind('form_send');

$app->run();

?>