<?php
     declare(strict_types = 1);

     require_once(__DIR__ .'/../database/session.class.php');

     $session = new Session();

     if (!$session->isLoggedIn()) die(header('Location: /'));
 
     require_once(__DIR__ .'/../database/connection.db.php');
     require_once(__DIR__ .'/../database/dish.class.php');
 
     $db = getDatabaseConnection();


     Dish::removeFavoriteDish($db,intval($_GET['dishId']), $session->getId());
     
?>