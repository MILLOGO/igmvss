<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 21/07/2018
 * Time: 19:05
 */
include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$ide="";
if(isset($_POST['idcollection'])){
    $ide=$_POST['idcollection'];
}/*else{
    if($_POST) {
        $collecteu = strip_tags($_POST['collecteur']);
        $siteCollect=strip_tags($_POST['site']);
        $datecollect=strip_tags($_POST['datecollect']);
        $numeroFiche=strip_tags($_POST['numFiche']);
        $identi=strip_tags($_POST['idcollectionsite']);

        $gestionSite= new Bd_GestionSite();
        $gestionSite->ModifierCollection($collecteu,$siteCollect,$datecollect,$numeroFiche,$identi);
    }
}*/

?>


<div class="modal" id="updatecollection" data-backdrop="static">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification d'une collection</span></h3>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?php
                    $tableau=Bd_GestionSite::ObserverSite($ide);
                    foreach ($tableau as $tab):
                        ?>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-6">
                            <fieldset>
                                <legend>Détails collecteur</legend>

                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <label for="nomCollecteur"> Nom du collecteur <span style="color: red">*</span></label>
                                    <input type="hidden" value="<?php echo $tab[12]; ?>" id="idcollectionsite">
                                    <select id="nomCollecteur" name="nomCollecteur" class="formulaire" onchange="EnleverFocus(this.id)">
                                        <?php $collecteur=Bd_GestionSite::ListerTousCollecteur();
                                        $cle=1;
                                        $nom=2;
                                        $prno=3;
                                        foreach($collecteur as $collect):
                                            $id=$collect[$cle];
                                            $cle=$cle+6;
                                            $nomCollecteur=$collect[$nom];
                                            $nom=$nom+6;
                                            $prnomCollecteur=$collect[$prno];
                                            $prno=$prno+6;
                                            ?>
                                            <option value="<?php echo $id;?>" <?php if($tab[6]==$id){echo "selected"; } ?>><?php echo "<span class='maj'>".$nomCollecteur."</span> ".$prnomCollecteur;?></option>
                                        <?php endforeach?>
                                    </select>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <label for="dateObs">Date d'observation <span style="color: red">*</span></label>
                                    <input type="text" class="formulaire calendrier" id="dateObs" name="dateObs" value="<?php echo $tab[7] ?>" onchange="EnleverFocus(this.id)">
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <label for="numFiche">N°Fiche d'observation <span style="color: red">*</span></label>
                                    <input class="formulaire" id="numFiche" name="numFiche" type="text" value="<?php echo $tab[8] ?>" onchange="EnleverFocus(this.id)">
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6">
                            <fieldset>
                                <legend>Localisation</legend>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="region">Région <span style="color: red">*</span></label>
                                        <select id="region" name="region" class="formulaire" title="sélectionner une région" onchange="EnleverFocus(this.id)">
                                            <option></option>
                                            <?php $region=Bd_parametre::ListeRegion();
                                            $cle=1; $nom=2;
                                            foreach($region as $listeRegion):
                                                $id=$listeRegion[$cle];
                                                $cle=$cle+2;
                                                $nomRegion=$listeRegion[$nom];
                                                $nom=$nom+2;
                                                ?>
                                                <option value="<?php echo $id ?>" <?php if($tab[20]==$id){echo "selected"; } ?> ><?php echo $nomRegion ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="province">Province <span style="color: red">*</span></label>
                                        <select id="province" name="province" class="formulaire" title="sélectionner une province" onchange="EnleverFocus(this.id)">
                                            <option></option>
                                            <?php
                                            $province=Bd_parametre::ListeProvinceParRegion($tab[20]);
                                            $cle=1;
                                            $nom=3;
                                            foreach($province as $prov):
                                                $idPro=$prov[$cle];
                                                $cle=$cle+3;
                                                $nomProvince=$prov[$nom];
                                                $nom=$nom+3;
                                                ?>
                                                <option value="<?php echo $idPro ?>" <?php if($idPro==$tab[17]){ echo 'selected';} ?>><?php echo $nomProvince ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="commune">Commune <span style="color: red">*</span></label>
                                        <select id="commune" name="commune" class="formulaire" title="sélectionner une commune" onchange="EnleverFocus(this.id)">
                                            <?php
                                            $commune=Bd_parametre::ListeCommuneParProvince($tab[17]);
                                            $cle=1;
                                            $nom=3;
                                            foreach($commune as $com):
                                                $idcom=$com[$cle];
                                                $cle=$cle+7;
                                                $nomCommune=$com[$nom];
                                                $nom=$nom+7;
                                                ?>
                                                <option value="<?php echo $idcom ?>" <?php if($idcom==$tab[15]){ echo 'selected';} ?>><?php echo $nomCommune ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="localite">Localité <span style="color: red">*</span></label>
                                        <select id="localite" name="localite" class="formulaire" title="sélectionner une localité" onchange="EnleverFocus(this.id)">
                                            <?php
                                            $localite = Bd_parametre::ListeLocaliteParCommune($tab[15]);
                                            $cle = 1;
                                            $nom = 3;
                                            foreach ($localite as $loc):
                                                $idloc = $loc[$cle];
                                                $cle = $cle + 3;
                                                $nomLocalite = $loc[$nom];
                                                $nom = $nom + 3;
                                                ?>
                                                <option value="<?php echo $idloc ?>" <?php if($idloc==$tab[13]){ echo 'selected';} ?>><?php echo $nomLocalite ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <label for="nomSite">Nom du site <span style="color: red">*</span></label><br>
                                        <select class="formulaire" id="nomSite" name="nomSite" onchange="EnleverFocus(this.id)">
                                            <?php
                                            $site = Bd_GestionSite::ListerSiteParLocalite($tab[13]);
                                            $cle = 1;
                                            $nom = 6;
                                            $taille = 7;
                                            foreach ($site as $loc):
                                                $id = $loc[$cle];
                                                $cle = $cle + $taille;
                                                $nomsite = $loc[$nom];
                                                $nom = $nom + $taille;
                                                ?>
                                                <option value="<?php echo $id ?>" <?php if($id==$tab[11]){ echo 'selected';} ?>><?php echo $nomsite ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <?php
                        endforeach
                    ?>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="submit" id="validerCollection" name="enregistrer"  value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerCollection" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div><div id="Etatenregistrement"></div>
