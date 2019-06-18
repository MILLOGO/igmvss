<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 23/07/2018
 * Time: 00:31
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{
$idcom="";
if(isset($_POST['id'])){
    $idcom=$_POST['id'];

}/*else{
    if($_POST){
        $idprovince=strip_tags($_POST['nomProv']);
        $nomcommune=strip_tags($_POST['nomComm']);
        $nbreH=strip_tags($_POST['nombH']);
        $nbreF=strip_tags($_POST['nombF']);
        $nomM=strip_tags($_POST['nombreMena']);
        $popTotal=strip_tags($_POST['popTo']);
        $idcommune=strip_tags($_POST['cle']);
        $newfacteur=new Bd_parametre();
        $newfacteur->ModifierCommune($idprovince,$nomcommune,$nbreH,$nbreF,$popTotal,$nomM,$idcommune);
    }
}*/
?>

<div class="modal" id="updatecommune" data-backdrop="static">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification d'une commune</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <?php $tableau=Bd_parametre::ListeCommuneParId($idcom);
                        foreach($tableau as $comm):
                    ?>
                    <fieldset>
                        <legend>Commune</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="hidden" id="identifiant" value="<?php echo $comm[1]; ?>">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                            <label for="regionM">Région <span style="color: red">*</span></label>
                                            <select id="regionM" name="regionM" class="formulaire" title="sélectionner une région" onchange="EnleverFocus(this.id)">
                                                <option value=""></option>
                                                <?php $region=Bd_parametre::ListeRegion();
                                                $cle=1; $nom=2;
                                                $para=new Bd_parametre();
                                                $idre=$para->RecupererIdRegion($comm[2]);
                                                foreach($region as $listeRegion):
                                                    $id=$listeRegion[$cle];
                                                    $cle=$cle+2;
                                                    $nomRegion=$listeRegion[$nom];
                                                    $nom=$nom+2;
                                                    ?>
                                                    <option value="<?php echo $id ?>" <?php if($id==$idre){echo "selected";}?>><?php echo $nomRegion ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 ">
                                                <label for="nomProvinc">Province <span style="color: red">*</span></label><br />
                                                <?php
                                                $province=Bd_parametre::ListeProvinceParRegion($idre);
                                                $id=1;
                                                $no=3;
                                                ?>
                                                <select class="formulaire" name="nomProvinc" id="nomProvinc" onchange="EnleverFocus(this.id)">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($province as $tab):
                                                        $pri=$tab[$id];//id de la région
                                                        $id=$id+3;
                                                        $libelle=$tab[$no]; //NNom de la région
                                                        $no=$no+3;
                                                        ?>
                                                        <option value="<?php echo $pri;?>" <?php if($pri==$comm[2]){echo "selected";} ?> ><?php echo $libelle;?></option>
                                                        <?php endforeach ?>
                                                </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                            <label for="nomCommun">Nom de la commune <span style="color: red">*</span></label><br />
                                            <input type="text" name="nomCommun" id="nomCommun" required value="<?php echo $comm[3]; ?>" class="formulaire" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                            <label for="nbreH">Nombre d'homme <span style="color: red">*</span></label><br />
                                            <input type="number"  name="nbreH" id="nbreH" required  class="formulaire" min="0" value="<?php echo $comm[4]; ?>" onchange="EnleverFocus(this.id)">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                            <label for="nbreF">Nombre de femme <span style="color: red">*</span></label><br />
                                            <input type="number" name="nbreF" id="nbreF"  required class="formulaire" min="0" value="<?php echo $comm[5]; ?>" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                            <label for="nbreMenage">Nombre de ménage <span style="color: red">*</span></label><br />
                                            <input type="number"  name="nbreMenage" id="nbreMenage" required  class="formulaire" min="0" value="<?php echo $comm[7]; ?>" onchange="EnleverFocus(this.id)">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                            <label for="popTot">Population Totale <span style="color: red">*</span></label><br />
                                            <input type="number" name="popTot" id="popTot"  required class="formulaire" min="0" value="<?php echo $comm[6]; ?>" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <?php endforeach ?>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="validerModif" name="enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerModif" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
    <div id="Etatenregistrement"></div>
<script type="application/javascript">
    //$(document).ready(function() {

    $('#regionM').change(function(){
        var idregion=$(this).val();
        var donne="idregion="+idregion;
        $.ajax({
            type:"GET",
            url:"./parametre/traitement/traitement.php",
            data:donne,
            success: function(server_response){
                $("#nomProvinc").html(server_response).show();
            }
        });
    });

    $("#validerModif").click(function(){
        var nomprovince=$('#nomProvinc').val();
        var nomcommune=$('#nomCommun').val();
        var nbreH=$('#nbreH').val();
        var nbreF=$('#nbreF').val();
        var nbreMena=$('#nbreMenage').val();
        var poptotal=$('#popTot').val();
        var id=$('#identifiant').val();

        var data='nomProv='+nomprovince+'&nomComm='+nomcommune+'&nombH='+nbreH+'&nombF='+nbreF+'&nombreMena='+nbreMena+'&popTo='+poptotal+"&cle="+id;

        if(nomprovince==''||nomcommune==''||nbreH==''||nbreF==''||nbreMena==''||poptotal==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/commune/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/commune/commune.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/commune/commune.php");
                        notification(1);
                    }

                }
            });
        }
    });

    $('#annulerModif').click(function(){
        $("#corps").load("./parametre/commune/commune.php");
    });

    function MettreFocus(){

            var idcommune=$('#nomCommun');
            var idprovince=$('#nomProvinc');
            var idregion=$('#regionM');
            var nbreH=$('#nbreH');
            var nbreF=$('#nbreF');
            var nbreMena=$('#nbreMenage');
            var poptotal=$('#popTot');

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

            if(nbreH.val()==''){
                nbreH.css('background-color', '#FDD');
            }else{
                nbreH.removeAttrs('style');
            }

            if(nbreF.val()==''){
                nbreF.css('background-color', '#FDD');
            }else{
                nbreF.removeAttrs('style');
            }

            if(nbreMena.val()==''){
                nbreMena.css('background-color', '#FDD');
            }else{
                nbreMena.removeAttrs('style');
            }

            if(poptotal.val()==''){
                poptotal.css('background-color', '#FDD');
            }else{
                poptotal.removeAttrs('style');
            }
        }
    //});
</script>

<?php }?>