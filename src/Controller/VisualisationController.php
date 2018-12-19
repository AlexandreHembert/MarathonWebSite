<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
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
     * @Route("/", name="visualisation")
     */
    public function index(Request $request)
    {

        $avis = new Avis();
        $formAvis = $this->createForm(AvisType::class, $avis);
        $formAvis->handleRequest($request);

        if ($formAvis->isSubmitted() && $formAvis->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();

            return $this->redirectToRoute('visualisation');
        }

        $histoires = $this->repository->findAll();

        return $this->render('visualisation/index.html.twig', [
            'controller_name' => 'VisualisationController',
            'histoires' => $histoires,
            'formAvis' => $formAvis->createView()
        ]);
    }


}
