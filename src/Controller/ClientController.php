<?php

namespace App\Controller;

use App\Entity\ClientMoral;
use App\Entity\ClientPhysique;
use App\Entity\TypeClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $data['error']=0;
        return $this->render('client/index.html.twig',$data);
    }

    /**
     * @Route("/client/addClient", name="app_client_add", methods={"POST|PATCH"})
     */
    public function addClient(Request $request)
    {
        if($request->isMethod("POST"))
        {
            if($this->isCsrfTokenValid('client_token', $request->request->get('token')))
            {
                if($request->request->get('typeclient')==2)
                {
                    //Cas d'un client moral

                    $this->addCM($request);
                    return $this->redirectToRoute('app_client_index');
                }
                elseif ($request->request->get('typeclient')==1)
                {
                    //Cas d'un client physique
                    $this->addCM($request);
                }
            }
        }
        $data['error']=1;
        $data['typeclients']=$this->typeclient_repository->findAll();
        return $this->render('client/index.html.twig',$data);
    }

    /**
     * fonction d'ajout d'un client moral
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function addCM(Request $request)
    {
        $client=new ClientMoral();
        $client->setEmail($request->request->get('emailCM'));
        $client->setPasswd($request->request->get('passwdCM'));
        $client->setLogin($request->request->get('loginCM'));
        $client->setNom($request->request->get('nomCM'));
        $client->setAddresse($request->request->get('adresseCM'));
        $client->setTelephone($request->request->get('telephoneCM'));
        $client->setNinea($request->request->get('identifiantCM'));
        $client->setRaisonSocial($request->request->get('raisonSocialCM'));
        $this->em->persist($client);
        $this->em->flush();
        return $client->getId();
    }

    private function addCP(Request $request)
    {
        $client=new ClientPhysique();
    }
}
