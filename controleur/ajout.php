<meta charset="utf-8">
<?php 
include "../modele/modele.php";
echo "OK";

if (isset($_POST['btn1'])) {
	echo "OK";
	if(reqAjoutQuantite()==True){
		?>
		<script type="text/javascript" language="javascript">
			alert('mise a jour du stock correctement effectuer');
			window.location.replace("/index.php?MenuP=Consultation");
		</script>
		<?php
	}
}

if (isset($_POST['btn2'])) {
	echo "OK";
	$_SESSION['temp']=$_POST['reference'];
	$_SESSION['temp2']=$_POST['etat'];

	echo "<script type='text/javascript'>document.location.replace('../index.php?MenuA=Materiel');</script>";
}

?>

