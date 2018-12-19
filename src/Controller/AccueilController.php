<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 19/12/2018
 * Time: 17:03
 */


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="show_accueil")
     */
    public function ShowAccueil()
    {
        //return new Response("abc");

        return new Response($this->render('accueil.html.twig',array()));

    }
}