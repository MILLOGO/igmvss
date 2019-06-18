<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 15/07/2018
 * Time: 08:24
 */
include_once('../../../Databases/FichierBD.php');
if($_SESSION){
    $RACINE_REQUETES='';
}
//echo $RACINE_REQUETES;
?>
<br>
<div class="row" >
    <input type="button" class="pull-right btn btn-primary" value="Aide" id="aider" style="background-color: #006600; color: #fff">
</div >
<br>
<div class="row zone_filtre">
    <form id="RequeteAmenagement">
            <div class="col-lg-5 col-md-5 col-sm-5">
                <fieldset>
                    <legend>Aménagement</legend>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="nomCat">Catégorie aménagement</label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="amenage">aménagement</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6" id="blocCategorie">
                            <?php
                            $categorie=Bd_parametre::ListeCatAmenagement();
                            $id=1;
                            $no=2;
                            ?>
                            <select class="formulaire" name="nomCat" id="nomCat">
                                <option value="">Sélectionner la catégorie</option>
                                <?php
                                foreach ($categorie as $tab):
                                    $pri=$tab[$id];
                                    $id=$id+2;
                                    $libelle=$tab[$no];
                                    $no=$no+2;
                                    ?>
                                    <option value="<?php echo $pri;?>"><?php echo $libelle;?></option>
                                    <?php
                                endforeach
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6" id="blocAmenagement">

                            <select class="formulaire" id="amenage" name="amenage">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <fieldset>
                    <legend>Zone Géographique</legend>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-3" id="blocRegion">
                            <label for="region">Région</label><br>
                            <select id="region" name="region" class="formulaire" title="sélectionner une région">
                                <option value="">Sélectionner la région</option>
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
                        <div class="col-md-3 col-lg-3 col-sm-3" id="blocLocalite">
                            <label for="localite">Localité</label><br>
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
                            <label for="anneebouton">Année</label>
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
                        <legend>Aménagement</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    Cette requête permet de lister la superficie totale: <br />
                                    Par aménagement (type d’aménagement et catégorie d’aménagement), <br />
                                    Par unité géographique (région, province, commune, localité) <br />
                                    Par année.
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

    /* debut du traitement des listes selecte*/
    $('#region').change(function(){
        var idregion=$(this).val();
        var donne="idregion="+idregion;
        $('#commune').val("");
        $('#localite').val("");
        $.ajax({
            type:"GET",
           // url: "<?php echo $RACINE_REQUETES ?>/traitement.php",
            url: "<?php echo $RACINE_REQUETES ?>requetes/amenagement/traitement.php",
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
            url:"<?php echo $RACINE_REQUETES;?>requetes/amenagement/traitement.php",
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
            url:"<?php echo $RACINE_REQUETES;?>requetes/amenagement/traitement.php",
            data:donne,
            success: function(server_response){
                $("#localite").html(server_response).show();
            }
        })
    });

    $('#nomCat').change(function(){
        var idcat=$(this).val();
        var donne="idcategorie="+idcat;
        $.ajax({
            type:"GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/amenagement/traitement.php",
            data:donne,
            success: function(reponse){
                $('#amenage').html(reponse).show();

            }
        });
    });



    /*fin du traitement*/

    $('#valider').click(function(){
        var region=$('#region').val();
        var province=$('#province').val();
        var commune=$('#commune').val();
        var nomCat=$('#nomCat').val();
        var amenage=$('#amenage').val();
        var localite=$('#localite').val();
        var annee=$('#annee').val();

        var data="region="+region+"&province="+province+"&commune="+commune+"&localite="+localite+"&nomcat="+nomCat+"&amenge="+amenage+"&annee="+annee;

        $.ajax({
            type: "GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/amenagement/traitementRecherche.php",
            data:data,
            success: function(reponse){
                $('#resultat').html(reponse).show();
            }
        });

    });

    $('#Reinitialiser').click(function(){
        effacer("RequeteAmenagement");
    });
    function effacer(idformulaire){
        $(':input','#'+idformulaire)
            .not(':button, :submit, :hidden, :reset')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    }

    $('#aider').on('click',function(){
        $("#details").modal();
    });
</script>
