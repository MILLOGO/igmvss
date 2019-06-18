<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 06/07/2018
 * Time: 14:15
 */
include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

?>


<div class="modal" id="newsite" data-backdrop="static">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'un site</span></h3>
            </div>
            <div class="modal-body">
            <form method="post" action="">
                <div class="row">
                    <div class="col-md-7 col-lg-7 col-sm-7">
                        <fieldset>
                            <legend>Localisation du site</legend>
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
                                        <option value="<?php echo $id ?>"><?php echo $nomRegion ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <label for="province">Province <span style="color: red">*</span></label>
                                    <select id="province" name="province" class="formulaire" title="sélectionner une province" onchange="EnleverFocus(this.id)">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <label for="commune">Commune <span style="color: red">*</span></label>
                                    <select id="commune" name="commune" class="formulaire" title="sélectionner une commune" onchange="EnleverFocus(this.id)">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <label for="localite">Localité <span style="color: red">*</span></label>
                                    <select id="localite" name="localite" class="formulaire" title="sélectionner une localité" onchange="EnleverFocus(this.id)">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <label for="nomSite">Nom du site <span style="color: red">*</span></label><br>
                                    <input type="text" id="nomSite" name="nomSite" class="formulaire" placeholder="Nom du site" onchange="EnleverFocus(this.id)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <label for="typeSite">Type de mesure</label><br>
                                    <select id="typeSite" name="typeSite" class="formulaire" title="sélectionner un type">
                                        <option value="">Selectionner un type</option>
                                        <option value="1">Longueur</option>
                                        <option value="2">Superficie</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <label for="superficieSite">Mesure du site(ha/km)</label><br>
                                    <input type="number" id="superficieSite" name="superficieSite" min="0" class="formulaire" placeholder="Mesure du site">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-5">
                        <fieldset>
                            <legend>Statut Foncier</legend>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <label for="reconnait">Reconnaissance légale <span style="color: red">*</span></label><br>
                                    <select class="formulaire" id="reconnait" name="reconnait" onchange="EnleverFocus(this.id)">
                                        <option value=""></option>
                                        <?php $exploit=Bd_parametre::ListeReconnaissance();
                                        $i=2;
                                        foreach($exploit as $exploitation):
                                            $libelle=$exploitation[$i];
                                            $i=$i+2;
                                            ?>
                                            <option value="<?php echo $libelle ?>"><?php echo $libelle ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <label for="exploit">Type d'exploitation <span style="color: red">*</span></label><br>
                                    <select class="formulaire" id="exploit" name="exploit" onchange="EnleverFocus(this.id)">
                                        <option value=""></option>
                                        <?php $exploit=Bd_parametre::ListeExploitation();
                                            $i=2;

                                            foreach($exploit as $exploitation):
                                                $libelle=$exploitation[$i];
                                                $i=$i+2;
                                        ?>
                                                <option value="<?php echo $libelle ?>"><?php echo $libelle ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div><br><br>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 col-lg-7 col-sm-7">
                        <fieldset>
                            <legend>Gestionnaire</legend>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <input type="radio" name="typeGest" id="individuel" value="individuel">
                                        <label for="individuel" class="labelcouleur"> Individuel</label>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <input type="radio" name="typeGest" id="collectif" value="collectif">
                                        <label for="collectif" class="labelcouleur"> Collectif</label>
                                    </div>
                                    <input type="hidden" id="Valcocher" value="">
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <label for="nomGest">Gestionnaire <span style="color: red">*</span></label><br>
                                    <select class="formulaire" id="nomGest" name="nomGest" onchange="EnleverFocus(this.id)">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div><br>
                        </fieldset>
                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-5">
                        <fieldset>
                            <legend>Vocation</legend>
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <label for="catVocation">Catégorie de la vocation <span style="color: red">*</span></label><br>
                                <select id="catVocation" class="formulaire" name="catVocation" onchange="EnleverFocus(this.id)">
                                    <option></option>
                                    <?php $catego=Bd_parametre::ListeCatVocation();
                                        $cle=1;
                                        $nom=2;

                                    foreach($catego as $categorie):
                                        $id=$categorie[$cle];
                                        $cle=$cle+2;
                                        $nomCat=$categorie[$nom];
                                        $nom=$nom+2;
                                    ?>
                                    <option value="<?php echo $id?>"><?php echo $nomCat; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <label for="vocationSite">Vocation <span style="color: red">*</span></label>
                                <select class="formulaire" id="vocationSite" name="vocationSite" onchange="EnleverFocus(this.id)">
                                    <option value=""></option>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 col-lg-7 col-sm-7">
                        <fieldset id="detailGest">
                            <legend>detail du gestionnaire</legend>
                            <div id="detail"></div>
                        </fieldset>
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="submit" id="validerSite" name="enregistrer"  value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annuler" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div><div id="Etatenregistrement"></div>

