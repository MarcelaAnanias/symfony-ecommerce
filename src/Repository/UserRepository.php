<?php

namespace App\Repository;

use App\Entity\User; // Importa a classe User, que representa a entidade do banco de dados.
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository; // Classe base para repositórios no Symfony.
use Doctrine\Persistence\ManagerRegistry; // Gerencia o acesso ao EntityManager para trabalhar com entidades.
use Symfony\Component\Security\Core\Exception\UnsupportedUserException; // Exceção lançada para tipos de usuário não suportados.
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface; // Interface para usuários autenticados com senha.
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface; // Interface para definir métodos de atualização de senha.


/**
 * @extends ServiceEntityRepository<User>
 * * Declara que este repositório é especializado para a entidade User.
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class); // Inicializa a classe pai, informando que este repositório trabalha com User.
    }

    /**
     * Este método serve para atualizar automaticamente a senha do usuário,
     * re-hashando (recalculando) a senha quando necessário.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user); // Prepara o EntityManager para salvar o objeto atualizado.
        $this->getEntityManager()->flush(); // Confirma as alterações no banco de dados.
    }

    //    /**
    //     * @return User[] Returns an array of User objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
