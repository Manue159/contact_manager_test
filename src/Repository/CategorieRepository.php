<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;

class CategorieRepository
{
    private EntityManagerInterface $em;

    public function __construct()
    {
        /** @var EntityManagerInterface $em */
        $em = require __DIR__ . '/../../config/doctrine.php';
        $this->em = $em;
    }

    /**
     * Récupère toutes les catégories triées par nom
     */
    public function findAll(): array
    {
        return $this->em->createQueryBuilder()
            ->select('cat')
            ->from(Categorie::class, 'cat')
            ->orderBy('cat.libelle', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
