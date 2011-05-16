<?php
require_once(__DIR__.'/../bootstrap.php');

//$s = new MarksService();
//print_r($s->getMarks());
//\Doctrine\Common\Util\Debug::dump($s->getMarks());

class MarksService {
	
	public function __construct() {
    	$this->entityManager = $GLOBALS['em'];
    }
    
	public function getMarks() {
		$dql = "SELECT m, c FROM Wfw\Entity\Mark m JOIN m.course c";
		$q = $this->entityManager->createQuery($dql);
//		die($q->getSql());
		return $q->getArrayResult();
	}
	
}