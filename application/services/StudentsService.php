<?php


//$s = new StudentsService();
//print_r($s->getStudents());

class StudentsService {
	
	public function __construct() {
    	$this->entityManager = $GLOBALS['em'];
    }
    
	public function getStudents() {
		$dql = "SELECT s, c, m, e FROM Wfw\Entity\Student s 
			JOIN s.country c JOIN s.marks m 
			JOIN m.course e ORDER BY s.lastName, s.firstName";
		$q = $this->entityManager->createQuery($dql);
		return $q->getArrayResult();
	}

	public function saveStudent($student) {
		if ($student->id) { //update
			$entity = $this->entityManager->find('Wfw\Entity\Student', $student->id);
			if (!$entity)
				throw new Exception('Error saving student!');
			
			$marks = $entity->getMarks();
			foreach ($marks as $mark) { //update mark value for existent records
				$found = false;
				foreach ($student->marks as $record) { 
					if ($mark->getCourse()->getId() == $record->course->id) {
						$mark->setMark($record->mark); 
						$found = true;
						$key = array_search($record, $student->marks, true); //remove the $record from array
				        if ($key !== false) 
				            unset($student->marks[$key]);
						break;
					}
				}
				if (!$found) { //remove current mark
					$entity->removeMark($mark);
					$this->entityManager->remove($mark);//remove mark from database
				}
			}
		} else { //insert
			$entity = new entities\Student();
			$this->entityManager->persist($entity);
		}
		
		$this->addNewMarks($entity, $student); //add new marks if any
		
		$entity->setFirstName($student->firstName);
		$entity->setLastName($student->lastName);
		$d = new DateTime();
		$d->setTimestamp($student->registration->getTimestamp());
		$entity->setRegistration($d);
		$country = $this->entityManager->find('Wfw\Entity\Country', $student->country->id);
		if (!$country)
			throw new Exception('Error saving student; invalid country!');
		$entity->setCountry($country);
		
		$this->entityManager->flush(); //save the student
	}
	
	public function deleteStudent($student) {
		$entity = $this->entityManager->find('Wfw\Entity\Student', $student->id);
		if (!$entity)
			throw new Exception('Error deleting student!');
		$this->entityManager->remove($entity);
		$this->entityManager->flush();
	}

	private function addNewMarks($entity, $student) {
		foreach ($student->marks as $record) { //adding marks
			$mark = new entities\Mark();
			$mark->setMark($record->mark);
			$course = $this->entityManager->find('Wfw\Entity\Course', $record->course->id);
			if (!$course)
				throw new Exception('Error saving student; invalid course!');
			$mark->setCourse($course);
			$mark->setStudent($entity);
			$entity->addMark($mark);
		}
	}
	
}