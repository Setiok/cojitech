<?php
//recuperation des variables du formulaire et les enregistres en session
$_SESSION["searchTemp"]=$_POST['txtRecherche'];
$_SESSION["searchTemp2"]=$_POST['ouChercher'];
?>
<script type="text/javascript">
 	//redirige vers la page consultation
 	window.location.replace("../index.php?MenuP=Consultation");
 </script>