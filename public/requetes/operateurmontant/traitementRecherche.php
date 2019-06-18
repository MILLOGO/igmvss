<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/07/2018
 * Time: 13:19
 */

include_once('../../../Databases/FichierBD.php');

if($_SESSION){
    $RACINE_REQUETES='';
}

if(isset($_GET['bailleur']) && isset($_GET['nomOpt']) && isset($_GET['region']) && isset($_GET['province'])
        && isset($_GET['commune'])&& isset($_GET['localite'])&& isset($_GET['anne'])){

    $bailleur=$_GET['bailleur'];
    $nomOpt=$_GET['nomOpt'];
    $region=$_GET['region'];
    $province=$_GET['province'];
    $commune=$_GET['commune'];
    $localite=$_GET['localite'];
    $annee=$_GET['anne'];

    $condition=new RequetesFunction();

    $where=$condition->OperateurMontant($bailleur, $nomOpt, $region, $province, $commune, $localite,$annee);
    $requete='';
    if($where!=''){
        $requete = "SELECT nombailleur, nomoperateur, nomregion, nomprovince, nomcommune, nomlocalite, anneefinancement, montantfinancement
                    FROM requete7 WHERE $where";
    }else{
        $requete = "SELECT nombailleur, nomoperateur, nomregion, nomprovince, nomcommune, nomlocalite, anneefinancement, montantfinancement
                    FROM requete7";
    }

    $resultat = Bd_Requetes::ListeRequete1($requete);
    $requeBd=new Bd_Requetes();
    $nbre=$requeBd->CompterResultat($requete);
    $ba=1; $pro=4; $reg=3; $lo=6; $com=5; $op=2; $mon=8; $an=7
    ?>
    <input type="button" class="pull-right btn btn-primary" value="<?php $s=''; if($nbre>1){
        $s='s';
    } echo $nbre.' Resultat'.$s.' trouvé'.$s; ?>" style="background-color: #006600; color: #fff; font-weight: bold">
    <table class="table table-striped myTable" >
        <thead style="background-color: #060; color: #FFF;">
        <th>Bailleur</th>
        <th>Opérateur</th>
        <th>Région</th>
        <th>Province</th>
        <th>Commune</th>
        <th>Localité</th>
        <th>Montant financement</th>
        <th>Année de financement</th>
        </thead>
        <tbody>
        <?php
        foreach ($resultat as $tab):
            $nomBail=$tab[$ba];
            $ba=$ba+8;
            $nomOpt=$tab[$op];
            $op=$op+8;
            $montant=$tab[$mon];
            $mon=$mon+8;
            $nomregion=$tab[$reg];
            $reg=$reg+8;
            $nomprovince=$tab[$pro];
            $pro=$pro+8;
            $nomcommune=$tab[$com];
            $com=$com+8;
            $nomlocalite=$tab[$lo];
            $lo=$lo+8;
            $annee=$tab[$an];
            $an=$an+8;
            ?>
            <tr>
                <td><?php echo $nomBail; ?></td>
                <td><?php echo $nomOpt; ?></td>
                <td><?php echo $nomregion; ?></td>
                <td><?php echo $nomprovince; ?></td>
                <td><?php echo $nomcommune; ?></td>
                <td><?php echo $nomlocalite; ?></td>
                <td><?php echo $montant.' FCFA'; ?></td>
                <td><?php echo $annee; ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <br><br>
    <a href="<?php echo $RACINE_REQUETES;?>requetes/operateurmontant/exportExcel.php?where=<?php echo $where; ?>" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>
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
