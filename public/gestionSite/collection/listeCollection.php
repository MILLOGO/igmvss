<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 09/07/2018
 * Time: 23:52
 */


include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_GestionSite::ListeCollection();

$cle=12;
$no=1;
$preno=2;
$numeC=4;
$dat=7;
$numFi=8;
$nosit=9;
$super=10;

?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Observations</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="newcollection" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th></th>
            <th>Nom et Prénom du collecteur</th>
            <th>Numéro</th>
            <th>Nom du site</th>
            <th>Superficie du site </th>
            <th>Date d'observation </th>
            <th>N°Fiche d'observation </th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+12;
                $numero=$tab[$numeC];
                $numeC=$numeC+12;
                $nom=$tab[$no];
                $no=$no+12;
                $prenom=$tab[$preno];
                $preno=$preno+12;
                $nomSite=$tab[$nosit];
                $nosit=$nosit+12;
                $superficie=$tab[$super];
                $super=$super+12;
                $datepass=$tab[$dat];
                $dat=$dat+12;
                $numFiche=$tab[$numFi];
                $numFi=$numFi+12;

                ?>
                <tr>
                    <td></td>
                    <td><?php echo '<span class="maj">'. $nom.'</span> '.$prenom; ?></td>
                    <td><?php echo $numero; ?></td>
                    <td><?php echo $nomSite; ?></td>
                    <td><?php echo $superficie; ?></td>
                    <td><?php echo $datepass; ?></td>
                    <td><?php echo $numFiche; ?></td>
                    <td><a onclick="$('#corps').load('./gestionSite/collection/modifierCollection.php',{idcollection : <?php echo $id; ?>},function(){
                            $('#updatecollection').modal();});" href="#" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a onclick="$('#corps').load('./gestionSite/collection/supprimerCollection.php',{idcollection : <?php echo $id; ?>},function(){
                            $('#deletecollection').modal();});"  href="#" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./gestionSite/collection/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

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


    $("#newcollection").on('click',function(){
        $("#corps").load("./gestionSite/collection/ajouterCollection.php", function(){
            $('#newcollection').modal();
        });
    });
</script>
<?php }?>