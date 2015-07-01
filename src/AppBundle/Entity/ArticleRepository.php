<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{

	public function findAllOrderByName() {
		$em =  $this->getEntityManager();
		$query = $em->createQuery('SELECT a FROM AppBundle\Entity\Article a');
		$articles = $query->getResult();
		return $articles;
	}
}