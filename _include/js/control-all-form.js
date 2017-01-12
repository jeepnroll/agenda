/**
 * Created by BRUNET Jean-Philippe on 18/11/2016.
 */
/**
 * Améliorer ce script de manière à:
 *  - Désactiver le bouton valider si l'utilisateur efface un champ
 *  - Activer le bouton Valider si tous les champs sont remplis,
 *  même si l'utilisateur reste sur le dernier champ
 */
/*


$(".required").on('blur', function () {
    var formulaireValide = true;
    // verification de l'ensemble de tous les champs requis...
    console.log('sortie du champ ' + $(this).attr("data-label"));
    // boucler sur tous les champs requis...
    $(".required").each(function () {
        if($(this).val() == ""){
            // Valeur non saisie... le formulaire n'est pas valide
            formulaireValide = false;
        }
    });
    if(formulaireValide){
        $('#valider').removeAttr("disabled").removeClass("btn-outline-danger").addClass("btn-success");
    }
});

// gère l'évènement keyup : touche relachée sur le champ
$(".required").on("keyup", function () {
    var formulaireValide = true;
    if ($(this).val() == "") {
        $("#valider").attr("disabled", "disabled").removeClass("btn-success").addClass("btn-outline-danger");
    } else {
        $(".required").each(function () {
                if ($(this).val() == "") {
                    formulaireValide = false;
                    $(this).addClass("btn-outline-danger");
                    $(this).next(".labelErrors").fadeIn("slow");
                }
            }
        );
        if (formulaireValide) {
            $("#valider").removeAttr("disabled").removeClass("btn-outline-danger").addClass("btn-success");
            if($("#annee").val().length == 4 && $('#annee').val() > 1900){
                if(!isNaN($("#annee").val())){
                    $('#valider').removeAttr("disabled").removeClass("btn-outline-danger").addClass("btn-success");
                } else {
                    $('#valider').attr("disabled","disabled").removeClass("btn-success").addClass("btn-outline-danger");
                }
            } else {
                $('#valider').attr("disabled", "disabled").removeClass("btn-success").addClass("btn-outline-danger");
            }
        } else {
            // le formulaire n'est pas valide
            $("#valider").attr("disabled", "disabled").removeClass("btn-success").addClass("btn-outline-danger");
        }
        return formulaireValide;
    }
});

*/


$("form").on("submit", function () {
    var messages = String;
    var formulaireValide = true;

    console.log("l'utilisateur à validé le formulaire !");

    $(".required").each(function () {
        console.log("controle du champ :" + $(this).attr("id") + $(this).val());
        var label = $("[for=" + $(this).attr("id")+ "]");
        var pError = $("[id=error-" + $(this).attr("id") + "]" );
        var formGroup = $(this).parents(".form-group");
        if($(this).val() == ""){
            messages = "<p>Le champ " + $(this).attr("data-label") + " n'est pas rempli. </p>";
            $(pError).html(messages).addClass("labelErrors");
            $(label).effect("shake").addClass("labelErrors");
            $(formGroup).addClass("formGroupError");
            formulaireValide = false;
        } else {
            $(label).removeClass("labelErrors");
            $(formGroup).removeClass("formGroupError").addClass("formGroupValid");
            $(pError).html("");
        }
    });
    return formulaireValide;
});

