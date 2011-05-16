<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Wfw\Entity;
/**
 * 
 * @Entity
 * @author Harz
 */
class Course {

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
     * @Column(length=255, type="string", nullable="true")
     */
    private $name;
    
    /**
     *
     * @var \Doctrine\Common\Collections\Collection  
     * @OneToMany(targetEntity="Mark",mappedBy="course", cascade={"persist","remove"})
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
