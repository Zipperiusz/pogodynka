<?php

namespace App\Repository;

use App\Entity\Weather;
use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class WeatherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Weather::class);
    }

    public function findByLocation(Location $location)
    {
        $qb = $this->createQueryBuilder('m');
        $qb->where('m.location = :location')
            ->setParameter('location', $location)
            ->andWhere('m.datetime > :now')
            ->setParameter('now', date('Y-m-d'));

        $query = $qb->getQuery();
        $result = $query->getResult();
        return $result;
    }

    public function findLocationByCityAndCountry(string $city, ?string $country): ?Location
{
    $qb = $this->getEntityManager()->createQueryBuilder();

    $qb->select('l')
        ->from(Location::class, 'l')
        ->where('l.city = :city')
        ->setParameter('city', $city);

    if ($country) {
        $qb->andWhere('l.country = :country')
            ->setParameter('country', $country);
    }

    return $qb->getQuery()->getOneOrNullResult();
}


}
