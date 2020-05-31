<?php $this->titre = 'Accueil'; ?>
<h1>Réservations</h1>


<div class="partie">

    <h2>Liste des enregistrements dans la table :</h2>
    <table class="listeEnregistrement" align="center">
        <tr >

            <th>Date d'arrivée</th>
            <th>Date de départ</th>
            <th>No. chambre</th>
            <th>Nom de l'utilisateur</th>
        </tr>
        <?php
        foreach ($reservations as $reservations)
        {
            echo "<tr>".
                "<td>" . $this->nettoyer($reservations['dateArrivee']) . "</td>".
                "<td>" . $this->nettoyer($reservations['dateDepart']) . "</td>".
                "<td>" . $this->nettoyer($reservations['numeroChambre_fk']) . "<i> (".$this->nettoyer($reservations['typeChambre_fk']).")</i></td>".
                "<td>".$this->nettoyer($reservations['nomUtilisateur'])."</td>
					 </tr>";
        }
        ?>
    </table>
    <a style="margin-top: 10px;" href='chambres'>Voir les chambres</a>
</div>



</div>
<p></p>

