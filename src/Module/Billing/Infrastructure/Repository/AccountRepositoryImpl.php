<?php

declare(strict_types=1);

namespace App\Module\Billing\Infrastructure\Repository;

use App\Module\Billing\Domain\Entity\Account;
use App\Module\Billing\Domain\Repository\AccountRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AccountRepositoryImpl extends ServiceEntityRepository implements AccountRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    public function save(Account $account): void
    {
        $this->getEntityManager()->persist($account);
    }

    public function findByUser(int $userId): array
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('a')
            ->from(Account::class, 'a')
            ->join('a.currency', 'c')
            ->where('a.userId = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }

    public function findById(int $id): ?Account
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function getById(int $id): Account
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('a')
            ->from(Account::class, 'a')
            ->andWhere('a.id = :id')
            ->andWhere('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }
}