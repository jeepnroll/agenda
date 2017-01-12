<?php
/**
 * @name dashboard .php.
 * @project Initiation.
 * User: BRUNET Jean-Philippe
 * Date: 21/12/2016 à 12:01
 * @description => affiche tous les événement triés par titre
 **/
$page_titre = "Liste des événement privés";
?>
<!doctype html>
<html lang="fr">
<?php include"../_include/head.php" ; ?>
<body>
<main class="container">

    <header class="page-header">
        <h1><?= $page_titre ?></h1>
    </header>
    <section class="row">
        <article class="col-xs-offset-1 col-xs-10">
            <table class="table">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Horaires</th>
                    <th>Participants</th>
                    <th>Ordre du jour</th>
                </tr>
                </thead>
                <tbody>
            <?php foreach ($agendaPrive->getEvents() as $key => $event){ ?>
                <tr>
                    <th><?= $event->titre ?></th>
                    <th>Le <?= $event->dateDebut() ?></th>
                    <th>De <?= $event->heureDebut() . " à " . $event->heureFin() ?></th>
                    <th><?= $event->bureau ?></th>
                    <th><a role="button" data-toggle="modal" data-target="#<?= $event->idEvent ?>" >Ordre du jour</a></th>
                </tr>
            <?php } ?>
                </tbody>
            </table>
            <?php foreach ($agendaPrive->getEvents() as $key => $event){ ?>
            <!-- Modal -->
            <div class="modal fade" id="<?= $event->idEvent ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?= $event->titre ?></h4>
                        </div>
                        <div class="modal-body">
                           <?= $event->ordreDuJour ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </article>
    </section>
</main>

</body>
</html>
