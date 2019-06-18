<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 12/07/2018
 * Time: 18:31
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idlocalite=0;
if(isset($_POST['id'])){
    $idlocalite=$_POST['id'];
}/*
else {
    if ($_POST) {
        $idcommune = $_POST['idcommu'];
        $nom = $_POST['nomLocal'];
        $idlocal = $_POST['idlocal'];
        $Localite = new Bd_parametre();
        $Localite->ModifierLocalite($idcommune, $nom,$idlocal);
    }
}
*/
?>
<br>
<div class="modal" id="updatelocalite" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification Localité</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <?php
                    $localite=Bd_parametre::ListeLocaliteParId($idlocalite);
                        $par=new Bd_parametre();
                    foreach ($localite AS $local):
                        $idprov=$par->RecupererIdProvince($local[2]);
                        $idreg=$par->RecupererIdRegion($idprov);
                    ?>
                    <fieldset>
                        <legend>Localité</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="regi">Région <span style="color: red">*</span></label>
                                            <select id="regi" name="regi" class="formulaire" title="sélectionner une région" onchange="EnleverFocus(this.id)">
                                                <option></option>
                                                <?php $region=Bd_parametre::ListeRegion();
                                                $cle=1; $nom=2;
                                                foreach($region as $listeRegion):
                                                    $id=$listeRegion[$cle];
                                                    $cle=$cle+2;
                                                    $nomRegion=$listeRegion[$nom];
                                                    $nom=$nom+2;
                                                    ?>
                                                    <option value="<?php echo $id ?>"<?php if($id==$idreg){echo "selected";}?>><?php echo $nomRegion ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="nomPro">Province <span style="color: red">*</span></label><br />
                                            <?php
                                            $province=Bd_parametre::ListeProvinceParRegion($idreg);
                                            $id=1;
                                            $no=3;
                                            ?>
                                            <select class="formulaire" name="nomPro" id="nomPro" onchange="EnleverFocus(this.id)">
                                                <option value=""></option>
                                                <?php
                                                foreach ($province as $tab):
                                                    $pri=$tab[$id];//id de la région
                                                    $id=$id+3;
                                                    $libelle=$tab[$no]; //NNom de la région
                                                    $no=$no+3;
                                                    ?>
                                                    <option value="<?php echo $pri;?>" <?php if($pri==$idprov){echo "selected";} ?> ><?php echo $libelle;?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div><br />
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="nomCom">Nom de la commune <span style="color: red">*</span></label>
                                            <select class="formulaire" name="nomCom" id="nomCom" onchange="EnleverFocus(this.id)">
                                                <option value=""></option>
                                                <?php
                                                $param=Bd_parametre::ListeCommuneParProvince($idprov);
                                                $id=1;
                                                $no=3;
                                                foreach ($param as $tab):
                                                    $pric=$tab[$id];//id de la commune
                                                    $id=$id+7;
                                                    $libelle=$tab[$no]; //NNom de la commune
                                                    $no=$no+7;
                                                    ?>
                                                    <option value="<?php echo $pric;?>" <?php if($local[2]==$pric){echo "selected";}?>><?php echo $libelle;?></option>
                                                    <?php
                                                endforeach
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="Localite">Nom de la localité <span style="color: red">*</span></label>
                                            <input type="hidden" name="idLocalite" id="idLocalite" value="<?php echo $local[1];?>">
                                            <input type="text" name="Localite" id="Localite" value="<?php echo $local[3];?>" class="formulaire" placeholder="saisir la localité" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="modifLoca" name="enregistrer"  value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerModif" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
<div id="envoi"> </div>
    <div id="Etatenregistrement"></div>
<script type="application/javascript">


    $('#regi').change(function(){
        var idregion=$(this).val();
        var donne="idregion="+idregion;
        $('#Localite').val("");
        $('#nomCom').val("");
        $.ajax({
            type:"GET",
            url:"./parametre/traitement/traitement.php",
            data:donne,
            success: function(server_response){
                $("#nomPro").html(server_response).show();
            }
        });
    });

    $('#nomPro').change(function(){
        var idprovince=$(this).val();
        var donne="idprovince="+idprovince;
        $('#nomCom').val("");
        $('#Localite').val("");
        $.ajax({
            type:"GET",
            url:"./parametre/traitement/traitement.php",
            data:donne,
            success: function(server_response){
                $("#nomCom").html(server_response).show();
            }
        })
    });

    /*$("#nomCom").change(function(){
        $('#Localite').val("");
    });*/


    $("#modifLoca").click(function(){

        var idcommune=$('#nomCom').val();
        var idlocal=$('#idLocalite').val();
        var nomlocalite=$('#Localite').val();
        var data='idcommu='+idcommune+'&nomLocal='+nomlocalite+"&idlocal="+idlocal;
        if(idcommune==''|| nomlocalite==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/localite/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/localite/localite.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/localite/localite.php");
                        notification(1);
                    }

                }
            });
        }

    });

    function MettreFocus(){
        var idcommune=$('#nomCom');
        var idprovince=$('#nomPro');
        var idregion=$('#regi');
        var nomlocalite=$('#Localite');

        if(idcommune.val()==''){
            idcommune.css('background-color', '#FDD');
        }else{
            idcommune.removeAttrs('style');
        }

        if(idprovince.val()==''){
            idprovince.css('background-color', '#FDD');
        }else{
            idprovince.removeAttrs('style');
        }

        if(idregion.val()==''){
            idregion.css('background-color', '#FDD');
        }else{
            idregion.removeAttrs('style');
        }

        if(nomlocalite.val()==''){
            nomlocalite.css('background-color', '#FDD');
        }else{
            nomlocalite.removeAttrs('style');
        }
    }
</script>
<?php }?>
