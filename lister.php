<?php

// $aff = tableau des emprunts calculé dans lib.php
// $aff2 = tableau des livres calculé dans lib.php
// $aff3 = tableau des membres calculé dans lib.php

//jaffiche la nav et le tableau correspondant a lattribu GET que je recois
if($_GET['tab']=="emprunts"){
	$nav= "<li><a href='?tab=home'>Accueil</a></li>
                <li class='active'><a href='?tab=emprunts'>Emprunts</a></li>
                <li><a href='?tab=membres'>Membres</a></li>
                <li><a href='?tab=livres'>Livres</a></li>";
	$liste= $aff;
}

elseif ($_GET['tab']=="membres") {
	$nav= "<li><a href='?tab=home'>Accueil</a></li>
                <li><a href='?tab=emprunts'>Emprunts</a></li>
                <li class='active'><a href='?tab=membres'>Membres</a></li>
                <li><a href='?tab=livres'>Livres</a></li>";
    $liste= $aff3;
	
}

elseif ($_GET['tab']=="livres") {
	$nav= "<li><a href='?tab=home'>Accueil</a></li>
                <li><a href='?tab=emprunts'>Emprunts</a></li>
                <li><a href='?tab=membres'>Membres</a></li>
                <li class='active'><a href='?tab=livres'>Livres</a></li>";
	$liste= $aff2;
}


//validation et envoi du formulaire d'emprunt
if($_POST['emprunter']){
	extract($_POST);
	$erreur=0;
	
	//verification si le champs est rempli
	if($livre==''){$err_livre= "Il faut la reference de l'ouvrage<br />";$erreur=1;}
	if($membre==''){$err_membre= "Il faut le matricule du membre<br />";$erreur=1;}
	if($duree==''){echo "ce champs ne peut etre vide<br />";$erreur=1;}

	//si pas d'erreur rencontrée envoi
	if(!$erreur){

		require '3TID2_connexion.php';
		
		try{
			//insertion du nouvel emprunt
			$sql="insert into emprunts(livre, membre, date, duree) values ('$livre','$membre','$date','$duree')";
			$count=$db->exec($sql);

			//update de la colone "libre" de la table livre
			$sql2=" update livres set libre=0 where id=$livre";
			$count=$db->exec($sql2);
		}
		catch(Exception $e)
		    {
		    echo "erreur : ".$e->getMessage();
		    }

		?>
		<script>
		document.location.href='?tab=emprunts&succes=1';
		</script>
		<?php
		
		exit();
	}
	else{
		 header('Location: index.php?tab=emprunts&oups=1');
	}
}

?>
<div class="masthead">
        <h3 class="muted">Bibliothèque DWM</h3>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="nav">
                <?php echo $nav;?>
              </ul>
            </div>
          </div>
        </div><!-- /.navbar -->
      </div>

<!-- 
	emprunt de 7j par defaut et commence a la date du jour, 
	le bibliothequaire na plus que 2champs a remplir 
-->
<?php echo $liste; ?>
<form method="post" action="?tab=emprunts" class="form-horizontal">
	<fieldset>
	<div class="control-group">
		<label  class="control-label" for="livre">Titre du livre:</label>
		<div class="controls">
			<?php echo $selectbook; ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="membre">Membre: </label>
		<div class="controls">
			<?php echo $selectppl; ?>
		</div>
	</div>

	 <div class="control-group">
	 	<label class="control-label" for="date">Date du jour</label>
		<div class="controls">
			<input type="date" name="date" id="date" placeholder="date du jour" value="<?php echo date('Y-m-d'); ?>">
		</div>
  </div>

	 <div class="control-group input-append">
		<label class="control-label" for="appendedInput">Durée de l'emprunt</label>
		<div class="controls">
			<input type="number" name="duree" id="appendedInput" placeholder="duree (j)" value="7">
			<span class="add-on">jours</span>
		</div>
  	</div>

	 <div class="control-group">
	<div class="controls">
	<input type="submit" class="btn" name="emprunter" value="confirmer">
	</div>
  </div>
</fieldset>
</form>


