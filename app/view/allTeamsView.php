<?php 
$title = 'Gestion Tournois';
ob_start();

?>

<content>

<h2>Équipes inscrites : </h2>

<p ><ul><?php
        while ($row = mysqli_fetch_assoc($teams)) { 
            $id_e = $row['id_e'];
            $nom_e = $row['nom_e'];
        ?>
        <li>
        <form method="post">
            <input type="hidden" name="nom_e" value="<?php echo $nom_e?>">	
			<?php echo $nom_e ?>													
			<button type="submit" name="action" value="one_team">		
				Détails
			</button>
        </form>

        <form id="form_team_delete" method='POST'>
            <input type="hidden" name="nom_e"	 value="<?php echo $nom_e ?>">	
            <input type="hidden" name="id_e"	 value="<?php echo $id_e ?>">	

            <button type="submit" name="action" value="delete_team">		
                    Supprimer
            </button>
        </form>


        </li>
        <?php
        }
        ?>
        </ul>
</p>


<content>

<?php 
$content = ob_get_clean();
require('template.php'); 
?>