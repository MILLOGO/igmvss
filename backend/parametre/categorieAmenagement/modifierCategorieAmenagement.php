<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 23/07/2018
 * Time: 23:58
 */
include_once('../../../DataBases/FichierBD.php');

if(!$_SESSION){
    header('location:../../');
}else{

$identifiant="";
if(isset($_POST['id'])){
    $identifiant=$_POST['id'];
}/*else {
    if ($_POST) {
        $nom = $_POST['categorie'];
        $id = $_POST['idele'];
        $newCatAm = new Bd_parametre();
        $newCatAm->ModifierCatAm($nom,$id);
    }
}*/
?>
    <div id="Etatenregistrement"></div>
<div class="modal" id="updatecategorie" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification d'une catégorie d'amenagement</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <?php $tableau=Bd_parametre::ListeCatAmenagementParId($identifiant);
                        foreach($tableau as $tabDne):
                    ?>
                    <fieldset>
                        <legend>Modification Catégorie Amenagement</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <label for="CatAm">Nom de la catégorie d'aménagement <span style="color: red">*</span></label><br />
                                    <input type="hidden" name="idCatAm" id="idCatAm" value=" <?php echo $tabDne[1] ?>">
                                    <input type="text" name="CatAm" id="CatAm" class="formulaire" value=" <?php echo $tabDne[2] ?>" onchange="EnleverFocus(this.id)">
                                    <br />
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <?php endforeach ?>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="validerCatAm" name="enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annuler" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

    $("#validerCatAm").click(function(){

        var Catam=$('#CatAm').val();
        var ident=$('#idCatAm').val();

        var data='categorie='+Catam+'&idele='+ident;

        if(Catam==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/categorieAmenagement/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/categorieAmenagement/categorieAmenagement.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/categorieAmenagement/categorieAmenagement.php");
                        notification(1);
                    }

                }
            });
        }
    });

    function MettreFocus(){

        var Catam=$('#CatAm');
        if(Catam.val()==''){
            Catam.css('background-color', '#FDD');
        }else{
            Catam.removeAttrs('style');
        }

    }
</script>
<?php }?>