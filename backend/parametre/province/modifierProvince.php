<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 04/07/2018
 * Time: 19:46
 */
include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

if(isset($_POST['id'])){
    $idprovince=$_POST['id'];
}/*else{
    if($_POST){

        $regionid=strip_tags($_POST['idregion']);
        $province=strip_tags($_POST['nomProv']);
        $provinceid=strip_tags($_POST['idprovince']);

        $parametre=new Bd_parametre();
        $parametre->ModifierProvince($provinceid,$regionid,$province);
    }
}*/

?>

<div class="modal" id="updateprovince" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification </span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <fieldset>
                        <legend>Province</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="nomRegionP">Nom de la région <span style="color: red">*</span></label>
                                        </div>
                                        <?php
                                        $region=Bd_parametre::ListeRegion();
                                            $id=1;
                                            $no=2;
                                        $province=Bd_parametre::ListeProvinceParId($idprovince);
                                            $i=1;
                                            $idregion=2;
                                            $libelleprov=3;
                                        ?>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <?php foreach ($province as $prov): ?>
                                            <input type="hidden" name="idProvModif" id="idProvModif" class="formulaire" value="<?php echo $prov[$i];?>">
                                            <select class="formulaire" name="nomRegionP" id="nomRegionP" onchange="EnleverFocus(this.id)">
                                                <option value=""></option>
                                                <?php
                                                foreach ($region as $tab):
                                                    $pri=$tab[$id];//id de la région
                                                    $id=$id+2;
                                                    $libelle=$tab[$no]; //Nom de la région
                                                    $no=$no+2;
                                                ?>
                                                <option value="<?php echo $pri;?>" <?php if($pri==$prov[$idregion]){ echo "selected"; }?>><?php echo $libelle;?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div><br />
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="nomProvMod">Nom de la province <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <input type="text" name="nomProvMod" id="nomProvMod" onchange="EnleverFocus(this.id)"  class="formulaire" value="<?php echo $prov[$libelleprov];?>">
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="validerP" name="enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerP" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
    <div id="Etatenregistrement"></div>
<script type="application/javascript">

    $('#validerP').click(function(){

        var idprovince= $('#idProvModif').val();
        var idregion=$('#nomRegionP').val();
        var nomprovince=$('#nomProvMod').val();
        var data='idregion='+idregion+'&nomProv='+nomprovince+'&idprovince='+idprovince;
        if(idregion==''|| nomprovince==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/province/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/province/province.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/province/province.php");
                        notification(1);
                    }

                }
            });
        }

        //console.log(data);
    });

    $('#annuler').click(function(){
        $("#corps").load("./parametre/province/province.php");
    });

    function MettreFocus(){

        var idregion=$('#nomRegionP');
        var nomprovince=$('#nomProvMod');

        if(idregion.val()==''){
            idregion.css('background-color', '#FDD');
        }else{
            idregion.removeAttrs('style');
        }

        if(nomprovince.val()==''){
            nomprovince.css('background-color', '#FDD');
        }else{
            nomprovince.removeAttrs('style');
        }
    }
</script>
<?php }?>
