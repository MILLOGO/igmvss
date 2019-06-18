<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 02/07/2018
 * Time: 18:35
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{


/*
if($_POST){

    $nomb=strip_tags($_POST['nomB']);
    $nomcontact=strip_tags($_POST['nomC']);
    $prenomcontact=strip_tags($_POST['prenom']);
    $email=strip_tags($_POST['mail']);
    $numero=strip_tags($_POST['num']);
    $description=strip_tags($_POST['nomDes']);
    $bailleur=new Bd_GestionProjetActeur();
    $bailleur->InsererBailleur($nomb,$nomcontact,$prenomcontact,$numero,$email,$description);
    //$bailleur->InsererProjet($nomb,3455,"2018-07-14","2018-07-14",$nomcontact,$prenomcontact,$numero,$email,"site",$description,34556);
}*/
?>

<div class="modal" id="newBailleur" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'un nouveau bailleur </span></h3>
            </div>
            <div class="modal-body">
            <form method="post" action="" novalidate>
                <fieldset>
                    <Legend>Bailleur</Legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <label for="nomB">Nom du bailleur <span style="color: red">*</span></label><br>
                            <input type="text" name="nomB" id="nomB" class="formulaire" required onchange="EnleverFocus(this.id)">
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <label for="nomC">Nom du contact <span style="color: red">*</span></label><br>
                            <input type="text" name="nomC" id="nomC" class="formulaire" required onchange="EnleverFocus(this.id)">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <label for="prenom">Prénom du contact <span style="color: red">*</span></label><br>
                            <input type="text" name="prenom" id="prenom" required class="formulaire" onchange="EnleverFocus(this.id)">
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <label for="mail">Email du contact</label><br>
                            <input type="email" name="mail" id="mail" class="formulaire">
                            <span class="erreur" aria-live="polite"></span>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <label for="num">Numéro du contact bailleur <span style="color: red">*</span></label><br>
                            <input type="text" name="num" id="num" class="formulaire" title="format (XXXXXXXX ou XX XX XX XX)"
                                   pattern="[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}" required onchange="EnleverFocus(this.id)">
                            <span class="erreurtel" aria-live="polite"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <label for="nomDes">Description</label><br>
                            <textarea name="nomDes" id="nomDes" class="formulaire" style="height: 100px" ></textarea>
                        </div>
                    </div><br>
                </fieldset>
            </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" value="Enregistrer" id="Enregistrer" name="Enregistrer"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annuler" name="fermer" value="Annuler" data-dismiss="modal" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
    <div id="Etatenregistrement"></div>

<script type="application/javascript">

    var emailverif = document.getElementById('mail');
    var tel = document.getElementById('num');
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


    $("#Enregistrer").click(function(){
        var nomb=$('#nomB').val();
        var nomc=$('#nomC').val();
        var prenom=$('#prenom').val();
        var mail=$('#mail').val();
        var num=$('#num').val();
        var nomDes=$('#nomDes').val();

        if(nomb==''|| nomc==''|| prenom==''|| num=='' ){
            notification("vide");
            MettreFocus(nomb, nomc,prenom,num);
        }else {
            if(mail!=''){
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
                        var data = "nomB=" + nomb + "&nomC=" + nomc + "&prenom=" + prenom + "&mail=" + mail + "&num=" + num + "&nomDes=" + nomDes+"&type=ajout";
                        $.ajax({
                            type: "POST",
                            url: "./gestionProjetActeur/bailleur/enregistrement.php",
                            data: data,
                            success: function (reponse) {
                                $('#Etatenregistrement').html(reponse).show();
                                var etat=$('#echec').val();
                                if(etat!=''){
                                    $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php");
                                    etatdeinsertion("echec");
                                }else{
                                    $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php");
                                    notification(1);
                                }

                            }
                        });
                    }
                }
            }
             else {
                if (!tel.validity.valid) {
                    errortel.innerHTML = "Entrer le numéro au format xxxxxxxx ou xx xx xx xx";
                    errortel.className = "error active";
                    event.preventDefault();
                }else {
                    $(this).attr('data-dismiss', 'modal');
                    var data = "nomB=" + nomb + "&nomC=" + nomc + "&prenom=" + prenom + "&mail=" + mail + "&num=" + num + "&nomDes=" + nomDes+"&type=ajout";

                    $.ajax({
                        type: "POST",
                        url: "./gestionProjetActeur/bailleur/enregistrement.php",
                        data: data,
                        success: function (reponse) {
                            $('#Etatenregistrement').html(reponse).show();
                            var etat=$('#echec').val();
                            if(etat!=''){
                                $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php");
                                etatdeinsertion("echec");
                            }else{
                                $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php");
                                notification(1);
                            }

                        }
                    });
                    /*$.ajax({
                        type: "POST",
                        url: "./gestionProjetActeur/bailleur/ajouterBailleur.php",
                        data: data,
                        success: function () {
                            $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php");
                            notification(1);
                        }
                    });*/
                }
           }
        }
    });

    function MettreFocus(nomB,nomC,prenom,num){
        if(nomB==''){
            //$('#nomB').css('background-color', '#FDD').css('border-color', '#900');
            $('#nomB').css('background-color', '#FDD');
        }else{
            $('#nomB').removeAttrs('style');
        }

        if(nomC==''){
            $('#nomC').css('background-color', '#FDD');
        }else{
            $('#nomC').removeAttrs('style');
        }

        if(prenom==''){

            $('#prenom').css('background-color', '#FDD');
        }else{
            $('#prenom').removeAttrs('style');
        }

        if(num==''){
            $('#num').css('background-color', '#FDD');
        }else{
            $('#num').removeAttrs('style');
        }

    }

</script>
<?php }?>
