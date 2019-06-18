<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 24/07/2018
 * Time: 21:05
 */
include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idam='';
$info='';
if(isset($_POST['idamenager']) && $_POST['idprojet']){
    $idam=$_POST['idamenager'];
    $idpro=$_POST['idprojet'];
}/*else{
 if($_POST) {
     $operateur = strip_tags($_POST['operateur']);
     $projet = strip_tags($_POST['projet']);
     $site = strip_tags($_POST['site']);
     $amenge = strip_tags($_POST['amenge']);
     $datedebut = strip_tags($_POST['datedebut']);
     $datefin = strip_tags($_POST['datefin']);
     $superCible = strip_tags($_POST['superCible']);
     $typesite = strip_tags($_POST['typesite']);
     //$pfnl = strip_tags($_POST['pfnl']);
     $espece = strip_tags($_POST['espece']);
     $vegetal = strip_tags($_POST['vegetalisation']);
     $nbreE = strip_tags($_POST['nbreE']);
     $nbreV = strip_tags($_POST['nbreV']);
     $quantite = strip_tags($_POST['qte']);
     $semi = strip_tags($_POST['semi']);
     $survi = strip_tags($_POST['survi']);
     $repri = strip_tags($_POST['repris']);
     $idamenager= strip_tags($_POST['idamen']);


     $Amenager = new Bd_GestionAmenagement();
         if ($projet == '') {
             $projet = -1;
         }

     $Amenager->ModifierAmenager($amenge, $site, $operateur, $superCible, $datedebut, $datefin, $projet,$idamenager,$typesite);
     $Amenager->supprimeEspeceAmenager($idamenager);
     $Amenager->supprimeVegetalisationAmenager($idamenager);

     if (!empty($vegetal)){
         $vegetalisation = explode(',', $vegetal);
         for ($i = 0; $i < $nbreV; $i++) {
             if ($vegetalisation[$i] != '') {
                 $Amenager->InsererAmenagerVegetation($idamenager, $vegetalisation[$i]);
             }
         }
     }

     if (!empty($espece)){
         $tableQuatite = explode(",", $quantite);
         $tableEspece = explode(",", $espece);
         $tblesemi = explode(",", $semi);
         $tblerepri = explode(',', $repri);
         $tblesurvi = explode(',', $survi);
         for ($j = 0; $j < $nbreE; $j++) {
             if ($tableEspece[$j] != '' && $tableQuatite[$j] != '') {
                 if ($tblesemi[$j] == '') {
                     $tblesemi[$j] = 0;
                 }
                 if ($tblerepri[$j] == '') {
                     $tblerepri[$j] = 0;
                 }
                 if ($tblesurvi[$j] == '') {
                     $tblesurvi[$j] = 0;
                 }
                 $Amenager->InsererAmenagerEspece($idamenager, $tableEspece[$j], $tableQuatite[$j], $tblesemi[$j], $tblesurvi[$j], $tblerepri[$j]);
             }
         }
     }
 }
}*/ ?>

