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
        $data['client_morals']=$this->clt_moral_repository->findAll();
        $data['error']=0;
        return $this->render('client/index.html.twig',$data);
    }

    //===============Fonction d'ajout d'un client moral ou physique=======
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

                    $this->addCP($request);
                    return $this->redirectToRoute('app_client_index');
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
     * @return int|null
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

    /**
     * Fonction d'ajout d'un client physique
     * @param Request $request
     * @return int|null
     */
    private function addCP(Request $request)
    {
        $client=new ClientPhysique();
        $client->setNom($request->request->get('nomcp'));
        $client->setPrenom($request->request->get('prenomcp'));
        $client->setNci($request->request->get('cnicp'));
        $client->setProfession($request->request->get('professioncp'));
        $client->setTelephone($request->request->get('telephonecp'));
        $client->setAdresse($request->request->get('adressecp'));
        $client->setLogin($request->request->get('logincp'));
        $client->setPasswd($request->request->get('passwdcp'));
        $client->setEmail($request->request->get('emailcp'));
        $client->setTypeClient($this->typeclient_repository->find($request->request->get('statutcp')));
        if($request->request->get('statutcp')==1)
        {
            /*===========Cas d'un salarier==========*/

            $client->setSalaire($request->request->get('salairecp'));

            if($request->request->get('employeur')==-1)
            {
                /*cas d'un salarier dont son employeur n'est pas
                un client de la banque*/

                $idEmp=$this->addCM($request);
                $client->setClientMoral($this->clt_moral_repository->find($idEmp));
            }
            else
            {
                /*============================================*
                 * cas d'un salarier dont son employeur est
                 *   un client de la banque
                 *============================================*/

                $client->setClientMoral($this->clt_moral_repository->find($request->request->get('employeur')));
            }
        }
        $this->em->persist($client);
        $this->em->flush();
        return $client->getId();
    }
}
