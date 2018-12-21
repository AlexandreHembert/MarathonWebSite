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
        $em = $this->getDoctrine()->getManager();
        $repoAvis = $em->getRepository(Avis::class);
        $repoChapitre = $em->getRepository(Chapitre::class);

        $avis = $repoAvis
            ->findOneBy(['histoires' => $histoire, 'user' => $this->getUser()]);

        $chapitres = $repoChapitre
            ->findBy(['histoire' => $histoire, 'premier' => false]);
        $parent = $repoChapitre
            ->findOneBy(['histoire' => $histoire, 'premier' => true]);

        $avisG = $repoAvis
            ->findBy(['histoires' => $histoire, 'positif' => true]);

        $avisB = $repoAvis
            ->findBy(['histoires' => $histoire, 'positif' => false]);

        if ($avis) {
            $em->remove($avis);


            return new Response($this->renderView('histoire/show.html.twig', array("histoire" => $histoire, 'chapitres' => $chapitres, 'parent' => $parent, 'avisG' => $avisG, 'avisB' => $avisB)));
        }

        $avis = new Avis();
        $avis->setUsers($this->token->getToken()->getUser());
        $avis->setHistoires($histoire);
        $avis->setPositif(true);

        $em->persist($avis);
        $em->flush();

        return new Response($this->renderView('histoire/show.html.twig', array("histoire" => $histoire, 'chapitres' => $chapitres, 'parent' => $parent, 'avisG' => $avisG, 'avisB' => $avisB)));

    }

    /**
     * @Route("/avis/negatif/{id}", name="avis_negatif_ajout")
     */
    public function newAvisNegatif(Histoire $histoire)
    {
        $em = $this->getDoctrine()->getManager();
        $repoAvis = $em->getRepository(Avis::class);
        $repoChapitre = $em->getRepository(Chapitre::class);

        $avis = $repoAvis
            ->findOneBy(['histoires' => $histoire, 'user' => $this->getUser(), 'positif' => false]);

        $chapitres = $repoChapitre
            ->findBy(['histoire' => $histoire, 'premier' => false]);
        $parent = $repoChapitre
            ->findOneBy(['histoire' => $histoire, 'premier' => true]);

        $avisG = $repoAvis
            ->findBy(['histoires' => $histoire, 'positif' => true]);
        $avisB = $repoAvis
            ->findBy(['histoires' => $histoire, 'positif' => false]);

        if ($avis) {
            return new Response($this->renderView('histoire/show.html.twig', array("histoire" => $histoire, 'chapitres' => $chapitres, 'parent' => $parent, 'avisG' => $avisG, 'avisB' => $avisB)));
        }

        $avis = new Avis();
        $avis->setUsers($this->token->getToken()->getUser());
        $avis->setHistoires($histoire);
        $avis->setPositif(false);

        $em->persist($avis);
        $em->flush();


        return new Response($this->renderView('histoire/show.html.twig', array("histoire" => $histoire, 'chapitres' => $chapitres, 'parent' => $parent, 'avisG' => $avisG, 'avisB' => $avisB)));

    }
}