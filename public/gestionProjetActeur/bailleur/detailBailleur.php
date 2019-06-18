<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 10/07/2018
 * Time: 01:37
 */
include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{


$idbailleur=0;
if(isset($_POST['idbailleur'])){
    $idbailleur=$_POST['idbailleur'];
}
?>
<div class="modal" id="detailBailleur" data-backdrop="static">
    <div class="modal-dialog" style="width: 30%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeDetailBailleur" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <?php $bailleu=Bd_GestionProjetActeur::ListeBailleurParId($idbailleur);
                    foreach($bailleu as $bail):
                ?>
                <h3 style="padding-left: 5px; padding-top: 5px;" >Détails  </span></h3>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Nom du Bailleur:
                        </td>
                        <td  style="vertical-align: middle">
                            <?php echo "<span class='maj'>". $bail[2]."</span>"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Nom du contact du Bailleur:
                        </td>
                        <td style="vertical-align: middle">
                            <?php echo "<span class='maj'>". $bail[3]."</span>"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Prénom du contact du Bailleur:
                        </td>
                        <td  style="vertical-align: middle">
                            <?php echo $bail[4]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Adresse email du contact du bailleur :
                        </td>
                        <td  style="vertical-align: middle">
                            <?php echo $bail[6]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Téléphone du contact du bailleur :
                        </td>
                        <td  style="vertical-align: middle">
                            <?php echo $bail[5]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Description :
                        </td>
                        <td >
                            <?php if($bail[7]==''){echo "Aucune description trouvée";}else{ echo $bail[7];} ?>
                        </td>
                    </tr>
                </table>
                <?php  endforeach ?>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="annulerB" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

    $('#annulerB').on('click', function(){
        $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php");
    });

    $('#closeDetailBailleur').on('click', function(){
        $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php");
    });
</script>
<?php }?>
