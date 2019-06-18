<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 04/07/2018
 * Time: 10:20
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{
/*
if($_POST){

    $nom=strip_tags($_POST['nomOpt']);
    $nomcop=strip_tags($_POST['nomCOpt']);
    $prenomcop=strip_tags($_POST['prenomOpt']);
    $numcop=strip_tags($_POST['numOpt']);
    $emailcop=strip_tags($_POST['mail']);
    $fonctcop=strip_tags($_POST['fctOpt']);
    $siteinterop=strip_tags($_POST['siteInt']);

    $operateur=new Bd_GestionProjetActeur();
    $operateur->InsererOperateur($nom,$nomcop,$prenomcop,$numcop,$emailcop,$fonctcop,$siteinterop);

}*/
?>
<div class="modal" id="newOperateur" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'un Opérateur </span></h3>
            </div>
            <div class="modal-body">
                <form method="post" action="">
            <fieldset>
                <Legend>OPERATEUR</Legend>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <label for="nomOpt">Nom l'Operateur <span style="color: red">*</span></label><br>
                        <input type="text" name="nomOpt" id="nomOpt" class="formulaire" required onchange="EnleverFocus(this.id)">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label for="nomCOpt">Nom du contact de l'opérateur <span style="color: red">*</span></label><br>
                        <input type="text" name="nomCOpt" id="nomCOpt" class="formulaire" required onchange="EnleverFocus(this.id)">
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label for="prenomOpt">Prénom du contact de l'opérateur <span style="color: red">*</span></label><br>
                        <input type="text" name="prenomOpt" id="prenomOpt" required class="formulaire" onchange="EnleverFocus(this.id)">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label for="numOpt">Numéro du contact l'opérateur <span style="color: red">*</span></label><br>
                        <input type="text" name="numOpt" id="numOpt" class="formulaire" title="format (XXXXXXXX ou XX XX XX XX)"
                               pattern="[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}" onchange="EnleverFocus(this.id)">
                        <span class="erreurtel" aria-live="polite"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label for="fctOpt">Fonction du contact de l'opérateur <span style="color: red">*</span></label><br>
                        <input type="text" name="fctOpt" id="fctOpt" class="formulaire" onchange="EnleverFocus(this.id)">
                    </div>

                </div><br>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label for="mail">Email du contact l'opérateur </label><br>
                        <input type="email" name="mail" id="mail" class="formulaire" required>
                        <span class="erreur" aria-live="polite"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label for="siteInt">site internet de l'opérateur</label><br>
                        <input type="text" name="siteInt" id="siteInt" class="formulaire">
                    </div>

                </div><br>
            </fieldset>
        </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" value="Enregistrer" id="EnregistrerOperateur" name="EnregistrerOperateur"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerOperateur" name="fermer" value="Annuler" data-dismiss="modal"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
<div id="Etatenregistrement"></div>

<?php

?>
<script type="application/javascript">

    var emailverif = document.getElementById('mail');
    var tel = document.getElementById('numOpt');
    var error = document.querySelector('.erreur');
    var errortel = document.querySelector('.erreurtel');

    emailverif.addEventListener("input", function (event) {
        if (emailverif.validity.valid) {
            error.innerHTML = ""; // On réinitialise le contenu
            error.className = "erreur"; // On réinitialise l'état visuel du message
        }
    }, false);

    tel.addEventListener("input", function (event) {
        if (tel.validity.valid) {
            errortel.innerHTML = ""; // On réinitialise le contenu
            errortel.className = "erreurtel"; // On réinitialise l'état visuel du message
        }
    }, false);

    $('#EnregistrerOperateur').click(function(){
        var nomOp=$('#nomOpt').val();
        var nomCop=$('#nomCOpt').val();
        var prenomcop=$('#prenomOpt').val();
        var numcop=$('#numOpt').val();
        var email=$('#mail').val();
        var fonction=$('#fctOpt').val();
        var siteiter=$('#siteInt').val();

        if(nomOp==''||nomCop==''||prenomcop==''||numcop==''||fonction==''){
            notification("vide");
            MettreFocus(nomOp,nomCop,prenomcop,numcop,fonction);
        }else{
            if(email!=''){
                if (!emailverif.validity.valid) {
                    error.innerHTML = "adresse e-mail incorrecte!";
                    error.className = "error active";
                    event.preventDefault();
                }else {
                    if (!tel.validity.valid) {
                        errortel.innerHTML = "Entrer le numéro au format xxxxxxxx ou xx xx xx xx";
                        errortel.className = "error active";
                        event.preventDefault();
                    }else {
                        $(this).attr('data-dismiss', 'modal');
                        var data = "nomOpt=" + nomOp + "&nomCOpt=" + nomCop + "&prenomOpt=" + prenomcop + "&numOpt=" + numcop + "&mail=" + email + "&fctOpt=" + fonction + "&siteInt=" + siteiter+"&type=ajout";
                        $.ajax({
                            type: "POST",
                            url: "./gestionProjetActeur/operateur/enregistrement.php",
                            data: data,
                            success: function (reponse) {
                                $('#Etatenregistrement').html(reponse).show();
                                var etat=$('#echec').val();
                                if(etat!=''){
                                    $('#corps').load("./gestionProjetActeur/operateur/listeOperateur.php");
                                    etatdeinsertion("echec");
                                }else{
                                    $('#corps').load("./gestionProjetActeur/operateur/listeOperateur.php");
                                    notification(1);
                                }

                            }
                        });
                    }
                }
            }else {
                if (!tel.validity.valid) {
                    errortel.innerHTML = "Entrer le numéro au format xxxxxxxx ou xx xx xx xx";
                    errortel.className = "error active";
                    event.preventDefault();
                }else {
                    $(this).attr('data-dismiss', 'modal');
                    var data = "nomOpt=" + nomOp + "&nomCOpt=" + nomCop + "&prenomOpt=" + prenomcop + "&numOpt=" + numcop + "&mail=" + email + "&fctOpt=" + fonction + "&siteInt=" + siteiter+"&type=ajout";
                    $.ajax({
                        type: "POST",
                        url: "./gestionProjetActeur/operateur/enregistrement.php",
                        data: data,
                        success: function (reponse) {
                            $('#Etatenregistrement').html(reponse).show();
                            var etat=$('#echec').val();
                            if(etat!=''){
                                $('#corps').load("./gestionProjetActeur/operateur/listeOperateur.php");
                                etatdeinsertion("echec");
                            }else{
                                $('#corps').load("./gestionProjetActeur/operateur/listeOperateur.php");
                                notification(1);
                            }

                        }
                    });
                }
            }
           // console.log(data);
        }
    });


    function MettreFocus(nom,nomC,prenom,num,fct){
        if(nom==''){
            //$('#nomB').css('background-color', '#FDD').css('border-color', '#900');
            $('#nomOpt').css('background-color', '#FDD');
        }else{
            $('#nomOpt').removeAttrs('style');
        }

        if(nomC==''){
            $('#nomCOpt').css('background-color', '#FDD');
        }else{
            $('#nomCOpt').removeAttrs('style');
        }

        if(prenom==''){

            $('#prenomOpt').css('background-color', '#FDD');
        }else{
            $('#prenomOpt').removeAttrs('style');
        }

        if(num==''){
            $('#numOpt').css('background-color', '#FDD');
        }else{
            $('#numOpt').removeAttrs('style');
        }

        if(fct==''){
            $('#fctOpt').css('background-color', '#FDD');
        }else{
            $('#fctOpt').removeAttrs('style');
        }

    }
</script>
<?php }?>
