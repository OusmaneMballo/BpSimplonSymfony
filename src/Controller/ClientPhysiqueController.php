<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClientPhysiqueController extends AbstractController
{
    /**
     * @Route("/client/physique", name="client_physique")
     */
    public function index()
    {
        return $this->render('client_physique/index.html.twig', [
            'controller_name' => 'ClientPhysiqueController',
        ]);
    }
}
