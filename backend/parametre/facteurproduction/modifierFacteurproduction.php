<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 23/07/2018
 * Time: 16:07
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{
$idfact=0;
if(isset($_POST['id'])){
    $idfact=$_POST['id'];
}/*else{
    if($_POST){
        $nomfac=$_POST['nomF'];
        $nomid=$_POST['identif'];
        $newfacteur=new Bd_parametre();
        $newfacteur->ModifierFacteur($nomfac,$nomid);
    }
}*/
?>

<div class="modal" id="updatefacteur" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--<h4 style="font-weight: bold">Ajouter les taches</h4>-->
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'un facteur de production</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <?php $tableau=Bd_parametre::listerFacteurParId($idfact);
                        foreach($tableau as $facteur):
                    ?>
                    <fieldset>
                        <legend>Nouvel facteur de production</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <label for="facteurName">Nom du facteur <span style="color: red">*</span></label><br />
                                    <input type="hidden" name="idfacteur" id="idfacteur"  value="<?php echo $facteur[1]?>">
                                    <input type="text" name="facteurName" id="facteurName"  value="<?php echo $facteur[2]?>" class="formulaire" onchange="EnleverFocus(this.id)">
                                    <br />
                                </div>
                            </div>
                        </div>
                    </fieldset>
                        <?php endforeach ?>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="validerModif" name="Enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerModif" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>

</div>
    <div id="Etatenregistrement"></div>
<script type="application/javascript">

    $("#validerModif").click(function(){

        var nom=$('#facteurName').val();
        var ident=$('#idfacteur').val();
        var data='nomF='+nom+'&identif='+ident;

        if(nom==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/facteurproduction/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/facteurproduction/listefacteurproduction.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/facteurproduction/listefacteurproduction.php");
                        notification(1);
                    }

                }
            });
        }
    });

    function MettreFocus(){
        var nom=$('#facteurName');
        if(nom.val()==''){
            nom.css('background-color', '#FDD');
        }else{
            nom.removeAttrs('style');
        }
    }
</script>
<?php }?>