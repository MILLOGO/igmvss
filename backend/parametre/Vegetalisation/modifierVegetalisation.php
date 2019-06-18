<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 24/07/2018
 * Time: 16:56
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
        $nom = $_POST['nom'];
        $id = $_POST['idele'];
        $description = $_POST['description'];
        $newfacteur = new Bd_parametre();
        $newfacteur->ModifierVegetalisation($nom, $description,$id);
    }
}*/
?>
    <div id="Etatenregistrement"></div>
<div class="modal" id="updatevegetalisation"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--<h4 style="font-weight: bold">Ajouter les taches</h4>-->
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification d'une végétalisation</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <?php $tableau=Bd_parametre::ListeVegetalisationParId($identifiant);
                        foreach($tableau as $table):
                    ?>
                    <fieldset>
                        <legend>Végetalisation</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="type">Type de végétalisation <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <input type="hidden" name="idVege" id="idVege" value="<?php echo $table[1] ?>">
                                            <input type="text" name="type" id="type" value="<?php echo $table[2] ?>" class="formulaire"
                                                   placeholder="Saisir le nom de la végétalisation" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div><br />
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="descriptio">Description de la végétalisation </label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <textarea name="descriptio" id="descriptio" class="formulaire" style="height: 100px"><?php echo $table[3] ?></textarea>
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
                <input type="button" id="modifVege" name="enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerModif" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>

</div>
<script type="application/javascript">

    $("#modifVege").click(function(){

        var nom=$('#type').val();
        var description=$('#descriptio').val();
        var ident=$('#idVege').val();
        var data='nom='+nom+'&description='+description+'&idele='+ident;
        if(nom==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss','modal');
            $.ajax({
                type:"POST",
                url:"./parametre/vegetalisation/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/vegetalisation/vegetalisation.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/vegetalisation/vegetalisation.php");
                        notification(1);
                    }
                }
            });
        }
    });

    function MettreFocus(){
        var nom=$('#type');
        if(nom.val()==''){
            nom.css('background-color', '#FDD');
        }else{
            nom.removeAttrs('style');
        }
    }

</script>
<?php }?>
