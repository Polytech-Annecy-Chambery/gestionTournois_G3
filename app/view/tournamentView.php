<!-- 
Choisir une équipe à ajouter dans le tournois ou ajouter une nouvelle équipe au tournois

Pouvoir supprimer une équipe

Pouvoir modifier le nom du tournois

Voir les équipes déjà dans le tournois 

Bouton "Générer le tableau du tournois" actif quand le nombre d'équipes est égal à la capacité 4, 8 ou 16 -->

<?php require_once("model/TeamModel.php");?>
<?php $title = 'Gestion Tournois';  // Set the page Title?>

<?php ob_start(); // Initialize content start ?>
    <div id='ajoutTournois'>
			<h2>Ajouter un Tournoi :</h2>

			<form method='post' action=''>

				<div>
					<div>
						<label for="nom_t">Nom :</label>
					</div>
					<div>
						<input id="nom_t" type="text" name="nom_t" placeholder="Nom du tournois" title="Entrez un nom de tounrois. Champ obligatoire" required>
					</div>
				</div>

                <div>
					<div>
						<label for="sport_t">Sport :</label>
					</div>
					<div>
						<input id="sport_t" type="text" name="sport_t" placeholder="Sport" title="Entrez un sport. Champ obligatoire" required>
					</div>
				</div>	
					<div>
						<label for="nom_t">Choisissez les équipes :</label>
					</div>
					
	<fieldset method='post'>
    <legend>nombre de joueurs:</legend>

    <div>
      <input type="radio" id="4" name="capa" value="4"
             checked>
      <label for="huey">4</label>
    </div>

    <div>
      <input type="radio" id="8" name="capa" value="8">
      <label for="dewey">8</label>
    </div>

    <div>
      <input type="radio" id="16" name="capa" value="16">
      <label for="louie">16</label>
    </div>
</fieldset>


			<div>
				<input  type="submit" name="action" value="valider">
			</div>
			</form>
			<?php if(isset($_POST['action'])){
				$capa=$_POST["capa"];
				$nom=$_POST["nom_t"];
				$sport=$_POST["sport_t"];
				echo "nom: ".$nom."<br>";
				echo "sport: ".$sport."<br>";
				echo "nombre de joueur: ".$capa;
}?>
		</div>
<form>
	<?php
$donnees2=array();
while($donnees = $teams->fetch_array(MYSQLI_ASSOC)){
	//echo "<option value='".$donnees["id"]."'>".$donnees["nom_e"]."</option>";
	array_push($donnees2,$donnees);
}
$x = count($donnees2) . '<br>';


if(isset($_POST["capa"])){
	for ($i = 1; $i <=$_POST["capa"]; $i++) {
		echo "<select name='SelectEquipes'>";
		echo "<option value=''>--Choisissez une équipe--</option>";
		for ($j = 1; $j <= $x; $j++) {
			echo "<option value='".$donnees2[$j]['id_e']."'>".$donnees2[$j]['nom_e'] ."</option>";
			echo '<br>';
		}
		echo "</select>";
	}




echo "<input  type=".'submit'." name=".'action'." value=".'valider'.">";
}
?>
</form>
	

<?php $content = ob_get_clean(); // Get the html content into the content var ?>

<?php require('template.php'); ?>