<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 02/07/2018
 * Time: 18:13
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{



$tabBailleur=Bd_GestionProjetActeur::ListeTousBailleur();

$idbail=1;
$nomb=2;
$nomc=3;
$prenomC=4;
$numeC=5;
$email=6;
$desc=7;
?>
    <br>
<div class="row zone_filtre" style="text-align: center">
    <label style="font-size: 18pt">Liste des Bailleurs</label>
</div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="newbail" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th>Nom du bailleur</th>
            <th>Nom et Prénom du contact</th>
            <th>Numéro du contact</th>
            <th>Détails</th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            foreach ($tabBailleur as $tab):
                $id=$tab[$idbail];
                $idbail=$idbail+7;
                $numero=$tab[$numeC];
                $numeC=$numeC+7;
                $nombail=$tab[$nomb];
                $nomb=$nomb+7;
                $prenomcont=$tab[$prenomC];
                $prenomC=$prenomC+7;
                $nomcont=$tab[$nomc];
                $nomc=$nomc+7;
                $emailB=$tab[$email];
                $email=$email+7;
                $descrip=$tab[$desc];
                $desc=$desc+7;
                ?>
                <tr>
                    <td><?php echo strtoupper($nombail); ?></td>
                    <td><?php echo strtoupper($nomcont).' '.$prenomcont; ?></td>
                    <td><?php echo $numero; ?></td>
                    <td><a style="text-decoration: none" href="#" onclick="$('#envoi').load('./gestionProjetActeur/bailleur/detailBailleur.php',{idbailleur : <?php echo $id; ?>},function(){
                        $('#detailBailleur').modal();});">Details</a></td>
                    <td><a href="#" onclick="$('#envoi').load('./gestionProjetActeur/bailleur/modifierBailleur.php',{idbailleur : <?php echo $id; ?>},function(){
                            $('#updateBailleur').modal();});" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a onclick="$('#envoi').load('./gestionProjetActeur/bailleur/supprimerBailleur.php',{idbailleur : <?php echo $id; ?>},function(){
                            $('#deleteBailleur').modal();});"  href="#" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div><br><br>
    <a href="./gestionProjetActeur/bailleur/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>
</div>
<div id="envoi"></div>
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


    $("#newbail").on('click',function(){
        $("#envoi").load("./gestionProjetActeur/bailleur/ajouterBailleur.php",function(){
            $('#newBailleur').modal();
        });
    });
</script>
<?php }?>

