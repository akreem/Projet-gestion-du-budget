<?php

namespace App\Controller;

use App\Entity\Ordrepayement;
use App\Form\OrdrepayementType;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrdrepayementController extends AbstractController
{
    /**
     * @Route("/ajout_ordrepayement", name="ajout_ordrepayement")
     */
    public function index(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $rep=$this->getDoctrine()->getRepository(Ordrepayement::class)->findAll();
        $op=new Ordrepayement();
        $op->setDate(new \DateTime('now'));
        $op->setNum(count($rep)+1);
        $op->setAnnee(date("Y"));


        $form=$this->createForm(OrdrepayementType::class,$op);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($op);
            $em->flush();
            return $this->redirectToRoute('ordrepayement');
        }


        return $this->render('ordrepayement/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ordrepayement", name="ordrepayement")
     */
    public function afficher()
    {
        $rep=$this->getDoctrine()->getRepository(Ordrepayement::class);
        $all=$rep->findAll();

        return $this->render('ordrepayement/afficher.html.twig',["ordre"=>$all]);
    }




    /**
     * @Route("/pdfop/{id}", name="pdfop")
     */
    public function pdf($id, \Knp\Snappy\Pdf $knpsnappy)
    {
        $em=$this->getDoctrine()->getRepository(Ordrepayement::class);
        $op=$em->find($id);


        $this->knpSnappy =$knpsnappy;
        $html=$this->renderView('ordrepayement/pdf.html.twig',[
            'op'=>$op,
        ]);

        $filename='ordrepaiement.pdf';

        return new  PdfResponse(
            $knpsnappy->getOutputFromHtml($html),
            $filename,'application/pdf','inline'
        );
    }

}
