<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 07/07/2018
 * Time: 07:55
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_GestionSite::ListeRevenu();

$type=1;
$noGe=2;
$preno=3;
$num=4;
$mail=5;
$mont=7;
$anne=8;
$cle=9;

?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des revenus aux gestionnaires</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="nvorevenu" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th>Nom et Prénom du gestionnaire</th>
            <th>Numéro</th>
            <th>Email </th>
            <th>Type</th>
            <th>Montant annuel</th>
            <th>Année</th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            $i=0;
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+9;
                $typeGest=$tab[$type];
                $type=$type+9;
                $numero=$tab[$num];
                $num=$num+9;
                $nomGe=$tab[$noGe];
                $noGe=$noGe+9;
                $prenomGe=$tab[$preno];
                $preno=$preno+9;
                $email=$tab[$mail];
                $mail=$mail+9;
                $montant=$tab[$mont];
                $mont=$mont+9;
                $annee=$tab[$anne];
                $anne=$anne+9;
                ?>
                <tr>
                    <td><?php echo '<span class="maj">'. $nomGe.'</span> '.$prenomGe; ?></td>
                    <td><?php echo $numero; ?></td>
                    <td><?php echo $email ?></td>
                    <td><?php echo $typeGest ?></td>
                    <td><?php echo $montant.' Fcfa' ; ?></td>
                    <td><?php echo $annee; ?> </td>
                    <td><a onclick="$('#corps').load('./gestionSite/revenuGestionnaire/modifierRevenu.php',{idRevenu : <?php echo $id; ?>},function(){
                            $('#updateRevenu').modal();});" href="#" id="modifRevenu<?php echo $i; ?>" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a onclick="$('#corps').load('./gestionSite/revenuGestionnaire/supprimerRevenu.php',{idRevenu : <?php echo $id; ?>},function(){
                            $('#deleterevenu').modal();});" href="#" id="suppRevenu<?php echo $i; ?>" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php $i++; endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./gestionSite/revenuGestionnaire/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

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

    $("#nvorevenu").on('click',function(){
        $('#corps').load("./gestionSite/revenuGestionnaire/ajouterRevenu.php", function () {
            $('#newRevenu').modal();
        });
    });
</script>
<?php }?>