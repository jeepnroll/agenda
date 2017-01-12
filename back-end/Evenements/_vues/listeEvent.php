<?php include('../../_include/head-back.php'); ?>
    <section class="col-md-10">
        <div class="row">
            <header class="page-header">
                <h1><?= $page_titre ?><small> Module Agenda</small></h1>
                <h2>Gestion des évènements</h2>
            </header>
            <article class="row">
                <div class="col-md-12">
                    <table class="table table-responsive table-hover table-inverse">
                        <thead>
                        <tr>
                            <th>ID.</th>
                            <th>Type</th>
                            <th>Titre</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Description</th>
                            <th>Lieu</th>
                            <th>Photo</th>
                            <th>Programme</th>
                            <th>Nombre de Places</th>
                            <th>Ordre Du Jour</th>
                            <th>Commission</th>
                            <th>Modif.</th>
                        </tr>
                        </thead>
                        <tbody >
                        <?php foreach ($evenement->events as $event) { ?>
                            <tr id="row_<?= $event['event_id'] ?>">
                                <th class="align-middle">
                                    <?= $event['event_id'] ?>
                                </th>
                                <th class="align-middle">
                                    <?= $event['type'] == 1 ? "Public" : "Privé" ; ?>
                                </th>
                                <td class="align-middle lead">
                                    <a href="Dashboard.php?id=<?= $event['event_id'] . "&titre=" . $event['titre']  ?>">
                                        <?= $event['titre']?>
                                    </a>
                                </td>
                                <td class="align-middle">
                                    Du <?= DateHelper::toFrDate($event['date_debut']) ?><br/>
                                    à <?= $event['heure_debut'] ?>
                                </td>
                                <td class="align-middle">
                                    Au <?= DateHelper::toFrDate($event['date_fin']) ?><br/>
                                    à <?= $event['heure_fin']?>
                                </td>
                                <td class="align-middle ">
                                    <a data-target="#desc_<?= $event['event_id'] ?>" data-toggle="modal" style="cursor: pointer">
                                        <i class="fa fa-file-text fa-2x"></i>
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <adress>
                                        <?= $event['lieu'] ?>
                                    </adress>
                                </td>
                                <td class="align-middle">
                                    <a data-target="#modalImg_<?= $event['event_id'] ?>" data-toggle="modal" style="cursor: pointer">
                                        <img src="<?= $event['illustration'] ?>" alt="<?= $event['photo_titre'] ?>" width="auto" height="50px">
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a href="<?= $event['programme'] ?>" target="_blank" title="Programme <?= $event["titre"] ?>" >
                                        <i class="fa fa-file-pdf-o fa-2x"></i>
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <?= $event['places_disponibles'] ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?= $event['ordre_du_jour'] !== "" ? $event['ordre_du_jour'] : "<i class=\"fa fa-ellipsis-h fa-2x\"></i>"?>
                                </td>
                                <td class="text-center align-middle"><?= $event['commission'] !== "" ? $event['commission'] : "<i class=\"fa fa-ellipsis-h fa-2x\"></i>"?></td>
                                <td class="align-middle">
                                    <div class="btn-group-xs">
                                        <a role="link" href="Dashboard.php?p=updateEvent&id=<?= $event["event_id"] ?>" class="btn btn-success" >
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a role="button" href="#" class="btn btn-danger supprimer" data-id="<?= $event['event_id'] ?>" data-label="<?= $event["titre"] ?>">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                    <?php foreach ($evenement->events as $modalDesc) { ?>
                        <div class="modal fade text-gray-dark" id="desc_<?= $modalDesc['event_id']; ?>" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title"><?= $modalDesc['titre'] ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <?= $modalDesc['description']; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    <?php } ?>

                    <?php foreach ($evenement->events as $modalImg) { ?>
                        <div class="modal fade text-gray-dark" id="modalImg_<?= $modalImg['event_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title"><?= $modalImg['titre'] ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <figure>
                                            <figcaption class="lead">
                                                <?= $modalImg['photo_titre'] ?>
                                            </figcaption>
                                            <img src="<?= $modalImg['illustration']; ?>" alt="<?= $modalImg['photo_titre']; ?>" width="100%" height="auto">
                                        </figure>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    <?php } ?>
                </div>
                <!-- Modale suppress -->
                <!--
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button>
    -->
                <div id="mask" class="mask"></div>
                <div id="dialogue" class="dialogue not-show">
                    <div class="dialContainer">
                        <header class="dialHead">
                            <h3></h3>
                        </header>
                        <div class="dialContent">
                        </div>
                        <div class="dialFooter">
                            <button class="btn btn-info closed">Annuler</button>
                            <button class="btn btn-danger" id="del">Supprimer</button>
                        </div>
                    </div>
                </div>

                <div id="info" class="info not-show">
                    <div class="infoContainer">
                        <header class="infoHead">
                            <h3></h3>
                        </header>
                        <div class="infoContent">

                        </div>
                        <div class="infoFooter">
                            <button class="btn btn-info closed">Fermer</button>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>

<?php
include('../../_include/foot-back.php');



