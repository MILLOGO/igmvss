<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 24/07/2018
 * Time: 12:49
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
        $nomAm = $_POST['nomAmena'];
        $nomSou = $_POST['nomSousCat'];
        $info = $_POST['infosSpe'];
        $iden = $_POST['idele'];
        if ($info != 1) {
            $info = 0;
        }
        $paramet = new Bd_parametre();
        $paramet->ModifierAmenagement($idcat, $nomAm, $nomSou, $info, $iden);
    }
}*/
?>

<div class="modal" id="updateamenagement" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Modification d'un aménagement</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <?php $tableau=Bd_parametre::ListeAmenagemenParId($identifiant);
                        foreach($tableau as $tabDne):
                    ?>
                    <fieldset>
                        <legend>Aménagement</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="Categorie">Nom de la Catégorie <span style="color: red">*</span></label>
                                        </div>
                                        <?php
                                        $categorie=Bd_parametre::ListeCatAmenagement();
                                        $id=1;
                                        $no=2;
                                        ?>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <select class="formulaire" name="Categorie" id="Categorie" onchange="EnleverFocus(this.id)">
                                                <option value=""></option>
                                                <?php
                                                foreach ($categorie as $tab):
                                                    $pri=$tab[$id];//id de la catégorie
                                                    $id=$id+2;
                                                    $libelle=$tab[$no]; //NNom de la catégorie
                                                    $no=$no+2;
                                                    ?>
                                                    <option value="<?php echo $pri;?>" <?php if($pri==$tabDne[2]){echo "selected";} ?>><?php echo $libelle;?></option>
                                                    <?php
                                                endforeach
                                                ?>
                                            </select>
                                        </div>
                                    </div><br />
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="Amena">Nom de l'aménagement <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <input type="hidden" name="identifiant" id="identifiant" value="<?php echo $tabDne[1] ?>">
                                            <input type="text" name="Amena" id="Amena" value="<?php echo $tabDne[3] ?>"
                                                   class="formulaire" placeholder="saisir l'aménagement" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="SousCat">Nom de la sous Catégorie </label>
                                        </div>
                                        <?php
                                        $categorie=Bd_parametre::ListeSousCatAmenagement();
                                        $id=1;
                                        $no=2;
                                        ?>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <select class="formulaire" name="SousCat" id="SousCat">
                                                <option value=""></option>
                                                <?php
                                                foreach ($categorie as $tab):
                                                    $pri=$tab[$id];//id de la catégorie
                                                    $id=$id+2;
                                                    $libelle=$tab[$no]; //NNom de la catégorie
                                                    $no=$no+2;
                                                    ?>
                                                    <option value="<?php echo $libelle;?>" <?php if($libelle==$tabDne[4]){echo "selected";} ?>><?php echo $libelle;?></option>
                                                    <?php
                                                endforeach
                                                ?>
                                            </select>
                                        </div>
                                    </div><br />
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="infoSpecif">Utilise des infos spécifiques </label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <input type="checkbox" name="infoSpecif" id="infoSpecif" value="1" <?php if($tabDne[5]==1){echo "checked";} ?>>
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
    <div id="Etatenregistrement"></div>
<script type="application/javascript">

    $("#validerModif").click(function(){
        var idcat=$('#Categorie').val();
        var nomam=$('#Amena').val();
        var nomsou=$('#SousCat').val();
        var ident=$('#identifiant').val();
        //$('#infoSpe:checked')
        var infos=$('#infoSpecif:checked').val();
        var data='idCategorie='+idcat+'&nomAmena='+nomam+'&nomSousCat='+nomsou+'&infosSpe='+infos+'&idele='+ident;
        if(nomam==''|| idcat==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/amenagement/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/amenagement/amenagement.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/amenagement/amenagement.php");
                        notification(1);
                    }

                }
            });
        }
        //console.log(data);
    });

    function MettreFocus(){

        var idcat=$('#Categorie');
        var nomam=$('#Amena');

        if(idcat.val()==''){
            idcat.css('background-color', '#FDD');
        }else{
            idcat.removeAttrs('style');
        }

        if(nomam.val()==''){
            nomam.css('background-color', '#FDD');
        }else{
            nomam.removeAttrs('style');
        }
    }
</script>
<?php }?>