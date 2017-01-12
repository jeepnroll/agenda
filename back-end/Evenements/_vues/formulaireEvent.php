<?php
include('../../_include/head-back.php');

?>
    <section class="col-md-9 ">
        <div class="pageContent">
            <header class="page-header">
                <h1><?= $page_titre ?> </h1>
                <p class="lead text-md-right"> Module agenda</p>
                <?php
                if(isset($maj)){
                    echo "<h3>" . $maj . "</h3>";
                }
                ?>
            </header>
            <form name="evenements" method="post" action="Dashboard.php" enctype="multipart/form-data" id="formAgenda">
                <input type="hidden" name="MAX_FILE_SIZE" value="20000000">
                <fieldset>
                    <legend>Titre et description</legend>
                    <div class="form-group">
                        <label for="titre">Titre :</label>
                        <input type="text" class="form-control" name="titre" id="titre" value="<?= isset($evenement->events['titre']) ? $evenement->events['titre'] : "" ?>" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea class="form-control" name="description" id="myEditor"  rows="15">
<?= isset($evenement->events['description']) ? $evenement->events['description'] : "Rediger une descrption ..." ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="programme">Programme :</label>
                        <input type="file" class="form-control" name="programme" id="programme" accept=".pdf"/>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Illustration</legend>
                    <?php if($evenement->events['illustration'] != ""){ ?>
                        <div class="row">
                            <div class="col-md-3">
                                <figure class="thumbnail">
                                    <img data-src="holder.js/300x300" src="<?= $evenement->events["illustration"] ?>" alt="<?= $evenement->events["photo_titre"] ?>" id="image_<?= $evenement->events["event_id"] ?>" width="100%" height="auto">
                                    <figcaption class="caption">
                                        <h6 class="lead text-center"><?= $evenement->events['photo_titre'] ?></h6>
                                        <a href="#" title="Supprimer l'illustration" class="btn btn-danger btn-xs imgDelete  text-center" data-id="<?= $evenement->events["event_id"] ?>">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="programme">Titre de l'illustration :</label>
                                    <input type="text" class="form-control" name="photo_titre" id="photo_titre" value="<?= isset($evenement->events['photo_titre']) ? $evenement->events['photo_titre'] : "" ?>" />
                                </div>
                            </div>
                        </div>
                        <div id="dialog-confirm" title="Etes-vous sûr de vouloir supprimer cette image ?" class="not-show" role="alert">
                            <p class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-2x"></i> Attention, si vous répondez oui,
                                l'image sera physiquement effacée sur le serveur. Cette action est irréversible.</p>
                        </div>
                    <?php } else { ?>
                        <div class="form-group">
                            <div id="image-file-<?= $evenement->events["event_id"] ?>"></div>
                            <input type="file" class="form-control" name="illustration" id="illustration" accept=".jpeg,.jpg,.png,.gif"/>
                        </div>
                    <?php }?>
                </fieldset>
                <fieldset>
                    <legend>Dates et heures</legend>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_debut">Date de début :</label>
                            <input type="date" class="form-control" name="date_debut" id="date_debut" value="<?= isset($evenement->events['date_debut']) ? strtolower($evenement->events['date_debut']) : "" ?>" />
                        </div>
                        <div class="form-group">
                            <label for="date_fin">Date de fin :</label>
                            <input type="date" class="form-control" name="date_fin" id="date_fin" value="<?= isset($evenement->events['date_fin']) ? strtolower($evenement->events['date_fin']) : "" ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="heure_debut">Heure de début :</label>
                            <input type="text" class="form-control" name="heure_debut" id="heure_debut" value="<?= isset($evenement->events['heure_debut']) ? $evenement->events['heure_debut'] : "" ?>" />
                        </div>
                        <div class="form-group">
                            <label for="heure_fin">Heure de fin :</label>
                            <input type="text" class="form-control" name="heure_fin" id="heure_fin" value="<?= isset($evenement->events['heure_fin']) ? $evenement->events['heure_fin'] : "" ?>" />
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Type</legend>

                    <div class="form-check">
                        <label class="form-check-inline">
                            <input type="radio" name="type" id="type_public" value="1" checked="checked" class="form-check-input" />
                            Public
                        </label>
                        <label class="form-check-inline">
                            <input type="radio" name="type" id="type_prive" value="2" class="form-check-input" />
                            Privé
                        </label>
                    </div>

                    <div class="content">
                        <div class="col-lg-6 current">
                            <div class="form-group">
                                <label for="lieu">Lieu :</label>
                                <input type="text" class="form-control" name="lieu" id="lieu" value="<?= isset($evenement->events['lieu']) ? $evenement->events['lieu'] : "" ?>" />
                            </div>
                            <div class="form-group">
                                <label for="places_disponibles">Places disponibles :</label>
                                <input type="text" class="form-control" name="places_disponibles" id="places_disponibles" value="<?= isset($evenement->events['places_disponibles']) ?  $evenement->events['places_disponibles'] : ""?>" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="commission">Commission :</label>
                                <input type="text" class="form-control" name="commission" id="commission" value="<?= isset($evenement->events['commission']) ? $evenement->events['commission'] : "" ?>" />
                            </div>
                            <div class="form-group">
                                <label for="ordre_du_jour">Ordre du jour :</label>
                                <input type="text" class="form-control" name="ordre_du_jour" id="ordre_du_jour" value="<?= isset($evenement->events['ordre_du_jour']) ? $evenement->events['ordre_du_jour'] : "" ?>" />
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group form-footer">
                    <button type="submit" class="btn btn-primary btn-lg"><?php echo $btnLabel ; ?></button>
                    <input type="hidden" name="event_id" value="<?= isset($evenement->events['event_id']) ? $evenement->events['event_id'] : "" ?>" />
                </div>
            </form>
        </div>

    </section>
<?php
include('../../_include/foot-back.php');