<?php $this->titre = 'Gérer les chambres'; ?>


<h3 style="color:var(--couleurOrange);font-weight: bold;"><?php if($msgCode!=="litsErr" && $msgCode!=="courrielErr" && $msgCode!=="chambreErr" && $msgCode !=="typeErr")echo $msg;?></h3>

<h1>Chambres</h1>
<div class="partie">
    <h2>Liste des enregistrements dans la table:</h2>
    <table class="listeEnregistrement" align="center">
        <tr >


            <th>Numéro</th>

            <th>Nombre de lits</th>
            <th>Type de chambre</th>
        </tr>
        <?php foreach ($chambresTab as $ligne) {
            ?>
            <tr>


                <td><?=$ligne['numeroChambre']?></td>
                <td><?=$ligne['nombreLits']?></td>
                <td><?=$ligne['typeChambre_fk']?></td>
            </tr>
            <?php
        }

        ?>
    </table>
    <a style="margin-top: 10px;" href='Reservations'>Retour à l'accueil</a>
</div>
<style>




</style>

<div id="alerteSuppression" class="modal">


    <div class="modal-content" style="background-color: var(--couleurGris);">

        <h3>Êtes-vous certain de vouloir supprimer cette chambre?</h3>
        <h4>La suppression d'une chambre peut causer des problèmes comme la suppression des réservations associées à cette chambre.</h4>
        <a id="ouiSupprimerBouton"style="margin:15px; font-size: 28px;">Oui</a>
        <a style="margin:15px; font-size: 28px;" onclick="masquer()">Non</a>
    </div>

</div>

<script>
    var modal = document.getElementById("alerteSuppression");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
    function afficher(noChambre) {
        modal.style.display = "block";
        $('#ouiSupprimerBouton').attr('href', 'chambres/supprimer/'+noChambre);
    }
    function masquer() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>




