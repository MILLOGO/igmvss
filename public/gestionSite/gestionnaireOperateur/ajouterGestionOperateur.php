<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 05/07/2018
 * Time: 15:45
 */
include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{
/*
if($_POST){
    $idgest= trim(strip_tags($_POST['idges']));
    $idop= trim(strip_tags($_POST['idopt']));
    $datedeb= trim(strip_tags($_POST['datedeb']));
    $datfin= trim(strip_tags($_POST['datefin']));
    $idappui= trim(strip_tags($_POST['idappui']));
    $nbreBenef= trim(strip_tags($_POST['nbreBeneficiaire']));
    $descripAppui=trim(strip_tags($_POST['descript']));
    $exploit=trim(strip_tags($_POST['exploit']));
    $nomPro=trim(strip_tags($_POST['nomPro']));
    if($nbreBenef==''){
        $nbreBenef=0;
    }
    $gestionnaire= new Bd_GestionSite();
    if($nomPro!='') {
        $gestionnaire->InsererGestionnaireOperateurAppuiAvecProjet($idop, $idappui, $idgest, $datedeb, $datfin, $nbreBenef, $descripAppui, $exploit,$nomPro);
    }else{
        $gestionnaire->InsererGestionnaireOperateurAppui($idop, $idappui, $idgest, $datedeb, $datfin, $nbreBenef, $descripAppui, $exploit);
    }
}*/
?>
<div class="modal" id="newAppuiGestionnaire" data-backdrop="static" >
    <div class="modal-dialog" >
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeGestOp" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Appui à un gestionnaire  </span></h3>
            </div>
            <div class="modal-body" >
                <form method="post" action="">
                    <fieldset>
                        <Legend>Gestionnaire/Opérateur</Legend>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="typeGest">Type de gestionnaire <span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <input type="radio" name="typeGest" id="Individuel" value="individuel">
                                    <label for="Individuel" class="labelcouleur">Individuel</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <input type="radio" name="typeGest" id="Collectif" value="collectif">
                                    <label for="Collectif" class="labelcouleur">Collectif</label>
                                </div>
                            </div>
                            <input type="hidden" name="typeCocher" id="typeCocher" value="">
                        </div><br>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="listGest">Gestionnaire <span style="color: red">*</span></label><br>
                                <select class="formulaire" name="listGest" id="listGest" onchange="EnleverFocus(this.id)">
                                    <option value="">Sélectionner un gestionnaire</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="listeOpt">Operateur <span style="color: red">*</span></label><br>
                                <select class="formulaire" name="listeOpt" id="listeOpt" onchange="EnleverFocus(this.id)">
                                    <option value="">Sélectionner un opérateur</option>
                                    <?php
                                    $operateur=Bd_GestionProjetActeur::ListerTousOperateur();
                                    $id=1;
                                    $no=2;
                                    foreach($operateur as $opt):
                                        $ident=$opt[$id];
                                        $id=$id+8;
                                        $nom=$opt[$no];
                                        $no=$no+8;
                                        ?>
                                        <option value="<?php echo $ident; ?>"><?php echo $nom; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <fieldset id="Gest">
                                    <legend>details du gestionnaire</legend>
                                    <div id="detailGest"></div>
                                </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <fieldset id="Op">
                                    <legend>details de l'Opérateur</legend>
                                    <div id="detailOp"></div>
                                </fieldset>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <Legend>Appui</Legend>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="anneeDeb">Periode début <span style="color: red">*</span></label><br>
                                <input class="formulaire calendrier" name="anneeDeb" id="anneeDeb" type="text" onchange="EnleverFocus(this.id)">
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="anneeFin">Période fin <span style="color: red">*</span></label><br>
                                <input class="formulaire calendrier" name="anneeFin" id="anneeFin" type="text" onchange="EnleverFocus(this.id)">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="appui">Type d'appui <span style="color: red">*</span></label><br>
                                <select class="formulaire" name="appui" id="appui" onchange="EnleverFocus(this.id)">
                                    <option value=""></option>
                                    <?php
                                    $apui=Bd_parametre::ListeTypeappui();
                                    $id=1;
                                    $no=2;
                                    foreach($apui as $appui):
                                        $ident=$appui[$id];
                                        $id=$id+2;
                                        $nom=$appui[$no];
                                        $no=$no+2;
                                        ?>
                                        <option value="<?php echo $ident; ?>"><?php echo $nom; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="nbrBenef">Nombre des bénéficiaires <span style="color: red">*</span></label><br>
                                <input class="formulaire" name="nbrBenef" id="nbrBenef" type="number" min="1" onchange="EnleverFocus(this.id)">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="nomPro">Nom du projet <span style="color: red">*</span></label><br>
                                <select class="formulaire" id="nomPro" name="nomPro" onchange="EnleverFocus(this.id)">
                                    <option value="">Sélectionner le projet</option>
                                    <?php
                                    $operateur=Bd_GestionProjetActeur::ListerTousProjet();
                                    $cle=1; $nom=2;
                                    foreach($operateur as $Opt):
                                        $id=$Opt[$cle];
                                        $cle=$cle+12;
                                        $nomOpt=$Opt[$nom];
                                        $nom=$nom+12;
                                        ?>
                                        <option value="<?php echo $id ?>"><?php echo $nomOpt; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="desAppui">Description de l'appui</label><br>
                                <textarea name="desAppui" id="desAppui" class="formulaire" style="height: 100px"></textarea>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <label for="pnfl">Exploitation PFNL </label>
                                </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                        <input type="radio" name="pnfl" id="pnflOui" value="True">
                                        <label for="pnflOui" class="labelcouleur">Oui</label>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                        <input type="radio" name="pnfl" id="pnflNon" value="False">
                                        <label for="pnflNon" class="labelcouleur">Non</label>
                                        <input id="valeurPnfl" value="" type="hidden">
                                    </div>
                            </div>
                        </div>
                    </fieldset><br>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" value="Enregistrer" id="ValiderGestOp" name="EnregistrerGes" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerGestOp" name="fermer" value="Annuler" data-dismiss="modal"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
    <div id="Etatenregistrement"></div>
<script type="application/javascript">

    $( ".calendrier" ).datepicker({
        onClose: function (selectedDate) {
        }
    });

    $('#Gest').hide();
    $('#Op').hide();
    var valeurtmp=-1;

    $('#Individuel').click(function(){
        valeurtmp=0;
        $('#nbrBenef').prop('disabled','true').css('background-color','#E3E3E3').val("");
            var valeur=$(this).val();
            $('#typeCocher').val(valeur);
            var data="type="+valeur;
            $.ajax({
                type: "GET",
                url: "./gestionSite/gestionnaireOperateur/traitement.php",
                data:data,
                success: function(server_response){
                    $("#listGest").html(server_response).show();
                }
            });
        });

    $('#Collectif').click(function(){
        $('#nbrBenef').removeAttrs('disabled');
        $('#nbrBenef').removeAttrs('style');
        var valeur=$(this).val();
        $('#typeCocher').val(valeur);
        var data="type="+valeur;
        $.ajax({
            type: "GET",
            url: "./gestionSite/gestionnaireOperateur/traitement.php",
            data:data,
            success: function(server_response){
                $("#listGest").html(server_response).show();
            }
        });
    });

    //fonction pour afficher les détails du gestionnaire selectionné
    $('#listGest').change(function(){
        var id=$(this).val();
        var type=$('#typeCocher').val();
        //$('#Op').hide();
        $('#Gest').show();
        var data="idgest="+id+"&typegest="+type;
        $.ajax({
            type:"GET",
            url:"./gestionSite/gestionnaireOperateur/traitement.php",
            data:data,
            success: function(reponse){
                $('#detailGest').html(reponse).show();
            }
        });
    });

    //idem pour l'opérateur

    $('#listeOpt').change(function(){
       var idOpt=$(this).val();
        var data="idopt="+idOpt;
        //$('#Gest').hide();
        $('#Op').show();
        $.ajax({
            type:"GET",
            url: "./gestionSite/gestionnaireOperateur/traitement.php",
            data:data,
            success: function(reponse){
                $('#detailOp').html(reponse).show();
            }
        })
    });
    $('#pnflNon').click(function(){
        document.getElementById("valeurPnfl").setAttribute("value",'False');
    });

    $('#pnflOui').click(function(){
        document.getElementById("valeurPnfl").setAttribute("value",'TRUE');
    });

    //gestion de la selection des dates
    $("#anneeFin").change(function(){
        var $datefin=$('#anneeFin');

        var parts=$datefin.val().split("/");
        var date_limit=new Date(parts[2],parts[1]-1,parts[0]);
        var parts=$("#anneeDeb").val().split("/");
        var date_lance=new Date(parts[2],parts[1]-1,parts[0]);
        $(".champ-datepicker").datepicker("option",{
            minDate:date_limit
        });
        if(date_lance>date_limit){
            $datefin.val("");
            notification('droit');
        }
    });

    $("#anneeDeb").change(function(){
        var $datedeb=$('#anneeDeb');

        var parts=$('#anneeFin').val().split("/");
        var date_limit=new Date(parts[2],parts[1]-1,parts[0]);
        var parts=$datedeb.val().split("/");
        var date_lance=new Date(parts[2],parts[1]-1,parts[0]);
        $(".champ-datepicker").datepicker("option",{
            minDate:date_lance
        });
        if(date_lance>date_limit){
            $datedeb.val("");
            notification('droit');
        }
    });

    //enregistrement des données dans  la base de données

    $('#ValiderGestOp').click(function(){

        var gest=$('#listGest').val();
        var operateur=$('#listeOpt').val();
        var datedebut=$('#anneeDeb').val();
        var datfin=$('#anneeFin').val();
        var appui=$('#appui').val();
        var beneficiair=$('#nbrBenef').val();
        var descripAppui=$('#desAppui').val();
        var exploit=$('#valeurPnfl').val();
        var nomPro=$('#nomPro').val();

        var typergestionna=$('#typeCocher').val();
        //var verification="";
        if(typergestionna=='collectif'){
            //verification="";
            if(gest==''||operateur==''||datedebut==''||datfin=='' ||nomPro=='' || appui=='' || beneficiair=='' || beneficiair<1){
                notification('vide');
                MettreFocus();
                //alert(verification);
            }else{
                $(this).attr('data-dismiss', 'modal');
                if(exploit==''){
                    exploit="False";
                }
                var data="idges="+gest+"&idopt="+operateur+"&datedeb="+datedebut+"&datefin="+datfin+"&idappui="+appui+"&nbreBeneficiaire="+beneficiair+"" +
                    "&descript="+descripAppui+"&exploit="+exploit+"&nomPro="+nomPro+"&aide=ajout";
                $.ajax({
                    type: "POST",
                    url: "./gestionSite/gestionnaireOperateur/enregistrement.php",
                    data:data,
                    success: function (reponse) {
                        $('#Etatenregistrement').html(reponse).show();
                        var etat=$('#echec').val();
                        if(etat!=''){
                            $("#corps").load("./gestionSite/gestionnaireOperateur/listeGestionOperateur.php");
                            etatdeinsertion("echec");
                        }else{
                            $("#corps").load("./gestionSite/gestionnaireOperateur/listeGestionOperateur.php");
                            notification(1);
                        }

                    }
                });
                //console.log(data);
            }
        }else{
            //verification=" ";
            if(gest==''||operateur==''||datedebut==''||datfin=='' ||nomPro=='' || appui==''){
                notification('vide');
                MettreFocusI();
            }else{
                $(this).attr('data-dismiss', 'modal');
                if(exploit==''){
                    exploit="False";
                }
                var data="idges="+gest+"&idopt="+operateur+"&datedeb="+datedebut+"&datefin="+datfin+"&idappui="+appui+"&nbreBeneficiaire="+beneficiair+"" +
                    "&descript="+descripAppui+"&exploit="+exploit+"&nomPro="+nomPro+"&aide=ajout";
                $.ajax({
                    type: "POST",
                    url: "./gestionSite/gestionnaireOperateur/enregistrement.php",
                    data:data,
                    success: function (reponse) {
                        $('#Etatenregistrement').html(reponse).show();
                        var etat=$('#echec').val();
                        if(etat!=''){
                            $("#corps").load("./gestionSite/gestionnaireOperateur/listeGestionOperateur.php");
                            etatdeinsertion("echec");
                        }else{
                            $("#corps").load("./gestionSite/gestionnaireOperateur/listeGestionOperateur.php");
                            notification(1);
                        }

                    }
                });
                //console.log(data);
            }
        }

        //if(gest==''||operateur==''||datedebut==''||datfin=='' ||nomPro=='' || appui=='' || beneficiair=='' || beneficiair<1){
        /*if(verification){
            notification('vide');
            MettreFocus();
            alert(verification);
        }else{
            $(this).attr('data-dismiss', 'modal');
            if(exploit==''){
                exploit="False";
            }
            var data="idges="+gest+"&idopt="+operateur+"&datedeb="+datedebut+"&datefin="+datfin+"&idappui="+appui+"&nbreBeneficiaire="+beneficiair+"" +
                "&descript="+descripAppui+"&exploit="+exploit+"&nomPro="+nomPro;
            $.ajax({
                type: "POST",
                url: "./gestionSite/gestionnaireOperateur/ajouterGestionOperateur.php",
                data:data,
                success: function(){
                    notification(1);
                    $("#corps").load("./gestionSite/gestionnaireOperateur/listeGestionOperateur.php");
                }
            });
            //console.log(data);
        }*/
    });


    $('#annulerGestOp').on('click',function(){
        $("#corps").load("./gestionSite/gestionnaireOperateur/listeGestionOperateur.php");
    });

    $('#closeGestOp').on('click',function(){
        $("#corps").load("./gestionSite/gestionnaireOperateur/listeGestionOperateur.php");
    });

    function MettreFocus(){

        var gest=$('#listGest');
        var operateur=$('#listeOpt');
        var datedebut=$('#anneeDeb');
        var datfin=$('#anneeFin');
        var appui=$('#appui');
        var nomPro=$('#nomPro');
        var beneficiair=$('#nbrBenef');

        if(gest.val()==''){
            gest.css('background-color', '#FDD');
        }else{
            gest.removeAttrs('style');
        }

        if(operateur.val()==''){
            operateur.css('background-color', '#FDD');
        }else{
            operateur.removeAttrs('style');
        }

        if(nomPro.val()==''){
            nomPro.css('background-color', '#FDD');
        }else{
            nomPro.removeAttrs('style');
        }

        if(datedebut.val()==''){
            datedebut.css('background-color', '#FDD');
        }else{
            datedebut.removeAttrs('style');
        }

        if(datfin.val()==''){

            datfin.css('background-color', '#FDD');
        }else{
            datfin.removeAttrs('style');
        }

        if(appui.val()==''){
            appui.css('background-color', '#FDD');
        }else{
            appui.removeAttrs('style');
        }

        if(beneficiair.val()==''){
            beneficiair.css('background-color', '#FDD');
        }else{
            beneficiair.removeAttrs('style');
        }

        if(beneficiair.val()<1){
            etatdeinsertion('nbrinvalid');
            beneficiair.css('background-color', '#FDD');
        }else{
            beneficiair.removeAttrs('style');
        }

    }

    function MettreFocusI(){

        var gest=$('#listGest');
        var operateur=$('#listeOpt');
        var datedebut=$('#anneeDeb');
        var datfin=$('#anneeFin');
        var appui=$('#appui');
        var nomPro=$('#nomPro');

        if(gest.val()==''){
            gest.css('background-color', '#FDD');
        }else{
            gest.removeAttrs('style');
        }

        if(operateur.val()==''){
            operateur.css('background-color', '#FDD');
        }else{
            operateur.removeAttrs('style');
        }

        if(nomPro.val()==''){
            nomPro.css('background-color', '#FDD');
        }else{
            nomPro.removeAttrs('style');
        }

        if(datedebut.val()==''){
            datedebut.css('background-color', '#FDD');
        }else{
            datedebut.removeAttrs('style');
        }

        if(datfin.val()==''){

            datfin.css('background-color', '#FDD');
        }else{
            datfin.removeAttrs('style');
        }

        if(appui.val()==''){
            appui.css('background-color', '#FDD');
        }else{
            appui.removeAttrs('style');
        }


    }
</script>
<?php }?>