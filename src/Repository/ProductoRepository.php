<?php

namespace App\Repository;

use App\Entity\Producto;
use App\Entity\Categoria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Producto>
 *
 * @method Producto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Producto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Producto[]    findAll()
 * @method Producto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }

    public function save(Producto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Producto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
     * Busca un producto por nombre de forma parcial.
     *
     * @param string $nombre El nombre parcial del producto a buscar.
     * @return Producto|null El producto encontrado o null si no se encontró ninguno.
     */
    public function findOneByNombreLike(string $nombre): ?Producto
    {
        $qb = $this->createQueryBuilder('p');

        $qb->andWhere($qb->expr()->like('p.nombre', ':nombre'))
            ->setParameter('nombre', '%' . $nombre . '%')
            ->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * Busca productos relacionados por categoría, excluyendo un producto específico.
     *
     * @param Producto $producto El producto principal.
     * @return Producto[] Los productos relacionados encontrados.
     */
    public function findRelatedProductsByCategoria(Producto $producto): array
    {
        $categoria = $producto->getCategoria();

        $qb = $this->createQueryBuilder('p');

        $qb->andWhere($qb->expr()->eq('p.categoria', ':categoria'))
            ->andWhere($qb->expr()->neq('p.id', ':productoId'))
            ->setParameter('categoria', $categoria)
            ->setParameter('productoId', $producto->getId());

        $query = $qb->getQuery();

        return $query->getResult();
    }

//    /**
//     * @return Producto[] Returns an array of Producto objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Producto
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
