<?php 
require '3TID2_connexion.php';
//ce fichier regroupe les fonction de mise en table ainsi que quelques fonctions utilisées dans le projet

//calculer la date de retour en ajoutant la duree de l'emprunt a la date dajout
//plus parlant que d'afficher la date d'emprunt et la durée
function retour($date1, $duree){
	$date = date_create($date1);
	date_add($date, date_interval_create_from_date_string($duree.'days'));
	return date_format($date, 'Y-m-d');
}

//jutilise cette fonction pour calculer lamende en cours, que je peux placer dans le tableau et envoyer par mail
function amende($date1, $duree){
	$datetime1 = new DateTime(retour($date1, $duree));
	$datetime2 = new DateTime(date('Y-m-d'));
	$interval = date_diff($datetime1, $datetime2);
	$retard= $interval->format('%R%a');
		if ($retard <= 0) {
			return '0 €';
		}
		else{
			return $retard*0.05." €";
		}
	}

$retards = 0;

function mise_en_table1($tableau){
	global $retards;
	$msg="<table class='table table-hover table-bordered'>
	<thead><tr><th>livre</th><th>nom</th><th>date de retour</th><th>tel</th><th>mail</th><th>amende</th><th>action</th></tr></thead>";
	$itt=0;
	foreach($tableau as $valeur){
		$id=$valeur['id'];

		$msg .="<tr";

		//je teste si l'amende est nulle, sinon jajoute une classe a la ligne du tableau pour quelle soit rouge et plus visible
		//j'incrémente le nombre damende pour pouvoir afficher sur laccueil le nombre damendes en cours pour avoir un apercu de
		//l'etat de la bibliotheque en un coup doeil
		if (amende($valeur['date'], $valeur['duree']) != "0 €") {
			$class= " class='error' ";
			
			$retards++;
		}

		else {
		$class="";
		}

		$msg.= $class;
		
		//itt est utilisé pour donner une valeur dattribut "class" unique a chaque element 
		//pour créer une fenetre modale lors de la redaction du mail
		$itt++;
		$msg.= "><td>".$valeur['titre']."</td><td>".$valeur['prenom']." ".$valeur['nom']."</td><td>".retour($valeur['date'], $valeur['duree'])."</td><td>".$valeur['tel']."</td><td>".$valeur['mail']."</td><td>".amende($valeur['date'], $valeur['duree'])."</td>";
		$msg.="<td><div class='btn-group'>
                <button class='btn dropdown-toggle' data-toggle='dropdown'>Action <span class='caret'></span></button>
                <ul class='dropdown-menu'>
                <li><a href='3TID2_update.php?id=".$valeur['emprunt']."'><i class='icon-pencil'></i> Editer</a></li>
			    <li><a href='3TID2_delete.php?id=".$valeur['emprunt']."&emp=".$valeur['id']."'><i class='icon-trash'></i> Supprimer</a></li>
			     <li class='divider'></li>
			     <!-- Button to trigger modal -->
			    <li><a href='#myModal".$itt."' data-toggle='modal'><i class='icon-envelope'></i> Contacter</a></li>
			                </ul>
				 </div>
				 <!-- Modal -->
				<div id='myModal".$itt."' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			 	<div class='modal-header'>
			    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
			    <h3 id='myModalLabel'>Contacter ".$valeur['prenom']."</h3>
			  	</div>
			  	<div class='modal-body'>

			    <form method='post' action='#' class='form-horizontal'>
			    <fieldset>
			      <label form='amende_adresse'>Email du membre</label>
			      <input type='text' id='amende_adresse' name='mail' class='input-xlarge uneditable-input' value='".$valeur['mail']."'>
			      <label for='amende_txt'>Contenu du mail</label>
			      <textarea rows='10' id='amende_txt'>Bonjour ".$valeur['prenom'].",\r\nNous vous informons du retard de votre livre '".$valeur['titre'].".' , de ".$valeur['auteur']."\r\nL'amende s'élève désormai à ".amende($valeur['date'], $valeur['duree']).", vous étiez sensé rentrer ce livre pour le ".$valeur['date'].". \r\nBien à vous,\r\nla bibliothèque.</textarea>
			      <input type='submit' class='btn btn-primary' value='envoyer'>
			    </fieldset>
			    </form>
			    
			    </div>
			  
			 	 <div class='modal-footer'>
			    <button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>
			    
			  	 </form>
			 	 </div>
				</div>
				</td></tr>";
		}
	
	$msg.="</table>";
	return $msg;

}

