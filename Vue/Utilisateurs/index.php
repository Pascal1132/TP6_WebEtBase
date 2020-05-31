<?php $this->titre = "Connexion" ?>
<h1 style="margin-bottom: 0px;">Connexion (admin|admin)</h1>
<form action="Utilisateurs/connecter" method="post">
    <input name="login" type="text" placeholder="Entrez votre login" required autofocus><br/>
    <input name="mdp" type="password" placeholder="Entrez votre mot de passe" required>
    <br/>
    <input type="submit" value="Se connecter">
</form>

<?= ($erreur == 'mdp') ? '<span style="color : red;">Login ou mot de passe incorrects</span>' : '' ?>
<br>