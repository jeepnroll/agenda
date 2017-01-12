$(document).ready(function () {


    $('.supprimer').on('click', function () {
        var id = $(this).data('id');
        var label = $(this).data("label");
        $("#dialogue .dialHead h3").html("Est tu sur ?");
        $("#dialogue .dialContent").html(
            "<p>Confirmer La suppression de l'évènement</p>" +
            "<p><b>" + label + "</b></p>"
        );


        $('#mask').fadeIn();
        $('#dialogue').fadeIn(function () {
            // Si je click sur delete
            $('#del').on('click', function () {
                // je ferme ma boite de dialogue de confirmation
                $(".dialogue").fadeOut('slow');
                $(".mask").fadeOut('slow');
                // a partir de ce moment, on peut essayer d'appeler le script coté serveur...
                $.ajax({
                    url: "Ajax/delete.php",
                    data: {
                        "id": id
                    },// définit les méthode
                    type: "post",
                    dataType: "json",
                    success: function (data) { // le script delete.php a correctement été appeler et il a été executer avec succès
                        console.log("Données retournées : " + JSON.stringify(data));
                        if (data.statut === 1) {
                            $('#' + data.row).remove();
                            $("#info .infoHead h3").html("Bravo ...");
                            $("#info .infoContent").html(
                                "<p>La suppression de :</p>" +
                                "<p><b>" + label + "</b></p>" +
                                "<p>S'est déroulée avec success</p>"
                            );
                        } else {
                            console.log("Pas de chance, La suppression a échouée");
                            $("#info .infoHead h3").html("Oups ...");
                            $("#info .infoContent").html("<p>La suppression à échouée</p>");

                        }
                    },
                    error: function (request, status, error) {// la requête à échouée
                        console.log(request.responseText + " | statut : " + status + " | error :" + error);
                    }
                });
                setTimeout(function () {
                    $('#mask').fadeIn("slow");
                    $('#info').fadeIn("slow");
                }, 1500)
            });
            setTimeout(function () {
                $('#mask').fadeOut("slow");
                $('#info').fadeOut("slow");
            }, 1500)
        });

    });

    $(".closed").on("click", function () {
        console.log("on click bien sur #closed");
        $("#mask").fadeOut();
        $("#dialogue").fadeOut();
        $('#info').fadeOut();
    });

    $('.imgDelete').on("click", function () {
        var id = $(this).data("id");
        $("#dialog-confirm").dialog(
            {
                resizable: false,
                width: 600,
                modal: true,
                buttons: {
                    "Oui": function () {
                        console.log("Oui on veut supprimer l'image");
                        $.ajax({
                            url: "Ajax/updateImage.php",
                            type: "get",
                            data: {
                                "id": id
                            },
                            dataType: "json",
                            success: function (result) {
                                // Supprimer du DOM l'image concernée
                                console.log('Okay, updateImage a bien été trouvé et exécuté');
                                if(result.status == 1){
                                    $(this).dialog("close");
                                    $("#image_" + result.id).remove();
                                    $("a[data-id=" + result.id + "]").remove();
                                    // créer... artificiellement un champ de type FILE pour pouvoir à nouveau télécharger un fichier
                                    var dock = $("#image-file-"+ result.id);
                                    var label = $("<label>");
                                        label.attr("for", "");
                                        label.html("Illustration :");
                                    var inputFile = $("<input>");
                                    inputFile.attr("name", "illustration");
                                    inputFile.attr("type", "file");
                                    inputFile.attr("class", "form-control");
                                    inputFile.attr("id", "illustration");
                                    inputFile.attr("accept", ".jpg,.jpeg,.png,.gif");
                                    // Ajouter l'élément au DOM
                                    label.appendTo(dock);
                                    inputFile.appendTo(dock);
                                }
                            },
                            error: function (request, status, error) {
                                console.log("Error => " + error + " | Status => " + status);
                            }
                        });
                    },
                    "Non": function () {
                        console.log("Non, on s'est fait peur, l'image ne sera pas supprimée.");
                        $(this).dialog("close");
                    }
                }
            }
        );
    });
});