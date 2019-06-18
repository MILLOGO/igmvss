<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 25/07/2018
 * Time: 13:12
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idam='';
$info='';
if(isset($_POST['idamenager']) && $_POST['idprojet']){
    $idam=$_POST['idamenager'];
    $idpro=$_POST['idprojet'];
}
?>
<div class="modal" id="detailAmenager" data-backdrop="static">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeDetailBailleur" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <?php $tableAmenager='';
                if($idpro!=-1) {
                    $tableAmenager = Bd_GestionAmenagement::detailamenager('detailamenageravcprojet',$idam);
                }else{
                    $tableAmenager = Bd_GestionAmenagement::detailamenager('detailamenagersansprojet',$idam);
                }
                foreach($tableAmenager as $tableDoner):
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
                                    Opérateur:
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo  $tableDoner[22]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Projet:
                                </td>
                                <td style="vertical-align: middle">
                                    <?php if($idpro!=-1){ echo $tableDoner[23];}else{ echo "Pas de projet";} ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Catégorie d'aménagement:
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $tableDoner[16] ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Aménagement :
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $tableDoner[19]?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Date de début :
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $tableDoner[3]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Date de fin :
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $tableDoner[4]; ?>
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
                                    <?php echo  $tableDoner[12]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Province:
                                </td>
                                <td style="vertical-align: middle">
                                    <?php echo $tableDoner[10]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Commune:
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $tableDoner[11] ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Localité:
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $tableDoner[8] ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Nom du site:
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $tableDoner[7]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Mesure du site :
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $tableDoner[5];
                                        if($idpro!=-1){
                                            if($tableDoner[25]=='longueur'){
                                                echo ' km';
                                            }else{
                                                echo ' ha';
                                            }
                                        }else{
                                            if($tableDoner[24]=='longueur'){
                                                echo ' km';
                                            }else{
                                                echo ' ha';
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Mesure Ciblée :
                                </td>
                                <td  style="vertical-align: middle">
                                    <?php echo $tableDoner[2];
                                    if($idpro!=-1){
                                        if($tableDoner[26]=='longueur'){
                                            echo ' km';
                                        }else{
                                            echo ' ha';
                                        }
                                    }else{
                                        if($tableDoner[25]=='longueur'){
                                            echo ' km';
                                        }else{
                                            echo ' ha';
                                        }
                                    }?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php  endforeach ?>
                <div class="row">
                    <div class="col-lg-8 col-sm-8 col-md-8">
                        <legend>Espèces utilisées</legend>
                        <table class="table table-striped">
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Espèces
                                </td>
                                <td style="color: #006600; font-size: 12pt;">
                                    Plant
                                </td>
                                <td style="color: #006600; font-size: 12pt;">
                                    Sémi
                                </td>
                                <td style="color: #006600; font-size: 12pt;">
                                    Survi
                                </td>
                                <td style="color: #006600; font-size: 12pt;">
                                    Répris
                                </td>
                            </tr>
                            <?php
                                $tabeesp=Bd_GestionAmenagement::detailamenager('amenager_espece',$idam);
                            if(!empty($tabeesp)) {
                                $no = 3;
                                $nbr = 4;
                                $qte = 5;
                                $taus = 6;
                                $taur = 7;
                                foreach ($tabeesp as $esp) {
                                    $nom = $esp[$no];
                                    $no = $no + 7;
                                    $nbre_pla = $esp[$nbr];
                                    $nbr = $nbr + 7;
                                    $qtitesemi = $esp[$qte];
                                    $qte = $qte + 7;
                                    $taux_semi = $esp[$taus];
                                    $taus = $taus + 7;
                                    $taux_repri = $esp[$taur];
                                    $taur = $taur + 7;
                                    ?>
                                    <tr>
                                        <td style="vertical-align: middle">
                                            <?php $para = new Bd_parametre();
                                            $nomesp = $para->RecupererNomEspece($nom);
                                            echo $nomesp;
                                            ?>
                                        </td>
                                        <td style="vertical-align: middle">
                                            <?= $nbre_pla ?>
                                        </td>
                                        <td style="vertical-align: middle">
                                            <?= $qtitesemi; ?>
                                        </td>
                                        <td style="vertical-align: middle">
                                            <?= $taux_semi; ?>
                                        </td>
                                        <td style="vertical-align: middle">
                                            <?= $taux_repri; ?>
                                        </td>
                                    </tr>
                                <?php }
                            }else{?>
                                <tr>
                                    <td style="vertical-align: middle">
                                        Pas d'espèces pour cet aménagement!
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>

                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">

                        <legend>Végétalisations</legend>
                        <table class="table table-striped">
                            <tr>
                                <td style="color: #006600; font-size: 12pt;">
                                    Nom de la végétalisation:
                                </td>
                            </tr>
                            <?php
                            $tabeveg=Bd_GestionAmenagement::detailamenager('amenager_vegetalisation',$idam);
                            $no=3;
                            if(!empty($tabeveg)){
                            foreach($tabeveg as $veg){
                                $nom=$veg[$no]; $no=$no+3;
                            ?>
                            <tr>
                                <td style="vertical-align: middle">
                                    <?php $para=new Bd_parametre();
                                        $nomesp=$para->RecupererNomVegetal($nom);
                                        echo $nomesp;
                                    ?>
                                </td>
                            </tr>
                            <?php }
                            }else{?>
                                <tr>
                                    <td style="vertical-align: middle">
                                        Pas de végétalisation pour cet aménagement!
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="annulerB" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

    $('#annulerB').on('click', function(){
        $("#corps").load("./gestionAmenagement/amenager/listeAmenager.php");
    });

    $('#closeDetailBailleur').on('click', function(){
        $("#corps").load("./gestionAmenagement/amenager/listeAmenager.php");
    });
</script>
<?php }?>