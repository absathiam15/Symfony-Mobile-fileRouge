<?php

namespace App\Controller;

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
    private $userServices;
    private $manager;
    public function __construct(TransactionServices $transactionServices, EntityManagerInterface $manager)
    {


    }
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
            $transactionJson= $request->toArray();
          //  dd($request->getContent());
            $transactionTab = $serializer->deco($transactionJson, 'json');
           
            $transaction = new Transactions();
            $user= $security->getUser();
           dd($user);

        }

}


