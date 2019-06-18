<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 05/07/2018
 * Time: 13:23
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    $tableauGest = [];
    $ident = "";
    if (isset($_POST['idgest']) && isset($_POST['type'])) {
        $type = $_POST['type'];
        $ident = $_POST['idgest'];
        if ($type == 'individuel') {
            $tableauGest = Bd_GestionSite::GestionnaireIndividuelParId($ident);
            echo "<script type='application/javascript'>
                    $('#denomination').attr('disabled','true').css('background-color','#E3E3E3').val('');
                    $('#typecollect').prop('disabled','true').css('background-color','#E3E3E3').val('');
                    $('#Genrecollect').prop('disabled','true').css('background-color','#E3E3E3').val('');
                    $('#nbremembre').prop('disabled','true').css('background-color','#E3E3E3').val('');
               </script>";
        } else {
            $tableauGest = Bd_GestionSite::GestionnaireCollectifParId($ident);
            echo "<script type='application/javascript'>
                    $('#dateNais').attr('disabled','true').css('background-color','#E3E3E3').val('');
                    $('#nbrPers').prop('disabled','true').css('background-color','#E3E3E3').val('');
                    $('#statu').prop('disabled','true').css('background-color','#E3E3E3').val('');
                    $('#nbrPers16').prop('disabled','true').css('background-color','#E3E3E3').val('');
               </script>";
        }
    } else {
        if ($_POST) {
            $gestion = new Bd_GestionSite();
            // $id = $gestion->RecupererID();;
            // $id = $id + 1;
            $typegest = $_POST['type'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $numeroges = $_POST['numero'];
            $cle = $_POST['idgestionnaire'];
            $mail = $_POST['mail'];
            $fact = $_POST['total'];
            $facteur = [];
            $facteu = $_POST['facteurs'];
            $facteur = explode(',', $facteu);

            if ($typegest == 'individuel') {
                //individuel
                $datenais = $_POST['dateNais'];
                $status = $_POST['statu'];
                $nbrepers = $_POST['nbrepers'];
                $nbrepers16 = $_POST['nbre16'];
                $gestion->ModifierGestionnaireInd($nom, $prenom, $numeroges, $mail, $typegest, $datenais, $status, $nbrepers, $nbrepers16, $cle);
                $gestion->supprimerFacteurParGestionnaire($cle);
                if (!empty($facteur)) {
                    for ($i = 0; $i < $fact; $i++) {
                        $gestion->InsererFacteur($cle, $facteur[$i]);
                    }
                }
            } else {
                //collectif
                $denomi = $_POST['deno'];
                $typecollec = $_POST['typecollectif'];
                $genre = $_POST['genr'];
                $nbremembre = $_POST['nbrMembre'];
                $gestion->ModifierGestionnaireC($nom, $prenom, $numeroges, $mail, $typegest, $denomi, $genre, $typecollec, $nbremembre, $cle);
                $gestion->supprimerFacteurParGestionnaire($cle);
                if (!empty($facteur)) {
                    for ($i = 0; $i < $fact; $i++) {
                        $gestion->InsererFacteur($cle, $facteur[$i]);
                    }
                }
            }
        }
    }

    ?>
    <div class="modal" id="updateGestionnaire" data-backdrop="static">
        <div class="modal-dialog" style="width: 80%">
            <div class="modal-content" style="background-color: white;">
                <div class="modal-header"
                     style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                    <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close" id="closeagentm"
                            data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br/>

                    <h3 style="padding-left: 5px; padding-top: 5px;">Modification d'un Gestionnaire </span></h3>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <?php foreach ($tableauGest as $Gest): ?>
                            <div class="row">
                                <div class="col-md-7 col-sm-7 col-lg-7">
                                    <fieldset>
                                        <Legend>Identité du gestionnaire</Legend>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <label for="nomGest">Nom du gestionnaire <span style="color: red">*</span></label><br>
                                                <input type="hidden" name="gestionn" id="gestionn" class="formulaire"
                                                       value="<?php echo $Gest[1] ?>">
                                                <input type="text" name="nomGest" id="nomGest" class="formulaire"
                                                       value="<?php echo $Gest[3] ?>" onchange="EnleverFocus(this.id)">
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <label for="prenomGest">Prénom du gestionnaire <span style="color: red">*</span></label><br>
                                                <input type="text" name="prenomGest" id="prenomGest"
                                                       value="<?php echo $Gest[4] ?>" class="formulaire" onchange="EnleverFocus(this.id)">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <label for="telGest">Tél gestionnaire <span style="color: red">*</span></label><br>
                                                <input type="text" title="format (XXXXXXXX ou XX XX XX XX)"
                                                       name="telGest" id="telGest" class="formulaire"
                                                       value="<?php echo $Gest[5] ?>"
                                                       pattern="[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}" onchange="EnleverFocus(this.id)">
                                                <span class="erreurtel" aria-live="polite"></span>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <label for="mailGest">Email du gestionnaire</label><br>
                                                <input type="email" name="mailGest" id="mailGest" class="formulaire"
                                                       value="<?php echo $Gest[6] ?>" onchange="EnleverFocus(this.id)">
                                                <span class="erreur" aria-live="polite"></span>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-lg-4">
                                                <label for="typeGest">Type de gestionnaire <span style="color: red">*</span></label>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                    <input type="radio" name="gestype" id="Individuel"
                                                           value="Individuel" <?php if ($Gest[2] == 'individuel') {
                                                        echo "checked";
                                                    } ?>>
                                                    <label for="Individuel" class="labelcouleur">Individuel</label>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                    <input type="radio" name="gestype" id="Collectif"
                                                           value="Collectif" <?php if ($Gest[2] == 'collectif') {
                                                        echo "checked";
                                                    } ?>>
                                                    <label for="Collectif" class="labelcouleur">Collectif</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="afficher" id="afficher"
                                                   value="<?php echo $Gest[2] ?>">
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-5 col-sm-5 col-lg-5" style="">
                                    <fieldset style="height: 248px;overflow:auto">
                                        <legend>Facteur de production</legend>
                                        <label>Liste des facteurs de productions</label><br><br>
                                        <table>
                                            <?php
                                            $facteurdugestion = Bd_GestionSite::ListerGestionnaireFacteurParIdGest($Gest[1]);
                                            $idf = 3;
                                            $j = 0;
                                            $idfa = [];
                                            foreach ($facteurdugestion as $factgest) {
                                                $idfa[$j] = $factgest[$idf];
                                                $idf = $idf + 3;
                                                $j++;
                                            }
                                            $nombreT = $j;
                                            $facteur = Bd_parametre::listerFacteur();
                                            $nbre = 0;
                                            $cle = 1;
                                            $libelle = 2;

                                            $i = 0;
                                            echo '<tr>';
                                            foreach ($facteur as $fact) {
                                                $nbre++;
                                                $id = $fact[$cle];
                                                $cle = $cle + 2;
                                                $nomfacteur = $fact[$libelle];
                                                $libelle = $libelle + 2;
                                                $i++;
                                                echo '<td class="col-md-6 col-lg-6 col-sm-6"><input type="checkbox" id="choix" name="choix" value="' . $id . '"';
                                                for ($j = 0; $j < $nombreT; $j++) {
                                                    if ($idfa[$j] == $id) {
                                                        echo "checked";
                                                    }
                                                }
                                                echo '/><label style="margin:0px 10px 0px 5px;" class="labelcouleur">' . $nomfacteur . '</label></td>';
                                                if (($i % 2) == 0)
                                                    echo '</tr><tr>';
                                            }
                                            $i = 0;
                                            ?>
                                            <input type="hidden" name="nombre" id="nombre"
                                                   value="<?php echo $nbre; ?>"/>
                                        </table>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-sm-7 col-lg-7" id="individ">
                                    <fieldset>
                                        <legend>Individuel</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <label for="dateNais">Date de naissance <span style="color: red">*</span></label><br>
                                                <input type="text" name="dateNais" id="dateNais"
                                                       class="formulaire calendrier" value="<?php echo $Gest[7]; ?>" onchange="EnleverFocus(this.id)"/>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <label for="statu">Sexe <span style="color: red">*</span></label><br>
                                                <select class="formulaire" name="statu" id="statu" onchange="EnleverFocus(this.id)">
                                                    <option selected></option>
                                                    <option value="Masculin" <?php if ($Gest[8] == 'Masculin') {
                                                        echo 'selected';
                                                    } ?> >Masculin
                                                    </option>
                                                    <option value="Féminin" <?php if ($Gest[8] == 'Féminin') {
                                                        echo 'selected';
                                                    } ?> >Féminin
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <label for="nbrPers">Nombre de personne dans le menage <span style="color: red">*</span></label><br>
                                                <input type="number" class="formulaire" name="nbrPers" id="nbrPers"
                                                       min="0" value="<?php echo $Gest[9]; ?>" onchange="EnleverFocus(this.id)">
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <label for="nbrPers16">Nbre de personne de moins de 16ans <span style="color: red">*</span></label><br>
                                                <input type="number" class="formulaire" name="nbrPers16" id="nbrPers16"
                                                       min="0" value="<?php echo $Gest[10]; ?>" onchange="EnleverFocus(this.id)">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-5 col-sm-5 col-lg-5" id="collect">
                                    <fieldset>
                                        <legend>Collectif</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <label for="denomination">Nom du collectif <span style="color: red">*</span></label><br>
                                                <input type="text" name="denomination" id="denomination"
                                                       class="formulaire" value="<?php echo $Gest[7]; ?>" onchange="EnleverFocus(this.id)"/>
                                            </div>

                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <label for="Genrecollect">Genre <span style="color: red">*</span></label>
                                                <select class="formulaire" name="Genrecollect" id="Genrecollect" onchange="EnleverFocus(this.id)">
                                                    <option value="Féminin" <?php if ($Gest[8] == 'Féminin') {
                                                        echo 'selected';
                                                    } ?>>Féminin
                                                    </option>
                                                    <option value="Masculin" <?php if ($Gest[8] == 'Masculin') {
                                                        echo 'selected';
                                                    } ?>>Masculin
                                                    </option>
                                                    <option value="Mixte" <?php if ($Gest[8] == 'Mixte') {
                                                        echo 'selected';
                                                    } ?>>Mixte
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <label for="typecollect">Type <span style="color: red">*</span></label>
                                                <?php
                                                $param = Bd_parametre::listerTypeCollectif();
                                                $no = 2;
                                                ?>
                                                <select class="formulaire" name="typecollect" id="typecollect" onchange="EnleverFocus(this.id)">
                                                    <?php
                                                    foreach ($param as $tab):
                                                        $libelle = $tab[$no];
                                                        $no = $no + 2;
                                                        ?>
                                                        <option
                                                            value="<?php echo $libelle; ?>" <?php if ($Gest[9] == $libelle) {
                                                            echo 'selected';
                                                        } ?>><?php echo $libelle; ?></option>
                                                        <?php
                                                    endforeach
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <label for="nbremembre">Nombre de membres <span style="color: red">*</span></label>
                                                <input type="number" class="formulaire" name="nbremembre"
                                                       id="nbremembre" min="0" value="<?php echo $Gest[10]; ?>" onchange="EnleverFocus(this.id)">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </form>
                </div>
                <div class="modal-footer"
                     style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                    <input type="button" value="Enregistrer" id="EnregistrerGes" name="EnregistrerGes"
                           class="btn btn-primary"
                           style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;"/>
                    <input type="button" id="annulerGes" name="fermer" value="Annuler" data-dismiss="modal"
                           class="btn btn-primary"
                           style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
                </div>
            </div>
        </div>
    </div>
<div id="Etatenregistrement"></div>

    <script type="application/javascript">

        $(".calendrier").datepicker({
            onClose: function (selectedDate) {
            }
        });

        var emailverif = document.getElementById('mailGest');
        var tel = document.getElementById('telGest');
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

        //filtrer le type de gestionnaire
        $('#Individuel').click(function () {
            $('#denomination').attr('disabled', 'true').css('background-color', '#E3E3E3').val("");
            $('#typecollect').prop('disabled', 'true').css('background-color', '#E3E3E3').val("");
            $('#Genrecollect').prop('disabled', 'true').css('background-color', '#E3E3E3').val("");
            $('#nbremembre').prop('disabled', 'true').css('background-color', '#E3E3E3').val("");

            $('#dateNais').removeAttrs('disabled');
            $('#dateNais').removeAttrs('style');
            $('#nbrPers').removeAttrs('disabled');
            $('#nbrPers').removeAttrs('style');
            $('#statu').removeAttrs('disabled');
            $('#statu').removeAttrs('style');
            $('#nbrPers16').removeAttrs('disabled');
            $('#nbrPers16').removeAttrs('style');
            // $(':checkbox').removeAttrs('disabled');
            // $(':checkbox').removeAttrs('style');

            document.getElementById("afficher").setAttribute("value", 'individuel');
        });

        $('#Collectif').click(function () {
            $('#dateNais').attr('disabled', 'true').css('background-color', '#E3E3E3').val("");
            $('#statu').prop('disabled', 'true').css('background-color', '#E3E3E3').val("");
            $('#nbrPers').prop('disabled', 'true').css('background-color', '#E3E3E3').val("");
            $('#nbrPers16').prop('disabled', 'true').css('background-color', '#E3E3E3').val("");
            // $(':checkbox').prop('disabled','true').css('background-color','#E3E3E3');
            //$(':checkbox').removeAttrs('checked');

            $('#denomination').removeAttrs('disabled');
            $('#denomination').removeAttrs('style');
            $('#typecollect').removeAttrs('disabled');
            $('#typecollect').removeAttrs('style');
            $('#Genrecollect').removeAttrs('disabled');
            $('#Genrecollect').removeAttrs('style');
            $('#nbremembre').removeAttrs('disabled');
            $('#nbremembre').removeAttrs('style');
            document.getElementById("afficher").setAttribute("value", 'collectif');
        });

        $('#EnregistrerGes').click(function () {

            var nombre = $('#nombre').val();
            var nomges = $('#nomGest').val();
            var prenomges = $('#prenomGest').val();
            var telges = $('#telGest').val();
            var email = $('#mailGest').val();
            var idgestion = $('#gestionn').val();
            var nbrecocher = 0;
            //facteur de production
            var facteur = [];
            $('#choix:checked').each(function () {
                //recuperation des facteurs de production cochés
                facteur.push($(this).val());
                nbrecocher++;
            });


            //individuel
            var datenaiss = $('#dateNais').val();
            var status = $('#statu').val();
            var nbrpers = $('#nbrPers').val();
            var nbrpers16 = $('#nbrPers16').val();
            //var idgest=$('#idge').val();
            //collectif
            var denomination = $('#denomination').val();
            var typecollect = $('#typecollect').val();
            var genrecollect = $('#Genrecollect').val();
            var nbrmembre = $('#nbremembre').val();

            var typegest = $('#afficher').val();
            if (typegest == 'individuel') {
                if (nomges == '' || prenomges == ''|| datenaiss == '' || status == '' || nbrpers == '' || nbrpers16 == '') {
                    notification("vide");
                    MettreFocusI();
                } else {
                    if (email != '') {
                        if (!emailverif.validity.valid) {
                            error.innerHTML = "adresse e-mail incorrecte!";
                            error.className = "error active";
                            event.preventDefault();
                        }else {
                            //if(telges != '') {
                            if (!tel.validity.valid) {
                                errortel.innerHTML = "Entrer le numéro au format xxxxxxxx ou xx xx xx xx";
                                errortel.className = "error active";
                                event.preventDefault();
                            }else {
                                //}
                                $(this).attr('data-dismiss', 'modal');
                                var data = 'nom=' + nomges + '&prenom=' + prenomges + '&numero=' + telges + '&mail=' + email + '&dateNais=' + datenaiss + '&statu=' + status + '&nbrepers=' + nbrpers + '' +
                                    '&nbre16=' + nbrpers16 + '&type=' + typegest + '&facteurs=' + facteur + '&total=' + nbrecocher + '&idgestionnaire=' + idgestion;
                                //console.log(data);
                                $.ajax({
                                    type: 'POST',
                                    url: './gestionSite/gestionnaire/enregistrement.php',
                                    data: data,
                                    success: function (reponse) {
                                        $('#Etatenregistrement').html(reponse).show();
                                        var etat=$('#echec').val();
                                        if(etat!=''){
                                            $('#corps').load('./gestionSite/gestionnaire/listeGestionnaire.php');
                                            etatdeinsertion("echec");
                                        }else{
                                            $('#corps').load('./gestionSite/gestionnaire/listeGestionnaire.php');
                                            notification(1);
                                        }

                                    }
                                });
                            }
                        }
                    }else {
                        //if(telges != '') {
                        if (!tel.validity.valid) {
                            errortel.innerHTML = "Entrer le numéro au format xxxxxxxx ou xx xx xx xx";
                            errortel.className = "error active";
                            event.preventDefault();
                        }else {
                            //}
                            $(this).attr('data-dismiss', 'modal');
                             data = 'nom=' + nomges + '&prenom=' + prenomges + '&numero=' + telges + '&mail=' + email + '&dateNais=' + datenaiss + '&statu=' + status + '&nbrepers=' + nbrpers + '' +
                                '&nbre16=' + nbrpers16 + '&type=' + typegest + '&facteurs=' + facteur + '&total=' + nbrecocher + '&idgestionnaire=' + idgestion;
                            //console.log(data);
                            $.ajax({
                                type: 'POST',
                                url: './gestionSite/gestionnaire/enregistrement.php',
                                data: data,
                                success: function (reponse) {
                                    $('#Etatenregistrement').html(reponse).show();
                                    var etat=$('#echec').val();
                                    if(etat!=''){
                                        $('#corps').load('./gestionSite/gestionnaire/listeGestionnaire.php');
                                        etatdeinsertion("echec");
                                    }else{
                                        $('#corps').load('./gestionSite/gestionnaire/listeGestionnaire.php');
                                        notification(1);
                                    }

                                }
                            });
                        }
                    }
                }
               // }
            } else {

                if (nomges == '' || prenomges == '' || telges == ''|| denomination == '' || typecollect == '' || genrecollect == '' || nbrmembre == '') {
                    notification("vide");
                    MettreFocusC();
                } else {
                    if (email != '') {
                        if (!emailverif.validity.valid) {
                            error.innerHTML = "adresse e-mail incorrecte!";
                            error.className = "error active";
                            event.preventDefault();
                        }else {
                            //if(telges != '') {
                            if (!tel.validity.valid) {
                                errortel.innerHTML = "Entrer le numéro au format xxxxxxxx ou xx xx xx xx";
                                errortel.className = "error active";
                                event.preventDefault();
                            }else {
                                // }
                                $(this).attr('data-dismiss', 'modal');
                                var data2 = 'nom=' + nomges + '&prenom=' + prenomges + '&numero=' + telges + '&mail=' + email + '&deno=' + denomination + '&typecollectif=' + typecollect + '&genr=' + genrecollect + '&nbrMembre=' + nbrmembre + '' +
                                    '&type=' + typegest + '&facteurs=' + facteur + '&total=' + nbrecocher + '&idgestionnaire=' + idgestion;
                                //console.log(data2);
                                $.ajax({
                                    type: 'POST',
                                    url: './gestionSite/gestionnaire/enregistrement.php',
                                    data: data2,
                                    success: function (reponse) {
                                        $('#Etatenregistrement').html(reponse).show();
                                        var etat=$('#echec').val();
                                        if(etat!=''){
                                            $('#corps').load('./gestionSite/gestionnaire/listeGestionnaire.php');
                                            etatdeinsertion("echec");
                                        }else{
                                            $('#corps').load('./gestionSite/gestionnaire/listeGestionnaire.php');
                                            notification(1);
                                        }

                                    }
                                });
                            }
                        }
                    } else {
                        //if(telges != '') {
                        if (!tel.validity.valid) {
                            errortel.innerHTML = "Entrer le numéro au format xxxxxxxx ou xx xx xx xx";
                            errortel.className = "error active";
                            event.preventDefault();
                        }else {
                            // }
                            $(this).attr('data-dismiss', 'modal');
                             data2 = 'nom=' + nomges + '&prenom=' + prenomges + '&numero=' + telges + '&mail=' + email + '&deno=' + denomination + '&typecollectif=' + typecollect + '&genr=' + genrecollect + '&nbrMembre=' + nbrmembre + '' +
                                '&type=' + typegest + '&facteurs=' + facteur + '&total=' + nbrecocher + '&idgestionnaire=' + idgestion;
                            //console.log(data2);
                            $.ajax({
                                type: 'POST',
                                url: './gestionSite/gestionnaire/enregistrement.php',
                                data: data2,
                                success: function (reponse) {
                                    $('#Etatenregistrement').html(reponse).show();
                                    var etat=$('#echec').val();
                                    if(etat!=''){
                                        $('#corps').load('./gestionSite/gestionnaire/listeGestionnaire.php');
                                        etatdeinsertion("echec");
                                    }else{
                                        $('#corps').load('./gestionSite/gestionnaire/listeGestionnaire.php');
                                        notification(1);
                                    }

                                }
                            });
                        }
                    }
                }
                }
           // }
        });

        //par defaut
       /* function MettreFocus(){

            var nomges = $('#nomGest');
            var prenomges = $('#prenomGest');
            var telges = $('#telGest');

            //individuel
            var datenaiss = $('#dateNais');
            var status = $('#statu');
            var nbrpers = $('#nbrPers');
            var nbrpers16 = $('#nbrPers16');
            var idgest = $('#idge');

            //collectif
            var denomination = $('#denomination');
            var typecollect = $('#typecollect');
            var genrecollect = $('#Genrecollect');
            var nbrmembre = $('#nbremembre');

            if(nomges.val()==''){
                nomges.css('background-color', '#FDD');
            }else{
                nomges.removeAttrs('style');
            }

            if(prenomges.val()==''){
                prenomges.css('background-color', '#FDD');
            }else{
                prenomges.removeAttrs('style');
            }

            if(telges.val()==''){

                telges.css('background-color', '#FDD');
            }else{
                telges.removeAttrs('style');
            }

            if(datenaiss.val()==''){
                datenaiss.css('background-color', '#FDD');
            }else{
                datenaiss.removeAttrs('style');
            }

            if(status.val()==''){
                status.css('background-color', '#FDD');
            }else{
                status.removeAttrs('style');
            }

            if(nbrpers.val()==''){
                nbrpers.css('background-color', '#FDD');
            }else{
                nbrpers.removeAttrs('style');
            }

            if(nbrpers16.val()==''){
                nbrpers16.css('background-color', '#FDD');
            }else{
                nbrpers16.removeAttrs('style');
            }

            if(denomination.val()==''){
                denomination.css('background-color', '#FDD');
            }else{
                denomination.removeAttrs('style');
            }

            if(typecollect.val()==''){
                typecollect.css('background-color', '#FDD');
            }else{
                typecollect.removeAttrs('style');
            }
            if(genrecollect.val()==''){
                genrecollect.css('background-color', '#FDD');
            }else{
                genrecollect.removeAttrs('style');
            }
            if(nbrmembre.val()==''){
                nbrmembre.css('background-color', '#FDD');
            }else{
                nbrmembre.removeAttrs('style');
            }

        }*/

        //pour individuel
        function MettreFocusI(){

            var nomges = $('#nomGest');
            var prenomges = $('#prenomGest');
            var telges = $('#telGest');

            //individuel
            var datenaiss = $('#dateNais');
            var status = $('#statu');
            var nbrpers = $('#nbrPers');
            var nbrpers16 = $('#nbrPers16');
            var idgest = $('#idge');

            //collectif
            var denomination = $('#denomination');
            var typecollect = $('#typecollect');
            var genrecollect = $('#Genrecollect');
            var nbrmembre = $('#nbremembre');

            if(nomges.val()==''){
                nomges.css('background-color', '#FDD');
            }else{
                nomges.removeAttrs('style');
            }

            if(prenomges.val()==''){
                prenomges.css('background-color', '#FDD');
            }else{
                prenomges.removeAttrs('style');
            }

            if(telges.val()==''){

                telges.css('background-color', '#FDD');
            }else{
                telges.removeAttrs('style');
            }

            if(datenaiss.val()==''){
                datenaiss.css('background-color', '#FDD');
            }else{
                datenaiss.removeAttrs('style');
            }

            if(status.val()==''){
                status.css('background-color', '#FDD');
            }else{
                status.removeAttrs('style');
            }

            if(nbrpers.val()==''){
                nbrpers.css('background-color', '#FDD');
            }else{
                nbrpers.removeAttrs('style');
            }

            if(nbrpers16.val()==''){
                nbrpers16.css('background-color', '#FDD');
            }else{
                nbrpers16.removeAttrs('style');
            }

        }

        //pour collectif
        function MettreFocusC(){

            var nomges = $('#nomGest');
            var prenomges = $('#prenomGest');
            var telges = $('#telGest');

            //individuel
            var datenaiss = $('#dateNais');
            var status = $('#statu');
            var nbrpers = $('#nbrPers');
            var nbrpers16 = $('#nbrPers16');
            var idgest = $('#idge');

            //collectif
            var denomination = $('#denomination');
            var typecollect = $('#typecollect');
            var genrecollect = $('#Genrecollect');
            var nbrmembre = $('#nbremembre');

            if(nomges.val()==''){
                nomges.css('background-color', '#FDD');
            }else{
                nomges.removeAttrs('style');
            }

            if(prenomges.val()==''){
                prenomges.css('background-color', '#FDD');
            }else{
                prenomges.removeAttrs('style');
            }

            if(telges.val()==''){

                telges.css('background-color', '#FDD');
            }else{
                telges.removeAttrs('style');
            }

            if(denomination.val()==''){
                denomination.css('background-color', '#FDD');
            }else{
                denomination.removeAttrs('style');
            }

            if(typecollect.val()==''){
                typecollect.css('background-color', '#FDD');
            }else{
                typecollect.removeAttrs('style');
            }
            if(genrecollect.val()==''){
                genrecollect.css('background-color', '#FDD');
            }else{
                genrecollect.removeAttrs('style');
            }
            if(nbrmembre.val()==''){
                nbrmembre.css('background-color', '#FDD');
            }else{
                nbrmembre.removeAttrs('style');
            }

        }
    </script>
    <?php
}
?>
