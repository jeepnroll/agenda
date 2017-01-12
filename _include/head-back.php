<?php include 'function.php'; ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../_include/tether-1.3.3/dist/css/tether.css">
    <link rel="stylesheet" href="../../_include/js/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="../../_include/js/jquery-ui/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="../../_include/js/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="../../_include/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../_include/bootstrap/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../../_include/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../_include/js/summernote/summernote.css">
    <link rel="stylesheet" href="../../_include/style-back.css">
    <title><?= $page_titre ?></title>
</head>
<body class="bg-inverse text-white">
<main class="container-fluid">
    <aside class="col-md-2 menu">
        <nav>
            <h3>Interface Utilisateur</h3>
            <div class="module " id="accordion" role="tablist" aria-multiselectable="true" >
                <div class="card bg-inverse">
                    <div class="card-header bg-inverse" role="tab" id="headAgenda">
                        <h4 class="mb-0">
                            <a href="#collapseAgenda" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseAgenda">
                                <i class="fa fa-calendar fa-fw"></i> Agenda
                            </a>
                        </h4>
                    </div>
                    <div  class="collapse in" role="tabpanel" aria-labelledby="agenda" id="collapseAgenda">
                        <div class="card-block">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="Dashboard.php">Les événements</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="Dashboard.php?context=addEvent">Ajouter un événement</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </aside>
