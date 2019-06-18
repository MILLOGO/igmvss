<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 02/07/2018
 * Time: 20:11
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_GestionProjetActeur::ListerTousProjet();

$cle=1;
$nop=2;
$budg=3;
$gmv=4;
$datd=5;
$datf=6;
$noc=7;
$prenoc=8;
$numc=9;
$mail=10;
$sit=11;
$desc=12;

?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Projets</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="newprojet" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th>Nom du projet</th>
            <th>Budget du projet</th>
            <th>Budget GMV</th>
            <th>Nom et Prénom du contact</th>
            <th>Détails</th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+12;
                $nomP=$tab[$nop];
                $nop=$nop+12;
                $budget=$tab[$budg];
                $budg=$budg+12;
                $datedeb=$tab[$datd];
                $datd=$datd+12;
                $datefin=$tab[$datf];
                $datf=$datf+12;
                $nomcont=$tab[$noc];
                $noc=$noc+12;
                $prenomcont=$tab[$prenoc];
                $prenoc=$prenoc+12;
                $numerocont=$tab[$numc];
                $numc=$numc+12;
                $email=$tab[$mail];
                $mail=$mail+12;
                $site=$tab[$sit];
                $sit=$sit+12;
                $descrip=$tab[$desc];
                $desc=$desc+12;
                $budgmv=$tab[$gmv];
                $gmv=$gmv+12;
                ?>
                <tr>
                    <td><?php echo $nomP; ?></td>
                    <td><?php echo $budget .' Fcfa'; ?></td>
                    <td><?php echo $budgmv. ' Fcfa'; ?></td>
                    <td><?php echo '<span class="maj">'.$nomcont.'</span> '.$prenomcont; ?></td>
                    <td><a style="text-decoration: none" href="#" onclick="$('#corps').load('./gestionProjetActeur/projet/detailProjet.php',{id : <?php echo $id; ?>},function(){
                            $('#detailProjet').modal();});">Details</a></td>
                    <td><a onclick="$('#corps').load('./gestionProjetActeur/projet/modifierProjet.php',{id : <?php echo $id; ?>},function(){
                            $('#updateProjet').modal();});" href="#" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a  onclick="$('#corps').load('./gestionProjetActeur/projet/supprimerProjet.php',{id : <?php echo $id; ?>},function(){
                            $('#deleteProjet').modal();});" href="#" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <br><br>
    <a href="./gestionProjetActeur/projet/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>
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

    $("#newprojet").on('click',function(){
        $("#corps").load("./gestionProjetActeur/projet/ajouterProjet.php", function(){
            $('#newprojet').modal();
        });
    });
</script>

<?php }?>
