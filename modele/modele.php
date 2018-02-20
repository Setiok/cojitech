<?php

// ------ test de connexion bdd
function connexion(){
	try{
		$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
		$user = 'root';
		$mdp = '';
		$bdd = new PDO ($source, $user, $mdp);
	}
	catch(PDOException $e){
		;
		die('erreur de co a la bdd');
	}
	
	return true;
}
// ----- fin test

// ----- liste des materiels et tri 

function listeMateriel(){
	
	$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
	$user = 'root';
	$mdp = '';
	$bdd = new PDO ($source, $user, $mdp);
	try{
		$resultats = $bdd->prepare("select reference, designation, marque, produit, etat, quantite_en_stock, quantite_minimal, fournisseur, emplacement from MATERIEL order by designation");
		$resultats->execute();
		$st = $resultats->fetchAll(PDO::FETCH_ASSOC);
		return $st;
	}
	catch(PDOException $e){

		die('erreur de requete a la bdd :'.$resultats.'/');
	}
};

function listeMaterielTri($order){
	try{
		$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
		$user = 'root';
		$mdp = '';
		$bdd = new PDO ($source, $user, $mdp);
		if ($order=="Stock") {
			$order= "quantite_en_stock";

			$resultats = $bdd->prepare("select reference, designation, marque, produit, etat, quantite_en_stock, quantite_minimal, fournisseur, emplacement from MATERIEL where (".$order." > 0) order by designation ");
			$resultats->execute();
			$st = $resultats->fetchAll(PDO::FETCH_ASSOC);
			//var_dump($st);
			return $st;
		}
	}
		catch(PDOException $e){
			die('erreur de requete a la bdd :'.$resultats.'');
		}
	};

	function getRecherche(){
	try {
		$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
		$user = 'root';
		$mdp = '';
		$bdd = new PDO ($source, $user, $mdp);
		$text=$_SESSION["searchTemp"];
		$ou=$_SESSION['searchTemp2'];


		if ($ou=="Désignation") {
			$resultats=$bdd->prepare("select reference, designation, marque, produit, etat, quantite_en_stock, quantite_minimal, fournisseur, emplacement from materiel where designation like '%".$text."%' order by designation ") or die(mysql_error());
			//var_dump($resultats);
		}
		elseif ($ou=="Référence") {
			$resultats=$bdd->prepare("select reference, designation, marque, produit, etat, quantite_en_stock, quantite_minimal, fournisseur, emplacement from materiel where reference like '%".$text."%' order by reference ") or die(mysql_error());

		}
		elseif ($ou=="Constructeur") {
			$resultats=$bdd->prepare("select reference, designation, marque, produit, etat, quantite_en_stock, quantite_minimal, fournisseur, emplacement from materiel where marque like '%".$text."%' order by marque ") or die(mysql_error());

		}
		elseif ($ou=="Famille") {
			$resultats=$bdd->prepare("select reference, designation, marque, produit, etat, quantite_en_stock, quantite_minimal, fournisseur, emplacement from materiel where produit like '%".$text."%' order by produit ") or die(mysql_error());

		}

		$resultats->execute();
		$st=$resultats->fetchAll(PDO::FETCH_ASSOC);
		return $st;


	} catch (PDOException $e) {
		
	}
	}

// ----- fin liste des materiels

// ----- fonction pour le tableau ajout-materiel

