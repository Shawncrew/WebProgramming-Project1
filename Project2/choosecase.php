<?php

include 'functions.php';
if(isset($_POST["caseNum"])) {
	$briefcases = $_SESSION['briefcases'];
	$caseNum = $_POST["caseNum"];
	$briefcases[$caseNum]->setChosen();
	$briefcases[$caseNum]->setRevealed();
	
	$_SESSION['chosenBriefCase'] = $caseNum;
}
header('Location: deal.php');







?>