<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$titre?></title>
    <base href="<?= $racineWeb ?>" >
	<link rel="stylesheet" type="text/css" href="Contenu/css/style.css">
	 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
	 <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
     <script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="Contenu/js/autocompletionTypeChambre.js"></script>

</head>
<body>


	<div class="enTete"><h1 style="margin: 0px;padding: 0px;">Gestion de l'hôtel</h1>

            <?php if ($utilisateur != '') : ?>
                <h3 class="connexionPartie">Connecté : <?=$utilisateur?> | <a href="Utilisateurs/deconnecter">Déconnexion</a></h3>
            <?php else : ?>
                <h3 class="connexionPartie">Visiteur non identifié | <a href="Utilisateurs/index">Connexion</a></h3>
            <?php endif; ?>


        </div>
	<?=$contenu?>
	<a href="Apropos" class="bouton">À propos</a><a href="tests.php" class="bouton">Tests</a>
</body>
</html>