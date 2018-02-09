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
		$resultats = $bdd->prepare("select reference, designation, marque, produit, etat, quantite_total, quantite_minimal, quantite_en_stock, quantite_reserve, quantite_en_test, quantite_en_SAV, commande from MATERIEL order by reference");
		$resultats->execute();
		$st = $resultats->fetchAll(PDO::FETCH_ASSOC);
		return $st;
	}
	catch(PDOException $e){
			
			die('erreur de requete a la bdd :'.$resultats.'/');
		}
};

function listeMaterielTri($order){
		$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
	    $user = 'root';
	    $mdp = '';
		$bdd = new PDO ($source, $user, $mdp);
		if ($order=="Stock") {
			$order= "quantite_en_stock";
		}
		elseif ($order== "Reserve"){
			$order="quantite_reserve";
		}
		elseif ($order=="SAV") {
			$order="quantite_en_SAV";
		}
		elseif ($order=="Test") {
			$order="quantite_en_test";
		}

		try{
			$resultats = $bdd->prepare("select reference, designation, marque, produit, etat, quantite_total, quantite_minimal, quantite_en_stock, quantite_reserve, quantite_en_test, quantite_en_SAV, commande from MATERIEL where (".$order." > 0) ");
			$resultats->execute();
			$st = $resultats->fetchAll(PDO::FETCH_ASSOC);
			return $st;
		}
		catch(PDOException $e){
			die('erreur de requete a la bdd :'.$resultats.'');
		}
};

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















function RequeteAjoutMateriel(){
	$source = 'mysql:host=127.0.0.1;dbname=cojitech;charset=utf8';
	$user = 'root';
	$mdp = '';
	$bdd = new PDO ($source, $user, $mdp);	

	try {

			//----- recuperation du nombre de ref similaire a celle rentrée
			$countRef = $bdd->prepare("select count(reference) from materiel where reference='".$_POST['reference']."'");
			$countRef->execute();
			$nbRef=$countRef->fetchAll(PDO::FETCH_COLUMN,0);
			//var_dump($nbRef);
			//echo $nbRef[0];


			if ($nbRef[0]==0) { //----- si ref = 0 alors on ajoute un nouveau materiel avec cette nouvelle ref
				ajoutNewMateriel();
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
function ajoutNewMateriel(){
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
		    quantite_total,
		     quantite_en_stock,
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
		    quantite_total,
		     quantite_en_SAV,
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
	
	elseif ($_POST['ou']=='test') { //ajout prevue pour test
				$resultats=$bdd->prepare("insert into materiel (
		reference,
		 designation,
		  marque,
		  produit,
		    quantite_total,
		     quantite_en_test,
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

$resultats->execute();
	//print_r($resultats->errorInfo());
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


















//funcyion mise a jour qte TT
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