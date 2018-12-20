<?php

namespace App\Controller;

use App\Entity\Histoire;
use App\Entity\User;
use App\Repository\HistoireRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
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
     * @Route("/dashboard/auteur/{id}", name="dashboard")
     */
    public function index(User $user)
    {

        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository(Histoire::class);
        $histoires = $repository->findBy(['user' => $user]);


        //$histoires = $this->repository->findBy(['user' => $user]);
        return $this->render('dashboard/index.html.twig', [
            'user' => $user,
            'id' => $user->getId(),
            'histoires' => $histoires
        ]);
    }


}





