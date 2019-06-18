<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 04/07/2018
 * Time: 11:37
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_GestionSite::ListerTousCollecteur();

$cle=1;
$no=2;
$preno=3;
$fct=4;
$numeC=5;
$email=6;

?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Collecteurs</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="newcolect" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th></th>
            <th>Nom et Prénom du collecteur</th>
            <th>Fonction</th>
            <th>Numéro</th>
            <th>Email</th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+6;
                $numero=$tab[$numeC];
                $numeC=$numeC+6;
                $nom=$tab[$no];
                $no=$no+6;
                $prenom=$tab[$preno];
                $preno=$preno+6;
                $fonction=$tab[$fct];
                $fct=$fct+6;
                $emailB=$tab[$email];
                $email=$email+6;

                ?>
                <tr>
                    <td></td>
                    <td><?php echo '<span class="maj">'. $nom.'</span> '.$prenom; ?></td>
                    <td><?php echo $fonction; ?></td>
                    <td><?php echo $numero; ?></td>
                    <td><?php echo $emailB; ?> </td>
                    <td><a onclick="$('#envoi').load('./gestionSite/collecteur/modifierCollecteur.php',{idcollecteur : <?php echo $id; ?>},function(){
                            $('#updateCollecteur').modal();});" href="#" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a onclick="$('#envoi').load('./gestionSite/collecteur/supprimerCollecteur.php',{idcollecteur : <?php echo $id; ?>},function(){
                            $('#deleteCollecteur').modal();});"  href="#" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./gestionSite/collecteur/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

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


    $("#newcolect").on('click',function(){
        $("#envoi").load("./gestionSite/collecteur/ajoutercollecteur.php", function(){
            $('#newCollecteur').modal();
        });
    });
</script>
<?php }?>
