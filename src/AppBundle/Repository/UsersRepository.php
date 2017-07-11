<?php


namespace AppBundle\Repository;

use AppBundle\Entity\Groups;
use Doctrine\ORM\EntityRepository;

class UsersRepository extends EntityRepository
{
    /**
     * Получить все группы у пользователя
     *
     * @param $user
     * @return array
     */
    public function getAllGroupsFromUser($user)
    {
        return $this
            ->_em
            ->getRepository(Groups::class)
            ->createQueryBuilder('g')
            ->innerJoin('g.users', 'u')
            ->where('u.id = :users_id')
            ->setParameter('users_id', $user->getId())
            ->getQuery()->getResult();
    }
}