<?php
    /*
if($_POST){
    $nomGest=strip_tags($_POST['nomGest']);
    $reconnait=strip_tags(($_POST['reconnaissance']));
    $exploitat=strip_tags(($_POST['exploitation']));
    $vocation=strip_tags($_POST['vocationSit']);
    $localite=strip_tags($_POST['localite']);
    $nomSite=strip_tags($_POST['nomSite']);
    $superficie=strip_tags($_POST['superficie']);
    $typesite=strip_tags($_POST['typesite']);

    if($typesite=='longueur'){
        $typegeom='Ligne';
    }else{
        if($typesite=='superficie'){
            $typegeom='Polygone';
        }else{
            $typegeom='Point';
        }
    }

    if($superficie==''){
       $superficie=0;
    }
    $site=new Bd_GestionSite();
    $status=new Bd_parametre();
    $status->InsererStatusFoncier($reconnait,$exploitat);
    $idfoncier=$status->RecupererIdStatusFoncier();
    $site->InsererSite($nomGest,$idfoncier,$vocation,$nomSite,$superficie,$typesite,$typegeom);
    $idsite=$site->RecupererIdSite();
    $site->InsererSituerSiteLocalite($localite,$idsite);
}*/
?>

<script type="application/javascript">

    $('#detailGest').hide();

    $('#region').change(function(){
        var idregion=$(this).val();
        var donne="idregion="+idregion;
        $('#commune').val("");
        $('#localite').val("");
        $.ajax({
            type:"GET",
            url:"./gestionSite/site/traitement.php",
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
            url:"./gestionSite/site/traitement.php",
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
            url:"./gestionSite/site/traitement.php",
            data:donne,
            success: function(server_response){
                $("#localite").html(server_response).show();
            }
        })
    });

    $('#catVocation').change(function(){
       var idcat=$(this).val();
        var donne="idcategorie="+idcat;
        $.ajax({
            type:"GET",
            url:"./gestionSite/site/traitement.php",
            data:donne,
            success: function(reponse){
                $('#vocationSite').html(reponse).show();

            }
        })
    });

    $('#individuel').click(function(){
        var type=$(this).val();
        var data="type="+type;
        document.getElementById("Valcocher").setAttribute("value",'individuel');
        $('#detailGest').hide();
        $.ajax({
            type:"GET",
            url: "./gestionSite/site/traitement.php",
            data:data,
            success: function(server_repond){
                $('#nomGest').html(server_repond).show();
            }
        });
    });

    $('#collectif').click(function(){
        document.getElementById("Valcocher").setAttribute("value",'collectif');
        $('#detailGest').hide();
        var type=$(this).val();
        var data="type="+type;
        $.ajax({
            type:"GET",
            url: "./gestionSite/site/traitement.php",
            data:data,
            success: function(server_repond){
                $('#nomGest').html(server_repond).show();
            }
        });
    });

    $('#nomGest').change(function(){
        var id=$(this).val();
        var type=$('#Valcocher').val();
        var data="idgest="+id+"&typegest="+type;
        $.ajax({
            type:"GET",
            url:"./gestionSite/site/traitement.php",
            data:data,
            success: function(reponse){
                $('#detailGest').show();
                $('#detail').html(reponse).show();
            }
        });
    });

    //choix du type de mesure du site
    $('#typeSite').change(function(){
        var valeur=$(this).val();
        if(valeur!=''){
            if(valeur==1){
                //longueur
                $('#superficieSite').attr('placeholder', 'Mesure en Km');
            }else{
                //Superficie
                $('#superficieSite').attr('placeholder', 'Mesure en Ha');
            }
        }else{
            $('#superficieSite').attr('placeholder', 'Mesure du site');
        }
    });

    $('#validerSite').click(function(){
        var nomGest=$('#nomGest').val();
        var exploit=$('#exploit').val();
        var reconnait=$('#reconnait').val();
        var vocation=$('#vocationSite').val();
        var localite=$('#localite').val();
        var site=$('#nomSite').val();
        var superficie=$('#superficieSite').val();
        var typesite=$('#typeSite').val();

        if(nomGest==''||reconnait==''||exploit==''||vocation==''||localite==''||site==''){
            notification("vide");
            MettreFocus();
        }else{
            if(typesite==1){
                typesite='longueur';
            }else{
                if(typesite==2){
                    typesite='superficie';
                }else{
                    typesite='inconnu';
                }

            }
            $(this).attr('data-dismiss', 'modal');
            var donnee="nomGest="+nomGest+"&vocationSit="+vocation+"&localite="+localite+"&nomSite="+site+"&superficie="+superficie+"&reconnaissance="+reconnait+"&exploitation="+exploit+"&typesite="+typesite+"&type=ajout";
            $.ajax({
                type:"POST",
                url:"./gestionSite/site/enregistrement.php",
                data:donnee,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $('#corps').load("./gestionSite/site/listeSite.php");
                        etatdeinsertion("echec");
                    }else{
                        $('#corps').load("./gestionSite/site/listeSite.php");
                        notification(1);
                    }

                }
            });

        }
    });

    function MettreFocus(){

        var nomGest=$('#nomGest');
        var exploit=$('#exploit');
        var reconnait=$('#reconnait');
        var vocation=$('#vocationSite');
        var localite=$('#localite');
        var site=$('#nomSite');
        var catvo=$('#catVocation');
        var commune=$('#commune');
        var province=$('#province');
        var region=$('#region');

        if(region.val()==''){
            region.css('background-color', '#FDD');
        }else{
            region.removeAttrs('style');
        }

        if(province.val()==''){
            province.css('background-color', '#FDD');
        }else{
            province.removeAttrs('style');
        }

        if(commune.val()==''){
            commune.css('background-color', '#FDD');
        }else{
            commune.removeAttrs('style');
        }


        if(catvo.val()==''){
            catvo.css('background-color', '#FDD');
        }else{
            catvo.removeAttrs('style');
        }

        if(nomGest.val()==''){
            nomGest.css('background-color', '#FDD');
        }else{
            nomGest.removeAttrs('style');
        }

        if(exploit.val()==''){
            exploit.css('background-color', '#FDD');
        }else{
            exploit.removeAttrs('style');
        }

        if(reconnait.val()==''){
            reconnait.css('background-color', '#FDD');
        }else{
            reconnait.removeAttrs('style');
        }

        if(vocation.val()==''){
            vocation.css('background-color', '#FDD');
        }else{
            vocation.removeAttrs('style');
        }

        if(localite.val()==''){
            localite.css('background-color', '#FDD');
        }else{
            localite.removeAttrs('style');
        }

        if(site.val()==''){
            site.css('background-color', '#FDD');
        }else{
            site.removeAttrs('style');
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