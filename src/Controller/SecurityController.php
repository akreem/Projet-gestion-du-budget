<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request,AuthenticationUtils $utils)
    {

        $error = $utils ->getLastAuthenticationError();
        $lastUsername = $utils ->getLastUsername();
        return $this->render('security/index.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }


    /**
     * @Route("/logout", name="logout")
     * @throws /RuntimeException
     */
    public function  logout()
    {
        throw  new \RuntimeException('this should never be called directly');


    }
    /**
     * @Route("/signup", name="signup")
     */


    public function registration(Request $request,EntityManagerInterface $manager,UserPasswordEncoderInterface $encoder)
    {

        $user=new User();
        $form= $this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('security/registration.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
