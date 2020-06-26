<?php

namespace App\Controller;

use App\Entity\Pv;
use App\Form\PvType;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PvController extends AbstractController
{
    /**
     * @Route("/ajouterpv", name="ajouterpv")
     */
    public function index(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $rep=$this->getDoctrine()->getRepository(Pv::class)->findAll();
        $pv = new Pv();
        $ligne_pv = new ArrayCollection();
        $cadre=new ArrayCollection();


        $pv->setDate(new \DateTime('now'));
        $pv->setNum(count($rep)+1);


        foreach ($pv->getLignepvs() as $lignepv) {

            $ligne_pv->add($lignepv);

            }


        $form = $this->createForm(PvType::class, $pv);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($ligne_pv as $lignepv) {

                if ($pv->getLignepvs()->contains($lignepv) === false) {
                    $em->remove($lignepv);
                }
            }
            if (count($pv->getLignepvs()) > 0) {

                $em->persist($pv);
                $em->flush();
                return $this->redirectToRoute('afficherpv');

            } else {
                return $this->render('devis_vierge/error.html.twig');
                // rester sur la meme et afficher un message d'erreur : Nombre de ligne devis ne doit pas être 0 !!!
            }
        }
            return $this->render('pv/index.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    /**
     * @Route("/afficherpv", name="afficherpv")
     */
    public  function afficher()
    {
        $rep=$this->getDoctrine()->getRepository(Pv::class);
        $pv=$rep->findAll();

        return $this->render('pv/afficher.html.twig', [
            'pv' => $pv
        ]);

    }
    /**
     * @Route("/pdfpv/{id}", name="pdfpv")
     */
    public function pdf($id, \Knp\Snappy\Pdf $knpsnappy)
    {
        $em=$this->getDoctrine()->getRepository(Pv::class);
        $pv=$em->find($id);


        $this->knpSnappy =$knpsnappy;
        $html=$this->renderView('pv/pdf.html.twig',[
            'pv'=>$pv,
        ]);

        $filename='pv.pdf';

        return new  PdfResponse(
            $knpsnappy->getOutputFromHtml($html),
            $filename,'application/pdf','inline'
        );
    }

    }


