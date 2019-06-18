<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 13/07/2018
 * Time: 00:24
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idprojet='';
if(isset($_POST['id'])){
    $idprojet=$_POST['id'];
}/*
else{
if($_POST) {

    $nomb = strip_tags($_POST['nomPro']);
    $nomcontact = strip_tags($_POST['nomContPro']);
    $prenomcontact = strip_tags($_POST['prenomContPro']);
    $budGlob = strip_tags($_POST['budgetGlobal']);
    $email = strip_tags($_POST['mail']);
    $numero = strip_tags($_POST['numContPro']);
    $description = strip_tags($_POST['nomDes']);
    $datde =strip_tags($_POST['dateDeb']);
    $datfin = strip_tags($_POST['dateFin']);
    $siteP = strip_tags($_POST['siteInt']);
    $budgmv = strip_tags($_POST['budgetGMV']);
    $commune = strip_tags($_POST['commune']);
    $nbreC = strip_tags($_POST['nbreC']);
    $bail = strip_tags($_POST['bailleur']);
    $motant = strip_tags($_POST['montant']);
    $anne = strip_tags($_POST['annee']);
    $nbreB = strip_tags($_POST['nbreB']);
    $techni = strip_tags($_POST['technique']);
    $finance = strip_tags($_POST['financiere']);
    $operateu = strip_tags($_POST['operateur']);
    $montOp = strip_tags($_POST['montantOp']);
    $nbrop = strip_tags($_POST['nbreOp']);
    $idprojet = strip_tags($_POST['identif']);

    $gestion = new Bd_GestionProjetActeur();
    $gestion->ModifierProjet($nomb, $budGlob, $datde, $datfin, $nomcontact, $prenomcontact, $numero, $email, $siteP, $description, $budgmv, $idprojet);


    $tableCommune = explode(',', $commune);
    $gestion->SupprimerExecuterProjetCommune($idprojet);
    for ($i = 0; $i < $nbreC; $i++) {
        if ($tableCommune[$i] != '') {
            $gestion->InseresExecuterProjetCommune($tableCommune[$i], $idprojet);
        }
    }

    $tableBailleur = explode(',', $bail);
    $tableMontant = explode(',', $motant);
    $tableAnnee = explode(',', $anne);
    $gestion->SupprimerFinancerBailleurProjet($idprojet);
    for ($j = 0; $j < $nbreB; $j++) {
        if ($tableBailleur[$j] != '') {
            $gestion->InseresFinancerBailleurProjet($tableBailleur[$j], $idprojet, $tableMontant[$j], $tableAnnee[$j]);
        }
    }

    $tableOperateu = explode(',', $operateu);
    $tableMontOp = explode(',', $montOp);
    $tbleTechnique = explode(',', $techni);
    $tblefinance = explode(',', $finance);
    $gestion->SupprimerExecuterProjetOperateur($idprojet);
    for ($k = 0; $k < $nbreC; $k++) {
        if ($tableOperateu[$k] != '') {
            if ($tbleTechnique[$k] == 1) {
                $tbleTechnique[$k] = 'TRUE';
            } else {
                $tbleTechnique[$k] = 'FALSE';
            }

            if ($tblefinance[$k] == 1) {
                $tblefinance[$k] = 'TRUE';
                $gestion->InsererExecuterProjetOperateur($tableOperateu[$k], $idprojet, $tbleTechnique[$k], $tblefinance[$k], $tableMontOp[$k]);
            } else {
                $tblefinance[$k] = 'FALSE';
                $gestion->InsererExecuterProjetOperate($tableOperateu[$k], $idprojet, $tbleTechnique[$k], $tblefinance[$k]);
            }
        }
    }

}
}*/


?>

