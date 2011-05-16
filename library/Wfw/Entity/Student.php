<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Wfw\Entity;
/**
 * Description of Student
 * @Entity
 * @author Harz
 */
class Student {
    /**
     *
     * @var integer
     * @Id @Column(type="integer", nullable="false")
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
     *
     * @var string
     * @Column(length=80, type="string", nullable="true")
     */
    private $firstname;
    
    /**
     *
     * @var string
     * @Column(length=80, type="string", nullable="true")
     */
    private $lastname;
    
    /**
     *
     * @var Country
     * @ManyToOne(targetEntity="Country")
     * @JoinColumns({
     *  @JoinColumn(name="country_id", referencedColumnName="id")
     * }) 
     */
    private $country;
    
    /**
     *
     * @var \Doctrine\Common\Collections\Collection  
     * @OneToMany(targetEntity="Mark",mappedBy="Student", cascade={"persist","remove"})
     */
    private $marks;
    
    public function __get($property){
        return $this->$property;
    }
    
    public function __set($property,$value){
        $this->$property = $value;
    }

    
}

?>
