<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/07/2018
 * Time: 16:38
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
    <form action="" id="RequeteGesRev">
        <div class="col-lg-7 col-md-7 col-sm-7">
            <fieldset>
                <legend>Gestionnaire</legend>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="typeGest">Type de gestionnaire</label><br>
                        <select name="typeGest" id="typeGest" class="formulaire">
                            <option value="">Sélectionner le type </option>
                            <option value="1">Individuel </option>
                            <option value="2">Collectif </option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
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
                        <legend>Revenu gestionnaire</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    Cette requête permet de  lister les revenus annuels:<br />
                                    o	Par gestionnaire,<br />
                                    o	Par année<br />
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
    $('#typeGest').change(function(){
        var valeur= $(this).val();
        var data='type='+valeur;
        $.ajax({
            type:"GET",
            url: "<?php echo $RACINE_REQUETES;?>requetes/gestionnaireRevenu/traitement.php",
            data:data,
            success: function(server_repond){
                $('#nomGest').html(server_repond).show();
            }
        });
    });

    $('#valider').click(function(){
        var gestionnaire=$('#nomGest').val();
        var type=$('#typeGest').val();
        var annee=$('#annee').val();
        var data="gestionnaire="+gestionnaire+"&annee="+annee+"&type="+type;
        $.ajax({
            type: "GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/gestionnaireRevenu/traitementRecherche.php",
            data:data,
            success: function(reponse){
                $('#resultat').html(reponse).show();
            }
        });
        //console.log(data);
    });

    $('#Reinitialiser').click(function(){
        effacer("RequeteGesRev");
    });

    function effacer(idformulaire){
        $(':input','#'+idformulaire)
            .not(':button, :submit, :hidden, :reset')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    }
</script>
