<?php

function delete_check($sql){
	global $db;
	try{
	$res=$db->exec($sql);
	}
	catch(Exception $e)
	    {
	    echo "erreur : ".$e->getMessage();
	    }
}

$id=$_GET['id'];
$emp= $_GET['emp'];
require '3TID2_connexion.php';

try{
	$sql="delete from emprunts where emprunt=$id";
	delete_check($sql);

	$sql2=" update livres set libre=1 where id=$emp";
	$count=$db->exec($sql2);
}
catch(Exception $e){
    echo "erreur : ".$e->getMessage();
    }

?>
<script>
document.location.href='index.php?tab=emprunts&succes=1';
</script>
<?php 
exit();

?>