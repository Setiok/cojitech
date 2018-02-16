<?php

require "modele/modele.php";


	function testco(){
		if (connexion()==true) {
			return true;
		}
		else{
			return false;
		}
	}

	function menu(){
		require "vue/menu.html";
	}

	function afficherMenu2(){
		require "vue/menu-consultation.html";
	}


	function afficherMateriel(){
		//ajouter if{rien de selectioner dans menu2}
		return listeMateriel();
		//else{afficher liste des materiel filtré}
	}

	function afficherMaterielTri(){
		$page=$_SESSION['page'];
		return listeMaterielTri($page);
	}

	function afficherAjout(){
		require "vue/Consultation/ajout-materiel.html";
	}

	function getValuesMateriel(){
	$ref=$_SESSION['temp'];
	$etat=$_SESSION['temp2'];
	unset($_SESSION['temp']);
	unset($_SESSION['temp2']);

	$values=getUnMateriel($ref,$etat);

	$design=$values[2];
	$marque=$values[3];
	$produit=$values[4];
	$fournisseur=$values[5];
	$qteMin=$values[7];
	$emplacement=$values[14];
	$qteStock=$values[8];

	?>
	<script type="text/javascript">
		document.getElementById('ref').value="<?php echo $ref; ?>";
		document.getElementById('design').value="<?php echo $design; ?>";
		document.getElementById('marque').value="<?php echo $marque; ?>";
		document.getElementById('produit').value="<?php echo $produit; ?>";
		document.getElementById('fournisseur').value="<?php echo $fournisseur; ?>";
		document.getElementById('etat').value="<?php echo $etat; ?>";
		document.getElementById('qte').value="<?php echo $qteMin; ?>";
		document.getElementById('emplacement').value="<?php echo $emplacement; ?>";
		document.getElementById('qteStock').value="<?php echo $qteStock; ?>";
	</script>
<?php
	}


//Tableau ajout-materiel
	function ReturnReference(){
		$st=getRef();
		return $st;
	}
	function ReturnDesignation(){
		$st=getDesi();
		return $st;
	}
	function ReturnMarque(){
		$st=getMarque();
		return $st;
	}
	function ReturnProduit(){
		$st=getProduit();
		return $st;
	}
	function ReturnEtat(){
		$st=getEtat();
		return $st;
	}
	function ReturnQte(){
		$st=getQte();
		return $st;
	}
	function ReturnOu(){
		$st=getOu();
		return $st;
	}
	/*function ReturnMateriel(){
		$st=getMateriel();
		return $st;
	}*/

// ----- Fin Tableau ajout-materiel

	function ajoutQuantite(){
		reqAjoutQuantite();
}



	function gestionMenuP(){

	    switch ($_GET['MenuP']) {
	        case 'Consultation':
	            include('vue/consultation/consultation.html');
	            break;

	        case 'Modification':
	        	include('vue/modification.html');
	        	break;

	        case 'Ajout':
	        	include('vue/Ajout/ajout.html');
	        	break;

	        case 'Historique':
	        	include('vue/historique.html');
	        	break;

	        default:
	            # code...
	            break;
	    }
	}

	function gestionMenuC(){
		switch ($_GET['MenuC']) {
			case 'Stock':
				$_SESSION['page']='Stock';
				include('vue/consultation/consultationTri.html');
				break;

			case 'reserve':
				$_SESSION['page']='Reserve';
				include('vue/consultation/consultationTri.html');
				break;
			
			case 'SAV':
				$_SESSION['page']='SAV';
				include('vue/consultation/consultationTri.html');
				break;

			case 'Test':
				$_SESSION['page']='Test';
				include('vue/consultation/consultationTri.html');
				break;

			default:
				# code...
				break;
		}
	}

	function gestionMenuA(){
		switch ($_GET['MenuA']) {
			case 'Materiel':
				include('vue/Ajout/ajout-new-materiel.html');
				break;

			case 'Produit':
				include('vue/Ajout/ajout-produit.html');
				break;
			
			default:
				# code...
				break;
		}
	}


?>