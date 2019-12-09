<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAll(){
        return $this->findBy(array(), array('id' => 'DESC'));
    }

    // méthode pour trouver des articles en fonction d'un mot dans la catégorie, l'auteur(user), pays, titre
    // afficher la variable
    public function getArticle($word)
    {
        // $word est récupéré DEPUIS L'URL (variable déja paramétré DANS LE CONTROLEUR)
        // je récupère le query builder, qui me permet de créer des
        // requetes SQL
        $qb = $this->createQueryBuilder('a');
        // je sélectionne tous les articles de la base de données
        $query = $qb->select('a')
            // si le 'word' est trouvé dans les entitées suivantes
            ->leftJoin('a.Categorie', 'cat')
            ->addSelect('cat')
            ->leftJoin('a.user','user')
            ->addSelect('user')
            ->leftJoin('a.pays','pays')
            ->addSelect('pays')
            ->where('a.titre LIKE :word')
            ->orWhere('a.contenu LIKE :word')
            ->orWhere('cat.libelle LIKE :word')
            ->orWhere('user.username LIKE :word')
            ->orWhere('pays.nomPays LIKE :word')

            // j'utilise le setParameter pour sécuriser la requete
            ->setParameter('word', '%' . $word . '%')
            // je créé la requete SQL
            ->getQuery();
        // je récupère les résultats sous forme d'array
        $resultats = $query->getArrayResult();
        return $resultats;
    }

    public function getarticleByPays($pays){
        $qb = $this->createQueryBuilder('a');
        $query = $qb->select('a')
            ->leftJoin('a.pays','pays')
            ->addSelect('pays')
            ->leftJoin('a.Categorie', 'cat')
            ->addSelect('cat')
            ->leftJoin('a.user','user')
            ->addSelect('user')
            ->where('pays.nomPays = :pays')
            ->setParameter('pays', $pays)
            ->getQuery();
        // je récupère les résultats sous forme d'array
        $resultats = $query->getArrayResult();
        return $resultats;
    }
}