<?php

?>
<script type="application/javascript">

    //gestion des remplissage automatique

    $('#region').change(function(){
        var idregion=$(this).val();
        var donne="idregion="+idregion;
        $('#commune').val("");
        $('#localite').val("");
        $('#nomSite').val("");
        $.ajax({
            type:"GET",
            url:"./gestionSite/collection/traitement.php",
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
        $('#nomSite').val("");
        $.ajax({
            type:"GET",
            url:"./gestionSite/collection/traitement.php",
            data:donne,
            success: function(server_response){
                $("#commune").html(server_response).show();
            }
        })
    });

    $('#commune').change(function(){
        var idcommune=$(this).val();
        var donne="idcommune="+idcommune;
        $('#nomSite').val("");
        $.ajax({
            type:"GET",
            url:"./gestionSite/collection/traitement.php",
            data:donne,
            success: function(server_response){
                $("#localite").html(server_response).show();
            }
        })
    });

    $('#localite').change(function(){
        var idlocalite=$(this).val();
        var donne="idlocalite="+idlocalite;
        $.ajax({
            type:"GET",
            url:"./gestionSite/collection/traitement.php",
            data:donne,
            success: function(server_response){
                $("#nomSite").html(server_response).show();
            }
        })
    });


    $( ".calendrier" ).datepicker({
        onClose: function (selectedDate) {
        }
    });


    $("#closeagentm").on('click',function(){
        $("#corps ").load("./gestionSite/collection/listeCollection.php")
    });

    $("#annulerCollection").on('click',function(){
        $("#corps ").load("./gestionSite/collection/listeCollection.php")
    });


    $('#validerCollection').on('click', function(){
        var collecteur=$('#nomCollecteur').val();
        var site=$('#nomSite').val();
        var datecollect=$('#dateObs').val();
        var numFiche=$('#numFiche').val();
        var idcollectionsite=$('#idcollectionsite').val();
        var data="collecteur="+collecteur+"&site="+site+"&datecollect="+datecollect+"&numFiche="+numFiche+"&idcollectionsite="+idcollectionsite;

        if(collecteur==''||site==''||datecollect==''||numFiche==''){
            notification('vide');
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type: "POST",
                url:'./gestionSite/collection/enregistrement.php',
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps ").load("./gestionSite/collection/listeCollection.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps ").load("./gestionSite/collection/listeCollection.php");
                        notification(1);
                    }

                }
            });
        }
    });

    function MettreFocus(){

        var collecteur=$('#nomCollecteur');
        var site=$('#nomSite');
        var datecollect=$('#dateObs');
        var numFiche=$('#numFiche');

        if(collecteur.val()==''){
            collecteur.css('background-color', '#FDD');
        }else{
            collecteur.removeAttrs('style');
        }

        if(site.val()==''){
            site.css('background-color', '#FDD');
        }else{
            site.removeAttrs('style');
        }

        if(datecollect.val()==''){

            datecollect.css('background-color', '#FDD');
        }else{
            datecollect.removeAttrs('style');
        }

        if(numFiche.val()==''){
            numFiche.css('background-color', '#FDD');
        }else{
            numFiche.removeAttrs('style');
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