<?php

namespace App\Repository;

use App\Entity\Consulta;
use App\Entity\HorariosMedico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method HorariosMedico|null find($id, $lockMode = null, $lockVersion = null)
 * @method HorariosMedico|null findOneBy(array $criteria, array $orderBy = null)
 * @method HorariosMedico[]    findAll()
 * @method HorariosMedico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorariosMedicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HorariosMedico::class);
    }

    // /**
    //  * @return HorariosMedico[] Returns an array of HorariosMedico objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findOneBySomeField($med, $diasemana, $data)
    {

        $subQueryBuilder = $this->getEntityManager()->createQueryBuilder();
        $subQuery = $subQueryBuilder
            ->select('hm.hora')
            ->from(Consulta::class, 'cs')
            ->innerJoin('cs.horarios_medico_idhorariosmedico', 'hm')
            ->where('cs.medico_idmedico = :med and cs.dia_consulta = :dia2')
            ->setParameters(array('med' => $med,
                'dia2' => $data,
            ))
        ;

        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder
            ->select('h')
            ->from(HorariosMedico::class, 'h')
            ->innerJoin('h.medico_idmedico', 'm')
            ->leftJoin('h.consulta_idconsulta', 'c')
            ->where('m.id = :med and h.dia = :dia')
            ->andWhere($queryBuilder->expr()->notIn('h.hora', $subQuery->getDQL()))
            ->setParameters(array('med' => $med,
                'dia' => $diasemana,
                'dia2' => $data
            ));
        return $query;

    }



}
