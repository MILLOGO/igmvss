<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 10/07/2018
 * Time: 11:28
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_GestionSite::ListerOperateurGestionnaireAppui();

$cle=22;
$noOp=1;
$noGe=9;
$preno=10;
$noCole=17;
$typ=21;
$typege=8;
$datedeb=23;
$datef=24;

?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Appuis aux gestionnaires</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="nvoOptGestAppui" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th>Nom de l'Opérateur</th>
            <th>Gestionnaire</th>
            <th>Type de gestionnaire</th>
            <th>Type d'appui</th>
            <th>date début</th>
            <th>date Fin</th>
            <th>Détails </th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            $i=0;
            $taille=27;
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+$taille;
                $nomGe=$tab[$noGe];
                $noGe=$noGe+$taille;
                $prenomGe=$tab[$preno];
                $preno=$preno+$taille;
                $typeappui=$tab[$typ];
                $typ=$typ+$taille;
                $datedebut=$tab[$datedeb];
                $datedeb=$datedeb+$taille;
                $datefin=$tab[$datef];
                $datef=$datef+$taille;
                $nomOpt=$tab[$noOp];
                $noOp=$noOp+$taille;
                $typegest=$tab[$typege];
                $typege=$typege+$taille;
                $nomcollectif=$tab[$noCole];
                $noCole=$noCole+$taille;
                ?>
                <tr>
                    <td><?php echo $nomOpt; ?></td>
                    <td><?php if($typegest=='individuel'){echo '<span class="maj">'. $nomGe.'</span> '.$prenomGe;}else{echo '<span class="maj">'. $nomcollectif.'</span> ';}  ?></td>
                    <td><?php echo $typegest; ?></td>
                    <td><?php echo $typeappui; ?></td>
                    <td><?php echo $datedebut; ?></td>
                    <td><?php echo $datefin; ?> </td>
                    <td><a style="text-decoration: none" href="#" onclick="$('#corps').load('./gestionSite/gestionnaireOperateur/detailGestionOperateur.php',{id : <?php echo $id; ?>},function(){
                            $('#detailGestOp').modal();});">Details</a></td>
                    <td><a  onclick="$('#corps').load('./gestionSite/gestionnaireOperateur/modifierGestionOperateur.php',{id : <?php echo $id; ?>},function(){
                            $('#updateAppuiGestionnaire').modal();});" href="#" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a  onclick="$('#corps').load('./gestionSite/gestionnaireOperateur/supprimerGestionOperateur.php',{id : <?php echo $id; ?>},function(){
                            $('#deleteAppuiGestionnaire').modal();});" href="#" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
                <?php $i++; endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./gestionSite/gestionnaireOperateur/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

</div>
<script type="application/javascript">
    $('.myTable').DataTable({
        "language": {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher&nbsp;:",
            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix": "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords": "Aucun &eacute;l&eacute;ment trouv&eacute;",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "&lt;",
                "sNext": ">",
                "sLast": "Dernier"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            }
        },
        responsive: true,
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tout"]],
        "ordering": false
//        "bInfo": false

    });

    $("#nvoOptGestAppui").on('click',function(){
        $('#corps').load("./gestionSite/gestionnaireOperateur/ajouterGestionOperateur.php",function(){
            $("#newAppuiGestionnaire").modal();
        });

    });
</script>
<?php }?>