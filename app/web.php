<?php

use Silex\Provider\FormServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

$app = require __DIR__.'/bootstrap.php';

//Controlers

//Appel le fichier twig en fonction de la page
$app->get('/', function () use ($app) {
    //Tableau de données
    $array_game = array();
    $array_player = array();
    //Recupere le tournois actif
    $tournaments = TournamentQuery::create()
        ->filterByActive(true)
        ->find();
    //Recuperer les player du tournois
    $player_tournament = TournamentPlayerQuery::create()
        ->filterByTournamentId($tournaments[0]->getId())
        ->find();
    //Recupere les games du tournois
    $games = GameQuery::create()
        ->filterByTournamentId($tournaments[0]->getId())
        ->find();
    //recupere les player de la game
    foreach($games as $game){
        $gameId = $game->getId();
        //recupération des joueurs
        $player_game[$gameId] = GamePlayerQuery::create()
        ->filterByGame($game)
        ->find();
    }
    //Comparaison des deux
    //Parcour de chaque game
    foreach($games as $game){
        $game_id=$game->getId();
        $array_game['game_'.$game_id]['id_game'] = $game_id;
        $game_bids = $game->getBids();
        $array_game['game_'.$game_id]['bids'] = $game_bids;
        $game_score = $game->getScore();
        $array_game['game_'.$game_id]['score'] = $game_score;
        foreach($player_tournament as $player){
            $player_id_tournament = $player->getPlayerId();
            $array_game['game_'.$game_id]['players'][$player_id_tournament]['score'] = 'OUT';
            $array_game['game_'.$game_id]['players'][$player_id_tournament]['type'] = 'OUT';
            foreach($player_game[$game->getId()] as $player){
                 $player_id_game = $player->getPlayerId();
                if($player_id_tournament == $player_id_game){
                    $array_game['game_'.$game_id]['players'][$player_id_tournament]['score'] = $player->getScore();
                    $array_game['game_'.$game_id]['players'][$player_id_tournament]['type'] = $player->getType();
                }
            }
        }
    }

    foreach($player_tournament as $player_in_game){
        $array_player['player_'.$player_in_game->getPlayerId()]['id']=$player_in_game->getPlayerId();
        $array_player['player_'.$player_in_game->getPlayerId()]['score']=$player_in_game->getScore();
        $array_player['player_'.$player_in_game->getPlayerId()]['name']=$player_in_game->getPlayer()->getName();
    }
    
     /*
    echo '<pre>';
        print_r($array_game);
    echo '</pre>';
*/
    return $app['twig']->render('template/index.twig', array(
        'array' => $array_game,
        'players' => $array_player,
        'id_tournament'=>$tournaments[0]->getId()
    ));

    //Récuperer tous les tournois
    
    //var_dump($tournaments);
    
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

//Ajout d'une nouvelle game au tournois
$app->match('/game/new/{id_tournament}', function ($id_tournament) use ($app) {
    //Récupere l'id du tournament
    $id_tournament;
    //On affiche un formulaire a remplire
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
    return $app['twig']->render('template/newGame.twig', array('form' => $form->createView()));
    //On recupere les player du tournois
    
});

return $app;

?>