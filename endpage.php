<!DOCTYPE php>
<html>
    <head>
        <meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
		<link rel="icon" type="image/gif" href="2.png" />
		<title>Tic Tac Toe game</title>
		
    </head>

    <body style="background-color:#303030;">
	<center>
	<?php
	session_start();
	$vainqueur = $_GET['vainqueur'];
	echo '<div class="header"><h1>';
	if($vainqueur==0){
		echo 'Match nul.';
	}
	elseif($vainqueur==1){
		echo $_SESSION['j1'].' gagne la partie.';
		$_SESSION['scores'][0]++;
	}
	elseif($vainqueur==2){
		echo $_SESSION['j2'].' gagne la partie.';
		$_SESSION['scores'][1]++;
	}
	echo '</h1></div>';
	
	echo '<div class="div1"><table id="resultats">
	<tr style="background-color:#33ACFF";><td><p> '.$_SESSION['j1'].' </p></td><td><p> '.$_SESSION['j2'].' </p></td></tr>
	<tr style="background-color:#7A7A7A";><td><p> '.$_SESSION['scores'][0].' </p></td><td><p> '.$_SESSION['scores'][1].' </p></td></tr>
	</table>';
	?>
	
	<br><button onclick="window.location.href = 'TicTacToe.php';">Nouvelle manche</button>
	<button onclick="window.location.href = 'TicTaccueil.php';">Nouvelle partie</button>
	</div>
	<?php
	unset($_SESSION['tab']);
	unset($_SESSION['joueur']);
	?>
	</body>
</html>