<div class="modal" id="updateProjet" data-backdrop="static">
    <div class="modal-dialog" style="width: 62%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeProjet" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification d'un projet</span></h3>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?php $tableau=Bd_GestionProjetActeur::ListerProjetParId($idprojet);
                        foreach ($tableau as $tab):
                    ?>
                    <fieldset>
                        <Legend>PROJET</Legend>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="nomPro">Nom du projet <span style="color: red">*</span></label><br>
                                <input type="hidden" name="identifiant" id="identifiant" class="formulaire" value="<?php echo $tab[1] ?>">
                                <input type="text" name="nomPro" id="nomPro" class="formulaire" value="<?php echo $tab[2] ?>" onchange="EnleverFocus(this.id)">
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="budgetGlobal">Budget global (Fcfa) <span style="color: red">*</span></label><br>
                                <input type="number" min="0" name="budgetGlobal" id="budgetGlobal" class="formulaire" value="<?php echo $tab[3] ?>" onchange="EnleverFocus(this.id)">
                                <span class="erreurglobal" aria-live="polite"></span>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="budgetGMV">Budget GMV (Fcfa) <span style="color: red">*</span></label><br>
                                <input type="number" min="0" name="budgetGMV" id="budgetGMV" class="formulaire" value="<?php echo $tab[4] ?>" onchange="EnleverFocus(this.id)">
                                <span class="erreurgmv" aria-live="polite"></span>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="dateDeb">Date de debut du projet <span style="color: red">*</span></label><br>
                                <input type="text" name="dateDeb" id="dateDeb" class="formulaire calendrier" value="<?php echo $tab[5] ?>" onchange="EnleverFocus(this.id)">
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="dateFin">Date de fin du projet <span style="color: red">*</span></label><br>
                                <input type="text" name="dateFin" id="dateFin" class="formulaire calendrier" value="<?php echo $tab[6] ?>" onchange="EnleverFocus(this.id)">
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="nomContPro">Nom du contact du projet <span style="color: red">*</span></label><br>
                                <input type="text" name="nomContPro" id="nomContPro" class="formulaire" value="<?php echo $tab[7] ?>" onchange="EnleverFocus(this.id)">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="prenomContPro">Prénom du contact du projet <span style="color: red">*</span></label><br>
                                <input type="text" name="prenomContPro" id="prenomContPro" class="formulaire" value="<?php echo $tab[8] ?>" onchange="EnleverFocus(this.id)">
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="numContPro">Numéro du contact du projet <span style="color: red">*</span></label><br>
                                <input type="text" title="format XX XX XX XX" name="numContPro" id="numContPro" value="<?php echo $tab[9] ?>" class="formulaire"
                                       pattern="[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}" onchange="EnleverFocus(this.id)">
                                <span class="erreurtel" aria-live="polite"></span>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="siteInt">Site internet du projet</label><br>
                                <input type="text" name="siteInt" id="siteInt" class="formulaire" value="<?php echo $tab[11] ?>">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="mail">Email du contact du projet </label><br>
                                <input type="email" name="mail" id="mail" class="formulaire" value="<?php echo $tab[10] ?>">
                                <span class="erreur" aria-live="polite"></span>
                            </div>
                            <div class="col-md-8 col-sm-8 col-lg-8">
                                <label for="nomDes">Description du projet</label><br>
                                <textarea name="nomDes" id="nomDes" class="formulaire" style="height: 100px" ><?php echo $tab[12] ?></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <fieldset id="lieu">
                                <legend>Zone d'intervention</legend>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="region">Région <span style="color: red">*</span></label>
                                        <select id="region" name="region" class="formulaire" title="sélectionner une région">
                                            <option></option>
                                            <?php $region=Bd_parametre::ListeRegion();
                                            $cle=1; $nom=2;
                                            foreach($region as $listeRegion):
                                                $id=$listeRegion[$cle];
                                                $cle=$cle+2;
                                                $nomRegion=$listeRegion[$nom];
                                                $nom=$nom+2;
                                                ?>
                                                <option value="<?php echo $id ?>"><?php echo $nomRegion ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="province">Province <span style="color: red">*</span></label>
                                        <select id="province" name="province" class="formulaire" title="sélectionner une province">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <label for="commune">Commune <span style="color: red">*</span></label>
                                        <select id="commune" class="formulaire" name="commune">

                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12" >
                                        <label>commune sélectionnée</label>
                                        <p id="selectCommune">
                                            <?php
                                            $executeCom=Bd_GestionProjetActeur::ListeCommuneParIdProjet($idprojet);
                                            $i=0;
                                            if(!empty($executeCom)){

                                            $com=3; $pro=2;
                                            ?>

                                            <?php
                                            foreach ($executeCom as $executeCo):
                                                $commune=$executeCo[$com];
                                                $com=$com+6;
                                                $idcom=$executeCo[$pro];
                                                $pro=$pro+6;
                                                ?>

                                                <a class="projetExe" href="#" id="com<?php echo $i; ?>" onclick="Retirer(this.id)">
                                                <input type="hidden" id="commune<?php echo $i;?>" value="<?php echo $idcom;?>">
                                                 <?php echo $commune;?><span class="pull-right"><i class="fa fa-trash" style="color: red"></i>
                                                </span><br></a>
                                                <?php $i++; endforeach;} ?>
                                            <input type="hidden" id="nbreC" value="<?php echo $i;?>">
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4" >
                            <fieldset id="financeur">
                                <legend>Financement</legend>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <label for="ListeBailleur">Bailleur <span style="color: red">*</span></label>
                                        <select name="ListeBailleur" id="ListeBailleur" class="formulaire" >
                                            <option value="">Sélectionné un bailleur </option>
                                            <?php
                                            $liste=Bd_GestionProjetActeur::ListeTousBailleur();
                                            $cle=1;
                                            $no=2;
                                            foreach ($liste as $bailleur):
                                                $id=$bailleur[$cle];
                                                $cle=$cle+7;
                                                $nom=$bailleur[$no];
                                                $no=$no+7;
                                                ?>
                                                <option value="<?php echo $id; ?>" id="selection<?php echo $id; ?>"><?php echo $nom; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="valeurBailleur">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="montant">Montant(Fcfa)<span style="color: red">*</span> </label><br>
                                        <input type="number" min="0" id="montant" name="montant" class="formulaire">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="annee">Année</label><br>
                                        <select class="formulaire" name="annee" id="annee">
                                            <?php
                                            $annedepar=2000;
                                            $anneeactuel=date('Y');

                                            for($i=1; $i<=50; $i++){
                                                ?>
                                                <option value="<?php $annee=$annedepar+$i; echo $annee; ?>"  <?php if($annee==$anneeactuel){ echo "selected";}; ?> > <?php echo $annee; ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12"><br>
                                        <input type="button" id="bouton" value="ajouter" style="width: 100%" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12" id="afficheBailleur">
                                        <label>Bailleur selectionné</label>
                                        <p id="selectBailleur">
                                            <?php
                                            $finance=Bd_GestionProjetActeur::ListeFinancierParIdProjet($idprojet);
                                            $i=0;
                                            if(!empty($finance)){
                                                $mont=4; $an=5; $nom=6; $id=2;
                                                foreach ($finance as $financier):
                                                    $idt=$financier[$id];
                                                    $id=$id+6;
                                                    $bailleur=$financier[$nom];
                                                    $nom=$nom+6;
                                                    $montant=$financier[$mont];
                                                    $mont=$mont+6;
                                                    $anne=$financier[$an];
                                                    $an=$an+6; ?>
                                            <a class="projetExe" href="#" id="baill<?php echo $i; ?>" onclick="Retirer(this.id)">
                                                <input type="hidden" id="anne<?php echo $i ?>" value="<?php echo $anne ?>">
                                                <input type="hidden" id="quantite<?php echo $i ?>" value="<?php echo $montant ?>">
                                                <input type="hidden" id="bailleur<?php echo $i ?>" value="<?php echo $idt ?>">
                                                <?php echo $bailleur." mont:".$montant." année:".$anne ?><span class="pull-right">
                                                    <i class="fa fa-trash" style="color: red"></i></span><br>
                                            </a>
                                            <?php $i++; endforeach; } ?>
                                            <input type="hidden" id="nbreB" value="<?php echo $i ?>">
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <fieldset id="executant">
                                <legend>Exécution</legend>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <label for="nomOpt">Nom de l'opérateur<span style="color: red">*</span></label><br>
                                        <select class="formulaire" id="nomOpt" name="nomOpt">
                                            <option value="">Sélectionné l'opérateur</option>
                                            <?php
                                            $operateur=Bd_GestionProjetActeur::ListerTousOperateur();
                                            $cle=1; $nom=2;
                                            foreach($operateur as $Opt):
                                                $id=$Opt[$cle];
                                                $cle=$cle+8;
                                                $nomOpt=$Opt[$nom];
                                                $nom=$nom+8;
                                                ?>
                                                <option id="operateurselect<?php echo $id ?>" value="<?php echo $id ?>"><?php echo $nomOpt; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row" id="fonction">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="checkbox" value="" id="technique" checked disabled>
                                        <label for="technique">Technique</label>
                                        <input type="hidden" id="tech" name="tech" class="formulaire" value="1">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="checkbox" id="financiere">
                                        <label for="financiere">Financière</label>
                                        <input type="hidden" id="financer" name="financer" class="formulaire" value="0">
                                    </div>
                                </div>
                                <div class="row" id="montExec">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="montantExec">Montant</label><br>
                                        <input type="number" min="0" id="montantExec" name="montantExec" class="formulaire">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6"><br>
                                        <input type="button" id="boutonExec" value="ajouter" style="width: 100%" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12" id="afficheOperateur">
                                        <label>Opérateur selectionné</label>
                                        <p id="selectOpt">
                                            <?php
                                            $executeOpt=Bd_GestionProjetActeur::ListeExecuterProjetOperateurParIdProjet($idprojet);
                                            $i=0;
                                            if(!empty($executeOpt)){
                                            $op=7; $fctTech=4; $fctF=5; $mont=6; $id=2;
                                            ?>
                                            <?php
                                                foreach ($executeOpt as $executeOp):
                                                    $idop=$executeOp[$id];
                                                    $id=$id+7;
                                                    $operateur=$executeOp[$op];
                                                    $op=$op+7;
                                                    $fctTechni=$executeOp[$fctTech];
                                                    $fctTech=$fctTech+7;
                                                    $fctFina=$executeOp[$fctF];
                                                    $fctF=$fctF+7;
                                                    $montOp=$executeOp[$mont];
                                                    $mont=$mont+7;
                                                ?>
                                                    <a class="projetExe" href="#" id="opera<?php echo $i; ?>" onclick="Retirer(this.id)">
                                                    <input type="hidden" id="technique<?php echo $i; ?>" value="<?php echo $fctTechni; ?>">
                                                    <input type="hidden" id="finance<?php echo $i; ?>" value="<?php if($fctFina==1){echo $fctFina; }else{echo 0;}?>">
                                                    <input type="hidden" id="qteOp<?php echo $i; ?>" value="<?php echo $montOp; ?>">
                                                    <input type="hidden" id="operateur<?php echo $i; ?>" value="<?php echo $idop; ?>">
                                                    <?php echo $operateur; if($fctFina==1){echo " mont:".$montOp;} ?><span class="pull-right">
                                                    <i class="fa fa-trash" style="color: red"></i></span><br></a>
                                                <?php
                                                $i++;
                                            endforeach;}
                                            ?>
                                            <?php ?>
                                            <input type="hidden" id="nbreOp" value="<?php echo $i; ?>">
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <?php endforeach ?>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="submit" id="validerProjet" name="enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerProjet" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
    <div id="Etatenregistrement"></div>
<script type="application/javascript">

    $('#montantExec').prop('disabled','true').css('background-color','#E3E3E3').val("");

    $( ".calendrier" ).datepicker({
        onClose: function (selectedDate) {
        }
    });

    var emailverif = document.getElementById('mail');
    var tel = document.getElementById('numContPro');
    var error = document.querySelector('.erreur');
    var errortel = document.querySelector('.erreurtel');
    var errorglobal=document.querySelector('.erreurglobal');
    var errorgmv=document.querySelector('.erreurgmv');

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

    $('#region').change(function(){
        var idregion=$(this).val();
        var donne="idregion="+idregion;
        $('#commune').val("");
        $('#localite').val("");
        $.ajax({
            type:"GET",
            url:"./gestionProjetActeur/projet/traitement.php",
            data:donne,
            success: function(server_response){
                $("#province").html(server_response).show();
            }
        })
    });

    $('#province').change(function(){
        var idprovince=$(this).val();
        var donne="idprovince="+idprovince;
        $('#localite').val("");
        $.ajax({
            type:"GET",
            url:"./gestionProjetActeur/projet/traitement.php",
            data:donne,
            success: function(server_response){
                $("#commune").html(server_response).show();
            }
        })
    });

    $('#ListeBailleur').change(function(){
        if($(this).val()!='') {
            $('#valeurBailleur').show();
            $('#bouton').show();
            $('#montant').val("");
        }else{
            $('#valeurBailleur').hide();
            $('#bouton').hide();
        }
    });


    $('#financiere').change(function(){
        var finance=$('#financer').val();
        if(finance==0){
            $('#financer').val("1");
            $('#montantExec').removeAttrs('disabled');
            $('#montantExec').removeAttrs('style');
        }else{
            // $('#montExec').hide();
            $('#financer').val("0");
            $('#technique').prop('checked','true');
            $('#technique').prop('disabled','true');
            $('#montantExec').prop('disabled','true').css('background-color','#E3E3E3').val("");
            $('#tech').val("1");
        }
    });


    $('#technique').change(function(){
        var tech=$('#tech').val();
        if(tech==1){
            $('#tech').val("0");
        }else{
            $('#tech').val("1");
        }
    });


    $('#commune').change(function(){
        var espe=$(this).val();
        var dernier=$('#nbreC').val();
        var nom= $('#commun'+espe).text();
        $('#affichCommune').show();
        if(espe!="") {
            EnleverFocusBloc('lieu');
            if(dernier!=0){
                var flag=0;
                for(var i=0; i<dernier; i++){
                    var commune=$('#commune'+i).val();
                    if(espe==commune){
                        flag=1;
                    }else{

                    }
                }
                if(flag!=1){

                    $('#selectCommune').append('<a class="projetExe" href="#" id="com'+dernier+'" onclick="Retirer(this.id)">' +
                        '<input type="hidden" id="commune' + dernier + '" value="' + espe + '">' + nom + '<span class="pull-right">' +
                        '<i class="fa fa-trash" style="color: red"></i></span><br></a>');
                    dernier++;
                    $('#nbreC').val(dernier);
                }else{
                    $.rtnotify({
                        title: "",
                        message: " Cette commune est d&eacute;j&agrave; dans la liste ",
                        type: "error",
                        permanent: false,
                        timeout: 5,
                        fade: true,
                        width: 300
                    });
                }
            }else{
                $('#selectCommune').append('<a class="projetExe" href="#" id="com'+dernier+'" onclick="Retirer(this.id)">' +
                    '<input type="hidden" id="commune' + dernier + '" value="' + espe + '">' + nom + '<span class="pull-right">' +
                    '<i class="fa fa-trash" style="color: red"></i></span><br></a>');
                dernier++;
                $('#nbreC').val(dernier);
            }

        }
    });

    $('#bouton').on('click',function(){
        var espe= $('#ListeBailleur').val();
        var dernier=$('#nbreB').val();
        var qte=$('#montant').val();
        var anne=$('#annee').val();

        var nom= $('#selection'+espe).text();
        if(nom!="" && qte!='') {
            EnleverFocusBloc('financeur');
            $('#afficheBailleur').show();
            if(dernier!=0){
                var flag=0;
                for(var i=0; i<dernier; i++){
                    var bailleur= $("#bailleur"+i).val();
                    var montantbaileur= $('#quantite'+i).val();
                    var anneefinance= $('#anne'+i).val();
                    //if((espe==bailleur) && (qte==montantbaileur) && (anne==anneefinance)){
                    if((espe==bailleur) && (anne==anneefinance)){
                        flag=1;
                    }else{
                        //alert('bail '+bailleur+' mont '+montantbaileur+' annee '+anneefinance);
                    }
                }
                if(flag!=1){
                    $('#selectBailleur').append('<a class="projetExe" href="#" id="baill'+dernier+'" onclick="Retirer(this.id)">' +
                        '<input type="hidden" id="anne'+dernier+'" value="'+anne+'">' +
                        '<input type="hidden" id="quantite'+dernier+'" value="'+qte+'">' +
                        '<input type="hidden" id="bailleur'+ dernier+ '" value="' + espe + '">' + nom + ' montant: '+qte+' année:'+anne+'<span class="pull-right">' +
                        '<i class="fa fa-trash" style="color: red"></i></span><br></a>');
                    dernier++;
                    $('#nbreB').val(dernier);
                    $('#montant').val("");
                }else{
                    $.rtnotify({
                        title: "",
                        message: " Bailleur existe sur la liste ",
                        type: "error",
                        permanent: false,
                        timeout: 5,
                        fade: true,
                        width: 300
                    });
                }
            }else{
                $('#selectBailleur').append('<a class="projetExe" href="#" id="baill'+dernier+'" onclick="Retirer(this.id)">' +
                    '<input type="hidden" id="anne'+dernier+'" value="'+anne+'">' +
                    '<input type="hidden" id="quantite'+dernier+'" value="'+qte+'">' +
                    '<input type="hidden" id="bailleur'+ dernier+ '" value="' + espe + '">' + nom + ' montant: '+qte+' année:'+anne+'<span class="pull-right">' +
                    '<i class="fa fa-trash" style="color: red"></i></span><br></a>');
                dernier++;
                $('#nbreB').val(dernier);
                $('#montant').val("");
            }

        }else{
            //alert("montant ou bailleur non renseigné");
            $.rtnotify({
                title: "",
                message: " montant ou bailleur non renseign&eacute; ",
                type: "error",
                permanent: false,
                timeout: 5,
                fade: true,
                width: 300
            });
        }
    });

    $('#boutonExec').on('click',function(){
        var espe= $('#nomOpt').val();
        var dernier=$('#nbreOp').val();
        var qte=$('#montantExec').val();
        var nom= $('#operateurselect'+espe).text();
        var finance=$('#financer').val();
        var tech=$('#tech').val();
        if(nom!="") {
            EnleverFocusBloc('executant');
            $('#afficheOperateur').show();
            if(dernier!=0){
                var flag=0;
                for(var i=0; i<dernier; i++){
                    var opertaeurchoisi= $('#operateur'+i).val();
                    var montantfinance=$('#qteOp'+i).val();
                    if((espe==opertaeurchoisi) && (qte==montantfinance)){
                        flag=1;
                    }else{}
                }
                if(flag!=1){
                    if(finance!=0) {
                        $('#selectOpt').append('<a class="projetExe" href="#" id="opera'+dernier+'" onclick="Retirer(this.id)">' +
                            '<input type="hidden" id="technique' + dernier + '" value="' + tech + '">' +
                            '<input type="hidden" id="finance' + dernier + '" value="' + finance + '">' +
                            '<input type="hidden" id="qteOp' + dernier + '" value="' + qte + '">' +
                            '<input type="hidden" id="operateur' + dernier + '" value="' + espe + '">' + nom + ' montant: ' + qte + '<span class="pull-right">' +
                            '<i class="fa fa-trash" style="color: red"></i></span><br></a>');
                    }else{
                        $('#selectOpt').append('<a class="projetExe" href="#" id="opera'+dernier+'" onclick="Retirer(this.id)">' +
                            '<input type="hidden" id="technique' + dernier + '" value="' + tech + '">' +
                            '<input type="hidden" id="finance' + dernier + '" value="' + finance + '">' +
                            '<input type="hidden" id="qteOp' + dernier + '" value="' + qte + '">' +
                            '<input type="hidden" id="operateur' + dernier + '" value="' + espe + '">' + nom +'<span class="pull-right">' +
                            '<i class="fa fa-trash" style="color: red"></i></span><br></a>');
                    }
                    dernier++;
                    $('#nbreOp').val(dernier);
                    $('#montantExec').val("");
                }else{
                    $.rtnotify({
                        title: "",
                        message: " Cet op&eacute;rateur existe d&eacute;j&agrave; sur la liste",
                        type: "error",
                        permanent: false,
                        timeout: 5,
                        fade: true,
                        width: 300
                    });
                }
            }else{
                if(finance!=0) {
                    $('#selectOpt').append('<a class="projetExe" href="#" id="opera'+dernier+'" onclick="Retirer(this.id)">' +
                        '<input type="hidden" id="technique' + dernier + '" value="' + tech + '">' +
                        '<input type="hidden" id="finance' + dernier + '" value="' + finance + '">' +
                        '<input type="hidden" id="qteOp' + dernier + '" value="' + qte + '">' +
                        '<input type="hidden" id="operateur' + dernier + '" value="' + espe + '">' + nom + ' montant: ' + qte + '<span class="pull-right">' +
                        '<i class="fa fa-trash" style="color: red"></i></span><br></a>');
                }else{
                    $('#selectOpt').append('<a class="projetExe" href="#" id="opera'+dernier+'" onclick="Retirer(this.id)">' +
                        '<input type="hidden" id="technique' + dernier + '" value="' + tech + '">' +
                        '<input type="hidden" id="finance' + dernier + '" value="' + finance + '">' +
                        '<input type="hidden" id="qteOp' + dernier + '" value="' + qte + '">' +
                        '<input type="hidden" id="operateur' + dernier + '" value="' + espe + '">' + nom +'<span class="pull-right">' +
                        '<i class="fa fa-trash" style="color: red"></i></span><br></a>');
                }
                dernier++;
                $('#nbreOp').val(dernier);
                $('#montantExec').val("");
            }

        }else{
            //alert("Opérateur non renseigné");
            $.rtnotify({
                title: "",
                message: " Op&eacute;rateur non renseign&eacute; ",
                type: "error",
                permanent: false,
                timeout: 5,
                fade: true,
                width: 300
            });
        }
    });

    $('#annulerProjet').click(function(){
        $('#corps').load("./gestionProjetActeur/projet/listeProjet.php");
    });

    $('#closeProjet').click(function(){
        $('#corps').load("./gestionProjetActeur/projet/listeProjet.php");
    });

    $('#validerProjet').click(function(){

        var ident=$('#identifiant').val();
        var nomPro=$('#nomPro').val();
        var siteInt=$('#siteInt').val();
        var budgetGlobal=$('#budgetGlobal').val();
        var budgetGMV=$('#budgetGMV').val();
        var dateDeb=$('#dateDeb').val();
        var dateFin=$('#dateFin').val();
        var nomContPro=$('#nomContPro').val();
        var prenomContPro=$('#prenomContPro').val();
        var numContPro=$('#numContPro').val();
        var mail=$('#mail').val();
        var nomDes=$('#nomDes').val();
        var nbreB=$('#nbreB').val();
        var nbreOp=$('#nbreOp').val();
        var nbreC=$('#nbreC').val();
        var techn=[];
        var finance=[];
        var bailleur=[];
        var montant=[];
        var annee=[];
        var commune=[];
        var operateur=[];
        var montantOp=[];



        if(nomPro==''|| budgetGlobal==''||budgetGMV==''||dateDeb==''||dateFin==''||nomContPro==''||prenomContPro==''||
            numContPro=='' || nbreB == 0 || nbreOp == 0 || nbreC == 0){
            notification("vide");
            MettreFocus(nomPro,nomContPro,prenomContPro,numContPro,budgetGlobal,budgetGMV,dateDeb,dateFin,nbreB,nbreOp,nbreC);
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
                        if (nbreB != 0) {
                            for (var i = 0; i < nbreB; i++) {
                                var valeur = $('#bailleur' + i).val();
                                var qtite = $('#quantite' + i).val();
                                var anne = $('#anne' + i).val();
                                bailleur.push(valeur);
                                montant.push(qtite);
                                annee.push(anne);
                            }
                        }

                        if (nbreOp != 0) {
                            for (i = 0; i < nbreOp; i++) {
                                var operat = $('#operateur' + i).val();
                                var montOp = $('#qteOp' + i).val();
                                var finan = $('#finance' + i).val();
                                var tech = $('#technique' + i).val();
                                operateur.push(operat);
                                montantOp.push(montOp);
                                finance.push(finan);
                                techn.push(tech);
                            }
                        }

                        if (nbreC != 0) {
                            for (var j = 0; j < nbreC; j++) {
                                var com = $('#commune' + j).val();
                                commune.push(com);
                            }
                        }

                        if (commune != '') {
                            if (bailleur != '') {
                                if (operateur != '') {
                                    var data = "nomPro=" + nomPro + "&siteInt=" + siteInt + "&budgetGlobal=" + budgetGlobal + "&budgetGMV=" + budgetGMV + "&dateDeb=" + dateDeb + "&dateFin=" + dateFin +
                                        "&nomContPro=" + nomContPro + "&prenomContPro=" + prenomContPro + "&numContPro=" + numContPro + "&mail=" + mail + "&nomDes=" + nomDes +
                                        "&commune=" + commune + "&nbreC=" + nbreC + "&bailleur=" + bailleur + "&montant=" + montant + "&annee=" + annee + "&nbreB=" + nbreB + "&technique=" + techn +
                                        "&financiere=" + finance + "&operateur=" + operateur + "&montantOp=" + montantOp + "&nbreOp=" + nbreOp + "&identif=" + ident;
                                    $.ajax({
                                        type: "POST",
                                        url: "./gestionProjetActeur/projet/enregistrement.php",
                                        data: data,
                                        success: function (reponse) {
                                            $('#Etatenregistrement').html(reponse).show();
                                            var etat=$('#echec').val();
                                            if(etat!=''){
                                                $("#corps").load("./gestionProjetActeur/projet/listeProjet.php");
                                                etatdeinsertion("echec");
                                            }else{
                                                $("#corps").load("./gestionProjetActeur/projet/listeProjet.php");
                                                notification(1);
                                            }

                                        }
                                    });
                                    console.log(data);
                                } else {
                                    alert("Echec!!! Aucun opérateur spécifié pour ce projet");
                                    $('#corps').load("./gestionProjetActeur/projet/listeProjet.php");
                                }
                            } else {
                                alert("Echec!!! Aucun bailleur spécifié pour ce projet");
                                $('#corps').load("./gestionProjetActeur/projet/listeProjet.php");
                            }

                        } else {
                            alert("Echec!!! zone d'intervention non spécifiée");
                            $('#corps').load("./gestionProjetActeur/projet/listeProjet.php");
                        }
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
                    if (nbreB != 0) {
                        for (var i = 0; i < nbreB; i++) {
                            var valeur = $('#bailleur' + i).val();
                            var qtite = $('#quantite' + i).val();
                            var anne = $('#anne' + i).val();
                            bailleur.push(valeur);
                            montant.push(qtite);
                            annee.push(anne);
                        }
                    }

                    if (nbreOp != 0) {
                        for (i = 0; i < nbreOp; i++) {
                            var operat = $('#operateur' + i).val();
                            var montOp = $('#qteOp' + i).val();
                            var finan = $('#finance' + i).val();
                            var tech = $('#technique' + i).val();
                            operateur.push(operat);
                            montantOp.push(montOp);
                            finance.push(finan);
                            techn.push(tech);
                        }
                    }

                    if (nbreC != 0) {
                        for (var j = 0; j < nbreC; j++) {
                            var com = $('#commune' + j).val();
                            commune.push(com);
                        }
                    }

                    if (commune != '') {
                        if (bailleur != '') {
                            if (operateur != '') {
                                var data = "nomPro=" + nomPro + "&siteInt=" + siteInt + "&budgetGlobal=" + budgetGlobal + "&budgetGMV=" + budgetGMV + "&dateDeb=" + dateDeb + "&dateFin=" + dateFin +
                                    "&nomContPro=" + nomContPro + "&prenomContPro=" + prenomContPro + "&numContPro=" + numContPro + "&mail=" + mail + "&nomDes=" + nomDes +
                                    "&commune=" + commune + "&nbreC=" + nbreC + "&bailleur=" + bailleur + "&montant=" + montant + "&annee=" + annee + "&nbreB=" + nbreB + "&technique=" + techn +
                                    "&financiere=" + finance + "&operateur=" + operateur + "&montantOp=" + montantOp + "&nbreOp=" + nbreOp + "&identif=" + ident;
                                $.ajax({
                                    type: "POST",
                                    url: "./gestionProjetActeur/projet/enregistrement.php",
                                    data: data,
                                    success: function (reponse) {
                                        $('#Etatenregistrement').html(reponse).show();
                                        var etat=$('#echec').val();
                                        if(etat!=''){
                                            $("#corps").load("./gestionProjetActeur/projet/listeProjet.php");
                                            etatdeinsertion("echec");
                                        }else{
                                            $("#corps").load("./gestionProjetActeur/projet/listeProjet.php");
                                            notification(1);
                                        }

                                    }
                                });
                                console.log(data);
                            } else {
                                alert("Echec!!! Aucun opérateur spécifié pour ce projet");
                                $('#corps').load("./gestionProjetActeur/projet/listeProjet.php");
                            }
                        } else {
                            alert("Echec!!! Aucun bailleur spécifié pour ce projet");
                            $('#corps').load("./gestionProjetActeur/projet/listeProjet.php");
                        }

                    } else {
                        alert("Echec!!! zone d'intervention non spécifiée");
                        $('#corps').load("./gestionProjetActeur/projet/listeProjet.php");
                    }
                }
            }
        }
    });


    $("#dateFin").change(function(){
        var $datefin=$('#dateFin');

        var parts=$datefin.val().split("/");
        var date_limit=new Date(parts[2],parts[1]-1,parts[0]);
        var parts=$("#dateDeb").val().split("/");
        var date_lance=new Date(parts[2],parts[1]-1,parts[0]);
        $(".champ-datepicker").datepicker("option",{
            minDate:date_limit
        });
        if(date_lance>date_limit){
            $datefin.val("");
            notification('droit');
        }
    });

    $("#dateDeb").change(function(){
        var $datebdeb=$('#dateDeb');

        var parts=$('#dateFin').val().split("/");
        var date_limit=new Date(parts[2],parts[1]-1,parts[0]);
             parts=$datebdeb.val().split("/");
        var date_lance=new Date(parts[2],parts[1]-1,parts[0]);
        $(".champ-datepicker").datepicker("option",{
            minDate:date_lance
        });
        if(date_lance>date_limit){
            $datebdeb.val("");
            notification('droit');
        }
    });


    //gestion sur les valeurs des budjet

    $('#budgetGMV').change(function(){
        var gmv=$(this).val();
        var global=$('#budgetGlobal').val();
        var difference=gmv-global;
        if(difference > 0){
            errorgmv.innerHTML = "ce budget doit être inférieur ou égal au budget global";
            errorgmv.className = "error active";
            $(this).val("");
            $(this).focus();
        }else{
            errorgmv.innerHTML = "";
            errorgmv.className = "erreurgmv";
        }

    });

    $('#budgetGlobal').change(function(){
        var global= $(this).val();
        var gmv= $('#budgetGMV').val();
        var difference=gmv-global;
        if(difference > 0){

            errorglobal.innerHTML = "ce budget doit être supérieur ou égal au budget gmv";
            errorglobal.className = "error active";

            $(this).val("");
            $(this).focus();
        }else{
            errorglobal.innerHTML = "";
            errorglobal.className = "erreurglobal";
        }

    });

