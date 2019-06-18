<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 04/07/2018
 * Time: 10:19
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_GestionProjetActeur::ListerTousOperateur();

$cle=1;
$nop=2;
$nocop=3;
$prenocop=4;
$emailcop=5;
$numecop=6;
$fctcop=7;
$siteop=8;
?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Opérateurs</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="newop" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th>Nom opérateur</th>
            <th>Nom et Prénom du Contact de opérateur</th>
            <th>Numéro contact opérateur</th>
            <th>Détails </th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+8;
                $numercopera=$tab[$numecop];
                $numecop=$numecop+8;
                $nomcopera=$tab[$nocop];
                $nocop=$nocop+8;
                $nomopera=$tab[$nop];
                $nop=$nop+8;
                $prenomcopera=$tab[$prenocop];
                $prenocop=$prenocop+8;
                $emailcopera=$tab[$emailcop];
                $emailcop=$emailcop+8;
                $fctcopera=$tab[$fctcop];
                $fctcop=$fctcop+8;
                $siteopera=$tab[$siteop];
                $siteop=$siteop+8;

                ?>
                <tr>
                    <td><?php echo $nomopera; ?></td>
                    <td><?php echo "<span class='maj'>". $nomcopera."</span> ".$prenomcopera; ?></td>
                    <td><?php echo $numercopera; ?></td>
                    <td><a style="text-decoration: none" href="#" onclick="$('#envoi').load('./gestionProjetActeur/operateur/detailOperateur.php',{idoperateur : <?php echo $id; ?>},function(){
                            $('#detailOperateur').modal();});" title="modifier">détails</a></td>
                    <td><a onclick="$('#envoi').load('./gestionProjetActeur/operateur/modifierOperateur.php',{idoperateur : <?php echo $id; ?>},function(){
                            $('#updateOperateur').modal();});" href="#" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a onclick="$('#envoi').load('./gestionProjetActeur/operateur/supprimerOperateur.php',{idoperateur : <?php echo $id; ?>},function(){
                            $('#deleteOperateur').modal();});" href="#" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <br><br>
    <a href="./gestionProjetActeur/operateur/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

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


    $("#newop").on('click',function(){
        $("#envoi").load("./gestionProjetActeur/operateur/ajouterOperateur.php", function(){
            $('#newOperateur').modal();
        });
    });


</script>
<?php }?>