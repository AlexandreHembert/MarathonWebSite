<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Genre;
use App\Entity\HistoireSearch;
use App\Entity\User;
use App\Form\AvisType;
use App\Form\HistoireSearchType;
use App\Repository\ChapitreRepository;
use App\Repository\HistoireRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/histoires", name="visualisation")
     */
    public function index(HistoireRepository $repo,Request $request)
    {

        $search = new HistoireSearch();
        $formSearch = $this->createForm(HistoireSearchType::class, $search);
        $formSearch->handleRequest($request);
        $histoires = $this->repository->findAll();

        return $this->render('visualisation/index.html.twig', [
            'histoires' => $histoires,
            'formSearch' => $formSearch->createView()
        ]);
    }


    /**
     * @Route("/histoire/auteur/{id}", name="histoire_user")
     */
    public function show_histoire(User $user){

        $histoires = $this->repository->findBy(['user' => $user]);



        return $this->render('histoire_user/show.html.twig', [
            'user' => $user,
            'id' => $user->getId(),
            'histoires'=>$histoires
        ]);
    }

    /**
     * @Route("/histoire/genre/{id}", name="histoire_genre")
     */
    public function show_genre(Genre $genre){

        $histoires = $this->repository->findBy(['genre' => $genre]);

        return $this->render('histoire_genre/show.html.twig', [
            'genre' => $genre,
            'id' => $genre->getId(),
            'histoires'=>$histoires
        ]);
    }




}
