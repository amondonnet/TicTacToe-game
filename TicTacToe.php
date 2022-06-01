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
		//déclaration des fonctions permettant aux bots de jouer
		function bot_facile(){
			$valid=false;
			$bot_play=[0,0];
			while($valid==false){
				$bot_play=[mt_rand(0, 2),mt_rand(0, 2)];
				if($_SESSION['tab'][$bot_play[0]][$bot_play[1]]==0){$valid=true;}
			}
			header('location: ./TicTacToe.php?ligne='.$bot_play[0].'&colonne='.$bot_play[1]);
			exit;
		}
		function bot_moyen(){
			function lecture($a,$b,$c,$n){
				$valeurs=[$a,$b,$c];
				$compte=array_count_values($valeurs);
				if(isset($compte[$n])){return $compte[$n];}
				else{return 0;}
			}
			
			for($j = 2; $j > 0; $j--){
			if(lecture($_SESSION['tab'][0][0],$_SESSION['tab'][1][1],$_SESSION['tab'][2][2],$j)==2){
				if($_SESSION['tab'][0][0]==0){
				header('location: ./TicTacToe.php?ligne=0&colonne=0');
					exit;
				}
				elseif($_SESSION['tab'][1][1]==0){
					header('location: ./TicTacToe.php?ligne=1&colonne=1');
					exit;
				}
				elseif($_SESSION['tab'][2][2]==0){
					header('location: ./TicTacToe.php?ligne=2&colonne=2');
					exit;
				}
			}
			
			if(lecture($_SESSION['tab'][0][2],$_SESSION['tab'][1][1],$_SESSION['tab'][2][0],$j)==2){
				if($_SESSION['tab'][0][2]==0){
					header('location: ./TicTacToe.php?ligne=0&colonne=2');
					exit;
				}
				elseif($_SESSION['tab'][1][1]==0){
					header('location: ./TicTacToe.php?ligne=1&colonne=1');
					exit;
				}
				elseif($_SESSION['tab'][2][0]==0){
					header('location: ./TicTacToe.php?ligne=2&colonne=0');
					exit;
				}
			}
			
			for($l = 0; $l < 3; $l++){
				if(lecture($_SESSION['tab'][$l][0],$_SESSION['tab'][$l][1],$_SESSION['tab'][$l][2],$j)==2){
					for($c = 0; $c < 3; $c++){
						if($_SESSION['tab'][$l][$c]==0){
							header('location: ./TicTacToe.php?ligne='.$l.'&colonne='.$c);
							exit;
						}
					}
				}
			}
			
			for($c = 0; $c < 3; $c++){
				if(lecture($_SESSION['tab'][0][$c],$_SESSION['tab'][1][$c],$_SESSION['tab'][2][$c],$j)==2){
					for($l = 0; $l < 3; $l++){
						if($_SESSION['tab'][$l][$c]==0){
							header('location: ./TicTacToe.php?ligne='.$l.'&colonne='.$c);
							exit;
						}
					}
				}
			}}
			bot_facile();
		}
		
		function bot_difficile(){
			if($_SESSION['tab'][0][0]+$_SESSION['tab'][0][1]+$_SESSION['tab'][0][2]+$_SESSION['tab'][1][0]+$_SESSION['tab'][1][1]+$_SESSION['tab'][1][2]+$_SESSION['tab'][2][0]+$_SESSION['tab'][2][1]+$_SESSION['tab'][2][2]==0){
					header('location: ./TicTacToe.php?ligne=0&colonne=0');
					exit;
				}
				elseif($_SESSION['tab'][0][0]+$_SESSION['tab'][0][1]+$_SESSION['tab'][0][2]+$_SESSION['tab'][1][0]+$_SESSION['tab'][1][1]+$_SESSION['tab'][1][2]+$_SESSION['tab'][2][0]+$_SESSION['tab'][2][1]+$_SESSION['tab'][2][2]==1 && $_SESSION['tab'][1][1]==0){
					header('location: ./TicTacToe.php?ligne=1&colonne=1');
					exit;
				}
				else{bot_moyen();}
		}
				
		session_start();
		
		if(isset($_POST['button']) && $_POST['button']=="Jouer en ligne"){
			header('location: ./accueil_online.php');
			exit;
		}
		//on vérifie si le robot joue
		if(isset($_POST['button']) && $_POST['button']=="Jouer contre TicTacBot (facile)"){
			$_SESSION['j2']="TicTacBot";
			$_SESSION['bot']=1;
		}
		elseif(isset($_POST['button']) && $_POST['button']=="Jouer contre TicTacBot (moyen)"){
			$_SESSION['j2']="TicTacBot";
			$_SESSION['bot']=2;
		}
		elseif(isset($_POST['button']) && $_POST['button']=="Jouer contre TicTacBot (difficile)"){
			$_SESSION['j2']="TicTacBot";
			$_SESSION['bot']=3;
		}
		elseif(isset($_POST['button']) && $_POST['button']=="Jouer contre TicTacBot (hardcore)"){
			$_SESSION['j2']="TicTacBot";
			$_SESSION['bot']=3;
		}
		
		//initialisation de la partie
		if($_SESSION['scores']==null){$_SESSION['scores']=[0,0];}
		if(isset(/*$_SESSION['j1'], $_SESSION['j2'], $_SESSION['tab'], */$_SESSION['joueur'])==false){
		if($_SESSION['j1']==null){$_SESSION['j1']=$_POST['j1'];}
		if($_SESSION['j2']==null){$_SESSION['j2']=$_POST['j2'];}
		if($_SESSION['j1']==null){$_SESSION['j1']="Sans nom 1";}
		if($_SESSION['j2']==null){$_SESSION['j2']="Sans nom 2";}
		$_SESSION['joueur']= mt_rand(1, 2);
		$_SESSION['tab'] = [
			[0, 0, 0],
			[0, 0, 0],
			[0, 0, 0]
		];
		header('location: ./TicTacToe.php');
		exit;
		}
		else{
			
			//on récupère le coup qui a été joué
			if(isset($_GET['ligne'], $_GET['colonne'])){	
				$li = $_GET['ligne'];
				$co = $_GET['colonne'];
				$_SESSION['tab'][$li][$co]=$_SESSION['joueur'];
			}
		
		
			//on vérifie si il y a un gagnant ou match nul
			for($l = 0; $l < 3; $l++){
				if($_SESSION['tab'][$l][0]!=0 && $_SESSION['tab'][$l][0]==$_SESSION['tab'][$l][1] && $_SESSION['tab'][$l][1]==$_SESSION['tab'][$l][2]){
					if($_SESSION['tab'][$l][0]==1){
						header('location: ./endpage.php?vainqueur=1');
						exit;
					}
					if($_SESSION['tab'][$l][0]==2){
						header('location: ./endpage.php?vainqueur=2');
						exit;
					}	
				}
			}
			for($c = 0; $c < 3; $c++){
				if($_SESSION['tab'][0][$c]!=0 && $_SESSION['tab'][0][$c]==$_SESSION['tab'][1][$c] && $_SESSION['tab'][1][$c]==$_SESSION['tab'][2][$c]){
					if($_SESSION['tab'][0][$c]==1){
						header('location: ./endpage.php?vainqueur=1');
						exit;
					}
					if($_SESSION['tab'][0][$c]==2){
						header('location: ./endpage.php?vainqueur=2');
						exit;
					}
				}
			}
			if($_SESSION['tab'][0][0]!=0 && $_SESSION['tab'][0][0]==$_SESSION['tab'][1][1] && $_SESSION['tab'][1][1]==$_SESSION['tab'][2][2]){
				if($_SESSION['tab'][1][1]==1){
						header('location: ./endpage.php?vainqueur=1');
						exit;
					}
					if($_SESSION['tab'][1][1]==2){
						header('location: ./endpage.php?vainqueur=2');
						exit;
					}
			}
			if($_SESSION['tab'][0][2]!=0 && $_SESSION['tab'][0][2]==$_SESSION['tab'][1][1] && $_SESSION['tab'][1][1]==$_SESSION['tab'][2][0]){
				if($_SESSION['tab'][1][1]==1){
						header('location: ./endpage.php?vainqueur=1');
						exit;
					}
					if($_SESSION['tab'][1][1]==2){
						header('location: ./endpage.php?vainqueur=2');
						exit;
					}
			}
			$mnul=0;
			for($l = 0; $l < 3; $l++){
				for($c = 0; $c < 3; $c++){
					if($_SESSION['tab'][$l][$c]!=0){$mnul++;}
					if($mnul==9){
						header('location: ./endpage.php?vainqueur=0');
						exit;
				}
				}
			}
			
			
			//on change de joueur
			echo '<div class="header"><p>';
			if($_SESSION['joueur']==1){
				$_SESSION['joueur']=2;
				echo "C'est au tour de ".$_SESSION['j2'];
			}
			elseif($_SESSION['joueur']==2){
				$_SESSION['joueur']=1;
				echo "C'est au tour de ".$_SESSION['j1'];
			}
			echo '</p></div>';
			
			//on fait jouer le robot si il joue
			if(isset($_SESSION['bot']) && $_SESSION['bot']==1 && $_SESSION['joueur']==2){
				bot_facile();
			}
			elseif(isset($_SESSION['bot']) && $_SESSION['bot']==2 && $_SESSION['joueur']==2){
				bot_moyen();
			}
			elseif(isset($_SESSION['bot']) && $_SESSION['bot']==3 && $_SESSION['joueur']==2){
				bot_difficile();
				
			}
			
			//on affiche le jeu
			echo '<div class="div2"><table id="jeu" style="background-color:#33ACFF;">';
			for($ligne = 0; $ligne < 3; $ligne++){
				echo '<br><tr>';
				for($colonne = 0; $colonne < 3; $colonne++){
					echo '<td>';
					if($_SESSION['tab'][$ligne][$colonne]==1){echo '<img src="1.png" width="200" height="200"/>';}
					elseif($_SESSION['tab'][$ligne][$colonne]==2){echo '<img src="2.png" width="200" height="200"/>';}
					else{echo '<a href="?ligne='.$ligne.'&colonne='.$colonne.'"><img src="0.png" width="200" height="200"/></a>';}
					// else{echo '<button onclick="window.location.href = "?ligne='.$ligne.'&colonne='.$colonne.'";"><img src="0.png" width="200" height="200"/></button>
					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</table></div>';
			}
	?>
	</center>
	</body>
</html>