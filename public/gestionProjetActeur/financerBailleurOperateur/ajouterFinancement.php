<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 14/07/2018
 * Time: 12:17
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{


?>
<div class="modal" id="newFinancement" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeFinancement" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Financement d'un opérateur </span></h3>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <fieldset>
                        <Legend>Financer un opérateur</Legend>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="ListeBailleur">Bailleur <span style="color: red">*</span></label>
                                <select name="ListeBailleur" id="ListeBailleur" class="formulaire" onchange="EnleverFocus(this.id)">
                                    <option value="">Sélectionné un bailleur </option>
                                    <?php
                                    $liste=Bd_GestionProjetActeur::ListeTousBailleur();
                                    $cle=1;
                                    $no=2;
                                    foreach ($liste as $bailleur):
                                        $id=$bailleur[$cle];
                                        $cle=$cle+7;
                                        $nom=$bailleur[$no];
                                        $no=$no+7;
                                        ?>
                                        <option value="<?php echo $id; ?>" id="selection<?php echo $id; ?>"><?php echo $nom; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="nomOpt">Nom de l'opérateur <span style="color: red">*</span></label><br>
                                <select class="formulaire" id="nomOpt" name="nomOpt" onchange="EnleverFocus(this.id)">
                                    <option value="">Sélectionné l'opérateur</option>
                                    <?php
                                    $operateur=Bd_GestionProjetActeur::ListerTousOperateur();
                                    $cle=1; $nom=2;
                                    foreach($operateur as $Opt):
                                        $id=$Opt[$cle];
                                        $cle=$cle+8;
                                        $nomOpt=$Opt[$nom];
                                        $nom=$nom+8;
                                        ?>
                                        <option value="<?php echo $id ?>"><?php echo $nomOpt; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="nomPro">Nom du projet</label><br>
                                <select class="formulaire" id="nomPro" name="nomPro" onchange="EnleverFocus(this.id)">
                                    <option value="">Sélectionné le projet </option>
                                    <?php
                                    $operateur=Bd_GestionProjetActeur::ListerTousProjet();
                                    $cle=1; $nom=2;
                                    foreach($operateur as $Opt):
                                        $id=$Opt[$cle];
                                        $cle=$cle+12;
                                        $nomOpt=$Opt[$nom];
                                        $nom=$nom+12;
                                        ?>
                                        <option value="<?php echo $id ?>"><?php echo $nomOpt; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3">
                                <label for="montant">Montant (Fcfa) <span style="color: red">*</span></label><br>
                                <input type="number"  name="montant" id="montant" class="formulaire" onchange="EnleverFocus(this.id)">
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3">
                                <label for="annee">Année</label><br>
                                <select class="formulaire" name="annee" id="annee">
                                    <?php
                                    $annedepar=2000;
                                    $anneeactuel=date('Y');

                                    for($i=1; $i<=50; $i++){
                                        ?>
                                        <option value="<?php $annee=$annedepar+$i; echo $annee; ?>"  <?php if($annee==$anneeactuel){ echo "selected";}; ?> > <?php echo $annee; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div><br>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" value="Enregistrer" id="EnregistrerFinance" name="EnregistrerCollecteur" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerFinance" name="fermer" value="Annuler" data-dismiss="modal"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
    <div id="Etatenregistrement"></div>
<?php
    /*
if($_POST){
    $nomBailleur=strip_tags($_POST['nomBailleur']);
    $nomOpt=strip_tags(($_POST['nomOpt']));
    $nomPro=strip_tags($_POST['nomPro']);
    $montant=strip_tags($_POST['montant']);
    $dateFinance=strip_tags($_POST['annee']);

    if($nomPro==''){
        $nomPro=-1;
    }
    $gestion=new Bd_GestionProjetActeur();
    $gestion->InsererFinancementOperateur($nomOpt,$nomBailleur,$montant,$dateFinance,$nomPro);
}*/
?>
<script type="application/javascript">


    $('#EnregistrerFinance').click(function(){
        var nomBailleurt=$('#ListeBailleur').val();
        var nomOpt=$('#nomOpt').val();
        var nomPro=$('#nomPro').val();
        var montant=$('#montant').val();
        var annee=$('#annee').val();

        if(nomBailleurt==''||nomOpt==''||montant==''||annee=='' ){
            notification("vide");
            MettreFocus(nomOpt,nomBailleurt,montant,annee)
        }else{
            $(this).attr('data-dismiss', 'modal');
            var donnee="nomBailleur="+nomBailleurt+"&nomOpt="+nomOpt+"&nomPro="+nomPro+"&montant="+montant+"&annee="+annee+"&type=ajout";
            $.ajax({
                type: "POST",
                url: "./gestionProjetActeur/financerBailleurOperateur/enregistrement.php",
                data: donnee,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $('#corps').load("./gestionProjetActeur/financerBailleurOperateur/listeFinancement.php");
                        etatdeinsertion("echec");
                    }else{
                        $('#corps').load("./gestionProjetActeur/financerBailleurOperateur/listeFinancement.php");
                        notification(1);
                    }

                }
            });
           // console.log(donnee);
        }
    });


    function MettreFocus(nomOpt,nomBailleurt,montant,annee){
        if(nomOpt==''){
            $('#nomOpt').css('background-color', '#FDD');
        }else{
            $('#nomOpt').removeAttrs('style');
        }

        if(nomBailleurt==''){
            $('#ListeBailleur').css('background-color', '#FDD');
        }else{
            $('#ListeBailleur').removeAttrs('style');
        }

        if(montant==''){

            $('#montant').css('background-color', '#FDD');
        }else{
            $('#montant').removeAttrs('style');
        }

        if(annee==''){
            $('#annee').css('background-color', '#FDD');
        }else{
            $('#annee').removeAttrs('style');
        }

    }
</script>
<?php }?>
