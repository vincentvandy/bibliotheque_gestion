<!-- Fichier qui permet de mettre lemprunt a jour surtout utilisé pour editer la duree donc je nai pas pris
la peine dafficher le nom du livre et de lemprunteur comme fait sur les autres pages -->
<html>
<head>
	<meta charset="utf-8">
    <title>Dwm Gestion de la bibliothèque</title>
	
</head>
<body>
<?php
error_reporting(E_ALL ^ E_NOTICE);
require '3TID2_connexion.php';

$id=$_GET['id'];

if ($_POST['soumission']) {
extract($_POST);

	try{
		$sql=" update emprunts set livre='$livre',membre='$membre',date='$date',duree='$duree' where emprunt=$id";
		echo $sql;
		$count=$db->exec($sql);
	}
	catch(Exception $e)
	    {
	    echo "erreur : ".$e->getMessage();
	    }
	
	?>
		<script>
		document.location.href='index.php?tab=emprunts&succes=1';
		</script>
		<?php 

		exit();
}

// recolte des données
$sql=" select * from emprunts where emprunt=$id";
$res=$db->query($sql);
$tab=$res->fetch(PDO::FETCH_BOTH);

// afficher les données dans le formulaire
?>

<form method="post" action="#">
<label for="livre">Reference livre: </label>
<input type="text" id="livre" name="livre" value="<?php echo $tab['livre']; ?>"><br />

<label for="membre">Id du membre: </label>
<input type="text" name="membre" id="membre" value="<?php echo $tab['membre']; ?>"><br />

<label for="date">Date de l'emprunt</label>
<input name="date" id="date" type="date" value="<?php echo $tab['date']; ?>"><br />

<label for="duree">Durée:</label>
<input type="text" id="duree" name="duree" value="<?php echo $tab['duree']; ?>"><br />

<input type="submit" name="soumission" value="confirmer">
</form>
</body>
</html>