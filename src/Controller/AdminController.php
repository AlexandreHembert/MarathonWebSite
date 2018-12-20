<?php

namespace App\Controller;
use App\Entity\User;

use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="show_admin")
     */
	  public function ShowAdmin(Request $request)
    {
        //Get repository like will be usefull to check our data and define the list of user/admin/assistance
      $repository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('App\Entity\User');

                                   


      $listUser = $repository->findAll();


      return new Response($this->render('admin.html.twig',array("users"=>$listUser)));
    }


    /**
     * @Route("/admin/register", name="admin_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder) {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            $this->addFlash('success','Votre compte a bien été crée');

            return $this->redirectToRoute('visualisation');
        }

        return $this->renderView(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}