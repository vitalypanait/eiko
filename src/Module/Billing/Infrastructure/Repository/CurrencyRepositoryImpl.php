<?php

declare(strict_types=1);

namespace App\Module\Billing\Infrastructure\Repository;

use App\Module\Billing\Domain\Entity\Currency;
use App\Module\Billing\Domain\Repository\CurrencyRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CurrencyRepositoryImpl extends ServiceEntityRepository implements CurrencyRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
    }

    public function save(Currency $currency): void
    {
        $this->getEntityManager()->persist($currency);
    }

    public function catalogue(): array
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('c')
            ->from(Currency::class, 'c')
            ->getQuery()
            ->getResult();
    }

    public function getById(int $id): Currency
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('c')
            ->from(Currency::class, 'c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }
}