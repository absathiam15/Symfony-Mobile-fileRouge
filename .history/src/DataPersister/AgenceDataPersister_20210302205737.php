<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Agence;
use App\Repository\AgenceRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class AgenceDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager, AgenceRepository $agenceRepo) {
        $this->entityManager = $entityManager;
        $this->agenceRepository = $agenceRepo;
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Agence;
    }

    public function persist($data, array $context = [])
    {
        // dd($data);
        if(!$data)
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
