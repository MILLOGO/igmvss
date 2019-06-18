<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 03/08/2018
 * Time: 12:38
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idsite='';
if(isset($_POST['idsite'])){
    $idsite=$_POST['idsite'];
}
?>
<div class="modal" id="detailSite" data-backdrop="static">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeDetailBailleur" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <?php $site=Bd_GestionSite::ListerSiteParId($idsite);
                foreach($site as $sit):
                ?>
                <h3 style="padding-left: 5px; padding-top: 5px;" >Détails  </span></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6">
                            <legend>Infos générales</legend>
                            <table class="table table-striped">
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Type du gestionnaire:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo  $sit[4]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Nom et prénoms:
                                    </td>
                                    <td style="vertical-align: middle">
                                        <?php echo "<span class='maj'>". $sit[5]." ". $sit[6]."</span>"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Statut foncier:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo $sit[11]." ". $sit[12] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Catégorie de vocation :
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php $para=new Bd_parametre();
                                            $nomcat=$para->RecupererNomCategorieVocation($sit[13]);
                                            echo $nomcat; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Vocation :
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo $sit[14]; ?>
                                    </td>
                                </tr>
                            </table>

                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6">

                            <legend>Localisation</legend>
                            <table class="table table-striped">
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Région:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo  $sit[23]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Province:
                                    </td>
                                    <td style="vertical-align: middle">
                                        <?php echo $sit[22]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Commune:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo $sit[20] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Localité:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo $sit[17] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Nom du site:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo $sit[2]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Mesure du site :
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php if($sit[24]=='longueur'){
                                            if($sit[3]!=0){
                                                echo $sit[3]." km";
                                            }else{
                                                echo 'inconnue';
                                            }

                                        }else{
                                            if($sit[24]=='superficie'){
                                                if($sit[3]!=0){
                                                    echo $sit[3]." ha";
                                                }else{
                                                    echo 'inconnue';
                                                }
                                            }else{
                                                echo 'inconnue';
                                            }
                                        } ?>
                                    </td>
                                </tr>
                            </table>

                    </div>
                </div>

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
        $("#corps").load("./gestionSite/site/listeSite.php");
    });

    $('#closeDetailBailleur').on('click', function(){
        $("#corps").load("./gestionSite/site/listeSite.php");
    });
</script>
<?php }?>