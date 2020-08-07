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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class CompteController extends AbstractController
{
    private $em;
    private $compte_repository;
    private $cltMoral_repository;
    private $cltPhysique_repository;
    private $typeFrais_repository;
    private $fraisBancaire_repository;
    private $typeCompte_repository;

    public function __construct(EntityManagerInterface $emi)
    {
        $this->em=$emi;
        $this->compte_repository=$this->em->getRepository(Compte::class);
        $this->cltMoral_repository=$this->em->getRepository(ClientMoral::class);
        $this->cltPhysique_repository=$this->em->getRepository(ClientPhysique::class);
        $this->typeFrais_repository=$this->em->getRepository(TypeFrais::class);
        $this->typeCompte_repository=$this->em->getRepository(TypeCompte::class);
        $this->fraisBancaire_repository=$this->em->getRepository(FraisBancaire::class);
    }

    /**
     * @Route("/compte", name="app_compte_index")
     */
    public function index()
    {

        $data['client_morals']=$this->cltMoral_repository->findAll();
        $data['client_physiques']=$this->cltPhysique_repository->findAll();
        $data['type_comptes']=$this->typeCompte_repository->findAll();

        return $this->render('compte/index.html.twig',$data);
    }

    /*===========Fonction d'ajout de compte=============*/
    /**
     * @Route("/compte/add", name="app_compte_add", methods={"POST|PATCH"})
     */
    public function add(Request $request)
    {

        if($request->isMethod("POST"))
        {

            if($this->isCsrfTokenValid('compte_token', $request->request->get('token')))
            {

                if($request->request->get('client') != 0)
                {
                    $compte=new Compte();
                    $compte->setCreateAt(date('d-m-y'));
                    $compte->setEtat("Actif");
                    $compte->setSolde($request->request->get('solde'));

                    if($request->request->get('typecp') != 0)
                    {
                        $compte->setTypeCompte($this->typeCompte_repository->find($request->request->get('typecp')));

                    }

                    $tab=explode('-',$request->request->get('client'));
                    if($tab[1]=="cm")
                    {
                        //ajout de compte pour un client moral
                        $clientMoral=$this->cltMoral_repository->find($tab[0]);

                        //generation du numero de compte et du cle rip
                        $numCmpte=$clientMoral->getNom()[0].$clientMoral->getNom()[1].date('d-m-y');
                        $clerib=$numCmpte.$clientMoral->getNinea();

                        $compte->setClientMoral($clientMoral);
                        $compte->setNumero($numCmpte);
                        $compte->setCleRip($clerib);

                    }
                    elseif ($tab[1]=="cp")
                    {
                        //ajout de compte pour un client physique

                        $clientPhysique=$this->cltPhysique_repository->find($tab[0]);

                        //generation du numero de compte et du cle rip
                        $numCmpte=$clientPhysique->getPrenom()[0].$clientPhysique->getNom()[1].date('d-m-y');
                        $clerib=$numCmpte.$clientPhysique->getNci()[0].$clientPhysique->getNci()[1].$clientPhysique->getNci()[2].$clientPhysique->getNci()[3];

                        $compte->setClientPhysique($clientPhysique);
                        $compte->setNumero($numCmpte);
                        $compte->setCleRip($clerib);

                    }
                    $this->em->persist($compte);
                    $this->em->flush();
                    return $this->redirectToRoute('app_compte_index');

                }
            }
            }


        $data['error']=1;
        $data['client_morals']=$this->cltMoral_repository->findAll();
        $data['client_physiques']=$this->cltPhysique_repository->findAll();
        $data['type_comptes']=$this->typeCompte_repository->findAll();
        return $this->render('compte/index.html.twig',$data);
    }
}
