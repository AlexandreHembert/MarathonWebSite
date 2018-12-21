<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 19/12/2018
 * Time: 17:03
 */


namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Chapitre;
use App\Entity\Histoire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AvisController extends AbstractController
{

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->token = $tokenStorage;
    }

    /**
     * @Route("/avis/positif/{id}", name="avis_positif_ajout")
     */
    public function newAvisPositif(Histoire $histoire)
    {
        $avis = $em = $this->getDoctrine()->getManager()->getRepository(Avis::class)
            ->findOneBy(['histoires' => $histoire, 'user' => $this->token->getToken()->getUser(), 'positif' => true]);

        $chapitres = $em = $this->getDoctrine()->getManager()->getRepository(Chapitre::class)
            ->findBy(['histoire' => $histoire, 'premier' => false]);
        $parent = $em = $this->getDoctrine()->getManager()->getRepository(Chapitre::class)
            ->findOneBy(['histoire' => $histoire, 'premier' => true]);

        $avisG = $em = $this->getDoctrine()->getManager()->getRepository(Avis::class)
            ->findBy(['histoires' => $histoire, 'positif' => true]);
        $avisB = $em = $this->getDoctrine()->getManager()->getRepository(Avis::class)
            ->findBy(['histoires' => $histoire, 'positif' => false]);

        if($avis){
            return new Response($this->renderView('histoire/show.html.twig',array("histoire" => $histoire, 'chapitres' => $chapitres, 'parent' => $parent, 'avisG' => $avisG, 'avisB' => $avisB)));
        }

        $avis = new Avis();
        $avis->setUsers($this->token->getToken()->getUser());
        $avis->setHistoires($histoire);
        $avis->setPositif(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($avis);
        $em->flush();

        return new Response($this->renderView('histoire/show.html.twig',array("histoire" => $histoire, 'chapitres' => $chapitres, 'parent' => $parent, 'avisG' => $avisG, 'avisB' => $avisB)));

    }

    /**
     * @Route("/avis/negatif/{id}", name="avis_negatif_ajout")
     */
    public function newAvisNegatif(Histoire $histoire)
    {
        $avis = $em = $this->getDoctrine()->getManager()->getRepository(Avis::class)
            ->findOneBy(['histoires' => $histoire, 'user' => $this->token->getToken()->getUser(), 'positif' => false]);

        $chapitres = $em = $this->getDoctrine()->getManager()->getRepository(Chapitre::class)
            ->findBy(['histoire' => $histoire, 'premier' => false]);
        $parent = $em = $this->getDoctrine()->getManager()->getRepository(Chapitre::class)
            ->findOneBy(['histoire' => $histoire, 'premier' => true]);

        $avisG = $em = $this->getDoctrine()->getManager()->getRepository(Avis::class)
            ->findBy(['histoires' => $histoire, 'positif' => true]);
        $avisB = $em = $this->getDoctrine()->getManager()->getRepository(Avis::class)
            ->findBy(['histoires' => $histoire, 'positif' => false]);

        if($avis){
            return new Response($this->renderView('histoire/show.html.twig',array("histoire" => $histoire, 'chapitres' => $chapitres, 'parent' => $parent, 'avisG' => $avisG, 'avisB' => $avisB)));
        }

        $avis = new Avis();
        $avis->setUsers($this->token->getToken()->getUser());
        $avis->setHistoires($histoire);
        $avis->setPositif(false);

        $em = $this->getDoctrine()->getManager();
        $em->persist($avis);
        $em->flush();


        return new Response($this->renderView('histoire/show.html.twig',array("histoire" => $histoire, 'chapitres' => $chapitres, 'parent' => $parent, 'avisG' => $avisG, 'avisB' => $avisB)));

    }
}