//fonction de retait des éléments ajouter
    function Retirer(selectorElement){
        var ids=selectorElement.substr(0,2);
       /* if(ids=='co'){
            var dernierC=$('#nbreC').val();
            dernierC=dernierC-1;
            $('#nbreC').val(dernierC);
        }

        if(ids=='op'){
            var dernierO=$('#nbreOp').val();
            dernierO=dernierO-1;
            $('#nbreOp').val(dernierO);
        }

        if(ids=='ba'){
            var dernierB=$('#nbreB').val();
            dernierB=dernierB-1;
            $('#nbreB').val(dernierB);
        }*/

        $('#'+selectorElement).remove();
    }

    function MettreFocus(nomPro,nomContPro,prenomContPro,numContPro,budgetGlobal,budgetGMV,dateDeb,dateFin,nbreB,nbreOp,nbreC){
        if(nomPro==''){
            //$('#nomB').css('background-color', '#FDD').css('border-color', '#900');
            $('#nomPro').css('background-color', '#FDD');
        }else{
            $('#nomPro').removeAttrs('style');
        }

        if(nomContPro==''){
            $('#nomContPro').css('background-color', '#FDD');
        }else{
            $('#nomContPro').removeAttrs('style');
        }

        if(prenomContPro==''){

            $('#prenomContPro').css('background-color', '#FDD');
        }else{
            $('#prenomContPro').removeAttrs('style');
        }

        if(numContPro==''){
            $('#numContPro').css('background-color', '#FDD');
        }else{
            $('#numContPro').removeAttrs('style');
        }

        if(budgetGlobal==''){
            $('#budgetGlobal').css('background-color', '#FDD');
        }else{
            $('#budgetGlobal').removeAttrs('style');
        }

        if(budgetGMV==''){
            $('#budgetGMV').css('background-color', '#FDD');
        }else{
            $('#budgetGMV').removeAttrs('style');
        }

        if(dateDeb==''){
            $('#dateDeb').css('background-color', '#FDD');
        }else{
            $('#dateDeb').removeAttrs('style');
        }

        if(dateFin==''){
            $('#dateFin').css('background-color', '#FDD');
        }else{
            $('#dateFin').removeAttrs('style');
        }

        if(nbreB==0){
            $('#financeur').css('background-color', '#FDD');
        }else{
            $('#financeur').removeAttrs('style');
        }

        if(nbreOp==0){
            $('#executant').css('background-color', '#FDD');
        }else{
            $('#executant').removeAttrs('style');
        }

        if(nbreC==0){
            $('#lieu').css('background-color', '#FDD');
        }else{
            $('#lieu').removeAttrs('style');
        }

    }
</script>
<?php }?>
