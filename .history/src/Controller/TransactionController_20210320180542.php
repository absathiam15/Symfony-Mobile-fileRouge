<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Entity\Transactions;
use App\Repository\UserRepository;
use App\Services\TransactionServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TransactionController extends AbstractController
{ 
   
    public function __construct() { }
    
       /** @Route
       *  ( path="/api/users/comptes/depots", methods={"POST"},
       *  defaults={
       *     "_controller"="\app\Controller\TransactionController::depotTransaction",
       *     "_api_resource_class"=Transactions::class,
       *     "_api_collection_operation_name"="depotTransaction",
       *    }
       * )
       */
 
    public function depotTransaction(Request $request,SerializerInterface $serializer, EntityManagerInterface $entityManager,
                                         ValidatorInterface $validator, UserRepository $userRepo, TransactionServices $transactionService, Security $security)
        {
            $transactionJson= $request->getContent();
            $transactionTab = $serializer->decode($transactionJson, 'json');
           // dd($transactionJson);
            $transaction = new Transactions();
            $user= $security->getUser();
          //dd($user);

            $idUserDepot = $user->getId();
           // dd($idUserDepot);
            $userDepot = $userRepo->find($idUserDepot);
            //dd($userDepot);
            $agenceDepot = $userDepot->getAgence();
            //dd($agenceDepot);
            $compteAgenceDepot =$agenceDepot->getComptes();
            //dd($compteAgenceDepot);
            $montantDepot = $transactionTab['montant'];
            $soldeCompteAgenceDepot = $compteAgenceDepot->getSolde();
            //dd($soldeCompteAgenceDepot);

            if ($montantDepot < $soldeCompteAgenceDepot){
                $compteAgenceDepot->setSolde($soldeCompteAgenceDepot - $montantDepot);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($userDepot);
                $transaction->setUserDepot($userDepot);
    
                $transaction->setCompteDepot($compteAgenceDepot);
                $transaction->setMontant($montantDepot);
    
                $dateDepot = new \DateTime();
                //dd($dateDepot);
                $transaction->setDateDepot($dateDepot);
                $codeTrans= $transactionService->generateCodeTransaction();
                //dd($codeTrans);
                $transaction->setCodeTransaction($codeTrans);
                $frais= $transactionService->frais($montantDepot);
                //dd($frais);
                $transaction->setFrais($frais);
                $fraisDepot = $transactionService->fraisDepot($frais);
                //dd($fraisDepot);
                $transaction->setFraisDepot($frais);
                $fraisRetrait=$transactionService->fraisRetrait($frais);
                $transaction->setFraisRetrait($fraisRetrait);
                $fraisSysteme=$transactionService->fraisSysteme($frais);
                $transaction->setFraisSystem($fraisSysteme);
                $fraisEtat=$transactionService->fraisEtat($frais);
                $transaction->setFraisEtat($fraisEtat);
    
                $clientDepot= new Clients();
                $clientDepot->setNomComplet($transactionTab['clientDepot']['nomComplet']);
                dd($clientDepot);
                if ($transactionService->validationCni($transactionTab['clientDepot']['numCni'])==false){
                    return $this->json('votre numero CNI n est pas correct',Response::HTTP_NOT_FOUND);
                // }
                // $clientDepot->setNumCni($transactionTab['clientDepot']['numCni']);
    
                // if ($transactionService->validationTelephone($transactionTab['clientDepot']['telephone'])==false){
                //     return $this->json('votre telephone n est pas correct',Response::HTTP_NOT_FOUND);
                // }
                // $clientDepot->setTelephone($transactionTab['clientDepot']['telephone']);
                // $entityManager = $this->getDoctrine()->getManager();
                // $entityManager->persist($clientDepot);
                // $transaction->setClientDepot($clientDepot);
                // //dd($clientDepot);
    
                // $clientRetrait= new Client();
                // $clientRetrait->setNomComplet($transactionTab['clientRetrait']['nomComplet']);
    
                // if ($transactionService->validationTelephone($transactionTab['clientRetrait']['telephone'])==false){
                //     return $this->json('votre telephone n est pas correct',Response::HTTP_NOT_FOUND);
                // }
                
                // $clientRetrait->setTelephone($transactionTab['clientRetrait']['telephone']);
                // $entityManager = $this->getDoctrine()->getManager();
                // $entityManager->persist($clientRetrait);
                // $transaction->setClientRetrait($clientRetrait);
                // //dd($clientRetrait);
    
                // $entityManager= $this->getDoctrine()->getManager();
                // $entityManager->persist($transaction);
                // $entityManager->flush();
                // return $this->json($transaction, Response::HTTP_OK);
            }
          
        }

}


