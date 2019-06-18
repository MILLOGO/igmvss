<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 05/07/2018
 * Time: 14:34
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

/*if($_POST){
    $idgest=strip_tags($_POST['idgest']);
    $anne=strip_tags($_POST['anne']);
    $montant=strip_tags($_POST['montantR']);
    $gestion=new Bd_GestionSite();
    $gestion->InsererRevenuAnnuel($idgest,$montant,$anne);
}*/
?>
<div class="modal" id="newRevenu" data-backdrop="static" >
    <div class="modal-dialog" >
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeRevenu" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Revenu Annuel </span></h3>
            </div>
            <div class="modal-body" >
                <form method="post" action="">
                    <fieldset>
                        <Legend>Infos sur gestionnaire</Legend>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="typeGest">Type de gestionnaire <span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <input type="radio" name="gestionnaire" id="Individuel" value="individuel">
                                    <label for="Individuel" class="labelcouleur">Individuel</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <input type="radio" name="gestionnaire" id="Collectif" value="collectif">
                                    <label for="Collectif" class="labelcouleur">Collectif</label>
                                </div>
                                <input type="hidden" id="Valcocher" value="">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-lg-3">
                                <label for="listeGest">Gestionnaire <span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <select class="formulaire" name="listeGest" id="listeGest" onchange="EnleverFocus(this.id)">
                                    <option value="">Selectionner le gestionnaire </option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-lg-9">
                                <fieldset id="detGest">
                                      <legend>detail du gestionnaire</legend>
                                      <div id="detail"></div>
                                </fieldset>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
            <Legend>Revenu Annuel</Legend>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-lg-3">
                    <label for="annee">Année <span style="color: red">*</span></label>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6">
                    <select class="formulaire" name="annee" id="annee" onchange="EnleverFocus(this.id)">
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
            <div class="row">
                <div class="col-md-3 col-sm-3 col-lg-3">
                    <label for="montRevenu">Montant revenu annuel (Fcfa) <span style="color: red">*</span></label>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6">
                    <input class="formulaire" name="montRevenu" id="montRevenu" type="number" min="0" onchange="EnleverFocus(this.id)">
                </div>
            </div><br>

        </fieldset><br>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" value="Enregistrer" id="ValiderRevenu" name="EnregistrerGes"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerRevenu" name="fermer" value="Annuler" data-dismiss="modal"  class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div><div id="Etatenregistrement"></div>

<script type="application/javascript">

    $('#detGest').hide();

    $('#Individuel').click(function(){
        var valeur=$(this).val();
        var data="type="+valeur;
        $('#Valcocher').val(valeur);
        $.ajax({
            type: "GET",
            url: "./gestionSite/revenuGestionnaire/traitement.php",
            data:data,
            success: function(server_response){
                $("#listeGest").html(server_response).show();
            }
        });
    });

    $('#Collectif').click(function(){
        var valeur=$(this).val();
        var data="type="+valeur;
        $('#Valcocher').val(valeur);
        $.ajax({
            type: "GET",
            url: "./gestionSite/revenuGestionnaire/traitement.php",
            data:data,
            success: function(server_response){
                $("#listeGest").html(server_response).show();
            }
        });
    });

    $('#listeGest').change(function(){
        var id=$(this).val();
        var type=$('#Valcocher').val();
        $('#detGest').show();
        var data="idgest="+id+"&typegest="+type;
        $.ajax({
            type:"GET",
            url:"./gestionSite/revenuGestionnaire/traitement.php",
            data:data,
            success: function(reponse){
                $('#detail').html(reponse).show();
            }
        });
    });

    $('#ValiderRevenu').click(function(){

        var gestionnaire=$('#listeGest').val();
        var annee=$('#annee').val();
        var montant=$('#montRevenu').val();
        if(gestionnaire==''||annee==''||montant==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            var data='idgest='+gestionnaire+'&anne='+annee+'&montantR='+montant+"&type=ajout";
            $.ajax({
                type:"POST",
                url:"./gestionSite/revenuGestionnaire/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $('#corps').load("./gestionSite/revenuGestionnaire/listeRevenu.php");
                        etatdeinsertion("echec");
                    }else{
                        $('#corps').load("./gestionSite/revenuGestionnaire/listeRevenu.php");
                        notification(1);
                    }

                }
            });
        }
    });

    $('#annulerRevenu').click(function(){
        $('#corps').load("./gestionSite/revenuGestionnaire/listeRevenu.php");
    });

    $('#closeRevenu').click(function(){
        $('#corps').load("./gestionSite/revenuGestionnaire/listeRevenu.php");
    });

    function MettreFocus(){

        var gestionnaire=$('#listeGest');
        var annee=$('#annee');
        var montant=$('#montRevenu');

        if(gestionnaire.val()==''){
            gestionnaire.css('background-color', '#FDD');
        }else{
            gestionnaire.removeAttrs('style');
        }

        if(annee.val()==''){
            annee.css('background-color', '#FDD');
        }else{
            annee.removeAttrs('style');
        }

        if(montant.val()==''){

            montant.css('background-color', '#FDD');
        }else{
            montant.removeAttrs('style');
        }

    }
</script>
<?php }?>