<?php

namespace App\Controller;

use App\Entity\Histoire;
use App\Repository\HistoireRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VisualisationController extends AbstractController
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
     * @Route("/", name="visualisation")
     */
    public function index()
    {

        $histoires = $this->repository->findAll();

        return $this->render('visualisation/index.html.twig', [
            'controller_name' => 'VisualisationController',
            'histoires' => $histoires
        ]);
    }


}
