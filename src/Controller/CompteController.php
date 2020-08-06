<?php

namespace App\Controller;

use App\Entity\ClientMoral;
use App\Entity\ClientPhysique;
use App\Entity\Compte;
use App\Entity\FraisBancaire;
use App\Entity\TypeCompte;
use App\Entity\TypeFrais;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    private $em;
    private $compte_repository;
    private $cltMoral_repository;
    private $cltPhysique_repository;
    private $typeFrais_repository;
    private $fraisBancaire_repository;
    private $typeCompte_repository;

    /**
     * @Route("/compte", name="app_compte_index")
     */
    public function index(EntityManagerInterface $emi)
    {
        $this->em=$emi;
        $this->compte_repository=$this->em->getRepository(Compte::class);
        $this->cltMoral_repository=$this->em->getRepository(ClientMoral::class);
        $this->cltPhysique_repository=$this->em->getRepository(ClientPhysique::class);
        $this->typeFrais_repository=$this->em->getRepository(TypeFrais::class);
        $this->typeCompte_repository=$this->em->getRepository(TypeCompte::class);
        $this->fraisBancaire_repository=$this->em->getRepository(FraisBancaire::class);

        $data['client_morals']=$this->cltMoral_repository->findAll();
        $data['client_physiques']=$this->cltPhysique_repository->findAll();
        $data['type_comptes']=$this->typeCompte_repository->findAll();

        return $this->render('compte/index.html.twig',$data);
    }
}
