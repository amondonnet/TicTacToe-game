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
	unset($_SESSION['j1']);
	unset($_SESSION['j2']);
	unset($_SESSION['tab']);
	unset($_SESSION['joueur']);
	unset($_SESSION['scores']);
	unset($_SESSION['bot']);
	unset($_SESSION['identifiant']);
	?>	
	<div class="header">
	<h1>Jeu du Tic Tac Toe</h1><br>
	</div>
	
	<center><div class="div1">
	<form action="TicTacToe.php" method="post">
 <input type="text" name="j1" placeholder="Joueur 1"/>
 <input type="text" name="j2" placeholder="Joueur 2"/>
 <p><input type="submit" name="button" value="Jouer à deux"></p>
 <p><input type="submit" name="button" value="Jouer contre TicTacBot (facile)"></p>
 <p><input type="submit" name="button" value="Jouer contre TicTacBot (moyen)"></p>
 <p><input type="submit" name="button" value="Jouer contre TicTacBot (difficile)"></p>
 <p><input type="submit" name="button" value="Jouer en ligne"></p>
 </form>
	</div></center>
	
	</body>
</html>