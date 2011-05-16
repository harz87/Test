<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Wfw\Entity;
/**
 * Description of Mark
 * @Entity
 * @author Harz
 */
class Mark {
    /**
     *
     * @var integer
     * @Id @Column(type="integer", nullable="false")
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
   /**
     *
     * @var number
     * @Column(type="float", nullable="true")
     */
    private $mark;
    
    /**
     *
     * @var Student
     * @ManyToOne(targetEntity="Student")
     * @JoinColumns({
     *  @JoinColumn(name="student_id", referencedColumnName="id")
     * }) 
     */
    private $student;
    
    /**
     *
     * @var Course
     * @ManyToOne(targetEntity="Course")
     * @JoinColumns({
     *  @JoinColumn(name="course_id", referencedColumnName="id")
     * }) 
     */
    private $course;
    
    public function __get($property){
        return $this->$property;
    }
    
    public function __set($property,$value){
        $this->$property = $value;
    }

}

?>
