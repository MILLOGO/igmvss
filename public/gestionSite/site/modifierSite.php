<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 19/07/2018
 * Time: 09:49
 */
include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$id="";
if(isset($_POST['idsite'])){
    $id=$_POST['idsite'];
}
/*else{
    if($_POST){
        $nomGest=strip_tags($_POST['idgest']);
        $reconnait=strip_tags(($_POST['reconnais']));
        $exploitat=strip_tags(($_POST['exploite']));
        $vocation=strip_tags($_POST['voca']);
        $localite=strip_tags($_POST['local']);
        $nomSite=strip_tags($_POST['libelle']);
        $superficie=strip_tags($_POST['surface']);
        $idsite=strip_tags($_POST['iddusit']);
        $idstatus=strip_tags($_POST['idsta']);
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

        $site=new Bd_GestionSite();
        $status=new Bd_parametre();
        $status->ModifierStatusSite($reconnait,$exploitat, $idstatus);
        $site->ModifierSite($nomSite,$superficie,$nomGest,$vocation,$idsite,$typesite,$typegeom);
        $situer=new Bd_GestionSite();
       $site->ModifierSituerSite($idsite,$localite);

    }
}*/

    $site=Bd_GestionSite::ListerSiteParId($id);

    foreach ($site AS $sit):
?>


