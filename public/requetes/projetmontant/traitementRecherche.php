<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 16/07/2018
 * Time: 15:12
 */


include_once('../../../Databases/FichierBD.php');

if($_SESSION){
    $RACINE_REQUETES='';
}

if(isset($_GET['projet']) && isset($_GET['bailleur'])){
    $bailleur=$_GET['bailleur'];
    $projet=$_GET['projet'];

    $condition=new RequetesFunction();
    $where=$condition->ProjetMontant($bailleur,$projet);
    $requete='';

    if($where!=''){
        $requete = "SELECT nombailleur, nomprojet, budgetglobal, budgetgmv, datedebutprojet, datefinprojet
                    FROM requete6 WHERE $where";
    }else{
        $requete = "SELECT nombailleur, nomprojet, budgetglobal, budgetgmv, datedebutprojet, datefinprojet
                    FROM requete6";
    }

    $resultat = Bd_Requetes::ListeRequete1($requete);
    $requeBd=new Bd_Requetes();
    $nbre=$requeBd->CompterResultat($requete);
    $ba=1; $pro=2; $glo=3; $gmv=4; $deb=5; $fin=6;
    ?>
    <input type="button" class="pull-right btn btn-primary" value="<?php $s=''; if($nbre>1){
        $s='s';
    } echo $nbre.' Resultat'.$s.' trouvé'.$s; ?>" style="background-color: #006600; color: #fff; font-weight: bold">
    <table class="table table-striped myTable" >
        <thead style="background-color: #060; color: #FFF;">
        <th>Nom du bailleur</th>
        <th>Nom du projet</th>
        <th>Montant global</th>
        <th>Montant GMV</th>
        <th>Date début</th>
        <th>Date fin</th>
        </thead>
        <tbody>
        <?php
        foreach ($resultat as $tab):
            $nomBail=$tab[$ba];
            $ba=$ba+6;
            $nomPro=$tab[$pro];
            $pro=$pro+6;
            $montantglo=$tab[$glo];
            $glo=$glo+6;
            $montanGmv=$tab[$gmv];
            $gmv=$gmv+6;
            $dateDeb=$tab[$deb];
            $deb=$deb+6;
            $datefin=$tab[$fin];
            $fin=$fin+6;
            ?>
            <tr>
                <td><?php echo $nomBail; ?></td>
                <td><?php echo $nomPro; ?></td>
                <td><?php echo $montantglo .' FCFA'; ?></td>
                <td><?php echo $montanGmv.' FCFA'; ?></td>
                <td><?php echo $dateDeb; ?></td>
                <td><?php echo $datefin; ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <br><br>
    <a href="<?php echo $RACINE_REQUETES;?>requetes/projetmontant/exportExcel.php?where=<?php echo $where; ?>" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

    <?php

}

?>

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
</script>
