<?php


class CoursesService {
	
	public function __construct() {
    	$this->entityManager = $GLOBALS['em'];
    }
    
	public function getCourses() {
		$q = $this->entityManager->createQuery('SELECT c FROM Wfw\Entity\Course c ORDER BY c.name');
		return $q->getArrayResult();
	}
	
}