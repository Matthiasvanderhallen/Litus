<?php

namespace Litus\Repository\Cudi\Sales;

use Doctrine\ORM\EntityRepository;

use Litus\Entity\Cudi\SaleApp\PollingData;

/**
 * ServingQueueItem
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ServingQueueItem extends EntityRepository
{

    public function getQueueNumber( $sessionId ) {
    
        $query = $this->createQueryBuilder("qi");
        $query->select( "COUNT(qi)" )
              ->where( "qi.session = '".$sessionId."'");

        $result = $query->getQuery()->getResult();
        $count = $result[0][1];

        return $count + 1;
    }

    public function getPollingData() {
        $pd = $this->getEntityManager()
                  ->getRepository('\Litus\Entity\Cudi\SaleApp\PollingData')
                  ->findOneBy( array( 'name' => 'ServingQueueItem' ) );
        if( is_null($pd) ) {
           updatePollingData();
           return getPollingData();
        }
        return $pd->getTimestamp()->getTimestamp();
    }

    public function updatePollingData() {
        $pd = $this->getEntityManager()
                  ->getRepository('\Litus\Entity\Cudi\SaleApp\PollingData')
                  ->findOneBy( array( 'name' => 'ServingQueueItem' ) );
        if( is_null($pd) ) {
            $pd = new PollingData();
            $pd->setName( 'ServingQueueItem' );
        }
        $pd->setTimestamp( new \DateTime() );
        $this->getEntityManager()->persist( $pd );
    }

}
