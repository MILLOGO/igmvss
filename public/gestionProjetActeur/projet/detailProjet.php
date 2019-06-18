<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 10/07/2018
 * Time: 08:38
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idprojet=0;
if(isset($_POST['id'])){
    $idprojet=$_POST['id'];
}
?>

<div class="modal" id="detailProjet" data-backdrop="static">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeDetailProjet" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <?php $tableau=Bd_GestionProjetActeur::ListerProjetParId($idprojet);
                foreach($tableau as $donne):
                ?>
                <h3 style="padding-left: 5px; padding-top: 5px;" >Détails  </span></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6">
                        <legend>Informations générales</legend>
                            <table class="table table-striped">
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Nom du projet :
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo "<span class='maj'>". $donne[2]."</span>"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Budget Global:
                                    </td>
                                    <td style="vertical-align: middle">
                                        <?php echo  $donne[3]." Fcfa"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Budget GMV:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo $donne[4].' Fcfa'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Date de début du projet:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo $donne[5]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Date de fin du projet:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo $donne[6]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Nom du contact:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo $donne[7]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Prénom du contact:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo $donne[8]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Téléphone du contact:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo $donne[9]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Adresse email du contact:
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <?php echo $donne[10]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Site internet:
                                    </td>
                                    <td >
                                        <?php if($donne[11]==''){ echo "Pas de site internet";}else{
                                            echo "<a href='http://".$donne[11]."' target='blank'>".$donne[11]."</a>";
                                        }?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #006600; font-size: 12pt;">
                                        Description:
                                    </td>
                                    <td >
                                        <?php if($donne[12]==""){ echo "Aucune description trouvée";}else{ echo $donne[12]; }?>
                                    </td>
                                </tr>
                            </table>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6">
                        <legend>Autres informations</legend>
                        <p style="text-align: center; font-weight: bold"><label>Financé par:</label></p>
                    <?php
                        $finance=Bd_GestionProjetActeur::ListeFinancierParIdProjet($idprojet);
                    if(empty($finance)){
                        echo "<span style='color: red'> Aucun financier trouvé pour ce projet </span>";
                    }else {

                        $mont=4; $an=5; $nom=6;
                            ?>
                            <table class="table table-striped">
                                <thead>
                                <th style="color: #006600">Nom du Bailleur</th>
                                <th style="color: #006600">Montant Financé</th>
                                <th style="color: #006600">Année</th>
                                </thead>
                                <tbody>
                                <?php foreach ($finance as $financier):
                                    $bailleur=$financier[$nom];
                                    $nom=$nom+6;
                                    $montant=$financier[$mont];
                                    $mont=$mont+6;
                                    $anne=$financier[$an];
                                    $an=$an+6;
                            ?>
                                <tr>
                                    <td><?php echo $bailleur ?></td>
                                    <td><?php echo $montant.' Fcfa' ?></td>
                                    <td><?php echo $anne ?></td>

                                </tr>

                            <?php
                        endforeach;
                        ?>
                                </tbody>
                            </table>

                    <?php }?>
                        <p style="text-align: center; font-weight: bold"><label>Executé dans:</label></p>
                        <?php
                        $executeCom=Bd_GestionProjetActeur::ListeCommuneParIdProjet($idprojet);
                        if(empty($executeCom)){
                            echo "<span style='color: red'> Aucun lieu d'exécution renseigné pour ce projet </span>";
                        }else {

                        $com=3; $pro=4; $reg=5;
                        ?>
                        <table class="table table-striped">
                            <thead>
                            <th style="color: #006600">Nom de la commune</th>
                            <th style="color: #006600">Nom de la province</th>
                            <th style="color: #006600">Nom de la région</th>
                            </thead>
                            <tbody>
                            <?php foreach ($executeCom as $executeCo):
                                $commune=$executeCo[$com];
                                $com=$com+6;
                                $province=$executeCo[$pro];
                                $pro=$pro+6;
                                $region=$executeCo[$reg];
                                $reg=$reg+6;
                                ?>
                                <tr>
                                    <td><?php echo $commune ?></td>
                                    <td><?php echo $province ?></td>
                                    <td><?php echo $region ?></td>

                                </tr>

                                <?php
                            endforeach;
                            ?><p style="text-align: center; font-weight: bold">
                            </tbody>
                        </table>
                        <?php }?>
                        <p style="text-align: center; font-weight: bold"><label>Executé par:</label></p>
                        <?php
                        $executeOpt=Bd_GestionProjetActeur::ListeExecuterProjetOperateurParIdProjet($idprojet);
                        if(empty($executeOpt)){
                            echo "<span style='color: red'> Aucun opérateur d'exécution renseigné pour ce projet </sp>";
                        }else {

                            $op=7; $fctTech=4; $fctF=5; $mont=6;
                            ?>
                            <table class="table table-striped">
                                <thead>
                                <th style="color: #006600">Nom de l'opérateur</th>
                                <th style="color: #006600">Fonction technique</th>
                                <th style="color: #006600">Fonction Finacière</th>
                                <th style="color: #006600">Montant</th>
                                </thead>
                                <tbody>
                                <?php foreach ($executeOpt as $executeOp):
                                    $operateur=$executeOp[$op];
                                    $op=$op+7;
                                    $fctTechni=$executeOp[$fctTech];
                                    $fctTech=$fctTech+7;
                                    $fctFina=$executeOp[$fctF];
                                    $fctF=$fctF+7;
                                    $montOp=$executeOp[$mont];
                                    $mont=$mont+7;
                                    ?>
                                    <tr>
                                        <td><?php echo $operateur ?></td>
                                        <td><?php if($fctTechni==1){ echo "OUI";}else{echo "NON";} ?></td>
                                        <td><?php if($fctFina==1){ echo "OUI";}else{echo "NON";}  ?></td>
                                        <td><?php echo $montOp; if($fctFina==1){ echo ' Fcfa'; } ?></td>

                                    </tr>

                                    <?php
                                endforeach;
                                ?>
                                </tbody>
                            </table>
                    <?php } endforeach ?>
                    </div>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="annulerDetailProjet" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>

        </div>
    </div>
</div>

<script type="application/javascript">

    $('#annulerDetailProjet').on('click', function(){
        $("#corps").load("./gestionProjetActeur/projet/listeProjet.php");
    });
    
    $('#closeDetailProjet').on('click', function(){
        $("#corps").load("./gestionProjetActeur/projet/listeProjet.php");
    });
</script>

<?php }?>