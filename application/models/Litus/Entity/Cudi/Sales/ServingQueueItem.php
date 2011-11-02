<?php

namespace Litus\Entity\Cudi\Sales;

/**
 * @Entity(repositoryClass="Litus\Repository\Cudi\Sales\ServingQueueItem")
 * @Table(name="cudi.sales_serving_queue_item")
 */
class ServingQueueItem
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="bigint")
     */
    private $id;
    
    /**
     * @ManyToOne(targetEntity="\Litus\Entity\Users\Person")
     * @JoinColumn(name="person", referencedColumnName="id")
     */
    private $person;
    
    /**
     * @ManyToOne(targetEntity="\Litus\Entity\Cudi\Sales\ServingQueueStatus")
     * @JoinColumn(name="status", referencedColumnName="id")
     */
    private $status;
    
    /**
     * @ManyToOne(targetEntity="\Litus\Entity\Cudi\Sales\PayDesk")
     * @JoinColumn(name="pay_desk", referencedColumnName="id")
     */
    private $payDesk;
    
    /**
     * @ManyToOne(targetEntity="\Litus\Entity\Cudi\Sales\Session")
     * @JoinColumn(name="sale_session", referencedColumnName="id")
     */
    private $session;

    public function __construct() {
    }

    public function getId() {
        return $this->id;
    }

    public function setId( $id_ ) {
        $this->id = $id;
    }

    public function getPerson() {
        return $this->person;
    }

    public function setPerson( $person_ ) {
        $this->person = $person_;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus( $status_ ) {
        $this->status = $status_;
    }

    public function getPayDesk() {
        return $this->payDesk;
    }

    public function setPayDesk( $payDesk_ ) {
        $this->payDesk = $payDesk_;
    }

    public function getSession() {
        return $this->session;
    }

    public function setSession( $session_ ) {
        $this->session = $session_;
    }
}
