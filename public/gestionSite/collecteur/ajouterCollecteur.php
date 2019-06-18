<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 04/07/2018
 * Time: 11:36
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

?>
<div class="modal" id="newCollecteur" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'un Collecteur </span></h3>
            </div>
            <div class="modal-body">
                <form method="post" action="">
            <fieldset>
                <Legend>Collecteur</Legend>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label for="nomCollect">Nom du collecteur <span style="color: red">*</span></label><br>
                        <input type="text" name="nomCollect" id="nomCollect" class="formulaire" required onchange="EnleverFocus(this.id)">
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label for="prenomCollect">Prénom du collecteur <span style="color: red">*</span></label><br>
                        <input type="text" name="prenomCollect" id="prenomCollect" required class="formulaire" onchange="EnleverFocus(this.id)">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label for="fctCollect">Fonction du collecteur <span style="color: red">*</span></label><br>
                        <input type="text" name="fctCollect" id="fctCollect" class="formulaire" required onchange="EnleverFocus(this.id)">
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label for="telCollect">Tél collecteur <span style="color: red">*</span></label><br>
                        <input type="text" title="format (XXXXXXXX ou XX XX XX XX)" name="telCollect" id="telCollect" class="formulaire" required pattern="[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}" onchange="EnleverFocus(this.id)">
                        <span class="erreurtel" aria-live="polite"></span>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <label for="mail">Email du contact</label><br>
                        <input type="email" name="mail" id="mail" class="formulaire" required>
                        <span class="erreur" aria-live="polite"></span>
                    </div>
                </div><br>
            </fieldset>
        </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="submit" value="Enregistrer" id="EnregistrerCollecteur" name="EnregistrerCollecteur"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerCollecteur" name="fermer" value="Annuler" data-dismiss="modal"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
    <div id="Etatenregistrement"></div>
<?php
    /*
if($_POST){
    $nomColect=strip_tags($_POST['nomCollect']);
    $prenomcolect=strip_tags(($_POST['prenomCollect']));
    $fonction=strip_tags($_POST['fctCollect']);
    $num=strip_tags($_POST['telCollect']);
    $email=strip_tags($_POST['mail']);

    $collecteur=new Bd_GestionSite();
    $collecteur->InsererCollecteur($nomColect,$prenomcolect,$fonction,$num,$email);
}*/
?>

<script type="application/javascript">

    var email = document.getElementById('mail');
    var tel = document.getElementById('telCollect');
    var error = document.querySelector('.erreur');
    var errortel = document.querySelector('.erreurtel');

/*
    $('#nomCollect').change(function(){
        $(this).removeAttrs('style');
    });*/

    email.addEventListener("input", function (event) {
        if (email.validity.valid) {
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

 $('#EnregistrerCollecteur').click(function(){

        var nomCollect=$('#nomCollect').val();
        var prenomCollect=$('#prenomCollect').val();
        var fctCollect=$('#fctCollect').val();
        var telCollect=$('#telCollect').val();
        var mail=$('#mail').val();

        if(nomCollect==''||prenomCollect==''||fctCollect==''||telCollect==''){
            notification("vide");
            MettreFocus(nomCollect,prenomCollect,fctCollect,telCollect);
        }else {
            if(mail!=''){
                if (!email.validity.valid) {
                    error.innerHTML = "adresse e-mail incorrecte!";
                    error.className = "error active";
                    event.preventDefault();
                }else {
                    if (!tel.validity.valid) {
                        errortel.innerHTML = "Entrer le numéro au format xxxxxxxx ou xx xx xx xx";
                        errortel.className = "error active";
                        event.preventDefault();
                    }else {

                        var donnee = "nomCollect=" + nomCollect + "&prenomCollect=" + prenomCollect + "&fctCollect=" + fctCollect + "&telCollect=" + telCollect + "&mail=" + mail+"&type=ajout";
                        $(this).attr('data-dismiss', 'modal');
                        $.ajax({
                            type: "POST",
                            url: "./gestionSite/collecteur/enregistrement.php",
                            data: donnee,
                            success: function (reponse) {
                                $('#Etatenregistrement').html(reponse).show();
                                var etat=$('#echec').val();
                                if(etat!=''){
                                    $('#corps').load("./gestionSite/collecteur/listeCollecteur.php");
                                    etatdeinsertion("echec");
                                }else{
                                    $('#corps').load("./gestionSite/collecteur/listeCollecteur.php");
                                    notification(1);
                                }

                            }
                        });
                    }
                    // console.log(donnee);
                }
            }
            else {
                if (!tel.validity.valid) {
                    errortel.innerHTML = "Entrer le numéro au format xxxxxxxx ou xx xx xx xx";
                    errortel.className = "error active";
                    event.preventDefault();
                }else {

                     donnee = "nomCollect=" + nomCollect + "&prenomCollect=" + prenomCollect + "&fctCollect=" + fctCollect + "&telCollect=" + telCollect + "&mail=" + mail+"&type=ajout";
                    $(this).attr('data-dismiss', 'modal');
                    $.ajax({
                        type: "POST",
                        url: "./gestionSite/collecteur/enregistrement.php",
                        data: donnee,
                        success: function (reponse) {
                            $('#Etatenregistrement').html(reponse).show();
                            var etat=$('#echec').val();
                            if(etat!=''){
                                $('#corps').load("./gestionSite/collecteur/listeCollecteur.php");
                                etatdeinsertion("echec");
                            }else{
                                $('#corps').load("./gestionSite/collecteur/listeCollecteur.php");
                                notification(1);
                            }

                        }
                    });
                }
                // console.log(donnee);
            }
        }
    });


    function MettreFocus(nomCollect,prenomCollect,fctCollect,telCollect){
        if(nomCollect==''){
            $('#nomCollect').css('background-color', '#FDD');
        }else{
            $('#nomCollect').removeAttrs('style');
        }

        if(prenomCollect==''){
            $('#prenomCollect').css('background-color', '#FDD');
        }else{
            $('#prenomCollect').removeAttrs('style');
        }

        if(fctCollect==''){

            $('#fctCollect').css('background-color', '#FDD');
        }else{
            $('#fctCollect').removeAttrs('style');
        }

        if(telCollect==''){
            $('#telCollect').css('background-color', '#FDD');
        }else{
            $('#telCollect').removeAttrs('style');
        }

    }

    function EnleverFocus(idelement){
        var contenu=$('#'+idelement).val();
        if(contenu!=''){
            $('#'+idelement).removeAttrs('style');
        }
    }
</script>

<?php }?>