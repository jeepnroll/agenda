<?php
$page_titre = "Identification";
include('../../_include/head-singin.php');
?>
<main class="container">
    <form class="form-signin" action="singin.php" method="post">
        <h2 class="form-signin-heading">Identifiez-vous</h2>
        <label for="identifiant" class="sr-only">Identifiant</label>
        <input type="text" id="identifiant" name="identifiant" class="form-control" placeholder="Identifiant" required autofocus>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me">Se souvenir de moi
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
    </form>
</main>
<?php
include "../../_include/foot-back.php";