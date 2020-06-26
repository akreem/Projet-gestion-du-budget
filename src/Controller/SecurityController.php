<?php

namespace App\Controller;

use App\Entity\PasswordUpdate;
use App\Entity\User;
use App\Form\PasswordUpdateType;
use App\Form\RegistrationType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
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

    /**
     * @Route("/account",name="account")
     */
    public  function account()
    {
        return $this->render('security/account.html.twig',[
            'user' => $this->getUser()]);

    }

    /**
     * @Route ("/account_edit", name="account_edit")
     */
    public function profile(Request $request, EntityManagerInterface $manager)
    {
        $user = $this->getUser();
        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() )
        {
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('account');

        }
        return $this->render('security/edit.html.twig',[
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/password_update", name="account_password")
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager)
    {

        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class,$passwordUpdate);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // 1. Vérifier que l'ancien Password du formulaire soit le même que le password de l'user

            if(!password_verify($passwordUpdate->getOldPassword(),$user->getPassword())){
                // Gérer l'erreur
                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas votre mot de passe actuel !"));
            }
            else {
                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);
                $user->setPassword($hash);

                $manager->persist($user);
                $manager->flush();


                return $this->redirectToRoute('account');
            }
        }


        return $this->render('security/passwordupdate.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
