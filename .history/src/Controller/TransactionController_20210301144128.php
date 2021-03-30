<?php

namespace App\Controller;

use App\Entity\Transactions;
use App\Services\TransactionServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class TransactionController extends AbstractController
{ 
    private $dn;
    private $userServices;
    private $manager;
    public function __construct(TransactionServices $transactionServices, EntityManagerInterface $manager, DenormalizerInterface $denormalizer)
    {

        $this->$transactionServices = $transactionServices;
        $this->manager = $manager;
        $this->dn = $denormalizer;
    }
    /**
     * @Route(
     * name="addTransaction",
     * path="/api/users/comptes/depots",
     * methods={"POST"},
     *     defaults={
     *      "_controller"="\app\ControllerTransactionController::addTransaction",
     *      "_api_resource_class"=Transactions::class,
     *      "_api_collection_operation_name"="postTransaction",
     *    }
     * )
     */
    public function addTransaction()
    {
        //dd('test');
    }


}
