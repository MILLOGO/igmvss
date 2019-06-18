<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/07/2018
 * Time: 12:20
 */
include_once('../../../Databases/FichierBD.php');
if($_SESSION){
    $RACINE_REQUETES='';
}
?><br>
<div class="row" >
    <input type="button" class="pull-right btn btn-primary" value="Aide" id="aider" style="background-color: #006600; color: #fff">
</div >
<br>
<div class="row zone_filtre">
    <form action="" id="RequeteOpMont">
        <div class="col-md-3 col-lg-3 col-sm-3">
            <fieldset>
                <legend>Opérateur</legend>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" id="blocProjet">
                        <label for="nomOpt">Opérateur</label><br>
                        <select class="formulaire" id="nomOpt" name="nomOpt">
                            <option value="">Sélectionner l'opérateur</option>
                            <?php
                            $operateur=Bd_GestionProjetActeur::ListerTousOperateur();
                            $cle=1; $nom=2;
                            foreach($operateur as $Opt):
                                $id=$Opt[$cle];
                                $cle=$cle+8;
                                $nomOpt=$Opt[$nom];
                                $nom=$nom+8;
                                ?>
                                <option value="<?php echo $id ?>"><?php echo $nomOpt; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <fieldset>
                <legend>Bailleur</legend>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" id="blocBailleur">
                        <label for="champBailleur">Nom du bailleur</label><br>
                        <select name="listeBailleur" id="listeBailleur" class="formulaire">
                            <option value="">Sélectionner un bailleur </option>
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
            </fieldset>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5">
            <fieldset>
                <legend>Zone Géographique</legend>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="regionbouton">Région</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="provincebouton">Province</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6" >
                        <select id="region" name="region" class="formulaire" title="sélectionner une région">
                            <option value=""></option>
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
                    <div class="col-lg-6 col-md-6 col-sm-6" id="blocProvince">
                        <select id="province" name="province" class="formulaire" title="sélectionner une province">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="communebouton">Commune</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="localitebouton">Localité</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">

                        <select id="commune" name="commune" class="formulaire" title="sélectionner une commune">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6" id="blocLocalite">
                        <select id="localite" name="localite" class="formulaire" title="sélectionner une localité">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend>Année</legend>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <label for="annee">Année</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12" id="blocAnnee">
                        <select class="formulaire" name="annee" id="annee">
                            <option value="" ></option>
                            <?php
                                 $annedepar=2000;
                                 $anneeactuel=date('Y');

                                 for($i=1; $i<=50; $i++){
                                     ?>
                                     <option value="<?php $annee=$annedepar+$i; echo $annee; ?>" > <?php echo $annee; ?></option>
                                 <?php }?>
                        </select>
                    </div>
                </div>
            </fieldset>
        </div>

    </form>
    <input type="button" class="pull-right btn btn-primary" value="Afficher" id="valider" style="margin-top: 20px; margin-right: 20px; background-color: #007fff; border-radius: 0px">
    <input type="button" class="pull-right btn btn-primary" value="Reinitialiser" id="Reinitialiser" style="margin-top: 20px; margin-right: 20px; background-color: #ff0000; border-radius: 0px">
</div>
<div class="modal" id="details" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Aide</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <fieldset>
                        <legend>Opérateur bailleur</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                 Cette requête permet de  lister les montants
                                    o	Par opérateur<br />
                                    o	Par année<br />
                                    o	Par bailleur<br />
                                    o	Par unité géographique (région, province, commune,  localité)<br />

                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="annuler" name="fermer" data-dismiss="modal" value="J'ai compris" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
<div class="row" id="resultat">

</div>
<script type="application/javascript">

    $('#aider').on('click',function(){
        $("#details").modal();
    });

    $( ".calendrier" ).datepicker({
        onClose: function (selectedDate) {
        }
    });

    $('#region').change(function(){
        var idregion=$(this).val();
        var donne="idregion="+idregion;
        $('#commune').val("");
        $('#localite').val("");
        $.ajax({
            type:"GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/traitement.php",
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
            url:"<?php echo $RACINE_REQUETES;?>requetes/traitement.php",
            data:donne,
            success: function(server_response){
                $("#commune").html(server_response).show();
            }
        })
    });

    $('#commune').change(function(){
        var idcommune=$(this).val();
        var donne="idcommune="+idcommune;
        $.ajax({
            type:"GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/traitement.php",
            data:donne,
            success: function(server_response){
                $("#localite").html(server_response).show();
            }
        })
    });

    $('#valider').click(function(){
        var bailleur=$('#listeBailleur').val();
        var nomOpt=$('#nomOpt').val();
        var region=$('#region').val();
        var province=$('#province').val();
        var commune=$('#commune').val();
        var localite=$('#localite').val();
        var annee=$('#annee').val();
       // var bail=$('#champBailleur').text();
        var data="bailleur="+bailleur+"&nomOpt="+nomOpt+"&region="+region+"&province="+province+"&commune="+commune+"&localite="+localite+"&anne="+annee;
        $.ajax({
            type: "GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/operateurmontant/traitementRecherche.php",
            data:data,
            success: function(reponse){
                $('#resultat').html(reponse).show();
            }
        });

        console.log(data);
    });

    $('#Reinitialiser').click(function(){
        effacer("RequeteOpMont");
    });

    function effacer(idformulaire){
        $(':input','#'+idformulaire)
            .not(':button, :submit, :hidden, :reset')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    }
</script>
