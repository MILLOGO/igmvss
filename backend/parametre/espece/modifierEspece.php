<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 23/07/2018
 * Time: 23:20
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
        $nom = $_POST['nomM'];
        $id = $_POST['idele'];
        $description = $_POST['descriptionM'];

        $newfacteur = new Bd_parametre();
        $newfacteur->ModifierEspece($nom, $description, $id);
    }
}*/
?>

<div class="modal" id="updateespece" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>

                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification d'une espèce</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <?php $tableau=Bd_parametre::ListeEspeceParId($identifiant);
                        foreach($tableau as $tabDne):
                    ?>
                    <fieldset>
                        <legend>Espèce</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="Espece">Nom de l'espèce <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <input type="hidden" name="idEspece" id="idEspece" value="<?php echo $tabDne[1] ?>" class="formulaire">
                                            <input type="text" name="Espece" id="Espece" value="<?php echo $tabDne[2] ?>"
                                                   class="formulaire" placeholder="Saisir le nom de l'espèce" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div><br />
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="Descrip">Description de l'espèce </label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <textarea name="Descrip" id="Descrip" class="formulaire" style="height: 100px"><?php echo $tabDne[3] ?></textarea>
                                        </div>
                                    </div>
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

    $("#validerModif").click(function(){

        var nom=$('#Espece').val();
        var ident=$('#idEspece').val();
        var description=$('#Descrip').val();
        var data='nomM='+nom+'&descriptionM='+description+'&idele='+ident;
        if(nom==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/espece/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/espece/espece.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/espece/espece.php");
                        notification(1);
                    }

                }
            });
        }
    });

    function MettreFocus(){
        var nom=$('#Espece');
        if(nom.val()==''){
            nom.css('background-color', '#FDD');
        }else{
            nom.removeAttrs('style');
        }
    }

</script>
<?php }?>