/*function getMateriel(){
		$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
	    $user = 'root';
	    $mdp = '';
		$bdd = new PDO ($source, $user, $mdp);

		try{
			$resultats=$bdd->prepare("select distinct reference,designation,marque,produit from materiel order by reference ");
			$resultats->execute();
			$st=$resultats->fetchAll(PDO::FETCH_ASSOC);
			return $st;
		}
		catch(PDOException $e){
			die('erreur de requete a la bdd :'.$resultats. '');
		}
	}; */

	function getUnMateriel($ref,$etat){
		try {
			$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
			$user = 'root';
			$mdp = '';
			$bdd = new PDO ($source, $user, $mdp);

			$requete=$bdd->prepare("select distinct * from materiel where reference='".$ref."' and etat='".$etat."'");
			$requete->execute();
			$values=$requete->fetch();
			return $values;
		} catch (PDOException $e) {
			die('erreur base de donnée');
		}
	}

	function getRef(){
		$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
		$user = 'root';
		$mdp = '';
		$bdd = new PDO ($source, $user, $mdp);

		try{
			$resultats = $bdd->prepare("select distinct reference from materiel order by reference");
			$resultats->execute();
			$st=$resultats->fetchAll(PDO::FETCH_COLUMN, 0);
			return $st;
		}
		catch(PDOException $e){
			die('erreur requete recuperation des reference');
		}
	};

	function getDesi(){
		$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
		$user = 'root';
		$mdp = '';
		$bdd = new PDO ($source, $user, $mdp);

		try{
			$resultats = $bdd->prepare("select distinct designation from materiel order by designation");
			$resultats->execute();
			$st=$resultats->fetchAll(PDO::FETCH_COLUMN, 0);
			return $st;
		}
		catch(PDOException $e){
			die('erreur requete recuperation des reference');
		}
	};

	function getMarque(){
		$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
		$user = 'root';
		$mdp = '';
		$bdd = new PDO ($source, $user, $mdp);

		try{
			$resultats = $bdd->prepare("select distinct marque from materiel order by marque");
			$resultats->execute();
			$st=$resultats->fetchAll(PDO::FETCH_COLUMN, 0);
			return $st;
		}
		catch(PDOException $e){
			die('erreur requete recuperation des reference');
		}
	};

	function getProduit(){
		$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
		$user = 'root';
		$mdp = '';
		$bdd = new PDO ($source, $user, $mdp);

		try{
			$resultats = $bdd->prepare("select distinct nom from produit order by nom");
			$resultats->execute();
			$st=$resultats->fetchAll(PDO::FETCH_COLUMN, 0);
			return $st;
		}
		catch(PDOException $e){
			die('erreur requete recuperation des reference');
		}
	};

	function getEtat(){
		$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
		$user = 'root';
		$mdp = '';
		$bdd = new PDO ($source, $user, $mdp);

		try{
			$resultats = $bdd->prepare("select distinct Etat from materiel order by Etat");
			$resultats->execute();
			$st=$resultats->fetchAll(PDO::FETCH_COLUMN, 0);
			return $st;
		}
		catch(PDOException $e){
			die('erreur requete recuperation des reference');
		}
	};


	function getOu(){
		$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
		$user = 'root';
		$mdp = '';
		$bdd = new PDO ($source, $user, $mdp);

		try{
			$resultats = $bdd->prepare("select distinct ou from materiel order by ou");
			$resultats->execute();
			$st=$resultats->fetchAll(PDO::FETCH_COLUMN, 0);
			return $st;
		}
		catch(PDOException $e){
			die('erreur requete recuperation des reference');
		}
	};

// ----- Fin fonction tableau ajout materiel















	function reqAjoutMateriel(){
		try {
			$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
			$user = 'root';
			$mdp = '';
			$bdd = new PDO ($source, $user, $mdp);	

			$ref=$_POST['reference'];
			$design=$_POST['designation'];
			$marque=$_POST['marque'];
			$produit=$_POST['produit'];
			$fourn=$_POST['fournisseur'];
			$etat=$_POST['etat'];
			$qteMin=$_POST['quantitéMin'];
			$empl=$_POST['emplacement'];
			$qteStock=$_POST['qteStock'];

			//----- recuperation du nombre de ref similaire a celle rentrée
			$countRef = $bdd->prepare("select count(reference) from materiel where reference='".$ref."'");
			$countRef->execute();
			$nbRef=$countRef->fetchAll(PDO::FETCH_COLUMN,0);
			//var_dump($nbRef); // pour test


			if ($nbRef[0]==0) { //----- si ref = 0 alors on ajoute un nouveau materiel avec cette nouvelle ref
				ajoutNewMateriel($ref,$design,$marque,$produit,$fourn,$etat,$qteMin,$empl,$qteStock);
			}

			elseif ($nbRef[0]==1) {// si la ref existe une fois
				//on recupere l'etat de l'existant
				
				$reqEtat=$bdd->prepare("select etat from materiel where reference='".$_POST['reference']."'");
				$reqEtat->execute();
				$Etats=$reqEtat->fetchAll(PDO::FETCH_COLUMN,0);

				if ($Etats[0]==$_POST['etat']) { // si l'etat est le meme -> on met a jour

					// si "check" est cocher -> on retire de la qteStock et on ajoute a la quantité du "ou" de celui dont l'etat a ete choisi
				if (isset($_POST['check'])) {
					updateMaterielOutStock();

				}
					//sinon -> on met a jour la qteTT et la qte du "ou" de celui dont l'etat a ete choisi
				else{
					updateMaterielInStock();
					ajoutQteTT();
				}
			}
				else{ // sinon on ajoute en mettant a jour la qte TT
					ajoutNewMateriel();
					ajoutQteTT();
				}

			}
			elseif ($nbRef[0]==2) { //si la ref existe 2 fois

				// si "check" est cocher -> on update la qte du "ou" et retire a la qteStock de celui dont l'etat a ete choisi
				if (isset($_POST['check'])) {
					updateMaterielOutStock();
				}
				//sinon -> on update la qte du "ou" et la qteTT des deux
				else{
					updateMaterielInStock();
					ajoutQteTT();
				}
			}
		}
		catch (PDOException $e) {
			die('erreur ajout bdd'.$e.'');
		}
	}









