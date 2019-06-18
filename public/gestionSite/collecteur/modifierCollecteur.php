<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 21/07/2018
 * Time: 17:23
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idcol="";
if(isset($_POST['idcollecteur'])){
    $idcol=$_POST['idcollecteur'];
}
/*else{
    if($_POST){
        $nomColect=strip_tags($_POST['nomColl']);
        $prenomcolect=strip_tags(($_POST['prenomColl']));
        $fonction=strip_tags($_POST['fctColl']);
        $num=strip_tags($_POST['telColl']);
        $email=strip_tags($_POST['email']);
        $id=strip_tags($_POST['idcollect']);

        $collecteur=new Bd_GestionSite();
        $collecteur->ModifierCollecteur($nomColect,$prenomcolect,$fonction,$num,$email,$id);
    }
}*/

?>

<div class="modal" id="updateCollecteur" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification d'un Collecteur </span></h3>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?php
                    $tableau=Bd_GestionSite::ListerCollecteurParID($idcol);

                    $cle=1;
                    $no=2;
                    $preno=3;
                    $fct=4;
                    $numeC=5;
                    $email=6;

                    foreach ($tableau as $tab):
                    $id=$tab[$cle];
                    $cle=$cle+6;
                    $numero=$tab[$numeC];
                    $numeC=$numeC+6;
                    $nom=$tab[$no];
                    $no=$no+6;
                    $prenom=$tab[$preno];
                    $preno=$preno+6;
                    $fonction=$tab[$fct];
                    $fct=$fct+6;
                    $emailB=$tab[$email];
                    $email=$email+6;
                    ?>
                    <fieldset>
                        <Legend>Collecteur</Legend>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="nomCollect">Nom du collecteur <span style="color: red">*</span></label><br>
                                <input type="hidden" name="identifiant" id="identifiant"  value="<?php echo $id ?>">
                                <input type="text" name="nomCollect" id="nomCollect" class="formulaire" value="<?php echo $nom ?>" onchange="EnleverFocus(this.id)">
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="prenomCollect">Prénom du collecteur <span style="color: red">*</span></label><br>
                                <input type="text" name="prenomCollect" id="prenomCollect" value="<?php echo $prenom ?>" class="formulaire" onchange="EnleverFocus(this.id)">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="fctCollect">Fonction du collecteur <span style="color: red">*</span></label><br>
                                <input type="text" name="fctCollect" id="fctCollect" class="formulaire" value="<?php echo $fonction ?>" onchange="EnleverFocus(this.id)">
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="telCollect">Tél collecteur <span style="color: red">*</span></label><br>
                                <input type="text" title="format (XXXXXXXX ou XX XX XX XX)" name="telCollect" id="telCollect" class="formulaire" value="<?php echo $numero ?>" onchange="EnleverFocus(this.id)" pattern="[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}">
                                <span class="erreurtel" aria-live="polite"></span>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <label for="mail">Email du contact </label><br>
                                <input type="email" name="mail" id="mail" class="formulaire" value="<?php echo $emailB ?>">
                                <span class="erreur" aria-live="polite"></span>
                            </div>
                        </div><br>
                    </fieldset>
                    <?php endforeach ?>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="submit" value="Enregistrer" id="ModifierCollecteur" name="ModifierCollecteur"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerCollecteur" name="fermer" value="Annuler" data-dismiss="modal"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
    <div id="Etatenregistrement"></div>
<script type="application/javascript">

    var email = document.getElementById('mail');
    var tel = document.getElementById('telCollect');
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


    $('#ModifierCollecteur').click(function(){
        var nomCollect=$('#nomCollect').val();
        var prenomCollect=$('#prenomCollect').val();
        var fctCollect=$('#fctCollect').val();
        var telCollect=$('#telCollect').val();
        var mail=$('#mail').val();
        var ident=$('#identifiant').val();

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

                        var donnee = "nomColl=" + nomCollect + "&prenomColl=" + prenomCollect + "&fctColl=" + fctCollect + "&telColl=" + telCollect + "&email=" + mail + "&idcollect=" + ident;
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

                     donnee = "nomColl=" + nomCollect + "&prenomColl=" + prenomCollect + "&fctColl=" + fctCollect + "&telColl=" + telCollect + "&email=" + mail + "&idcollect=" + ident;
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