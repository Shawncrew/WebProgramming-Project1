<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title> Deal or No Deal</title>
	<link rel="stylesheet" type="text/css" href="deal.css">
	<?php 
	
	include 'functions.php';
	?>
</head>

<body>
	<div id="window">
		<div id="titleBar">
			Deal or No Deal
			<form action='sessionrestart.php'>
				<input type='submit' value='New Game'>
			</form>
			
			<a href='#instructions'>Instructions</a>
		</div>
		<div id="container">
			
			<?php
			for($i=0 ; $i < 9 ; $i++) {
				$caseNum = $_SESSION['briefcases'][$i]->getNumber();
				$displayCaseNum = $caseNum+1;
				$caseValue = $_SESSION['briefcases'][$i]->getValue();
				if(!$_SESSION['briefcases'][$i]->isRevealed() && !$_SESSION['briefcases'][$i]->isChosen()) {
					echo "
						<div class='caseSpot";
						
					if ($caseNum==3 || $caseNum == 3) {
						echo " newRow";
					}
					echo "
					'>
							<div class='closedCase'>
								<div class='caseNumber'>
									<h2>$displayCaseNum</h2>
								</div>
								<div class='openButton'>";
					if (!isset($_SESSION['chosenBriefCase'])) {
						echo "
						
								<form action='chooseCase.php' method='POST'>
										<input type='hidden' value=$caseNum name='caseNum' />
										<input type='submit' value='Choose Case'>
									</form>
								</div>
							</div>
						</div>
						";
					}
					else {
						echo "
										<form action='opencase.php' method='POST'>
											<input type='hidden' value=$caseNum name='caseNum' />
											<input type='submit' value='Reveal Case'>
										</form>
									</div>
								</div>
							</div>
						
						";
					}
				}
				else if($_SESSION['briefcases'][$i]->isRevealed() && !$_SESSION['briefcases'][$i]->isChosen()){
					echo "
					<div class='caseSpot'>
						<div class='openCase'>
							<div class='caseNumberOpened'>
								<h2>$displayCaseNum</h2>
								<h2>$$caseValue</h2>
							</div>
							
						</div>
					</div>
					";
				}
				else if($_SESSION['briefcases'][$i]->isChosen()) {
					echo "
					<div class='caseSpot'>
					</div>
					
					";
				}
					
			}
			?>
			
			
		</div>
		<div id="chosenCaseSlot">
		<?php 
		if(isset($_SESSION['chosenBriefCase'])) {
			$caseNum = $_SESSION['chosenBriefCase'] + 1;
			echo "
			<div id='chosenCase'>
				<div id='caseText'>
					<h5>Your Case:<br>$caseNum</h5><br>
					
				</div>
			</div>
			";
		}
		?>
		</div>
		<div id="currentOffer">
		
		<?php
		if(isset($_SESSION['chosenBriefCase'])) {
			$caseNum = $_SESSION['chosenBriefCase'];
			$offer = floor(generateOffer());
			echo "
				<h3>Current Offer: $$offer</h3>
				<a href='#takeOffer'>Take Offer</a>
				
			
			
			"; 
			
		}
		?>
		</div>
		<div id="takeOffer" class="overlay">
			<div class="popup">
			<h2>You made $<?php echo $offer; ?>!</h2>
			<h2>Your case contained $ <?php echo $_SESSION['briefcases'][$_SESSION['chosenBriefCase']]->getValue(); ?> </h2>
			<form action='sessionrestart.php'>
				<input type='submit' value='New Game'>
			</form>
			
			</div>
		</div>
		<div id="instructions" class="overlay">
			<div class="popup">
			<div class="close">
				<a href="#">&times;</a>
			</div>
			<h2>How To Play</h2>
			<p>
			1.) Choose a case. Each case contains either $100, $500, $1000, $5000, $10000, $50000, $100000, $500000, or $1000000.
			<br>2.) Reveal cases one and a time and try to obtain the highest offer from the game to buy back your case.
			
			</div>
		</div>
	</div>
	
</body>

</html>