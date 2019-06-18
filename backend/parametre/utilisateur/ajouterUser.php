<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 28/07/2018
 * Time: 08:27
 */
include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{
/*
if($_POST){

    $nom=trim(strip_tags($_POST['nom']));
    $prenom=trim(strip_tags($_POST['prenom']));
    $service=trim(strip_tags($_POST['service']));
    $fonction=trim(strip_tags($_POST['fonction']));
    $profil=trim(strip_tags($_POST['profil']));
    $email=trim(strip_tags($_POST['email']));
    $telep=trim(strip_tags($_POST['tele']));
    $identif=trim(strip_tags($_POST['identifiant']));
    $passwd=trim(strip_tags($_POST['passwod']));

    $user=new Bd_user($nom,$prenom,$telep,$identif,$passwd,$email,$fonction,$service,$profil);
    $user->InsererUser();
}*/
?>

<div class="modal" id="newuser" data-backdrop="static">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'un utilisateur</span></h3>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-6">
                            <fieldset>
                                <legend>Infos générales</legend>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="NomUser">Nom <span style="color: red">*</span></label>
                                        <input type="text" id="NomUser" name="NomUser" class="formulaire" placeholder="Nom" onchange="EnleverFocus(this.id)">
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="PrenomUser">Prénoms <span style="color: red">*</span></label>
                                        <input type="text" id="PrenomUser" name="PrenomUser" class="formulaire" placeholder="Prénoms" onchange="EnleverFocus(this.id)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="ServiceUser">Service <span style="color: red">*</span></label>
                                        <input type="text" id="ServiceUser" name="ServiceUser" class="formulaire" placeholder="Service" onchange="EnleverFocus(this.id)">
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="TeleUser">Téléphone <span style="color: red">*</span></label><br>
                                        <input type="text" id="TeleUser" name="TeleUser" title="format (XXXXXXXX ou XX XX XX XX)"
                                               pattern="[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}" class="formulaire" placeholder="Téléphone" onchange="EnleverFocus(this.id)">
                                        <span class="erreurtel" aria-live="polite"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="FonctionUser">Fonction </label>
                                        <input type="text" id="FonctionUser" name="FonctionUser" class="formulaire" placeholder="Fonction">
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="EmailUser">Email</label><br>
                                        <input type="email" id="EmailUser" name="EmailUser" class="formulaire" placeholder="Email" >
                                        <span class="erreur" aria-live="polite"></span>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6">
                            <fieldset>
                                <legend>Paramètre de connexion</legend>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="IdentifiantUser">Identifiant <span style="color: red">*</span></label><br>
                                        <input type="text" id="IdentifiantUser" name="IdentifiantUser" class="formulaire" placeholder="Identifiant" onchange="EnleverFocus(this.id)">
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="ProfiltUser">Profil <span style="color: red">*</span></label><br>
                                        <select class="formulaire" id="ProfiltUser" name="ProfiltUser" onchange="EnleverFocus(this.id)">
                                            <option value=""></option>
                                            <option value="1">Administrateur</option>
                                            <option value="2">Utilisateur simple</option>
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="pssword">Mot de passe <span style="color: red">*</span></label><br>
                                        <input type="password" id="pssword" name="pssword" class="formulaire" placeholder="Mot de passe"  minlength="6" maxlength="8" onchange="EnleverFocus(this.id)">
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="pssword2">Confirmer <span style="color: red">*</span></label><br>
                                        <input type="password" id="pssword2" name="pssword2" class="formulaire" placeholder="Ressaisir le Mot de passe" onchange="EnleverFocus(this.id)">
                                    </div>
                                </div><br><br>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="submit" id="validerUser" name="enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annuler" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
<div id="verif">
</div>
<div id="Etatenregistrement"></div>
<script type="application/javascript">

    var email = document.getElementById('EmailUser');
    var tel = document.getElementById('TeleUser');
    var error = document.querySelector('.erreur');
    var errortel = document.querySelector('.erreurtel');

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


    $('#validerUser').on('click',function(){
        var nom=$('#NomUser').val();
        var prenom=$('#PrenomUser').val();
        var service=$('#ServiceUser').val();
        var tele=$('#TeleUser').val();
        var mail=$('#EmailUser').val();
        var profil=$('#ProfiltUser').val();
        var fonction=$('#FonctionUser').val();
        var identifiant=$('#IdentifiantUser').val();
        var password=$('#pssword').val();
        var password2=$('#pssword2').val();

        if(nom==''||prenom==''||service==''||tele==''||profil==''||identifiant==''||password==''|| password2==''){
            notification('vide');
            MettreFocus()
        }else{
            if(password!=password2){
                //alert('les mots de passe ne sont pas identiques');
                $.rtnotify({
                    title: "",
                    message: " les mots de passe ne sont pas identiques ",
                    type: "error",
                    permanent: false,
                    timeout: 5,
                    fade: true,
                    width: 300
                });
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
                        }
                        $(this).attr('data-dismiss', 'modal');
                        var dne="login="+identifiant;
                        $.ajax({
                            type:'GET',
                            url:'./parametre/utilisateur/traitement.php',
                            data:dne,
                            success: function(rponse){
                                $('#verif').html(rponse).show();
                                var eta=$('#log').val();
                                if(eta==0){
                                    var data = 'nom=' + nom + '&prenom=' + prenom + '&service=' + service + '&tele=' + tele + '&email=' + mail + '&profil=' + profil + '&identifiant=' + identifiant + '' +
                                        '&passwod=' + password + '&fonction=' + fonction+'&type=ajout';
                                    $.ajax({
                                        type: 'POST',
                                        url: './parametre/utilisateur/enregistrement.php',
                                        data: data,
                                        success: function (reponse) {
                                            $('#Etatenregistrement').html(reponse).show();
                                            var etat=$('#echec').val();
                                            if(etat!=''){
                                                $('#corps').load('./parametre/utilisateur/listeUtilisateur.php');
                                                etatdeinsertion("echec");
                                            }else{
                                                $('#corps').load('./parametre/utilisateur/listeUtilisateur.php');
                                                notification(1);
                                            }

                                        }
                                    });
                                }else{
                                    //alert('cet identifiant est déjà utilisé');
                                    $.rtnotify({
                                        title: "",
                                        message: " cet identifiant est déjà utilisé ",
                                        type: "error",
                                        permanent: false,
                                        timeout: 5,
                                        fade: true,
                                        width: 300
                                    });
                                }
                            }
                        });

                    }
                }else {
                    if (!tel.validity.valid) {
                        errortel.innerHTML = "Entrer le numéro au format xxxxxxxx ou xx xx xx xx";
                        errortel.className = "error active";
                        event.preventDefault();
                    }
                    $(this).attr('data-dismiss', 'modal');
                    var dne="login="+identifiant;
                    $.ajax({
                        type:'GET',
                        url:'./parametre/utilisateur/traitement.php',
                        data:dne,
                        success: function(rponse){
                            $('#verif').html(rponse).show();
                            var eta=$('#log').val();
                            if(eta==0){
                                var data = 'nom=' + nom + '&prenom=' + prenom + '&service=' + service + '&tele=' + tele + '&email=' + mail + '&profil=' + profil + '&identifiant=' + identifiant + '' +
                                    '&passwod=' + password + '&fonction=' + fonction+'&type=ajout';
                                $.ajax({
                                    type: 'POST',
                                    url: './parametre/utilisateur/enregistrement.php',
                                    data: data,
                                    success: function (reponse) {
                                        $('#Etatenregistrement').html(reponse).show();
                                        var etat=$('#echec').val();
                                        if(etat!=''){
                                            $('#corps').load('./parametre/utilisateur/listeUtilisateur.php');
                                            etatdeinsertion("echec");
                                        }else{
                                            $('#corps').load('./parametre/utilisateur/listeUtilisateur.php');
                                            notification(1);
                                        }

                                    }
                                });
                            }else{
                                //alert('cet identifiant est déjà utilisé');
                                $.rtnotify({
                                    title: "",
                                    message: " cet identifiant est déjà utilisé ",
                                    type: "error",
                                    permanent: false,
                                    timeout: 5,
                                    fade: true,
                                    width: 300
                                });
                            }
                        }
                    });

                }
            }
        }
    });

    function MettreFocus(){

        var nom=$('#NomUser');
        var prenom=$('#PrenomUser');
        var service=$('#ServiceUser');
        var tele=$('#TeleUser');
        var profil=$('#ProfiltUser');
        var identifiant=$('#IdentifiantUser');
        var password=$('#pssword');
        var password2=$('#pssword2');

        if(nom.val()==''){
            nom.css('background-color', '#FDD');
        }else{
            nom.removeAttrs('style');
        }

        if(prenom.val()==''){
            prenom.css('background-color', '#FDD');
        }else{
            prenom.removeAttrs('style');
        }

        if(service.val()==''){
            service.css('background-color', '#FDD');
        }else{
            service.removeAttrs('style');
        }

        if(tele.val()==''){
            tele.css('background-color', '#FDD');
        }else{
            tele.removeAttrs('style');
        }

        if(profil.val()==''){
            profil.css('background-color', '#FDD');
        }else{
            profil.removeAttrs('style');
        }

        if(identifiant.val()==''){
            identifiant.css('background-color', '#FDD');
        }else{
            identifiant.removeAttrs('style');
        }

        if(password.val()==''){
            password.css('background-color', '#FDD');
        }else{
            password.removeAttrs('style');
        }

        if(password2.val()==''){
            password2.css('background-color', '#FDD');
        }else{
            password2.removeAttrs('style');
        }
    }

</script>
<?php }?>

