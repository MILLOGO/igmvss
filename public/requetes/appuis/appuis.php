<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 10/08/2018
 * Time: 20:31
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
    <form action="" id="RequeteApui">
        <div class="col-md-3 col-lg-3 col-sm-3">
            <fieldset>
                <legend>Projet Opérateur</legend>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="nomPro">Projet</label>
                        <select class="formulaire" id="nomPro" name="nomPro">
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
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="nomOpt">Opérateur</label>
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
                <legend>Gestionnaire</legend>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="typeGest">Type de gestionnaire</label><br>
                        <select name="typeGest" id="typeGest" class="formulaire">
                            <option value="">Sélectionner le type </option>
                            <option value="1">Individuel </option>
                            <option value="2">Collectif </option>
                        </select>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="nomGest">Nom du Gestionnaire</label><br>
                        <select name="nomGest" id="nomGest" class="formulaire">
                            <option value="">Sélectionner le gestionnaire </option>
                        </select>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
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
                    <div class="col-lg-6 col-md-6 col-sm-6" id="blocRegion">
                        <select id="region" name="region" class="formulaire" title="sélectionner une région">
                            <option value="">Selectionner une région</option>
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
                    <div class="col-lg-6 col-md-6 col-sm-6" id="blocCommune">

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
                <legend>Période</legend>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <label for="debut">Début</label><br>
                        <input id="debut" class="formulaire calendrier">
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <label for="fin">Fin</label><br>
                        <input id="fin" class="formulaire calendrier">
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
                        <legend>Appuis</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    Cette requête permet de lister les appuis (et type d’appui):<br />
                                    o	Par unité géographique <br />
                                    o	Par opérateur <br />
                                    o	Par projet <br />
                                    o	Par gestionnaire <br />
                                    o	Par type de gestionnaire (individuel ou collectif)<br />
                                    o	Par période <br />
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

    $('#typeGest').change(function(){
        var valeur= $(this).val();
        var data='type='+valeur;
        $.ajax({
            type:"GET",
            url: "<?php echo $RACINE_REQUETES;?>requetes/traitement.php",
            data:data,
            success: function(server_repond){
                $('#nomGest').html(server_repond).show();
            }
        });
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

        var nomOpt=$('#nomOpt').val();
        var region=$('#region').val();
        var province=$('#province').val();
        var commune=$('#commune').val();
        var localite=$('#localite').val();
        var projet=$('#nomPro').val();
        var type=$('#typeGest').val();
        var gestionnaire=$('#nomGest').val();
        var debut=$('#debut').val();
        var fin=$('#fin').val();

        var data="projet="+projet+"&nomOpt="+nomOpt+"&region="+region+"&province="+province+"&commune="+commune+"&localite="+localite+"&gestionnaire="+gestionnaire+
            "&type="+type+"&debut="+debut+"&fin="+fin;
        $.ajax({
            type: "GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/appuis/traitementRecherche.php",
            data:data,
            success: function(reponse){
                $('#resultat').html(reponse).show();
            }
        });
    });


    $('#Reinitialiser').click(function(){
        effacer("RequeteApui");
    });

    function effacer(idformulaire){
        $(':input','#'+idformulaire)
            .not(':button, :submit, :hidden, :reset')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    }
</script>
