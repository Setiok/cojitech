<meta charset="utf-8">
<?php 
include "../modele/modele.php";
echo "OK";

if (isset($_POST['ajouter'])) {
	if (reqAjoutMateriel()==True) {
		?>
		<script type="text/javascript" language="javascript">
			alert('mise a jour du stock correctement effectuer');
			window.location.replace("index.php?MenuA=Materiel");
		</script>
		<?php
	}
}

elseif (isset($_POST['btn1'])) {
	if(reqAjoutQuantite()==True){
		?>
		<script type="text/javascript" language="javascript">
			alert('mise a jour du stock correctement effectuer');
			window.location.replace("/index.php?MenuP=Consultation");
		</script>
		<?php
	}
}

elseif (isset($_POST['btn2'])) {
	$_SESSION['temp']=$_POST['reference'];
	$_SESSION['temp2']=$_POST['etat'];
	$_SESSION['temp3']=$_POST['quantité'];

	echo "<script type='text/javascript'>document.location.replace('../index.php?MenuA=Materiel');</script>";
}

?>