<div class="modal" id="updateAmenager" data-backdrop="static">
    <div class="modal-dialog" style="width: 65%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification d'un aménagement</span></h3>
            </div>
            <div class="modal-body">
                <form method="post">
                    <?php
                    $tableAmenager='';
                        if($idpro!=-1) {
                            $tableAmenager = Bd_GestionAmenagement::ListeAmenagerParId($idam);
                        }else{
                            $tableAmenager = Bd_GestionAmenagement::ListeAmenagerSansProjetParId($idam);
                        }
                        foreach($tableAmenager as $tableDoner):
                    ?>
                            <input type="hidden" value="<?php echo $tableDoner[1] ?>"  id="idamen">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <fieldset>
                                <legend>Infos générales</legend>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="nomOpt">Nom de l'opérateur <span style="color: red">*</span></label><br>
                                        <select class="formulaire" id="nomOpt" name="nomOpt" onchange="EnleverFocus(this.id)">
                                            <option value="">Sélectionné l'opérateur</option>
                                            <?php
                                            $operateur=Bd_GestionProjetActeur::ListerTousOperateur();
                                            $cle=1; $nom=2;
                                            foreach($operateur as $Opt):
                                                $id=$Opt[$cle];
                                                $cle=$cle+8;
                                                $nomOpt=$Opt[$nom];
                                                $nom=$nom+8;
                                                ?>
                                                <option value="<?php echo $id ?>" <?php if($tableDoner[3]==$id){echo 'selected';} ?>><?php echo $nomOpt; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="nomPro">Nom du projet </label><br>
                                        <select class="formulaire" id="nomPro" name="nomPro">
                                            <option value="">Sélectionné le projet</option>
                                            <?php
                                            $operateur=Bd_GestionProjetActeur::ListerTousProjet();
                                            $cle=1; $nom=2;
                                            foreach($operateur as $Opt):
                                                $id=$Opt[$cle];
                                                $cle=$cle+12;
                                                $nomOpt=$Opt[$nom];
                                                $nom=$nom+12;
                                                ?>
                                                <option value="<?php echo $id ?>" <?php if($tableDoner[7]==$id){echo 'selected';} ?>><?php echo $nomOpt; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="nomCat">Nom de la Catégorie <span style="color: red">*</span></label>
                                        <?php
                                        $categorie=Bd_parametre::ListeCatAmenagement();
                                        $id=1;
                                        $no=2;
                                        ?>
                                        <select class="formulaire" name="nomCat" id="nomCat" onchange="EnleverFocus(this.id)">
                                            <option value="">Sélectionné la catégorie</option>
                                            <?php
                                            foreach ($categorie as $tab):
                                                $pri=$tab[$id];
                                                $id=$id+2;
                                                $libelle=$tab[$no];
                                                $no=$no+2;
                                                ?>
                                                <option value="<?php echo $pri;?>" <?php if($tableDoner[12]==$pri){echo 'selected';} ?>><?php echo $libelle;?></option>
                                                <?php
                                            endforeach
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="amenage">Nom aménagement <span style="color: red">*</span></label>
                                        <?php
                                            $amenager = Bd_parametre::ListeAmenagementParCategorie($tableDoner[12]);
                                            $cle = 1;
                                            $nomAm = 3;
                                        ?>
                                        <select class="formulaire" id="amenage" name="amenage" onchange="EnleverFocus(this.id)">
                                            <option value=''>Sélectionné un amenagement</option>
                                            <?php
                                                foreach ($amenager AS $voc):
                                                    $id = $voc[$cle];
                                                    $cle = $cle + 5;
                                                    $amen = $voc[$nomAm];
                                                    $nomAm = $nomAm + 5;
                                                ?>

                                                    <option value="<?php echo $id; ?>" <?php if($id==$tableDoner[11]){ echo 'selected';} ?> ><?php echo $amen; ?></option>
                                             <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="periodeDeb">Date de début <span style="color: red">*</span></label><br>
                                        <input class="formulaire calendrier" id="periodeDeb" name="periodeDeb"
                                               type="text" value="<?php echo $tableDoner[5]; ?>" onchange="EnleverFocus(this.id)">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="periodFin">Date de fin <span style="color: red">*</span></label><br>
                                        <input class="formulaire calendrier" id="periodFin" name="periodFin"
                                               type="text" value="<?php echo $tableDoner[6]; ?>" onchange="EnleverFocus(this.id)">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <fieldset>
                                <legend>Localisation</legend>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="region">Région <span style="color: red">*</span></label>
                                        <?php $parametr=new Bd_parametre();
                                            $idprov=$parametr->RecupererIdProvince($tableDoner[10]);
                                            $idregion=$parametr->RecupererIdRegion($idprov);
                                        ?>
                                        <select id="region" name="region" class="formulaire" title="sélectionner une région" onchange="EnleverFocus(this.id)">
                                            <option value=""></option>
                                            <?php $region=Bd_parametre::ListeRegion();
                                            $cle=1; $nom=2;
                                            foreach($region as $listeRegion):
                                                $id=$listeRegion[$cle];
                                                $cle=$cle+2;
                                                $nomRegion=$listeRegion[$nom];
                                                $nom=$nom+2;
                                                ?>
                                                <option value="<?php echo $id ?>" <?php if($id==$idregion){ echo 'selected';} ?>><?php echo $nomRegion ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="province">Province <span style="color: red">*</span></label>
                                        <select id="province" name="province" class="formulaire" title="sélectionner une province" onchange="EnleverFocus(this.id)">
                                            <option value=""></option>
                                            <?php $province=Bd_parametre::ListeProvinceParRegion($idregion);
                                            $cle=1;
                                            $nom=3;
                                                foreach($province as $prov):
                                                    $id=$prov[$cle];
                                                    $cle=$cle+3;
                                                    $nomProvince=$prov[$nom];
                                                    $nom=$nom+3;
                                            ?>
                                            <option value="<?php echo $id ?>" <?php if($id==$idprov){ echo 'selected';} ?>><?php echo $nomProvince ?></option>
                                         <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="commune">Commune <span style="color: red">*</span></label>
                                        <select id="commune" name="commune" class="formulaire" title="sélectionner une commune" onchange="EnleverFocus(this.id)">
                                            <option value=""></option>
                                            <?php $commune=Bd_parametre::ListeCommuneParProvince($idprov);
                                            $cle=1;
                                            $nom=3;
                                                foreach($commune as $com):
                                                    $id=$com[$cle];
                                                    $cle=$cle+7;
                                                    $nomCommune=$com[$nom];
                                                    $nom=$nom+7;
                                            ?>
                                            <option value='<?php echo $id ?>' <?php if($id==$tableDoner[10]){ echo 'selected';} ?>><?php echo $nomCommune ?></option>
                                        <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <label for="localite">Localité <span style="color: red">*</span></label>
                                        <select id="localite" name="localite" class="formulaire" title="sélectionner une localité" onchange="EnleverFocus(this.id)">
                                            <option value=""></option>
                                            <?php
                                            $localite = Bd_parametre::ListeLocaliteParCommune($tableDoner[10]);
                                            $cle = 1;
                                            $nom = 3;
                                                foreach ($localite as $loc):
                                                    $id = $loc[$cle];
                                                    $cle = $cle + 3;
                                                    $nomLocalite = $loc[$nom];
                                                    $nom = $nom + 3;
                                                    echo "";
                                            ?>
                                            <option value='<?php echo $id ?>' <?php if($id==$tableDoner[14]){ echo 'selected';} ?>><?php echo $nomLocalite ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <label for="nomSite">Nom du site <span style="color: red">*</span></label><br>
                                        <select class="formulaire" id="nomSite" name="nomSite" onchange="EnleverFocus(this.id)">
                                            <option value="">Sélectionné le site</option>
                                            <?php
                                            $site = Bd_GestionSite::ListerSiteParLocalite($tableDoner[14]);
                                            $cle = 1;
                                            $nom = 6;
                                                foreach ($site as $loc):
                                                    $id = $loc[$cle];
                                                    $cle = $cle + 7;
                                                    $nomsite = $loc[$nom];
                                                    $nom = $nom + 7;
                                            ?>
                                            <option value='<?php echo $id ?>' <?php if($id==$tableDoner[2]){ echo 'selected';} ?>><?php echo $nomsite ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="typesiteamen">Type d'aménagement <span style="color: red">*</span></label><br>
                                        <select class="formulaire" id="typesiteamen" name="typesiteamen" onchange="EnleverFocus(this.id)">
                                            <?php if($tableDoner[15]=='longueur'){?>
                                                <option value="longueur" <?php if($tableDoner[16]=='longueur'){echo 'selected';}?>>Longueur</option>
                                            <?php }else{ ?>
                                                <option value="longueur" <?php if($tableDoner[16]=='longueur'){echo 'selected';}?>>Longueur</option>
                                                <option value="superficie" <?php if($tableDoner[16]=='superficie'){echo 'selected';}?>>Superficie</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="superCible">Mesure Ciblée <span style="color: red">*</span></label>
                                        <input id="superCible" class="formulaire" name="superCible" type="number" min="0" value='<?php echo $tableDoner[4] ?>' onchange="EnleverFocus(this.id)">
                                        <div id="validsuper">
                                            <input id='Cible' class='formulaire' name='Cible' type='hidden' value='<?php echo $tableDoner[9] ?>'>
                                            <input id='type' class='formulaire' name='type' type='hidden' value='<?php echo $tableDoner[15] ?>'>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $tableDoner[13]?>" id="verifInfo">
                    <?php  $info=$tableDoner[13]; /*if($tableDoner[13]==1){*/?>
                      <fieldset id="information">
                        <legend>Informations Spécifiques</legend>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <fieldset id="zoneEspece">
                                    <legend >Espèce</legend><br>
                                    <select id="espece" name="espece" class="formulaire">
                                        <option value="" id="premier">Sélectionner une espèce</option>
                                        <?php $espece=Bd_parametre::ListeEspece();
                                        $cle=1; $nom=2;
                                        foreach($espece as $epece):
                                            $id=$epece[$cle];
                                            $cle=$cle+3;
                                            $nomEspec=$epece[$nom];
                                            $nom=$nom+3;
                                            ?>
                                            <option value="<?php echo $id; ?>" id="EspeceN<?php echo $id; ?>"><?php echo $nomEspec; ?></option>
                                        <?php endforeach ?>
                                    </select><br><br>
                                    <div id="donnePlante">
                                        <div class="row">
                                            <div class="col-md-7 col-sm-7 col-lg-7" id="divqte">
                                                <label for="nbrePlant">Nombre de plant utilisé</label><br>
                                                <input type="number" class="formulaire" min="0" id="nbrePlant" name="nbrePlant">
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-lg-5">
                                                <label for="tauxSurvi">Taux de survi</label><br>
                                                <input type="number" class="formulaire" min="0" id="tauxSurvi" name="tauxSurvi">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7 col-sm-7 col-lg-7">
                                                <label for="qteSemi">Quantité de sémis</label><br>
                                                <input type="number" class="formulaire" min="0" id="qteSemi" name="qteSemi">
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-lg-5">
                                                <label for="tauxRepri">Taux de réprise</label><br>
                                                <input type="number" class="formulaire" min="0" id="tauxRepri" name="tauxRepri">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 col-sm-5 col-lg-5"><br>
                                                <input type="button" value="valider" class="btn btn-primary" id="bouton">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12" id="divaffiche">
                                                <label>Espèce nombre qtité semi taux survi  taux répris</label>
                                                <p id="selectEspece">
                                                    <?php
                                                        $i=0;
                                                        $especes=Bd_GestionAmenagement::ListeAmenagerEspeceParIdAmenager($tableDoner[1]);
                                                        $qte=4; $sem=5; $survi=6; $repri=7; $esp=3;
                                                        foreach($especes as $espec):
                                                            $quant=$espec[$qte];
                                                            $qte=$qte+7;
                                                            $tauSemi=$espec[$sem];
                                                            $sem=$sem+7;
                                                            $tauSurvi=$espec[$survi];
                                                            $survi=$survi+7;
                                                            $tauRepri=$espec[$repri];
                                                            $repri=$repri+7;
                                                            $Espec=$espec[$esp];
                                                            $esp=$esp+7;
                                                    ?>
                                                    <a class="amenager" href="#" id="esp<?php echo $i;?>" onclick="Retirer(this.id)">
                                                        <input type="hidden" id="quantite<?php echo $i ?>" value="<?php echo $quant ?>">
                                                        <input type="hidden" id="nbrSemi<?php echo $i ?>" value="<?php echo $tauSemi ?>">
                                                        <input type="hidden" id="nbrsurvi<?php echo $i ?>" value="<?php echo $tauSurvi ?>">
                                                        <input type="hidden" id="nbrrepris<?php echo $i ?>" value="<?php echo $tauRepri ?>">
                                                        <input type="hidden" id="espece<?php echo $i ?>" value="<?php echo $Espec ?>">
                                                        <?php $nom=$parametr->RecupererNomEspece($Espec); ?>
                                                        esp:<?php echo $nom ?> nbre: <?php echo $quant ?>
                                                        <?php if($tauSemi==''){$tauSemi=0; echo "Semi: ".$tauSemi;}else{ echo "Semi: ".$tauSemi;}?>
                                                        <?php if($tauSurvi==''){$tauSurvi=0; echo "survie: ".$tauSurvi;}else{echo "survie: ".$tauSurvi;}?>
                                                        <?php if($tauRepri==''){$tauRepri=0; echo "repri: ".$tauRepri;}else{echo "repri: ".$tauRepri;}?>
                                                        <span class="pull-right"><i class="fa fa-trash" style="color: red"></i></span><br>
                                                    </a>
                                                    <?php $i++; endforeach ?>
                                                    <input type="hidden" id="nbreE" value="<?php echo $i ?>">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <fieldset id="zoneVegetalisation">
                                    <legend >Végétalisation</legend><br>
                                    <select id="vegetal" name="vegetal" class="formulaire">
                                        <option value="">Sélectionner une végétalisation</option>
                                        <?php $vegetalisation=Bd_parametre::ListeVegetalisation();
                                        $cle=1; $nom=2;
                                        foreach($vegetalisation as $vege):
                                            $id=$vege[$cle];
                                            $cle=$cle+3;
                                            $nomVege=$vege[$nom];
                                            $nom=$nom+3;
                                            ?>
                                            <option value="<?php echo $id; ?>" id="vegetalN<?php echo $id; ?>"><?php echo $nomVege; ?></option>
                                        <?php endforeach ?>
                                    </select><br><br>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-lg-12" id="affichV">
                                            <label>Végétalisation sélectionnée</label>
                                            <p id="selectVegetal">
                                                <?php
                                                $i=0;
                                                $vegetals=Bd_GestionAmenagement::ListeAmenagerVegetalisationParIdAmenager($tableDoner[1]);
                                                 $vege=3;
                                                foreach($vegetals as $vegetal):
                                                    $idveg=$vegetal[$vege];
                                                    $vege=$vege+3;
                                                    ?>
                                                    <a class="amenager" href="#" id="vegetalisation<?php echo $i;?>" onclick="Retirer(this.id)">
                                                        <input type="hidden" id="vegetal<?php echo $i;?>" value="<?php echo $idveg;?>">
                                                        <?php $nomV=$parametr->RecupererNomVegetal($idveg);
                                                            echo $nomV;
                                                        ?>
                                                        <span class="pull-right"><i class="fa fa-trash" style="color: red"></i></span><br>
                                                    </a>
                                                    <?php $i++; endforeach ?>
                                                <input type="hidden" id="nbreV" value="<?php echo $i;?>">
                                            </p>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </fieldset>
                        <?php //}
                        endforeach ?>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="submit" id="validerAmenager" name="enregistrer"  value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerAmenager" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
<?php if($info==1){ ?>
<input type="hidden" value="1" id="special">
<?php }else{ ?>
    <input type="hidden" value="" id="special">
<?php }?>
    <div id="cacher"></div>
    <div id="Etatenregistrement"></div>

<script type="application/javascript">

    //fonction de retait des éléments ajouter
    function Retirer(selectorElement){
        $('#'+selectorElement).remove();
    }

    var verifier=$('#verifInfo').val();
    if(verifier==1){
        $('#information').show()
    }else{
        $('#information').hide();
    }

    $('#region').change(function(){
        var idregion=$(this).val();
        var donne="idregion="+idregion;
        $('#commune').val("");
        $('#localite').val("");
        $.ajax({
            type:"GET",
            url:"./gestionAmenagement/amenager/traitement.php",
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
            url:"./gestionAmenagement/amenager/traitement.php",
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
            url:"./gestionAmenagement/amenager/traitement.php",
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
            url:"./gestionAmenagement/amenager/traitement.php",
            data:donne,
            success: function(server_response){
                $("#nomSite").html(server_response).show();
            }
        })
    });

    $('#nomSite').change(function(){
        var idsite=$(this).val();
        var donne="idsite="+idsite;
        $.ajax({
            type:"GET",
            url:"./gestionAmenagement/amenager/traitement.php",
            data:donne,
            success: function(server_response){
                $("#validsuper").html(server_response).show();
                var type=$('#type').val();
                if(type=='longueur'){
                    //longueur
                    //$('#superCible').attr('placeholder', 'Longueur du site en Km');
                    $('#typesiteamen').html('<option value="longueur">Longueur</option>').show;
                }else{
                    //Superficie ou un point
                    $('#typesiteamen').html('<option value="longueur">Longueur</option>'
                        +'<option value="superficie">Superficie</option>');
                    //$('#superCible').attr('placeholder', 'Superficie du site en Ha');
                }

            }
        })
    });

    $( ".calendrier" ).datepicker({
        onClose: function (selectedDate) {
        }
    });



    $('#nomCat').change(function(){
        $('#information').hide();
        var idcat=$(this).val();
        var donne="idcategorie="+idcat;
        $('#special').val("");
        $.ajax({
            type:"GET",
            url:"./gestionAmenagement/amenager/traitement.php",
            data:donne,
            success: function(reponse){
                $('#amenage').html(reponse).show();

            }
        });
    });

    //pour mettre les éléments dans une liste tempon
    $('#espece').change(function(){
        $('#donnePlante').show();
        $('#nbrePlant').val("");
    });


    $('#bouton').on('click',function(){
        var espe= $('#espece').val();
        var dernier=$('#nbreE').val();
        var qte=$('#nbrePlant').val();
        var semi=$('#qteSemi').val();
        var survi=$('#tauxSurvi').val();
        var repris=$('#tauxRepri').val();
        var nom= $('#EspeceN'+espe).text();
        if(espe!="" && qte!='') {
            EnleverFocusBloc('zoneEspece');
            $('#divaffiche').show();
            if(dernier!=0){
                var flag=0;
                for(var i=0; i<dernier; i++){
                    var especechoisi= $('#espece'+i).val();
                    var quantite=$('#quantite'+i).val();
                    //if((espe==especechoisi) && (qte==quantite)){
                    if(espe==especechoisi){
                        flag=1;
                    }else{}
                }
                if(flag!=1){
                    $('#selectEspece').append('<a class="amenager" href="#" id="esp'+dernier+'" onclick="Retirer(this.id)">' +
                        '<input type="hidden" id="quantite'+dernier+'" value="'+qte+'">' +
                        '<input type="hidden" id="nbrSemi'+dernier+'" value="'+semi+'">' +
                        '<input type="hidden" id="nbrsurvi'+dernier+'" value="'+survi+'">' +
                        '<input type="hidden" id="nbrrepris'+dernier+'" value="'+repris+'">' +
                        '<input type="hidden" id="espece'+ dernier+ '" value="' + espe + '">esp:' + nom + ' nbre: '+qte+' semi: '+semi+' survie: '+survi+' repri: '+repris+' ' +
                        '<span class="pull-right"><i class="fa fa-trash" style="color: red"></i></span><br></a>');
                    dernier++;
                    $('#nbreE').val(dernier);
                    $('#nbrePlant').val("");
                    $('#premier').prop("selected","true");
                }else{
                    $.rtnotify({
                        title: "",
                        message: " Cette esp&egrave;ce de plante existe d&eacute;j&agrave; sur la liste",
                        type: "error",
                        permanent: false,
                        timeout: 5,
                        fade: true,
                        width: 300
                    });
                }
            }else{
                $('#selectEspece').append('<a class="amenager" href="#" id="esp'+dernier+'" onclick="Retirer(this.id)">' +
                    '<input type="hidden" id="quantite'+dernier+'" value="'+qte+'">' +
                    '<input type="hidden" id="nbrSemi'+dernier+'" value="'+semi+'">' +
                    '<input type="hidden" id="nbrsurvi'+dernier+'" value="'+survi+'">' +
                    '<input type="hidden" id="nbrrepris'+dernier+'" value="'+repris+'">' +
                    '<input type="hidden" id="espece'+ dernier+ '" value="' + espe + '">esp:' + nom + ' nbre: '+qte+' semi: '+semi+' survie: '+survi+' repri: '+repris+' ' +
                    '<span class="pull-right"><i class="fa fa-trash" style="color: red"></i></span><br></a>');
                dernier++;
                $('#nbreE').val(dernier);
                $('#nbrePlant').val("");
                $('#premier').prop("selected","true");
            }

        }else{
            notification(-1);
        }
    });

    $('#vegetal').change(function(){
        var espe=$(this).val();
        var dernier=$('#nbreV').val();
        var nom= $('#vegetalN'+espe).text();
        $('#affichV').show();
        if(espe!="") {
            EnleverFocusBloc('zoneVegetalisation');
            if(dernier!=0){
                var flag=0;
                for(var i=0; i<dernier; i++){
                    var especechoisi= $('#vegetal'+i).val();
                    //if((espe==especechoisi) && (qte==quantite)){
                    if(espe==especechoisi){
                        flag=1;
                    }else{}
                }
                if(flag!=1){
                    $('#selectVegetal').append('<a class="amenager" href="#" id="vegetalisation'+dernier+'" onclick="Retirer(this.id)">' +
                        '<input type="hidden" id="vegetal' + dernier + '" value="' + espe + '">' + nom + '' +
                        '<span class="pull-right"><i class="fa fa-trash" style="color: red"></i></span><br></a>');
                    dernier++;
                    $('#nbreV').val(dernier);
                }else{
                    $.rtnotify({
                        title: "",
                        message: " Ce type de v&eacute;g&eacute;talisation existe d&eacute;j&agrave; sur la liste",
                        type: "error",
                        permanent: false,
                        timeout: 5,
                        fade: true,
                        width: 300
                    });
                }
            }else{
                $('#selectVegetal').append('<a class="amenager" href="#" id="vegetalisation'+dernier+'" onclick="Retirer(this.id)">' +
                    '<input type="hidden" id="vegetal' + dernier + '" value="' + espe + '">' + nom + '' +
                    '<span class="pull-right"><i class="fa fa-trash" style="color: red"></i></span><br></a>');
                dernier++;
                $('#nbreV').val(dernier);
            }

        }
    });

    /*$('#vegetal').change(function(){
        var espe=$(this).val();
        var dernier=$('#nbreV').val();
        var nom= $('#vegetalN'+espe).text();
        $('#affichV').show();
        if(espe!="") {
            $('#selectVegetal').append('<a class="amenager" href="#" id="vegetalisation'+dernier+'" onclick="Retirer(this.id)">' +
                '<input type="hidden" id="vegetal' + dernier + '" value="' + espe + '">' + nom + '' +
                '<span class="pull-right"><i class="fa fa-trash" style="color: red"></i></span><br></a>');
            dernier++;
            $('#nbreV').val(dernier);
        }
    });*/

    //$('#information').hide();

    $('#amenage').change(function(){
        var id=$(this).val();
        var data="idAm="+id;
        $.ajax({
            type:"GET",
            url:"./gestionAmenagement/amenager/traitement.php",
            data:data,
            success: function(reponse){
                $('#cacher').html(reponse).show();
                var info= $('#elementSelectionne').val();
                if(info==1){
                    $('#information').show();
                    $('#special').val(1);
                }
            }
        });
    });

    $('#validerAmenager').on('click',function(){
        var operateur=$('#nomOpt').val();
        var projet=$('#nomPro').val();
        var site=$('#nomSite').val();
        var amenage=$('#amenage').val();
        var datedebut=$('#periodeDeb').val();
        var datefin=$('#periodFin').val();
        var superCible=$('#superCible').val();
        var idamenager=$('#idamen').val();
        var $typer=$('#typesiteamen').val();
        var special=$('#special').val();
        var nbreE=$('#nbreE').val();
        var nbreV=$('#nbreV').val();
        var espece=[];
        var vegetalisation=[];
        var qte=[];
        var semi=[];
        var survi=[];
        var repris=[];
        if(operateur==''||site==''||amenage==''||datedebut==''||datefin==''||superCible==''){
            notification("vide");
            MettreFocus();
        }else{
            //var $valsaisi=$('#superCible').val();
            var $valeurTmp=$('#Cible').val();
            var diff=1;//valeur pour eviter le test un peu plus bas
            if($valeurTmp!=0){
                diff=$valeurTmp-superCible;
            }
            if($typer=='longueur'){
                var unite='km';
            }else{
                if($typer=='superficie'){
                    var unite='ha';
                }
            }
            if(diff<0){
                alert("La Mesure ciblée ne doit pas être supérieure à la Mesure du site ("+$valeurTmp+' '+unite+")");
                $('#superCible').val("");
            }else {
                if (nbreE != 0) {
                    for (var i = 0; i < nbreE; i++) {
                        var valeur = $('#espece' + i).val();
                        var qtite = $('#quantite' + i).val();
                        var semie = $('#nbrSemi' + i).val();
                        var survis = $('#nbrsurvi' + i).val();
                        var repri = $('#nbrrepris' + i).val();
                        espece.push(valeur);
                        qte.push(qtite);
                        semi.push(semie);
                        survi.push(survis);
                        repris.push(repri);
                    }
                }

                if (nbreV != 0) {
                    for (var j = 0; j < nbreV; j++) {
                        var veget = $('#vegetal' + j).val();
                        vegetalisation.push(veget);
                    }
                }
                if (special == 1) {

                    if ((espece == '' || qte == '') && vegetalisation == '') {
                        notification('default');
                        MettreFocus1(espece,vegetalisation);
                        MettreFocus();
                    } else {
                        $(this).attr('data-dismiss', 'modal');
                        var data = "operateur=" + operateur + "&projet=" + projet + "&site=" + site + "&amenge=" + amenage + "&datedebut=" + datedebut + "&datefin=" + datefin +
                            "&superCible=" + superCible + "&espece=" + espece + "&vegetalisation=" + vegetalisation + "&nbreE=" + nbreE + "&nbreV=" + nbreV +
                            "&qte=" + qte + "&semi=" + semi + "&survi=" + survi + "&repris=" + repris + '&idamen=' + idamenager+"&typesite="+$typer;
                        //console.log(data);
                        $.ajax({
                            type: "POST",
                            url: "./gestionAmenagement/amenager/enregistrement.php",
                            data: data,
                            success: function (reponse) {
                                $('#Etatenregistrement').html(reponse).show();
                                var etat=$('#echec').val();
                                if(etat!=''){
                                    $("#corps").load("./gestionAmenagement/amenager/listeAmenager.php");
                                    etatdeinsertion("echec");
                                }else{
                                    $("#corps").load("./gestionAmenagement/amenager/listeAmenager.php");
                                    notification(1);
                                }

                            }
                        });

                    }
                } else {
                    $(this).attr('data-dismiss', 'modal');
                    var data2 = "operateur=" + operateur + "&projet=" + projet + "&site=" + site + "&amenge=" + amenage + "&datedebut=" + datedebut + "&datefin=" + datefin +
                        "&superCible=" + superCible + '&idamen=' + idamenager+"&typesite="+$typer;
                    //console.log(data2);
                    $.ajax({
                        type: "POST",
                        url: "./gestionAmenagement/amenager/enregistrement.php",
                        data: data2,
                        success: function (reponse) {
                            $('#Etatenregistrement').html(reponse).show();
                            var etat=$('#echec').val();
                            if(etat!=''){
                                $("#corps").load("./gestionAmenagement/amenager/listeAmenager.php");
                                etatdeinsertion("echec");
                            }else{
                                $("#corps").load("./gestionAmenagement/amenager/listeAmenager.php");
                                notification(1);
                            }

                        }
                    });

                }
            }

        }

    });

    $("#periodFin").change(function(){
        var $datefin=$('#periodFin');

        var parts=$datefin.val().split("/");
        var date_limit=new Date(parts[2],parts[1]-1,parts[0]);
        var parts=$("#periodeDeb").val().split("/");
        var date_lance=new Date(parts[2],parts[1]-1,parts[0]);
        $(".champ-datepicker").datepicker("option",{
            minDate:date_limit
        });
        if(date_lance>date_limit){
            $datefin.val("");
            notification('droit');
        }
    });

    $("#periodeDeb").change(function(){
        var $datebdeb=$('#periodeDeb');

        var parts=$('#periodFin').val().split("/");
        var date_limit=new Date(parts[2],parts[1]-1,parts[0]);
        var parts=$datebdeb.val().split("/");
        var date_lance=new Date(parts[2],parts[1]-1,parts[0]);
        $(".champ-datepicker").datepicker("option",{
            minDate:date_lance
        });
        if(date_lance>date_limit){
            $datebdeb.val("");
            notification('droit');
        }
    });

    function MettreFocus(){

        var operateur=$('#nomOpt');
        var site=$('#nomSite');
        var amenage=$('#amenage');
        var datedebut=$('#periodeDeb');
        var datefin=$('#periodFin');
        var superCible=$('#superCible');
        var $typer=$('#typesiteamen');

        var region=$('#region');
        var commune=$('#commune');
        var province=$('#province');
        var localite=$('#localite');
        var categorie= $('#nomCat');

        if(categorie.val()==''){
            categorie.css('background-color', '#FDD');
        }else{
            categorie.removeAttrs('style');
        }

        if(localite.val()==''){
            localite.css('background-color', '#FDD');
        }else{
            localite.removeAttrs('style');
        }

        if(region.val()==''){
            region.css('background-color', '#FDD');
        }else{
            region.removeAttrs('style');
        }

        if(commune.val()==''){
            commune.css('background-color', '#FDD');
        }else{
            commune.removeAttrs('style');
        }
        if(province.val()==''){
            province.css('background-color', '#FDD');
        }else{
            province.removeAttrs('style');
        }

        if(operateur.val()==''){
            operateur.css('background-color', '#FDD');
        }else{
            operateur.removeAttrs('style');
        }

        if(site.val()==''){
            site.css('background-color', '#FDD');
        }else{
            site.removeAttrs('style');
        }

        if(amenage.val()==''){
            amenage.css('background-color', '#FDD');
            //$('#nomCat').css('background-color', '#FDD');
        }else{
            amenage.removeAttrs('style');
            //$('#nomCat').removeAttrs('style');
        }

        if(datedebut.val()==''){
            datedebut.css('background-color', '#FDD');
        }else{
            datedebut.removeAttrs('style');
        }

        if(datefin.val()==''){
            datefin.css('background-color', '#FDD');
        }else{
            datefin.removeAttrs('style');
        }

        if(superCible.val()==''){
            superCible.css('background-color', '#FDD');
        }else{
            superCible.removeAttrs('style');
        }

        if($typer.val()==''){
            $typer.css('background-color', '#FDD');
        }else{
            $typer.removeAttrs('style');
        }

    }

    function MettreFocus1(espe,vegetal){

        if(espe==''){
            $('#zoneEspece').css('background-color', '#FDD');
        }else{
            $('#zoneEspece').removeAttrs('style');
        }

        if(vegetal==''){
            $('#zoneVegetalisation').css('background-color', '#FDD');
        }else{
            $('#zoneVegetalisation').removeAttrs('style');
        }
    }
</script>
<?php }?>

