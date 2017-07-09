<?php
session_start();

if(isset($_POST["caseNum"])) {
	$briefcases = $_SESSION['briefcases'];
	$caseNum = $_POST["caseNum"];
	$briefcases[$caseNum]->setRevealed();

}
header('Location: dealOrNoDeal.php');







class Briefcase {
	public $number;
	public $value;
	public $isRevealed = false;
	public $userChosen = false;

	public function __construct($number, $value) { 
		$this->number = $number;
		$this->value = $value;
	}
	
	public function setRevealed() {
		$this->isRevealed = true;
	}
	
	public function setChosen() {
		$this->userChosen = true;
	}
	
	public function getNumber() {
		return $this->number;
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function isRevealed() {
		return $this->isRevealed;
	}
	
	public function isChosen() {
		return $this->userChosen;
	}
	
	public function showAll() {
		$caseNum = $this->number;
		echo "Number: " . $this->number . "<br>";
		echo "Value: " . $this->value . "<br>";
		echo "Revealed? " . $this->isRevealed . "<br>";
		
		if($this->isRevealed) {
			echo '<img src="openbag.jpg">';
		}
		else if(!$this->isRevealed) {
			echo 
			"<form action='opencase.php' method='POST'>
				<input type='hidden' value=$caseNum name='caseNum' />
				<input type='submit' value='Open Bag'>
			</form>";
			echo '<img src="closedbag.jpg"><br>';
			
			
		}
		echo "User Chosen? " . $this->userChosen . "<br><br>";
	}
}
?>