<div class="modal" id="updateSite" data-backdrop="static">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification d'un site</span></h3>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" value="<?php echo $sit[1]; ?>" id="idsite">
                    <input type="hidden" value="<?php echo $sit[8]; ?>" id="idstatus">
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
                                                $idreg=$listeRegion[$cle];
                                                $cle=$cle+2;
                                                $nomRegion=$listeRegion[$nom];
                                                $nom=$nom+2;
                                                ?>
                                                <option value="<?php echo $idreg ?>" <?php if($idreg==$sit[21]){ echo 'selected';} ?>><?php echo $nomRegion ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="province">Province <span style="color: red">*</span></label>
                                        <select id="province" name="province" class="formulaire" title="sélectionner une province" onchange="EnleverFocus(this.id)">
                                            <option></option>
                                            <?php
                                            $province=Bd_parametre::ListeProvinceParRegion($sit[21]);
                                            $cle=1;
                                            $nom=3;
                                            foreach($province as $prov):
                                                $idPro=$prov[$cle];
                                                $cle=$cle+3;
                                                $nomProvince=$prov[$nom];
                                                $nom=$nom+3;
                                                ?>
                                                <option value="<?php echo $idPro ?>" <?php if($idPro==$sit[19]){ echo 'selected';} ?>><?php echo $nomProvince ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="commune">Commune <span style="color: red">*</span></label>
                                        <select id="commune" name="commune" class="formulaire" title="sélectionner une commune" onchange="EnleverFocus(this.id)">
                                            <?php
                                            $commune=Bd_parametre::ListeCommuneParProvince($sit[19]);
                                            $cle=1;
                                            $nom=3;
                                            foreach($commune as $com):
                                                $idPro=$com[$cle];
                                                $cle=$cle+7;
                                                $nomCommune=$com[$nom];
                                                $nom=$nom+7;
                                                ?>
                                                <option value="<?php echo $idPro ?>" <?php if($idPro==$sit[18]){ echo 'selected';} ?>><?php echo $nomCommune ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="localite">Localité <span style="color: red">*</span></label>
                                        <select id="localite" name="localite" class="formulaire" title="sélectionner une localité" onchange="EnleverFocus(this.id)">
                                            <?php
                                            $localite = Bd_parametre::ListeLocaliteParCommune($sit[18]);
                                            $cle = 1;
                                            $nom = 3;
                                            foreach ($localite as $loc):
                                                $idCom = $loc[$cle];
                                                $cle = $cle + 3;
                                                $nomLocalite = $loc[$nom];
                                                $nom = $nom + 3;
                                                ?>
                                                <option value="<?php echo $idCom ?>" <?php if($idCom==$sit[16]){ echo 'selected';} ?>><?php echo $nomLocalite ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <label for="nomSite">Nom du site <span style="color: red">*</span></label><br>
                                        <input type="text" id="nomSite" name="nomSite" class="formulaire" value="<?php echo $sit[2];?>" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="typeSite">Type de mesure</label><br>
                                        <select id="typeSite" name="typeSite" class="formulaire" title="sélectionner un type" >
                                            <option value="">Selectionner un type</option>
                                            <option value="1" <?php if($sit[24]=='longueur'){echo 'selected';} ?>>Longueur</option>
                                            <option value="2" <?php if($sit[24]=='superficie'){echo 'selected';} ?>>Superficie</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="superficieSite">Mesure du site(ha/km)</label><br>
                                        <input type="number" id="superficieSite" name="superficieSite" min="0" class="formulaire" value="<?php echo $sit[3];?>">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-5 col-lg-5 col-sm-5">
                            <fieldset>
                                <legend>Status Foncier</legend>
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
                                                <option value="<?php echo $libelle ?>" <?php if($libelle==$sit[11]){echo "selected";};?>><?php echo $libelle ?></option>
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
                                                <option value="<?php echo $libelle ?>" <?php if($libelle==$sit[12]){echo "selected";};?>><?php echo $libelle ?></option>
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
                                            <input type="radio" name="typeGest" id="individuel" value="individuel" <?php if($sit[4]=='individuel'){ echo 'checked';} ?>>
                                            <label for="individuel" class="labelcouleur"> Individuel</label>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                            <input type="radio" name="typeGest" id="collectif" value="collectif" <?php if($sit[4]=='collectif'){ echo 'checked';} ?>>
                                            <label for="collectif" class="labelcouleur"> Collectif</label>
                                        </div>
                                        <input type="hidden" id="Valcocher" value="<?php echo $sit[4] ?>">
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <label for="nomGest">Gestionnaire <span style="color: red">*</span></label><br>
                                        <select class="formulaire" id="nomGest" name="nomGest" onchange="EnleverFocus(this.id)">
                                            <?php
                                            $type=$sit[4];
                                            $idgest=$sit[7];
                                            if($type=='individuel'){
                                                $gestion=Bd_GestionSite::GestionnaireIndividuel();
                                                echo "<option></option>";
                                                    $cle=1;
                                                    $nom=3;
                                                    $pre=4;
                                                    foreach($gestion as $gest):
                                                        $id=$gest[$cle];
                                                        $cle=$cle+10;
                                                        $nomget=$gest[$nom];
                                                        $nom=$nom+10;
                                                        $prenom=$gest[$pre];
                                                        $pre=$pre+10;
                                            ?>
                                               <option value='<?php echo $id; ?>' <?php if($id==$idgest){echo 'selected';} ?>><?php echo $nomget." ".$prenom ?></option>

                                            <?php   endforeach;
                                            }else{
                                                $gestion=Bd_GestionSite::GestionnaireCollectif();
                                                echo "<option></option>";
                                                    $cle=1;
                                                    $nom=7;
                                                    foreach($gestion as $gest):
                                                        $id=$gest[$cle];
                                                        $cle=$cle+10;
                                                        $nomget=$gest[$nom];
                                                        $nom=$nom+10;

                                            ?>
                                            <option value='<?php echo $id; ?>' <?php if($id==$idgest){echo 'selected';} ?>><?php echo $nomget?></option>
                                            <?php endforeach; }?>
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
                                            <option value="<?php echo $id?>" <?php if($id==$sit[13]){echo "selected";};?>><?php echo $nomCat; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <label for="vocationSite">Vocation <span style="color: red">*</span></label>
                                    <select class="formulaire" id="vocationSite" name="vocationSite" onchange="EnleverFocus(this.id)">
                                        <?php   $vocation=Bd_parametre::ListeVocationParCategorie($sit[13]);
                                        $cle=1;
                                        $nomVoc=3;

                                        foreach($vocation AS $voc):
                                        $idv=$voc[$cle];
                                        $cle=$cle+3;
                                        $vocat=$voc[$nomVoc];
                                        $nomVoc=$nomVoc+3;
                                        ?>

                                        <option value='<?php echo $idv  ?>'<?php if($idv==$sit[15]){echo 'selected';} ?>><?php echo $vocat; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-lg-7 col-sm-7">
                            <fieldset id="detailGest">
                                <legend>détail du gestionnaire</legend>
                                <div id="detail">
                                    <?php
                                    $typegestion=$sit[4];
                                    $idgestionnaire=$sit[7];

                                    if($typegestion=='individuel'){
                                        $detailInd=Bd_GestionSite::GestionnaireIndividuelParId($idgestionnaire);
                                        $ty=2;
                                        $no=3; $pre=4; $num=5; $mail=6;

                                        foreach($detailInd as $detail):
                                            $typ=$detail[$ty];
                                            $ty=$ty+10;
                                            $nomges=$detail[$no];
                                            $no=$no+10;
                                            $pren=$detail[$pre];
                                            $pre=$pre+10;
                                            $nume=$detail[$num];
                                            $num=$num+10;
                                            $email=$detail[$mail];
                                            $mail=$mail+10;

                                            echo "<p><span style='color: #006600'>type du gestionnaire:</span> $typ <br><span style='color: #006600'>Nom et Prénom du gestionnaire:
               </span><span class='maj'>$nomges</span> $pren <br> <span style='color: #006600'>Numéro:</span> $nume<br>
               <span style='color: #006600'>Adresse email:</span> $email</p>";
                                        endforeach;
                                    }else{
                                        $detailInd=Bd_GestionSite::GestionnaireCollectifParId($idgestionnaire);
                                        $ty=2;
                                        $no=3; $pre=4; $num=5; $mail=6; $noC=7;

                                        foreach($detailInd as $detail):
                                            $typ=$detail[$ty];
                                            $ty=$ty+10;
                                            $nomges=$detail[$no];
                                            $no=$no+10;
                                            $pren=$detail[$pre];
                                            $pre=$pre+10;
                                            $nume=$detail[$num];
                                            $num=$num+10;
                                            $email=$detail[$mail];
                                            $mail=$mail+10;
                                            $nomcolect=$detail[$noC];
                                            $noc=$noC+10;

                                            echo "<p><span style='color: #006600'>type du gestionnaire:</span> $typ  <br><span style='color: #006600'>Nom du collectif:</span> $nomcolect<br><span style='color: #006600'>Nom et Prénom du contact:
               </span><span class='maj'>$nomges</span> $pren <br> <span style='color: #006600'>Numéro:</span> $nume<br>
               <span style='color: #006600'>Adresse email:</span> $email</p>";
                                        endforeach;
                                    }
                                    ?>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="submit" id="validerSite" name="enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annuler" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div><div id="Etatenregistrement"></div>
<?php endforeach ?>


<script type="application/javascript">

    //$('#detailGest').hide();

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
                $('#superficieSite').attr('placeholder', 'Longueur du site en Km');
            }else{
                //Superficie
                $('#superficieSite').attr('placeholder', 'Superficie du site en Ha');
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
        var idsite=$('#idsite').val();
        var idstatus=$('#idstatus').val();
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
            var donnee="idgest="+nomGest+"&voca="+vocation+"&local="+localite+"&libelle="+site+"&surface="+superficie+
                "&reconnais="+reconnait+"&exploite="+exploit+"&iddusit="+idsite+"&idsta="+idstatus+"&typesite="+typesite;
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