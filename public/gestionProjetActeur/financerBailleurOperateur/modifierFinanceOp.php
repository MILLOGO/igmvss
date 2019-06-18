<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 20/07/2018
 * Time: 21:49
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{



$id=0;

    if(isset($_POST['idfinance'])){
        $id=$_POST['idfinance'];
    }

    /*else {

        if($_POST){

            //$gestion->InsererFinancementOperateur($nomOpt,$nomBailleur,$montant,$dateFinance,$nomPro);
        }
    }*/
?>
<div class="modal" id="UpdateFinancement" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeFinancement" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Financement d'un opérateur </span></h3>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?php
                        $donnee=Bd_GestionProjetActeur::ListeFinanceOperateurParId($id);

                        foreach($donnee as $tab):
                    ?>
                    <fieldset>
                        <Legend>Financer un opérateur</Legend>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <input type="hidden"  name="identifiant" id="identifiant"  value="<?php echo $tab[8]; ?>">
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
                                        <option value="<?php echo $id; ?>" <?php if($tab[2]==$id){echo "selected";}  ?>><?php echo $nom; ?></option>
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
                                        <option value="<?php echo $id ?>" <?php if($tab[4]==$id){echo "selected";}  ?>><?php echo $nomOpt; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="nomPro">Nom du projet </label><br>
                                <select class="formulaire" id="nomPro" name="nomPro">
                                    <option value="">Sélectionné le projet</option>
                                    <?php
                                    $operateur=Bd_GestionProjetActeur::ListerTousProjet();
                                    $cle=1; $nom=2;
                                    foreach($operateur as $Opt):
                                        $id=$Opt[$cle];
                                        $cle=$cle+12;
                                        $nomOpt=$Opt[$nom];
                                        $nom=$nom+12;
                                        ?>
                                        <option value="<?php echo $id ?>" <?php if($tab[1]==$id){echo "selected";}  ?>><?php echo $nomOpt; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3">
                                <label for="montant">Montant (Fcfa) <span style="color: red">*</span></label><br>
                                <input type="number"  name="montant" id="montant" class="formulaire" value="<?php echo $tab[6]; ?>" onchange="EnleverFocus(this.id)">
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3">
                                <label for="annee">Année</label><br>
                                <select class="formulaire" name="annee" id="annee">
                                    <?php
                                    $annedepar=2000;
                                    $anneeactuel=date('Y');

                                    for($i=1; $i<=50; $i++){
                                        ?>
                                        <option value="<?php $annee=$annedepar+$i; echo $annee; ?>"  <?php if($annee==$tab[7]){ echo "selected";}; ?> > <?php echo $annee; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div><br>
                    </fieldset>
                    <?php
                        endforeach
                    ?>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" value="Enregistrer" id="ModifierFinance" name="ModifierFinance"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerFinance" name="fermer" value="Annuler" data-dismiss="modal"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
    <div id="Etatenregistrement"></div>

<script type="application/javascript">


    $('#ModifierFinance').click(function(){
        var nomBailleurt=$('#ListeBailleur').val();
        var nomOpt=$('#nomOpt').val();
        var nomPro=$('#nomPro').val();
        var montant=$('#montant').val();
        var annee=$('#annee').val();
        var ident=$('#identifiant').val();

        if(nomBailleurt==''|| nomOpt==''|| montant==''|| annee==''){
            notification("vide");
            MettreFocus(nomOpt,nomBailleurt,montant,annee);
        }else{
            $(this).attr('data-dismiss', 'modal');
            var donnee="Bailleur="+nomBailleurt+"&Operateur="+nomOpt+"&Projet="+nomPro+"&mont="+montant+"&anne="+annee+"&identif="+ident;
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
