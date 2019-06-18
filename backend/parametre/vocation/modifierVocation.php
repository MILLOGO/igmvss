<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 24/07/2018
 * Time: 15:56
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
        $idcat = $_POST['idCategorie'];
        $nomAm = $_POST['nomVoca'];
        $id = $_POST['idele'];

        $paramet = new Bd_parametre();
        $paramet->ModifierVocation($idcat, $nomAm,$id);
    }
}*/
?>
    <div id="Etatenregistrement"></div>
<div class="modal" id="updatevocation" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modifictaion d'une Vocation</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <?php $tableau=Bd_parametre::ListeVocationParId($identifiant);
                        foreach($tableau as $table):
                    ?>
                    <fieldset>
                        <legend>Vocation</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="namCat">Nom de la catégorie de vocation <span style="color: red">*</span></label>
                                        </div>
                                        <?php
                                        $categorie=Bd_parametre::ListeCatVocation();
                                        $id=1;
                                        $no=2;
                                        ?>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <select class="formulaire" name="namCat" id="namCat" onchange="EnleverFocus(this.id)">
                                                <option value=""></option>
                                                <?php
                                                foreach ($categorie as $tab):
                                                    $pri=$tab[$id];//id de la région
                                                    $id=$id+2;
                                                    $libelle=$tab[$no]; //NNom de la région
                                                    $no=$no+2;
                                                    ?>
                                                    <option value="<?php echo $pri;?>" <?php if($pri==$table[2]){echo "selected";} ?>><?php echo $libelle;?></option>
                                                    <?php
                                                endforeach
                                                ?>
                                            </select>
                                        </div>
                                    </div><br />
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="namVo">Nom de la vocation <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <input type="hidden" name="idVo" id="idVo" value="<?php echo $table[1]?>">
                                            <input type="text" name="namVo" id="namVo" value="<?php echo $table[3]?>" class="formulaire"
                                                   placeholder="saisir la vocation" onchange="EnleverFocus(this.id)">
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
                <input type="button" id="validerModif" name="enregistrer"  value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerModif" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">

    $("#validerModif").click(function(){

        var idcat=$('#namCat').val();
        var idvo=$('#idVo').val();
        var nomvo=$('#namVo').val();
        var data='idCategorie='+idcat+'&nomVoca='+nomvo+'&idele='+idvo;
        if(nomvo==''|| idcat==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss','modal');
            $.ajax({
                type:"POST",
                url:"./parametre/vocation/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/vocation/vocation.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/vocation/vocation.php");
                        notification(1);
                    }
                }
            });
        }
    });

    function MettreFocus(){
        var nom=$('#namVo');
        var idcat=$('#namCat');
        if(nom.val()==''){
            nom.css('background-color', '#FDD');
        }else{
            nom.removeAttrs('style');
        }

        if(idcat.val()==''){
            idcat.css('background-color', '#FDD');
        }else{
            idcat.removeAttrs('style');
        }
    }
</script>
<?php }?>