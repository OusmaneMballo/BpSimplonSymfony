<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="app_compte_index")
     */
    public function index()
    {
        return $this->render('compte/index.html.twig');
    }
}
