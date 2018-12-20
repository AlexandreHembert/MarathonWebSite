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

        $avis = new Avis();
        $search = new HistoireSearch();

        $formSearch = $this->createForm(HistoireSearchType::class, $search);
        $formSearch->handleRequest($request);





        $formAvis = $this->createForm(AvisType::class, $avis);
        $formAvis->handleRequest($request);




        if ($formAvis->isSubmitted() && $formAvis->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();

            return $this->redirectToRoute('visualisation');
        }






        $histoires = $this->repository->findVisibleQuery();

        return $this->render('visualisation/index.html.twig', [
            'histoires' => $histoires,
            'formAvis' => $formAvis->createView(),
            'formSearch' => $formSearch->createView()
        ]);
    }


    /**
     * @Route("/histoire/auteur/{id}", name="histoire_user")
     */
    public function show_histoire(User $user){
        return $this->render('histoire_user/show.html.twig', [
            'user' => $user,
            'id' => $user->getId()
        ]);
    }

    /**
     * @Route("/histoire/genre/{id}", name="histoire_genre")
     */
    public function show_genre(Genre $genre){
        return $this->render('histoire_genre/show.html.twig', [
            'genre' => $genre,
            'id' => $genre->getId()
        ]);
    }




}
