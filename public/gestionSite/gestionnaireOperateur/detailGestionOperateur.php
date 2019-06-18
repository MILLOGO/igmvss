<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 10/07/2018
 * Time: 12:26
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$id=0;
if(isset($_POST['id'])){
    $id=$_POST['id'];
}
?>
<div class="modal" id="detailGestOp" data-backdrop="static">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeDetailGestOp" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <?php $bailleu=Bd_GestionSite ::ListeGestOpParId($id);
                $gestionsite=new Bd_GestionSite();
                $nomprojet=$gestionsite->RecupererNomProjet($id);
                foreach($bailleu as $bail):
                ?>
                <h3 style="padding-left: 5px; padding-top: 5px;" >Détails  </span></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6">
                        <legend>Infos sur l'opérateur</legend>
                        <table class="table table-striped">
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Opérateur:
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo  $bail[1]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Nom et Prénoms
                                </td>
                                <td style="vertical-align: middle">
                                    <?php echo "<span class='maj'> ".$bail[2]." </span>". $bail[3];?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Tél:
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $bail[5] ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Email :
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $bail[4]?>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6">

                        <legend>Infos sur le gestionnaire</legend>
                        <table class="table table-striped">
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Gestionnaire:
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo  $bail[8]; ?>
                                </td>
                            </tr>
                            <?php if($bail[8]=='collectif'){ ?>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Nom du collectif:
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo  $bail[17]; ?>
                                </td>
                            </tr>
                            <?php } ?>

                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Nom et Prénoms:
                                </td>
                                <td style="vertical-align: middle">
                                    <?php echo "<span class='maj'> ".$bail[9]." </span>". $bail[10];?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Téléphone:
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $bail[11] ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Email:
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $bail[12] ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <legend>Infos sur l'appui</legend>
                        <table class="table table-striped">
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Type d'appui
                                </td>
                                <td style="vertical-align: middle">
                                    <?php echo " ".$bail[21]; ?>
                                </td>
                                <td style="color: #006600; font-size: 12pt;">
                                    Nbre de bénéficiaire
                                </td>
                                <td style="vertical-align: middle">
                                    <?= $bail[25];  ?>
                                </td>
                            </tr>
                            <tr>
                               <td style="color: #006600; font-size: 12pt;">
                                    Date de début
                               </td>
                               <td style="vertical-align: middle">
                                    <?= $bail[23]; ?>
                               </td>
                               <td style="color: #006600; font-size: 12pt;">
                                    Date de fin
                               </td>
                               <td style="vertical-align: middle">
                                    <?= $bail[24]; ?>
                               </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Exploitation PFNL
                                </td>
                                <td style="vertical-align: middle">
                                    <?php if($bail[27]==TRUE){echo " OUI";}else{ echo "NON";} ?>
                                </td>
                                <td style="color: #006600; font-size: 12pt;">
                                    Description
                                </td>
                                <td style="vertical-align: middle">
                                    <?= $bail[26]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Nom du projet
                                </td>
                                <td style="vertical-align: middle">
                                    <?php echo $nomprojet; ?>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
                <?php  endforeach ?>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="annulerGestOp" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

    $('#annulerGestOp').on('click', function(){
        $("#corps").load("./gestionSite/gestionnaireOperateur/listeGestionOperateur.php");
    });

    $('#closeDetailGestOp').on('click', function(){
        $("#corps").load("./gestionSite/gestionnaireOperateur/listeGestionOperateur.php");
    });
</script>
<?php }?>