<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;

class ContactRepository
{
    private EntityManagerInterface $em;

    public function __construct()
    {
        /** @var EntityManagerInterface $em */
        $em = require __DIR__ . '/../../config/doctrine.php';
        $this->em = $em;
    }

    /**
     * Récupère tous les contacts triés par nom
     */
    public function findAllOrdered(): array
    {
        return $this->em->createQueryBuilder()
            ->select('c', 'cat')
            ->from(Contact::class, 'c')
            ->leftJoin('c.categorie', 'cat')
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupère les contacts d’une catégorie donnée
     */
    public function findByCategorie(int $categorieId): array
    {
        return $this->em->createQueryBuilder()
            ->select('c', 'cat')
            ->from(Contact::class, 'c')
            ->leftJoin('c.categorie', 'cat')
            ->where('cat.id = :categorieId')
            ->setParameter('categorieId', $categorieId)
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupère les contacts répondant au critère de recherche et les affiche par page si nécessaire
     */
    public function searchPaginated(
        ?int $categorieId,
        ?string $search,
        string $sort,
        int $limit,
        int $offset
    ): array {
        $qb = $this->em->createQueryBuilder()
            ->select('c')
            ->from(Contact::class, 'c')
            ->leftJoin('c.categorie', 'cat');

        if ($categorieId !== null) {
            $qb->andWhere('cat.id = :cat')
                ->setParameter('cat', $categorieId);
        }

        if ($search !== null) {
            $qb->andWhere(
                'c.nom LIKE :term OR c.prenom LIKE :term OR c.email LIKE :term'
            )
                ->setParameter('term', '%' . $search . '%');
        }

        $countQb = clone $qb;
        $total = (int) $countQb
            ->select('COUNT(c.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $direction = strtoupper($sort) === 'DESC' ? 'DESC' : 'ASC';

        $data = $qb
            ->orderBy('c.nom', $direction)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        return [
            'data' => $data,
            'total' => $total,
        ];
    }
}
