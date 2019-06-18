<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 04/07/2018
 * Time: 16:53
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{


$idregion="";
if(isset($_POST['id'])){
    $idregion=$_POST['id'];
}
/*else{
    if($_POST){

    $id=strip_tags($_POST['idregi']);
    $nom=strip_tags($_POST['nom']);

    $parametre= new Bd_parametre();
        $parametre->ModifierSousCategorie($nom,$id);
    }
}*/

$tableau=Bd_parametre::ListeSousCategorieParId($idregion);
$id=1;
$nom=2;
?>
    <div id="Etatenregistrement"></div>
<div class="modal" id="updatesous" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <fieldset>
                        <legend>Modification de la sous catégorie</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="SousCat">Nom de la sous catégorie <span style="color: red">*</span></label><br />
                                    <?php foreach ($tableau as $tab):
                                        $idregion=$tab[$id];
                                        $nomregion=$tab[$nom];
                                    ?>
                                        <input type="hidden" name="idregi" id="idregi"  class="formulaire" value="<?php echo $idregion; ?>">
                                        <input type="text" name="SousCat" id="SousCat"  class="formulaire" value="<?php echo $nomregion; ?>" onchange="EnleverFocus(this.id)">
                                    <?php endforeach ?>
                                        <br />
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="valider" name="enregistrer"  value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annuler" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
    </div>

<script type="application/javascript">

    $("#valider").click(function(){
        var idregi=$('#idregi').val();
        var nom=$('#SousCat').val();
        var data='nom='+nom+'&idregi='+idregi;
        if(nom==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/souscategorieamenagement/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/souscategorieamenagement/souscategorie.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/souscategorieamenagement/souscategorie.php");
                        notification(1);
                    }
                }
            });
        }
    });

    $('#annuler').click(function(){
        $("#corps").load("./parametre/souscategorieamenagement/souscategorie.php");
    });

    function MettreFocus(){
        var nom=$('#SousCat');
        if(nom.val()==''){
            nom.css('background-color', '#FDD');
        }else{
            nom.removeAttrs('style');
        }
    }
</script>
<?php }?>