<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 01/08/2018
 * Time: 19:32
 */
include_once('../../../Databases/FichierBD.php');
if($_SESSION){
    $RACINE_REQUETES='';
}
?>
<br>
<div class="row" >
    <input type="button" class="pull-right btn btn-primary" value="Aide" id="aider" style="background-color: #006600; color: #fff">
</div >
<br>
<div class="row zone_filtre">
<div class="col-lg-12 col-md-12 col-sm-12">
    <form id="RequeteProGeo">
    <fieldset>
        <legend>Zone Géographique</legend>
        <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-3" id="blocRegion">
                <label for="region">Région</label><br>
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
            <div class="col-md-3 col-lg-3 col-sm-3" id="blocProvince">
                <label for="province">Province</label><br>
                <select id="province" name="province" class="formulaire" title="sélectionner une province">
                    <option value=""></option>
                </select>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-3" id="blocCommune">
                <label for="commune">Commune</label><br>
                <select id="commune" name="commune" class="formulaire" title="sélectionner une commune">
                    <option value=""></option>
                </select>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-3">
                <label for="">Projet</label><br>
                <input type="checkbox" value="terminer" id="filtre"> <label for="">Terminés</label>
                <input type="checkbox" value="encours" id="filtre"> <label for="">En cours</label>
            </div>
            <input type="button" class="pull-right btn btn-primary" value="Afficher" id="valider" style="margin-top: 20px; margin-right: 20px; background-color: #007fff; border-radius: 0px">
            <input type="button" class="pull-right btn btn-primary" value="Reinitialiser" id="Reinitialiser" style="margin-top: 20px; margin-right: 20px; background-color: #ff0000; border-radius: 0px">
        </div>
    </fieldset>
    </form><br>
</div><br>
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
                        <legend>Projet par zone géographique</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    Cette permet de lister les montants globaux et GMV<br />
                                    8.	Par unité géographique (région, province, commune, éventuellement localité), lister les projets intervenants
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

    /* debut du traitement des listes selecte*/
    $('#region').change(function(){
        var idregion=$(this).val();
        var donne="idregion="+idregion;
        $('#commune').val("");
        //$('#localite').val("");
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


   /* $('#commune').change(function(){
        var idcommune=$(this).val();
        var donne="idcommune="+idcommune;
        $.ajax({
            type:"GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/amenagement/traitement.php",
            data:donne,
            success: function(server_response){
                $("#localite").html(server_response).show();
            }
        })
    });*/

    /*fin du traitement*/
    $('#valider').click(function(){
        var region=$('#region').val();
        var province=$('#province').val();
        var commune=$('#commune').val();
        var filtrer =[];
        $('#filtre:checked').each(function(){
            filtrer.push($(this).val());
        });
        var data="region="+region+"&province="+province+"&commune="+commune+"&filtre="+filtrer;
        $.ajax({
            type: "GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/projetParGeographie/traitementRecherche.php",
            data:data,
            success: function(reponse){
                $('#resultat').html(reponse).show();
            }
        });
    });

    $('#Reinitialiser').click(function(){
        effacer("RequeteProGeo");
    });

    function effacer(idformulaire){
        $(':input','#'+idformulaire)
            .not(':button, :submit, :hidden, :reset')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    }
</script>