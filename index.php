<!-- Systeme MVC -->
<link rel="stylesheet" type="text/css" href="style/normalize.css">
<link rel="stylesheet" type="text/css" href="style/style.css">
<?php
    require "controleur/controleur.php";
    if (session_status()==1) {
    	//echo session_status();
    	session_start();
    }

    if (testco()==true) {

    	menu();
    }
   


    if (isset($_GET['MenuP'])) {
    	gestionMenuP();
	}
	if (isset($_GET['MenuC'])) {
    	gestionMenuC();
    }
    if (isset($_GET['MenuA'])) {
        gestionMenuA();
    }

?>