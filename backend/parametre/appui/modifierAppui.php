<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 23/07/2018
 * Time: 22:46
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
        $nom = $_POST['nomAp'];
        $id = $_POST['idele'];
        $newfacteur = new Bd_parametre();
        $newfacteur->ModifierTypeappui($nom,$id);
    }
}*/
?>

<div class="modal" id="updateappui" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>

                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification d'un type d'appui</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <?php $tableau=Bd_parametre::ListeTypeappuiParId($identifiant);
                        foreach($tableau as $tabDne):
                    ?>
                    <fieldset>
                        <legend>Nouveau type d'appui</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <label for="namappui">Type de l'appui <span style="color: red">*</span></label><br />
                                    <input type="hidden" name="idappui" id="idappui"  value="<?php echo $tabDne[1];?>">
                                    <input type="text" name="namappui" id="namappui"  value="<?php echo $tabDne[2];?>" class="formulaire" onchange="EnleverFocus(this.id)">
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
<script type="application/javascript">

    $("#validerModif").click(function(){
        var nom=$('#namappui').val();
        var ident=$('#idappui').val();
        var data='nomAp='+nom+'&idele='+ident;
        if(nom==''){
            notification("vide");
            MettreFocus()
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/appui/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/appui/appui.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/appui/appui.php");
                        notification(1);
                    }

                }
            });
        }
    });

    function MettreFocus(){

        var nom=$('#namappui');
        if(nom.val()==''){
            nom.css('background-color', '#FDD');
        }else{
            nom.removeAttrs('style');
        }

    }
</script>

<?php }?>