//fonction pour l'ajout d'un nouveau materiel
	function ajoutNewMateriel($ref,$design,$marque,$produit,$fourn,$etat,$qteMin,$empl,$qteStock){
		try{
			$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
			$user = 'root';
			$mdp = '';
			$bdd = new PDO ($source, $user, $mdp);
			$resultats=$bdd->prepare("insert into materiel (
				reference,
				designation,
				marque,
				produit,
				fournisseur,
				etat,
				quantite_minimal,
				emplacement,
				quantite_en_stock
			)
			VALUES('".$ref."',
			'".$design."',
			'".$marque."',
			'".$produit."',
			'".$fourn."',
			'".$etat."',
			'".$qteMin."',
			'".$empl."',
			'".$qteStock."'
		)"
	);
			$resultats->execute();
		}
		catch(PDOException $e){
			die('erreur ajot bdd "'.$e.'" ');
		}
	}
// fin fonction ajout materiel















//fonction pour l'ajout d'un nouveau materiel sans QteTT
	function ajoutNewMaterielSansQteTT(){
		$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
		$user = 'root';
		$mdp = '';
		$bdd = new PDO ($source, $user, $mdp);

//echo $_POST['ou'];

	if ($_POST['ou']=='stock') { //ajout au stock
		
		$resultats=$bdd->prepare("insert into materiel (
			reference,
			designation,
			marque,
			produit,
			quantite_en_stock,
			etat)
			VALUES('".$_POST['reference']."',
			'".$_POST['designation']."',
			'".$_POST['marque']."',
			'".$_POST['produit']."',
			'".$_POST['quantité']."',
			'".$_POST['etat']."')"
		);
	}

	elseif ($_POST['ou']=='reserve') { //ajout reservé a un client
		$resultats=$bdd->prepare("insert into materiel (
			reference,
			designation,
			marque,
			produit,
			quantite_total,
			quantite_reserve,
			etat)
			VALUES('".$_POST['reference']."',
			'".$_POST['designation']."',
			'".$_POST['marque']."',
			'".$_POST['produit']."',
			'".$_POST['quantité']."',
			'".$_POST['quantité']."',
			'".$_POST['etat']."')"
		);
	}
	
	elseif ($_POST['ou']=='SAV') { // ajout prevue pour SAV
		$resultats=$bdd->prepare("insert into materiel (
			reference,
			designation,
			marque,
			produit,
			quantite_en_SAV,
			etat)
			VALUES('".$_POST['reference']."',
			'".$_POST['designation']."',
			'".$_POST['marque']."',
			'".$_POST['produit']."',
			'".$_POST['quantité']."',
			'".$_POST['etat']."')"
		);
	}
	
	elseif ($_POST['ou']=='test') { //ajout prevue pour test
		$resultats=$bdd->prepare("insert into materiel (
			reference,
			designation,
			marque,
			produit,
			quantite_en_test,
			etat)
			VALUES('".$_POST['reference']."',
			'".$_POST['designation']."',
			'".$_POST['marque']."',
			'".$_POST['produit']."',
			'".$_POST['quantité']."',
			'".$_POST['etat']."')"
		);
	}

	$resultats->execute();
	//print_r($resultats->errorInfo());
}
// fin fonction ajout materiel sans Qte TT



















