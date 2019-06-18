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

$tableau=Bd_GestionSite::ListerTousGestionnaire();

$cle=1;
$no=3;
$preno=4;
$typ=2;
$numeC=5;
$email=6;
$sexe=8;
$genre=12;

?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Gestionnaires</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="newgest" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">

            <th>Nom et Prénom du gestionnaire</th>
            <th>Numéro</th>
            <th>Email</th>
            <th>Type</th>
            <th>Genre</th>
            <th>Details </th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            $i=0;
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+14;
                $numero=$tab[$numeC];
                $numeC=$numeC+14;
                $nom=$tab[$no];
                $no=$no+14;
                $prenom=$tab[$preno];
                $preno=$preno+14;
                $type=$tab[$typ];
                $typ=$typ+14;
                $emailB=$tab[$email];
                $email=$email+14;
                if($type=='individuel'){
                    $genreGes=$tab[$sexe];
                    $sexe=$sexe+14;
                    $genre=$genre+14;
                }else{
                    $genreGes=$tab[$genre];
                    $sexe=$sexe+14;
                    $genre=$genre+14;
                }
                ?>
                <tr>

                    <td><?php echo '<span class="maj">'. $nom.'</span> '.$prenom; ?></td>
                    <td><?php echo $numero; ?></td>
                    <td><?php echo $emailB; ?> </td>
                    <td><?php echo $type; ?></td>
                    <td><?php echo $genreGes; ?></td>
                    <td><a style="text-decoration: none" href="#" onclick="$('#envoi').load('./gestionSite/gestionnaire/detailGestionnaire.php',{idgest : <?php echo $id; ?>},function(){
                            $('#detailGestionnaire').modal();});">Details</a></td>
                    <td><a  href="#" onclick="$('#envoi').load('./gestionSite/gestionnaire/modifierGestionnaire.php',{idgest : <?php echo $id; ?>, type:<?php echo "'".$type."'"; ?> },function(){
                            $('#updateGestionnaire').modal();});" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a onclick="$('#envoi').load('./gestionSite/gestionnaire/supprimerGestionnaire.php',{idgest : <?php echo $id; ?>},function(){
                            $('#deleteGestionnaire').modal();});" href="#" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php $i++; endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./gestionSite/gestionnaire/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

</div>
<div id="envoi"> </div>

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


    $("#newgest").on('click',function(){
        $("#envoi").load("./gestionSite/gestionnaire/ajouterGestionnaire.php", function(){
            $('#newGestionnaire').modal();
        });
    });


</script>
<?php }?>