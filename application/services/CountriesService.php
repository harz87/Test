<?php

class CountriesService {
	
    public function __construct() {
    	$this->entityManager = $GLOBALS['em'];
    }
    
    public function getCountries() {
        $q = $this->entityManager->createQuery('SELECT c FROM Wfw\Country\Country c ORDER BY c.name');
	return $q->getArrayResult();
     }

}