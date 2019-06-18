<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 13/07/2018
 * Time: 21:34
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idgest=0;
$type='';
if(isset($_POST['idgest'])){
    $idgest=$_POST['idgest'];
    $gestionnaire=new Bd_GestionSite();
    $type=$gestionnaire->RecupererTypeGest($idgest);
}
?>
<div class="modal" id="detailGestionnaire" data-backdrop="static">
    <div class="modal-dialog" style="width: 30%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeDetailBailleur" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <?php
                $gestion='';
                if($type=='individuel') {
                    $gestion = Bd_GestionSite::GestionnaireIndividuelParId($idgest);
                }else{
                    $gestion = Bd_GestionSite::GestionnaireCollectifParId($idgest);
                }
                foreach($gestion as $bail):
                ?>
                <h3 style="padding-left: 5px; padding-top: 5px;" >Détails du gestionnaire  </span></h3>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Type du Gestionnaire:
                        </td>
                        <td  style="vertical-align: middle">
                            <?php echo "<span class='maj'>". $bail[2]."</span>"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Nom du Gestionnaire:
                        </td>
                        <td style="vertical-align: middle">
                            <?php echo "<span class='maj'>". $bail[3]."</span>"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Prénom du Gestionnaire:
                        </td>
                        <td  style="vertical-align: middle">
                            <?php echo $bail[4]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Adresse email du Gestionnaire :
                        </td>
                        <td  style="vertical-align: middle">
                            <?php echo $bail[6]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #006600; font-size: 12pt;">
                            Téléphone du Gestionnaire :
                        </td>
                        <td  style="vertical-align: middle">
                            <?php echo $bail[5]; ?>
                        </td>
                    </tr>
                    <tr>
                        <?php if($type!='collectif'){?>
                        <td style="color: #006600; font-size: 12pt;">
                            Date de naissance :
                        </td>
                        <?php }else{?>
                        <td style="color: #006600; font-size: 12pt;">
                            Nom du collectif :
                        </td>
                        <?php }?>
                        <td >
                            <?php  echo $bail[7]; ?>
                        </td>
                    </tr>
                    <tr>
                        <?php if($type!='collectif'){?>
                            <td style="color: #006600; font-size: 12pt;">
                                Sexe :
                            </td>
                        <?php }else{?>
                            <td style="color: #006600; font-size: 12pt;">
                                Genre du collectif :
                            </td>
                        <?php }?>
                        <td >
                            <?php  echo $bail[8]; ?>
                        </td>
                    </tr>
                    <tr>
                        <?php if($type!='collectif'){?>
                            <td style="color: #006600; font-size: 12pt;">
                                Nombre de personne dans le ménage :
                            </td>
                        <?php }else{?>
                            <td style="color: #006600; font-size: 12pt;">
                                Type du collectif :
                            </td>
                        <?php }?>
                        <td >
                            <?php  echo $bail[9]; ?>
                        </td>
                    </tr>
                    <tr>
                        <?php if($type!='collectif'){?>
                            <td style="color: #006600; font-size: 12pt;">
                                Nombre de personne de moins de 16 ans :
                            </td>
                        <?php }else{?>
                            <td style="color: #006600; font-size: 12pt;">
                                Nombre des membres du collectif :
                            </td>
                        <?php }?>
                        <td >
                            <?php  echo $bail[10]; ?>
                        </td>
                    </tr>
                </table>
                <h4 style="text-align: center; font-weight: bold; color: red">Facteur de production du gestionnaire:</h4>
                <?php $facteur=Bd_GestionSite::ListerGestionnaireFacteurParIdGest($idgest);
                if(empty($facteur)){
                echo "<span style='color: red'> Ce gestionnaire ne possède aucun facteur de production </span>";
                }else{

                $op=1;
                ?>
                <table class="table table-striped">
                    <?php
                    $i=0;
                    foreach ($facteur as $facteurs):

                        $nomfacteur=$facteurs[$op];
                        $op=$op+3;
                        $i++;
                        echo'<td >'.$nomfacteur .',</td>';
                        if(($i%5)==0)
                            echo'</tr><tr>';
                    endforeach;
                        $i=0;
                        ?>

                </table>

                <?php } endforeach ?>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="annulerGest" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

    $('#annulerGest').on('click', function(){
        $("#corps").load("./gestionSite/gestionnaire/listeGestionnaire.php");
    });

    $('#closeDetailGestionnaire').on('click', function(){
        $("#corps").load("./gestionSite/gestionnaire/listeGestionnaire.php");
    });
</script>
<?php }?>