//fonction mise a jour de la quantité d'un materiel qui sort du stock pour aller "ou"
function updateMaterielOutStock(){
	$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
	$user = 'root';
	$mdp = '';
	$bdd = new PDO ($source, $user, $mdp);

	//on recupere les quantités en stock actuelles et on y soustrait la nouvelle

	$quantiteStock=$bdd->prepare('select distinct quantite_en_stock from materiel where reference ="'.$_POST['reference'].'"and etat="'.$_POST['etat'].'"');
	$quantiteStock->execute();
	$qteStock=$quantiteStock->fetchAll(PDO::FETCH_COLUMN,0);
	$qteStockAAjouter=$qteStock[0]-$_POST['quantité'];


	if ($_POST['ou']=="reserve") {//reserve
		$quantite=$bdd->prepare('select distinct quantite_reserve from materiel where reference ="'.$_POST['reference'].'"and etat="'.$_POST['etat'].'"');
		$quantite->execute();
		$qte=$quantite->fetchAll(PDO::FETCH_COLUMN,0);
		$qteAAjouter=$qte[0]+$_POST['quantité'];


		$resultats=$bdd->prepare("update materiel set
			designation='".$_POST['designation']."',
			marque='".$_POST['marque']."',
			produit='".$_POST['produit']."',
			quantite_en_stock='".$qteStockAAjouter."',
			quantite_reserve='".$qteAAjouter."'
			where reference='".$_POST['reference']."' and etat='".$_POST['etat']."'
			");
	}

	if ($_POST['ou']=="SAV") { //sav
		$quantite=$bdd->prepare('select distinct quantite_en_SAV from materiel where reference ="'.$_POST['reference'].'" and etat="'.$_POST['etat'].'"');
		$quantite->execute();
		$qte=$quantite->fetchAll(PDO::FETCH_COLUMN,0);
		$qteAAjouter=$qte[0]+$_POST['quantité'];


		$resultats=$bdd->prepare("update materiel set
			designation='".$_POST['designation']."',
			marque='".$_POST['marque']."',
			produit='".$_POST['produit']."',
			quantite_en_stock='".$qteStockAAjouter."',
			quantite_en_SAV='".$qteAAjouter."'
			where reference='".$_POST['reference']."' and etat='".$_POST['etat']."'
			");
	}

	if ($_POST['ou']=="test") {//test
		$quantite=$bdd->prepare('select distinct quantite_en_test from materiel where reference ="'.$_POST['reference'].'" and etat="'.$_POST['etat'].'"');
		$quantite->execute();
		$qte=$quantite->fetchAll(PDO::FETCH_COLUMN,0);
		$qteAAjouter=$qte[0]+$_POST['quantité'];


		$resultats=$bdd->prepare("update materiel set
			designation='".$_POST['designation']."',
			marque='".$_POST['marque']."',
			produit='".$_POST['produit']."',
			quantite_en_stock='".$qteStockAAjouter."',
			quantite_en_test='".$qteAAjouter."'
			where reference='".$_POST['reference']."' and etat='".$_POST['etat']."'
			");
	}

	$resultats->execute();
}
//fin fonction mise a jour

















//fonction mise a jour de la quantité d'un materiel qui est ajouter au stock et a la qteTT
function updateMaterielInStock(){

	$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
	$user = 'root';
	$mdp = '';
	$bdd = new PDO ($source, $user, $mdp);

	//on recupere les quantités actuelles et on les aditionne avec les nouvelles


	if ($_POST['ou']=="stock") {

		$quantiteStock=$bdd->prepare('select distinct quantite_en_stock from materiel where reference ="'.$_POST['reference'].'" and etat="'.$_POST['etat'].'"');
		$quantiteStock->execute();
		$qteStock=$quantiteStock->fetchAll(PDO::FETCH_COLUMN,0);
		$qteStockAAjouter=$qteStock[0]+$_POST['quantité'];

		$resultats=$bdd->prepare("update materiel set
			designation='".$_POST['designation']."',
			marque='".$_POST['marque']."',
			produit='".$_POST['produit']."',
			quantite_en_stock='".$qteStockAAjouter."' 
			where reference='".$_POST['reference']."' and etat='".$_POST['etat']."'
			");
		
	}

	elseif ($_POST['ou']=="reserve") {

		$quantiteStock=$bdd->prepare('select distinct quantite_reserve from materiel where reference ="'.$_POST['reference'].'" and etat="'.$_POST['etat'].'"');
		$quantiteStock->execute();
		$qteStock=$quantiteStock->fetchAll(PDO::FETCH_COLUMN,0);
		$qteStockAAjouter=$qteStock[0]+$_POST['quantité'];


		$resultats=$bdd->prepare("update materiel set
			designation='".$_POST['designation']."',
			marque='".$_POST['marque']."',
			produit='".$_POST['produit']."',
			quantite_reserve='".$qteStockAAjouter."' 
			where reference='".$_POST['reference']."' and etat='".$_POST['etat']."'
			");
	}
	elseif ($_POST['ou']=="SAV") {

		$quantiteStock=$bdd->prepare('select distinct quantite_en_SAV from materiel where reference ="'.$_POST['reference'].'"and etat="'.$_POST['etat'].'"');
		$quantiteStock->execute();
		$qteStock=$quantiteStock->fetchAll(PDO::FETCH_COLUMN,0);
		$qteStockAAjouter=$qteStock[0]+$_POST['quantité'];


		$resultats=$bdd->prepare("update materiel set
			designation='".$_POST['designation']."',
			marque='".$_POST['marque']."',
			produit='".$_POST['produit']."',
			quantite_en_SAV='".$qteStockAAjouter."' 
			where reference='".$_POST['reference']."' and etat='".$_POST['etat']."'
			");
	}
	elseif ($_POST['ou']=="test") {

		$quantiteStock=$bdd->prepare('select distinct quantite_en_test from materiel where reference ="'.$_POST['reference'].'" and etat="'.$_POST['etat'].'"');
		$quantiteStock->execute();
		$qteStock=$quantiteStock->fetchAll(PDO::FETCH_COLUMN,0);
		$qteStockAAjouter=$qteStock[0]+$_POST['quantité'];


		$resultats=$bdd->prepare("update materiel set
			designation='".$_POST['designation']."',
			marque='".$_POST['marque']."',
			produit='".$_POST['produit']."',
			quantite_en_test='".$qteStockAAjouter."' 
			where reference='".$_POST['reference']."' and etat='".$_POST['etat']."'
			");
	}
	$resultats->execute();

};
//fin fonction mise a jour

//function mise a jour qte TT
function ajoutQteTT(){

	$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
	$user = 'root';
	$mdp = '';
	$bdd = new PDO ($source, $user, $mdp);

	$quantiteTT=$bdd->prepare('select distinct quantite_total from materiel where reference ="'.$_POST['reference'].'"');
	$quantiteTT->execute();
	$qteTT=$quantiteTT->fetchAll(PDO::FETCH_COLUMN,0);
	$qteTTAAjouter=$qteTT[0]+$_POST['quantité'];
	$updateQteTT=$bdd->prepare('update materiel set 
		quantite_total="'.$qteTTAAjouter.'"
		where reference ="'.$_POST['reference'].'"');
	$updateQteTT->execute();
}

















//fonction pour modif la qte d'un materiel (page consultation)
function reqAjoutQuantite(){
	try{
	$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
	$user = 'root';
	$mdp = '';
	$bdd = new PDO ($source, $user, $mdp);

	$design=$_POST['designation'];
	$etat=$_POST['etat'];
	$qte=$_POST['quantité'];

	$reqGetQte=$bdd->prepare('select distinct quantite_en_stock from materiel where designation="'.$design.'" and etat="'.$etat.'"');
	$reqGetQte->execute();
	$getQte=$reqGetQte->fetchAll(PDO::FETCH_COLUMN,0);
	$qteAAjouter=$getQte[0]+$qte;

	//echo $getQte[0],"+",$qte,"=",$qteAAjouter;

	$reqUpdateQte=$bdd->prepare('update materiel set quantite_en_stock="'.$qteAAjouter.'" where designation="'.$design.'" and etat="'.$etat.'"');
	$reqUpdateQte->execute();
	
	return true;
}
	catch (PDOException $e){
		return false;
	}
};

/*function verifCheck($ref,$qte,$etat,$bdd){

	if (isset($_POST["checkI"])) {
		echo "checkI";
		$search='-';
		$replace='';
		$qte=str_replace($search, $replace, $qte);
		$qte=(int)$qte;

		$reqGetQte=$bdd->prepare('select distinct quantite_en_stock from materiel where reference="'.$ref.'" and etat="'.$etat.'"');
		$reqGetQte->execute();
		$getQte=$reqGetQte->fetchAll(PDO::FETCH_COLUMN,0);

		$qteAAjouter=($getQte[0])-($qte);
		$reqUpdateQte=$bdd->prepare('update materiel set quantite_en_stock="'.$qteAAjouter.'" where reference="'.$ref.'"and etat="'.$etat.'"');
		$reqUpdateQte->execute();
	}

	elseif (isset($_POST["checkA"])) {
		echo "checkA";
		$search='-';
		$replace='';
		$qte=str_replace($search, $replace, $qte);
		$qte=(int)$qte;

		$reqGetQte=$bdd->prepare('select distinct quantite_en_stock from materiel where reference="'.$ref.'" and etat="'.$etat.'"');
		$reqGetQte->execute();
		$getQte=$reqGetQte->fetchAll(PDO::FETCH_COLUMN,0);

		$qteAAjouter=($getQte[0])+($qte);
		$reqUpdateQte=$bdd->prepare('update materiel set quantite_en_stock="'.$qteAAjouter.'" where reference="'.$ref.'"and etat="'.$etat.'"');
		$reqUpdateQte->execute();
	}

	else{
		echo "qteTT";
		ajoutQteTT();
	}
}*/