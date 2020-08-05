<?php

namespace App\Controller;

use App\Entity\ClientMoral;
use App\Entity\ClientPhysique;
use App\Entity\TypeClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ClientController extends AbstractController
{
    private $em;
    private $clt_moral_repository;
    private $clt_physique_repository;
    private $typeclient_repository;


    public function __construct(EntityManagerInterface $emi)
    {

        $this->em=$emi;
        $this->clt_moral_repository=$this->em->getRepository(ClientMoral::class);
        $this->clt_physique_repository=$this->em->getRepository(ClientPhysique::class);
        $this->typeclient_repository=$this->em->getRepository(TypeClient::class);

    }

    /**
     * @Route("/client", name="app_client_index")
     */
    public function index()
    {
        $data['typeclients']=$this->typeclient_repository->findAll();

        return $this->render('client/index.html.twig',$data);
    }
}
