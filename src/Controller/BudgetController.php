<?php

namespace App\Controller;

use App\Entity\BonCommande;
use App\Entity\Budget;
use App\Entity\Engagement;
use App\Entity\LigneEngagement;
use App\Entity\Rubrique;
use App\Form\BudgetType;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BudgetController extends AbstractController
{
    /**
     * @Route("/afficherbudget", name="afficherbudget")
     */
    public function index()
    {

        $rep=$this->getDoctrine()->getRepository(Budget::class);
        $budget=$rep->findAll();

        return $this->render('budget/afficherbudget.html.twig', [
            'budget' => $budget,
        ]);
    }

    /**
     * @Route("/lebudget/{id}", name="budget")
     */
    public function budget($id)
    {

        $rep=$this->getDoctrine()->getRepository(Budget::class);
        $budget=$rep->find($id);

        return $this->render('budget/index.html.twig', [
            'budget' => $budget,
        ]);
    }

    /**
     * @Route("/budget/", name="Ajoutbudget")
     */
    public function ajout(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

            $budget = new  Budget();
            $budget->setDate(new  \DateTime('now'));



        $rubrique=new ArrayCollection();
        foreach ($budget->getRubriques() as $rub)
        {


            $rubrique->add($rub);

        }
        $form=$this->createForm(BudgetType::class,$budget);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            foreach ($rubrique as $rub)
            {
                if ($budget->getRubriques()->contains($rub) === false)
                {
                    $em->remove($rub);
                }
            }

            if(count($budget->getRubriques()) > 0) {
                $em->persist($budget);
                $em->flush();
                return $this->redirectToRoute('afficherbudget');
            }
            else
            {  return $this->render('devis_vierge/error.html.twig');
                // rester sur la meme et afficher un message d'erreur : Nombre de ligne devis ne doit pas être 0 !!!
            }
        }

        return $this->render('budget/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/modifierbudget/{id}",name="modifierbudget")
     */
    public function modifier(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $budget=$this->getDoctrine()->getRepository(Budget::class)->find($id);

        $budget->setDate(new  \DateTime('now'));

        $formedit=$this->createForm(BudgetType::class,$budget);
        $formedit->handleRequest($request);

        if($formedit->isSubmitted()&&$formedit->isValid())
        {
            $em->persist($budget);
            $em->flush();
            return $this->redirectToRoute('afficherbudget');
        }
        return $this->render('budget/edit.html.twig',[
            'budget'=>$budget,'form'=>$formedit->createView()]);
    }

    /**
     * @Route("/Imprimerbudget/{id}",name="Imprimerbudget")
     */
    public function imprimer($id,\Knp\Snappy\Pdf $knpsnappy)
    {
        $em=$this->getDoctrine()->getRepository(Budget::class);
        $budget=$em->find($id);
        $this->knpSnappy=$knpsnappy;
        $html=$this->renderView('budget/pdf.html.twig',[
            'budget'=>$budget
        ]);
        $filename='budget.pdf';
        return new PdfResponse(
            $knpsnappy->getOutputFromHtml($html, array('orientation'=>'Landscape')),
            $filename,'application/pdf','inline');



    }
    /**
     * @Route("/engagement/{id}",name="")
     */
    public function ajoutengagement(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $lignengagement=new LigneEngagement();
        $engagment=new Engagement();

        $repeng=$this->getDoctrine()->getRepository(Engagement::class);

        $rep=$this->getDoctrine()->getRepository(Rubrique::class);
        $reb=$rep->find($id);

        $lignengagement->setNum(count($repeng->findAll()+1));

    }
    /**
     * @Route("/boncommandes",name="boncommandes")
     */
    public function afficherboncommande()
    {
        $rep=$this->getDoctrine()->getRepository(BonCommande::class);
        $boncommande=$rep->findAll();
        return $this->render('budget/afficherboncommande.html.twig',[
            'boncommande'=>$boncommande
        ]);
    }
    /**
     * @Route("/detboncommandes/{id}",name="detboncommandes")
     */
    public function detailboncommande($id,\Knp\Snappy\Pdf $knpsnappy)
    {
        $rep=$this->getDoctrine()->getRepository(BonCommande::class);
        $boncommande=$rep->find($id);


        $this->knpSnappy =$knpsnappy;
        $html=$this->renderView('budget/detailboncommande.html.twig',[
            'b' => $boncommande,

        ]);
        $filename='BonCommande.pdf';

        return new  PdfResponse(
            $knpsnappy->getOutputFromHtml($html),
            $filename,'application/pdf','inline');

    }
}