//creation de la table livre 
function mise_en_table2($tableau){
	$msg="<table class='table table-hover table-bordered'>
	<thead><tr><td>ref</td><td>titre</td><td>auteur</td><td>genre</td><td>resume</td><td>libre</td></tr></thead>
	";
	foreach($tableau as $valeur){
		$id=$valeur['id'];

		$msg.= "<tr><td>".$valeur['id']."</td><td>".$valeur['titre']."</td><td>".$valeur['auteur']."</td><td>".$valeur['genre']."</td><td>".$valeur['resume']."</td><td>".$valeur['libre']."</td>";
		$msg.="</tr>";
	}
	$msg.="</table>";
	return $msg;
}

function mise_en_table3($tableau){
	$msg="<table class='table table-hover table-bordered'>
	<thead><tr><td>prenom</td><td>nom</td><td>cp</td><td>mail</td><td>tel</td></tr></thead>";
	foreach($tableau as $valeur){
		$id=$valeur['id'];

		$msg.= "<tr><td>".$valeur['prenom']."</td><td>".$valeur['nom']."</td><td>".$valeur['cp']."</td><td>".$valeur['mail']."</td><td>".$valeur['tel']."</td>";
		$msg.="</tr>";
	}
	$msg.="</table>";
	return $msg;
}


try{
	//je joins les 3tables pour pouvoir afficher 
	//le titre(table livres) la durée (table emprunts) et le nom de l'emprunteur(table membres)

	$sql="SELECT * 
FROM emprunts
INNER JOIN membres ON emprunts.membre = membres.id
LEFT JOIN livres ON emprunts.livre = livres.id";
	$res=$db->query($sql);

	$sql2="select * from livres";
	$res2=$db->query($sql2);

	$sql3="select * from membres";
	$res3=$db->query($sql3);
}
catch(Exception $e)
    {
    echo "erreur : ".$e->getMessage();
    }

// en faire un tableau
$tab=$res->fetchAll();
$tab2=$res2->fetchAll();
$tab3=$res3->fetchAll();

// parcourir le tableau
$aff=mise_en_table1($tab);
$aff2=mise_en_table2($tab2);
$aff3=mise_en_table3($tab3);

//jadapte la phrase a afficher sur laccueil suivant le nombre de retards
if ($retards > 0) {
		$retard_info = "il y a ".$retards." retards parmis les emprunts.";
		
		if ($retards === 1) {
		$retard_info = "il y a 1 retard parmis les emprunts.";
		}
	}

	else{
		$retard_info = "Il n'y a pas de retards parmis les emprunts.";
	}

//Afficher les livres libres dans un select
//puis les membres dans un autre select
try{
	$libre="SELECT titre,id FROM livres where libre=1";
	$free=$db->query($libre);

	$mbr="SELECT prenom,nom,id FROM membres";
	$bla=$db->query($mbr);
	}

catch(Exception $e)
    {
    echo "erreur : ".$e->getMessage();
    }

$ok = $free->fetchAll();
$ppl= $bla->fetchAll();

//je cree le "select" avec tous les membre que je "echo" dans le formulaire
$selectppl .="<select name='membre'>";

foreach($ppl as $kikou) {
	$selectppl .="<option value=".$kikou['id'].">".$kikou['nom']." ".$kikou['prenom']."</option>";
};

$selectppl .= "</select>";

//je cree le "select" avec tous les livres libres que je "echo" dans le formulaire
$selectbook .= "<select name='livre'>";

foreach($ok as $livre) {
	$selectbook .="<option value=".$livre['id'].">".$livre['titre']."</option>";
};

$selectbook .= "</select>";

// pour les sources de ce fichier j'ai utilisé quelques fonctions sur la doc de php.net (notamment pour les manipulations de date)
// le reste est un savant mélange du cours et de ma créativité
?>