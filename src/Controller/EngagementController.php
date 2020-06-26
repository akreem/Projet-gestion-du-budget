<?php

namespace App\Controller;

use App\Entity\Engagement;
use App\Entity\Rubrique;
use App\Form\EngagementType;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EngagementController extends AbstractController
{
    /**
     * @Route("/Ajoutengagement/{id}", name="Ajoutengagement")
     */
    public function Ajout(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $rep=$this->getDoctrine()->getRepository(Engagement::class);

        $rep1=$this->getDoctrine()->getRepository(Rubrique::class);
        $r=$rep1->findOneBy(['id' => $id]);


        $budget=$r->getBudget();
        $route=$r->getBudget()->getId();


        $budget->setDate(new  \DateTime('now'));
        $engagement=new  Engagement();
        $engagement->setNum(count($rep->findAll())+1);
        $engagement->setDate(new \DateTime("now"));
        $engagement->setRubrique($r);


        $form=$this->createForm(EngagementType::class,$engagement);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $em->persist($engagement);

            $r->setEngnp($r->getEngnp()+ $engagement->getMontant());
            $em->persist($r);

            $budget->setTotalnpaye($budget->getTotalnpaye()+$engagement->getMontant());
            $em->persist($budget);

            $em->flush();
            return $this->redirectToRoute('budget', array(
                'id' => $route));
        }

        return $this->render('engagement/index.html.twig', ['form'=> $form->createView()
        ]);
    }
    /**
     * @Route("AfficherEngagement",name="AfficherEngagement")
     */
    public function afficher()
    {
        $rep=$this->getDoctrine()->getRepository(Engagement::class);
        $eng=$rep->findAll();

        return $this->render('engagement/afficher.html.twig',['eng'=>$eng]
        );
    }

    /**
     * @Route("SupprimerEng/{id}",name="SupprimerEng")
     */
    public  function supprimer($id)
    {
        $em=$this->getDoctrine()->getManager();
        $listeng=$em->getRepository(Engagement::class)->find($id);
        $rub=$listeng->getRubrique();
        $budget=$rub->getBudget();

        if(!$listeng)
        {
            return $this->render('404.html.twig');
        }
        $em->remove($listeng);


        $rub->setEngnp($rub->getEngnp()- $listeng->getMontant());
        $em->persist($rub);

        $budget->setTotalnpaye($budget->getTotalnpaye()-$listeng->getMontant());
        $em->persist($budget);

        $em->flush();

        return $this->redirectToRoute('AfficherEngagement');

    }

    /**
     * @Route("EngagementPDF/{id}",name="EngagementPDF")
     */
    public function engagementPDF($id, \Knp\Snappy\Pdf $knpsnappy)

    {
        $eng=$this->getDoctrine()->getRepository(Engagement::class)->find($id);

        $this->knpSnappy =$knpsnappy;
        $html=$this->renderView('engagement/engagementPDF.html.twig',[
            'eng' => $eng,

        ]);
        $filename='Engagement.pdf';

        return new  PdfResponse(
            $knpsnappy->getOutputFromHtml($html),
            $filename,'application/pdf','inline');


    }

}
