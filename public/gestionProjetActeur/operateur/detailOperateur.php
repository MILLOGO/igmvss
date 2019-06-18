<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 12/07/2018
 * Time: 22:15
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idop=0;
if(isset($_POST['idoperateur'])){
    $idop=$_POST['idoperateur'];
}
?>
<div class="modal" id="detailOperateur" data-backdrop="static">
    <div class="modal-dialog" style="width: 30%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeDetailOpt" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <?php $operat=Bd_GestionProjetActeur::ListerOperateurParId($idop);
                foreach($operat as $opt):
                ?>
                <h3 style="padding-left: 5px; padding-top: 5px;" >Détails  </span></h3>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Nom de l'opérateur :
                        </td>
                        <td  style="vertical-align: middle">
                            <?php echo "<span class='maj'>". $opt[2]."</span>"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Nom du contact de l'opérateur:
                        </td>
                        <td style="vertical-align: middle">
                            <?php echo "<span class='maj'>". $opt[3]."</span>"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Prénom du contact de l'opérateur:
                        </td>
                        <td  style="vertical-align: middle">
                            <?php echo $opt[4]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Adresse email du contact de l'opérateu:
                        </td>
                        <td  style="vertical-align: middle">
                            <?php echo $opt[5]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Téléphone du contact de l'opérateur:
                        </td>
                        <td  style="vertical-align: middle">
                            <?php echo $opt[6]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Fonction du contact:
                        </td>
                        <td >
                            <?php  echo $opt[7]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Site internet:
                        </td>
                        <td >
                            <?php if($opt[8]==''){ echo "Pas de site internet";}else{
                                echo "<a href='http://".$opt[8]."' target='blank'>".$opt[8]."</a>";
                            }?>
                        </td>
                    </tr>
                </table>
                <?php  endforeach ?>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="annulerOpt" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

    $('#annulerOpt').on('click', function(){
        $("#corps").load("./gestionProjetActeur/operateur/listeOperateur.php");
    });

    $('#closeDetailOpt').on('click', function(){
        $("#corps").load("./gestionProjetActeur/operateur/listeOperateur.php");
    });
</script>
<?php }?>
