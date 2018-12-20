<?php

namespace App\Controller;

use App\Repository\HistoireRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class CoController extends AbstractController
{


    /**
     * @var HistoireRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(HistoireRepository $repository, ObjectManager $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @param HistoireRepository $repository
     * @return Response

     */

// @Route("/histoires", name="search")


    function CoBDD(HistoireRepository $repository)  {
        // Se connecte à la BDD

        //Récupère le titre de l'histoire






        if(isset($_GET['titre'])) {
            $titre = $_GET['titre'];
            $histoire = $repository -> findBy(['titre' => $titre]);
            if($histoire ==null)
                return new Response('false');


        }

        return new Response($histoire);





    }
}

?>