<?php
//require_once('../controller.agenda.php');
//require_once('../Modele/EvenementPublic.class.php');
//require_once('../Modele/EvenementPrive.class.php');
//require_once('../Modele/Agenda.class.php');
/**
 * @name public .php.
 * @project Initiation.
 * User: BRUNET Jean-Philippe
 * Date: 21/12/2016 à 12:01
 * @description => Seulement les événements publics dans l'ordre inverse chronologique
 **/
$page_titre = "Agenda Public";
?>
<!doctype html>
<html lang="fr">
<?php include"../_include/head.php" ; ?>
<body>
<main class="container">
    <header class="page-header">
        <h1><?= $page_titre ?></h1>
    </header>
    <section class="col-xs-offset-1 col-xs-10" >
        <div class="row">
            <?php /** Début de boucle pour afficher les articles **/
            foreach ($agendaPublic->getEvents() as $key => $event ){
                ?>
                <article class="col-xs-12 col-md-6 col-lg-4">
                    <figure class="thumbnail event">
                        <a  tabindex="0" role="button" data-toggle="modal" data-target="#<?= $event->idEvent ?>" >
                            <img src="<?= $event->photo() ?>" alt="<?= $event->titrePhoto() ?>" width="100%" height="auto"/>
                            <figcaption class="text-center">
                                <!-- titre de la photo -->
                                <h4><?= $event->titrePhoto() ?></h4>
                            </figcaption>
                        </a>
                    </figure>
                </article>
                    <!-- Modal -->
                    <div class="modal text-center" id="<?= $event->idEvent ?>" role="dialog" aria-labelledby="<?= $event->idEvent ?>">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <header class="modal-header">

                                    <h4 class="modal-title" id="myModalLabel"><?=$event->titre ?></h4>
                                    <img src="<?= $event->photo() ?>" alt="<?= $event->titrePhoto() ?>" width="100%" height="auto">
                                </header>
                                <div class="modal-body">
                                    <div>
                                        <h4>C'est Quand ? </h4>
                                        <p><?= $event->dateDebut() . " à " . $event->heureDebut() ?></p>
                                        <p><?= $event->dateFin() . " à " . $event->heureFin() ?></p>
                                    </div>
                                    <div class="adresse"><h4>Lieu :</h4>
                                        <?= $event->lieu ?></div>
                                    <div><h4>C'est quoi ?</h4>
                                        <?= $event->description ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php /** Début de boucle pour afficher les articles **/ }?>
        </div>
    </section>
</main>
<script src="../include/js/jquery-3.1.1.min.js"></script>
<script src="../include/bootstrap/js/bootstrap.js" ></script>
</body>
</html>
