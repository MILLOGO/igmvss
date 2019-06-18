<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 14/07/2018
 * Time: 12:37
 */


include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{


$tableau=Bd_GestionProjetActeur::ListeFinanceOperateur();
/*
$cle=9;
$nopro=2;
$noBail=4;
$noOp=6;
$mont=7;
$anne=8;*/
    $cle=8;
    $nopro=1;
    $noBail=3;
    $noOp=5;
    $mont=6;
    $anne=7;

?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Financements</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="newfinance" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th>Nom du bailleur</th>
            <th>Nom de l'opérateur</th>
            <th>Nom du projet</th>
            <th>Montant</th>
            <th>année</th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            $gesttionprojetacteur=new Bd_GestionProjetActeur();
            $taille=8;
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+$taille;
                $bailleur=$tab[$noBail];
                $noBail=$noBail+$taille;
                $operateur=$tab[$noOp];
                $noOp=$noOp+$taille;
                if($tab[$nopro]!=-1){
                    $projet= $gesttionprojetacteur->RecupererNomProjet($tab[$nopro]);
                }else{
                    $projet= "Aucun Projet";
                }

                $nopro=$nopro+$taille;
                $montant=$tab[$mont];
                $mont=$mont+$taille;
                $annee=$tab[$anne];
                $anne=$anne+$taille;

                ?>
                <tr>
                    <td><?php echo $bailleur ?></td>
                    <td><?php echo $operateur; ?></td>
                    <td><?php echo $projet; ?></td>
                    <td><?php echo $montant.' Fcfa'; ?> </td>
                    <td><?php echo $annee; ?> </td>
                    <td><a onclick="$('#envoi').load('./gestionProjetActeur/financerBailleurOperateur/modifierFinanceOp.php',{idfinance : <?php echo $id; ?>},function(){
                            $('#UpdateFinancement').modal();});" href="#" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a onclick="$('#envoi').load('./gestionProjetActeur/financerBailleurOperateur/supprimerFinanceOp.php',{idfinance : <?php echo $id; ?>},function(){
                            $('#deleteFinacement').modal();});" href="#" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <br><br>
    <a href="./gestionProjetActeur/financerBailleurOperateur/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>
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


    $("#newfinance").on('click',function(){
        $("#envoi").load("./gestionProjetActeur/financerBailleurOperateur/ajouterFinancement.php", function(){
            $('#newFinancement').modal();
        });
    });
</script>
<?php }?>