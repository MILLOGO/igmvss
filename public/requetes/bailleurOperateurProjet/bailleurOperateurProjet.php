<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 12/08/2018
 * Time: 10:48
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
    <form action="" id="RequeteBaiOpPro">
        <div class="col-md-4 col-lg-4 col-sm-4">
            <fieldset>
                <legend>Bailleur Opérateur Projet</legend>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label for="idBailleur">Bailleur </label>
                        <select name="idBailleur" id="idBailleur" class="formulaire">
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
                                <option value="<?php echo $id; ?>"><?php echo $nom; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="nomOpt">Opérateur</label>
                        <select class="formulaire" id="nomOpt" name="nomOpt">
                            <option value=""></option>

                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="nomPro">Projet</label>
                        <select class="formulaire" id="nomPro" name="nomPro">
                            <option value=""></option>

                        </select>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <fieldset>
                <legend>Aménagement</legend>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" id="blocCategorie">
                        <label for="nomCat">Catégorie aménagement</label>
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
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="amenage">aménagement</label>
                        <select class="formulaire" id="amenage" name="amenage">
                            <option value=""></option>
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
                        <select id="region" name="region" class="formulaire">
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
                        <label for="province">Province</label>
                        <select id="province" name="province" class="formulaire" title="sélectionner une province">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6" id="blocCommune">
                        <label for="communebouton">Commune</label>
                        <select id="commune" name="commune" class="formulaire" title="sélectionner une commune">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6" id="blocLocalite">
                        <label for="localitebouton">Localité</label>
                        <select id="localite" name="localite" class="formulaire" title="sélectionner une localité">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
            </fieldset>
        </div>
        <div >
            <fieldset>
                <legend>Année</legend>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12" id="blocAnnee">
                        <label for="anneebouton">Année</label>
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
<div class="row" id="resultat">

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
                        <legend>Bailleur Opérateur Projet</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                   Cette requête permet de lister les aménagements (type d’aménagement et catégorie d’aménagement):<br />
                                    o	Par Bailleur<br />
                                    o	Par unité géographique (région, province, commune, éventuellement localité)<br />
                                    o	Par année (liste la liste d’aménagement au total et par unité géographique (région, province, commune, localité)<br />
                                    o	Par projet<br />
                                    o	Par opérateur<br />
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
<script type="application/javascript">
    $('#aider').on('click',function(){
        $("#details").modal();
    });

    $('#idBailleur').change(function(){
        var idbailleur=$(this).val();
        var donne="idbailleur="+idbailleur;
        $('#nomOpt').val("");
        $('#nomPro').val("");
        $.ajax({
            type:"GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/traitement.php",
            data:donne,
            success: function(server_response){
                $("#nomOpt").html(server_response).show();
            }
        })
    });

    $('#nomOpt').change(function(){
        var idoperateur=$(this).val();
        var idbailleur=$('#idBailleur').val();
        var donne="idbail="+idbailleur+"&idoperateur="+idoperateur;
        $.ajax({
            type:"GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/traitement.php",
            data:donne,
            success: function(server_response){
                $("#nomPro").html(server_response).show();
            }
        })
    });

    /* debut du traitement des listes selecte*/
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

    $('#nomCat').change(function(){
        var idcat=$(this).val();
        var donne="idcategorie="+idcat;
        $.ajax({
            type:"GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/traitement.php",
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
        var projet=$('#nomPro').val();
        var operateur=$('#nomOpt').val();
        var annee=$('#annee').val();
        var idbailleur=$('#idBailleur').val();

        var data="region="+region+"&province="+province+"&commune="+commune+"&localite="+localite+"&nomcat="+nomCat+"&amenge="+amenage+
            "&projet="+projet+"&operateur="+operateur+"&annee="+annee+"&idbailleur="+idbailleur;

        $.ajax({
            type: "GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/bailleurOperateurProjet/traitementRecherche.php",
            data:data,
            success: function(reponse){
                $('#resultat').html(reponse).show();
            }
        });

        // console.log(data);
    });

    $('#Reinitialiser').click(function(){
        effacer("RequeteBaiOpPro");
    });

    function effacer(idformulaire){
        $(':input','#'+idformulaire)
            .not(':button, :submit, :hidden, :reset')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    }

</script>
