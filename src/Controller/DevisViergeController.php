<?php

namespace App\Controller;

use App\Entity\Devis;
use App\Entity\DevisVierge;
use App\Entity\LigneDevis;
use App\Entity\LigneDevisVierge;
use App\Entity\TableauRecap;
use App\Form\DevisType;
use App\Form\DevisViergeType;
use App\Form\LigneDevisType;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DevisViergeController extends AbstractController
{
    /**
     * @Route("/devis_vierge", name="devis_vierge")
     */
    public function ajout(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $devis_vierge = new DevisVierge();
        $ligne_devis= new ArrayCollection();



        $repv = $this->getDoctrine()->getRepository(DevisVierge::class);
        $devis_vierge->setnum(count($repv->findAll())+1);
        $devis_vierge->setYear(date("Y"));
        $devis_vierge->setDateEdition(new  \DateTime('now'));

        foreach ($devis_vierge->getLigneDevisVierges() as $ligneDevisVierge)
        {

            $ligne_devis->add($ligneDevisVierge);

        }
        $form=$this->createForm(DevisViergeType::class,$devis_vierge);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            foreach ($ligne_devis as $ligneDevisVierge)
            {
                if ($devis_vierge->getLigneDevisVierges()->contains($ligneDevisVierge) === false)
                {
                    $em->remove($ligneDevisVierge);
                }
            }
            if(count($devis_vierge->getLigneDevisVierges()) > 0) {
                $em->persist($devis_vierge);
                $em->flush();
                return $this->redirectToRoute('listeDevisvierge');
            }
            else
            {  return $this->render('devis_vierge/error.html.twig');
                // rester sur la meme et afficher un message d'erreur : Nombre de ligne devis ne doit pas être 0 !!!
            }

        }

        return $this->render('devis_vierge/index.html.twig', [
            'form' => $form->createView()
        ]);

    }




    /**
     * @Route("/liste_DevisVierge",name="listeDevisvierge")
     */
    public function afficher()
    {
        $repd=$this->getDoctrine()->getRepository(DevisVierge::class);
        $liste_devis_vierge=$repd->findAll();

        $repd=$this->getDoctrine()->getRepository(TableauRecap::class);
        $tr=$repd->findAll();

        return $this->render('devis_vierge/afficher.html.twig',[
            "devis_vierge"=>$liste_devis_vierge,
            'tr'=>$tr

        ]);

    }

    /**
     *@Route("detailDevis/{id}",name="detail_devis")
     */
    public function detail($id)
    {
        $em=$this->getDoctrine()->getRepository(DevisVierge::class);
        $devisVierge=$em->find($id);
        $em1=$this->getDoctrine()->getRepository(LigneDevisVierge::class);
        $lignedevis=$em1->findBy(['devisVierge'=>$devisVierge]);
        return $this->render('devis_vierge/detail.html.twig',[
            'devisVierge'=>$devisVierge,
            'lignedevis'=>$lignedevis

        ]);

    }

    /**

     * @Route("/deletedevis/{id}", name="SupprimerDevis")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $listeDevis = $em -> getRepository(DevisVierge::class)->find($id);
        if(!$listeDevis)
        {
            return $this->render('404.html.twig');
        }

        $em -> remove($listeDevis);
        $em -> flush();
        return $this ->redirectToRoute('listeDevisvierge');

    }

    /**
     * @Route("/printDevis/{id}",name="printDevis")
     */
    public function pdf($id, \Knp\Snappy\Pdf $knpsnappy)
    {
        $em=$this->getDoctrine()->getRepository(DevisVierge::class);
        $devisVierge=$em->find($id);

        $em1=$this->getDoctrine()->getRepository(LigneDevisVierge::class);
        $lignedevis=$em1->findBy(['devisVierge'=>$devisVierge]);


        $this->knpSnappy =$knpsnappy;
        $html=$this->renderView('devis_vierge/pdf.html.twig',[
            'devisVierge'=>$devisVierge,
            'lignedevis'=>$lignedevis
        ]);
        $filename='devis.pdf';

        return new  PdfResponse(
            $knpsnappy->getOutputFromHtml($html),
            $filename,'application/pdf','inline'
        );

    }
    /**
     * @Route("/edit_devisvierge/{id}",name="editDevisvierge")
     */
    public function modifier(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $devisVierge=$em->getRepository(DevisVierge::class)->find($id);

        $devisVierge->setDateEdition(new  \DateTime('now'));

        $formedit=$this->createForm(DevisViergeType::class,$devisVierge);
        $formedit->handleRequest($request);
        if($formedit->isSubmitted() && $formedit->isValid())
        {
            $em->persist($devisVierge);
            $em->flush();
            return $this->redirectToRoute('listeDevisvierge');
        }
        return $this->render('devis_vierge/edit.html.twig',['devisVierge'=>$devisVierge,'form'=>$formedit->createView()]);

    }

    /**
     *@Route("/ajoutdevis/{id}", name="ajout_devis")

     */
    public function index(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();


        // recupérer un devis vierge////////

        $devis= new Devis();
        $repv = $this->getDoctrine()->getRepository(DevisVierge::class);
        $devisVierge=$repv->findOneBy(['id' => $id]);
        $ligne_devis_vierge = $devisVierge->getLigneDevisVierges();

        // /////////////////////////////////

        // initialiser un devis a partir des données d'un devis vierge
        $devis->setnum($devisVierge->getNum());
        $devis->setAnnee($devisVierge->getYear());
        $devis->setRubrique($devisVierge->getRubrique());
        $devis->setDevisVierge($devisVierge);

        ///////////////////////////////////////////

        foreach ($ligne_devis_vierge as $ldv)
        {
            $ld = new LigneDevis();

            $ld->setProduit($ldv->getProduit());
            $ld->setQuantite($ldv->getQuantite());
            $ld->setPuHt(0);
            $ld->setTva(0);
            $ld->setTotalHt(0);

            $devis->addLigneDevi($ld);
        }

        ///////////////////////////////////////////
        ///
        ///
        ///
        /*

        $form=$this->createForm(DevisType::class, $devis);
        $ligne_devis = $devis->getLigneDevis();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            foreach ($ligne_devis as $ligneDevis)
            {
                if ($devis->getLigneDevis()->contains($ligneDevis) === false)
                {
                    $em->remove($ligneDevis);
                }
            }
            if(count($devis->getLigneDevis()) > 0) {
                $em->persist($devis);
                $em->flush();
                return $this->redirectToRoute('devis');
            }
            else
            {  return $this->render('devis_vierge/error.html.twig');
                // rester sur la meme et afficher un message d'erreur : Nombre de ligne devis ne doit pas être 0 !!!
            }

        }
        */



        $form=$this->createForm(DevisType::class,$devis);
        $form->add('ligneDevis',CollectionType::class,['entry_type' => LigneDevisType::class,
        'label' => false
    ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($devis);
            $em->flush();

            return $this->redirectToRoute('listeDevisvierge');
        }


         return $this->render('devis/index.html.twig', ['listeDevis'=>$devis,"lignedevis_vierge"=>$ligne_devis_vierge,
        'form' =>$form->createView(),'form1' => $form->createView()
        ]);
    }





    /**
     * @Route("/updatedv/{num}/{annee}", name="update_devis_vierge")
     */
    public function updatedv(Request $request, $num = -1, $annee = -1)
    {
        $em=$this->getDoctrine()->getManager();

        if($num == -1 || $annee == -1)
        {
            return $this->render('devis_vierge/error.html.twig');
        }
        else {
            $repDv = $this->getDoctrine()->getRepository(DevisVierge::class);

            $devis_vierge = $repDv->findOneBy(['num' => $num, 'year' => $annee]);
            $ligne_devis = $devis_vierge->getLigneDevisVierges();
            $repv = $this->getDoctrine()->getRepository(DevisVierge::class);

            /* foreach ($devis_vierge->getLigneDevisVierges() as $ligneDevisVierge) {
                 $ligne_devis->add($ligneDevisVierge);
             }
            */
            $form = $this->createForm(DevisViergeType::class, $devis_vierge);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                foreach ($ligne_devis as $ligneDevisVierge) {
                    if ($devis_vierge->getLigneDevisVierges()->contains($ligneDevisVierge) === false) {
                        $em->remove($ligneDevisVierge);
                    }
                }
                if (count($devis_vierge->getLigneDevisVierges()) > 0) {
                    $em->persist($devis_vierge);
                    $em->flush();
                    return $this->redirectToRoute('listeDevisvierge');
                } else {
                    return $this->render('devis_vierge/error.html.twig');

                    // rester sur la meme et afficher un message d'erreur : Nombre de ligne devis ne doit pas être 0 !!!
                }

            }
        }
        return $this->render('devis_vierge/index.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
