<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="menu")
     */
    public function index()
    {
        return $this->render('menu/index.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }


    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        return $this->render('test.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }
    /**
     * @Route("/MaxchoicesReached", name="Maxchoices")
     */
    public function Maxchoices()
    {
        return $this->render('MaxchoicesReached.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }

    /**
     * @Route("/ItemAlreadySelected", name="AlreadySelected")
     */
    public function AlreadySelected()
    {
        return $this->render('AlreadySelected.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }

    /**
     * @Route("/ItemDuplicated", name="ItemDuplicated")
     */
    public function ItemDuplicated()
    {
        return $this->render('ItemDuplicated.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }

}
