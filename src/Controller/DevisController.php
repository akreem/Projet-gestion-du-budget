<?php

namespace App\Controller;

use App\Entity\Devis;
use App\Entity\DevisVierge;
use App\Entity\LigneDevis;
use App\Entity\LigneDevisVierge;
use App\Entity\LigneRecap;
use App\Entity\TableauRecap;
use App\Entity\TabRecap;
use App\Form\DevisType;
use App\Form\LigneRecapType;
use App\Form\RecapType;
use App\Form\TableauRecapType;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DevisController extends AbstractController
{
    /**
     * @Route("/devis", name="devis")
     */
    public function afficher()
    {
        $repd=$this->getDoctrine()->getRepository(Devis::class);
        $liste_devis=$repd->findAll();
        return $this->render('devis/afficher.html.twig',[
            "devis"=>$liste_devis
        ]);

    }
    /**
     * @Route("/TabComparatif_PDF/{id}",name="TabComparatif_PDF")
     */
    public function recap_pdf($id, \Knp\Snappy\Pdf $knpsnappy)
    {
        $rep = $this->getDoctrine()->getRepository(DevisVierge::class);
        $dv = $rep->findOneBy(['id' => $id]);

        $this->knpSnappy =$knpsnappy;
        $html=$this->renderView('devis/recap.html.twig',[
            'dv' => $dv

        ]);
        $filename='recap.pdf';

        return new  PdfResponse(
            $knpsnappy->getOutputFromHtml($html,
                array('orientation'=>'Landscape')),
            $filename,'application/pdf','inline');
      /*return $this->render('devis/recap.html.twig',[
           'dv' => $dv

        ]);
      */
    }

    /**
     * @Route("/TabComparatif/{id}",name="TabComparatif")
     */
    public function recap($id)
    {
        $rep = $this->getDoctrine()->getRepository(DevisVierge::class);
        $dv = $rep->findOneBy(['id' => $id]);

        $num=$dv->getNum();

        $rep1 = $this->getDoctrine()->getRepository(TableauRecap::class);
        $tr = $rep1->findOneBy(['num' => $num]);

        return $this->render('devis/recapitulation.html.twig',[
             'dv' => $dv,'tr'=>$tr
          ]);
    }


    /**
     * @Route("/RecapParArticle/{id}",name="RecapParArticle")
     */
    public function choixparArticle(Request $request,$id)
    {

        $em=$this->getDoctrine()->getManager();

        $ligne_recap= new LigneRecap();
        $tableau_recap=new TableauRecap();


        $rep = $this->getDoctrine()->getRepository(LigneDevis::class);
        $ld = $rep->findOneBy(['id' => $id]);

        $rep2 = $this->getDoctrine()->getRepository(LigneRecap::class);
        $lr = $rep2->findOneBy(['ligneDevis' => $ld]);

        $devis=$ld->getDevis();
        $dv=$devis->getDevisVierge();
        $route=$dv->getId();

        $num=$devis->getNum();
        $rep1=$this->getDoctrine()->getRepository(TableauRecap::class);
        $tr=$rep1->findOneBy(['num'=>$num]);

        $rep3 = $this->getDoctrine()->getRepository(LigneRecap::class);
        $lrr = $rep3->findBy(['TableauRecap' => $tr]);



        if ($lr==null ) {
            if($tr== null) {


                $ligne_recap->setPuHt($ld->getPuHt());
                $ligne_recap->setTva($ld->getTva());
                $ligne_recap->setQuantite($ld->getQuantite());
                $ligne_recap->setProduit($ld->getProduit());
                $ligne_recap->setNomfournisseur($devis->getNomFournisseur());
                $ligne_recap->setTotalht($ld->getTotalht());
                $ligne_recap->setLigneDevis($ld);

                $tableau_recap->setDevis($devis);
                $tableau_recap->setTotalht($ld->getTotalht());
                $tableau_recap->setTotaltva($ld->getTva());
                $tableau_recap->setTotalttc($ld->getTotalht()+$ld->getTva());
                $tableau_recap->setAnnee($devis->getAnnee());
                $tableau_recap->setNomfournisseur($devis->getNomfournisseur());

                $tableau_recap->setNum($devis->getNum());

                $tableau_recap->addLigneRecap($ligne_recap);

                $em->persist($tableau_recap);
                $em->flush();

            }

                   else if ($devis->getNum() == $tr->getNum())
                   {
                       if (count($tr->getLigneRecaps()) >=count($dv->getLigneDevisVierges()) )

                   {
                   return $this->redirectToRoute('Maxchoices');
                    }

                   else {
                           foreach ($lrr as  $lrr)
                           {
                               if ($ld->getProduit()==$lrr->getProduit())
                               {
                                   return $this->redirectToRoute('ItemDuplicated');
                               }
                           }
                       $ligne_recap->setPuHt($ld->getPuHt());
                       $ligne_recap->setTva($ld->getTva());
                       $ligne_recap->setQuantite($ld->getQuantite());
                       $ligne_recap->setProduit($ld->getProduit());
                       $ligne_recap->setNomfournisseur($ld->getDevis()->getNomFournisseur());
                       $ligne_recap->setTotalht($ld->getTotalht());
                       $ligne_recap->setLigneDevis($ld);
                       $ligne_recap->setTableauRecap($tr);
                       $tr->setTotalht($tr->getTotalht() + $ld->getTotalht());
                       $tr->setTotaltva($tr->getTotaltva() + $ld->getTva());
                       $tr->setTotalttc($tr->getTotalht()+ $tr->getTotaltva());


                       $em->persist($tr);
                       $em->persist($ligne_recap);
                       $em->flush();
                   }
                }
            }
        else
        {
           return $this->redirectToRoute('AlreadySelected');
        }
        return $this->redirectToRoute('TabComparatif', array(
            'id' => $route));

    }



    /**
     * @Route("/TabRecap/{id}",name="Recapi")
     */
    public function recapi($id)
    {
        $rep = $this->getDoctrine()->getRepository(TableauRecap::class);
        $tr = $rep->findOneBy(['id' => $id]);
        return $this->render('devis/recapi.html.twig',[
            'tr' => $tr
        ]);
    }


    /**
     * @Route("/RecapParFournisseur/{id}",name="RecapParFournisseur")
     */
    public function choixparfournissuer($id)
    {
        $em=$this->getDoctrine()->getManager();
        $tableau_recap=new TableauRecap();


        $rep = $this->getDoctrine()->getRepository(Devis::class);
        $d = $rep->findOneBy(['id' => $id]);

        $rep1 = $this->getDoctrine()->getRepository(LigneDevis::class);
        $ld = $rep1->findBy(['devis' => $d]);


        $dv=$d->getDevisVierge();
        $route=$dv->getId();

        $num=$d->getNum();

        $rep2=$this->getDoctrine()->getRepository(TableauRecap::class);
        $tr=$rep2->findOneBy(['num'=>$num]);



        if($tr== null) {


            $tableau_recap->setDevis($d);
            $tableau_recap->setTotalht($d->getTotalht());
            $tableau_recap->setTotalttc($d->getTotalttc());
            $tableau_recap->setTotaltva($d->getTotaltva());
            $tableau_recap->setAnnee($d->getAnnee());
            $tableau_recap->setNomfournisseur($d->getNomfournisseur());
            $tableau_recap->setNum($d->getNum());

            foreach ($ld as  $ldd)
            {
                if(!$ldd->getPuHt()==null)
                {
                    $ligne_recap = new LigneRecap();

                    $ligne_recap->setPuHt($ldd->getPuHt());
                    $ligne_recap->setTva($ldd->getTva());
                    $ligne_recap->setQuantite($ldd->getQuantite());
                    $ligne_recap->setProduit($ldd->getProduit());
                    $ligne_recap->setTotalht($ldd->getTotalht());
                    $ligne_recap->setNomfournisseur($ldd->getDevis()->getNomFournisseur());
                    $ligne_recap->setLigneDevis($ldd);
                    $ligne_recap->setTableauRecap($tableau_recap);
                    $tableau_recap->addLigneRecap($ligne_recap);
                }
            }
            $em->persist($tableau_recap);
            $em->flush();

        }
        else
        {
            return $this->redirectToRoute('Maxchoices');
        }

        return $this->redirectToRoute('TabComparatif', array(
            'id' => $route));

    }


  /**
    * @Route("/AfficherTabsRecap",name="AfficherTabsRecap")
   */
       public function afficherrecaps(Request $request)

          {
              $rep=$this->getDoctrine()->getRepository(TableauRecap::class);
              $tbr=$rep->findAll();

              return $this->render('devis/tabsrecap.html.twig',[
                  "tabrecap"=>$tbr
              ]);



          }
    /**
     * @Route("/TabRecap_PDF/{id}",name="TabRecap_PDF")
     */
    public function tabrecap_pdf($id, \Knp\Snappy\Pdf $knpsnappy)
    {
        $rep = $this->getDoctrine()->getRepository(TableauRecap::class);
        $tr = $rep->findOneBy(['id' => $id]);

        $this->knpSnappy =$knpsnappy;
        $html=$this->renderView('devis/recepdf.html.twig',[
            'tr' => $tr

        ]);
        $filename='tabrecap.pdf';

        return new  PdfResponse(
            $knpsnappy->getOutputFromHtml($html),
            $filename,'application/pdf','inline');

    }

    /**
     * @Route("/editrecap/{id}", name="editrecap")
     */
    public function editrecap (Request $request,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $listerecap = $em -> getRepository(TableauRecap::class)->find($id);
        $formedit=$this->createForm(TableauRecapType::class,$listerecap);
        $formedit->add('ligneRecaps',CollectionType::class,['entry_type' => LigneRecapType::class,
            'label' => false
        ]);
        $route=$listerecap->getId();

        $formedit ->handleRequest($request);
        if($formedit ->isSubmitted() && $formedit -> isValid())
        {
            $em ->persist($listerecap);
            $em ->flush();
            return $this->redirectToRoute('Recapi', array(
                'id' => $route));        }
        return $this->render('tableau_recap/edit.html.twig',
            ['tr' => $listerecap, 'form' => $formedit -> createView()]);
    }

    /**
     * @Route("/TabRecapF_PDF/{id}",name="TabRecapF_PDF")
     */
    public function tabrecapf_pdf($id, \Knp\Snappy\Pdf $knpsnappy)
    {
        $rep = $this->getDoctrine()->getRepository(LigneRecap::class);
        $ltr = $rep->findOneBy(['id' => $id]);

        $reptr=$this->getDoctrine()->getRepository(TableauRecap::class);
        $tabrecap=$reptr->findOneBy(['id'=>$id]);

        //recuperer dans un tableau les noms fournisseurs d'un tableau recap

        $listefournisseur=$rep->findListeFournisseur($tabrecap);
      //  $tr=$rep->findBy(['TableauRecap'=>$tabrecap,'nomfournisseur'=>$four] );
        $tr=$rep->findBy(['TableauRecap'=>$tabrecap] );

        $this->knpSnappy =$knpsnappy;
        $html=$this->renderView('devis/recaparfourpdf.html.twig',[
            'lr' => $tr,
            'fournisseur'=>$listefournisseur

        ]);
        $filename='tabrecapparfour.pdf';

        return new  PdfResponse(
            $knpsnappy->getOutputFromHtml($html),
            $filename,'application/pdf','inline');

    }

    /**
     * @Route("/TabRecapsamef_PDF/{id}",name="TabRecapsamef_PDF")
     */
    public function tabrecapsamef_pdf($id, \Knp\Snappy\Pdf $knpsnappy)
    {
        $rep = $this->getDoctrine()->getRepository(TableauRecap::class);
        $tr = $rep->findOneBy(['id' => $id]);

        $this->knpSnappy =$knpsnappy;
        $html=$this->renderView('devis/samefourpdf.html.twig',[
            'tr' => $tr

        ]);
        $filename='tabrecapsamefour.pdf';

        return new  PdfResponse(
            $knpsnappy->getOutputFromHtml($html),
            $filename,'application/pdf','inline');

    }
    /**
     * @Route("/BonCommandeFournisseur_PDF/{id}",name="BonCommandeFournisseur_PDF")
     */
    public function boncommandeFournisseur_pdf($id, \Knp\Snappy\Pdf $knpsnappy)
    {
        $rep = $this->getDoctrine()->getRepository(TableauRecap::class);
        $tr = $rep->findOneBy(['id' => $id]);

        $this->knpSnappy =$knpsnappy;
        $html=$this->renderView('devis/BonCommandeFournisseur_PDF.html.twig',[
            'tr' => $tr

        ]);
        $filename='BonCommandeF.pdf';

        return new  PdfResponse(
            $knpsnappy->getOutputFromHtml($html),
            $filename,'application/pdf','inline');

    }


    /**
     * @Route("/BonCommande_PDF/{id}",name="BonCommande_PDF")
     */
    public function boncommande_pdf($id, \Knp\Snappy\Pdf $knpsnappy)
    {
        $rep = $this->getDoctrine()->getRepository(LigneRecap::class);
        $tr = $rep->findOneBy(['id' => $id]);

        $this->knpSnappy =$knpsnappy;
        $html=$this->renderView('devis/BonCommande_PDF.html.twig',[
            'lr' => $tr

        ]);
        $filename='BonCommande.pdf';

        return new  PdfResponse(
            $knpsnappy->getOutputFromHtml($html),
            $filename,'application/pdf','inline');

    }




}
