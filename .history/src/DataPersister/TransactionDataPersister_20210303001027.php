<?php

namespace App\DataPersister;

use App\Entity\Agence;
use Doctrine\ORM\EntityManager;
use App\Repository\AgenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Transactions;

class AgenceDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager, AgenceRepository $agenceRepo) {
        // $this->entityManager = $entityManager;
        // $this->agenceRepository = $agenceRepo;
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Transactions;
    }

    public function persist($data, array $context = [])
    {
        // if(!($data->id)) {
        //     $data->comptes->setDateCreation(new \DateTime());
        //     if($data->comptes->solde < 700000) {
        //         return new  JsonResponse('Désolé ce compte doit contenir au minimum 700000', Response::HTTP_FORBIDDEN,[], true);
        //     }
        //     // dd($data);
        // }
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $data->setIsDeleted(true);
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}
