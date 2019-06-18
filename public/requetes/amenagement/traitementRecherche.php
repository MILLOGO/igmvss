<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 16/07/2018
 * Time: 02:34
 */

include_once('../../../Databases/FichierBD.php');

if($_SESSION){
    $RACINE_REQUETES='';
}

if(isset($_GET['region']) && isset($_GET['province']) && isset($_GET['commune']) && isset($_GET['localite'])
    && isset($_GET['nomcat']) && isset($_GET['amenge']) && isset($_GET['annee'])){
    $region=$_GET['region'];
    $province=$_GET['province'];
    $commune=$_GET['commune'];
    $local=$_GET['localite'];
    $categorie=$_GET['nomcat'];
    $amenage=$_GET['amenge'];
    $annee=$_GET['annee'];

    $condition=new RequetesFunction();
    $where= $condition->RequeteAmenagement($region,$province,$commune,$local,$categorie,$amenage, $annee);
    $requete='';

    if($where!='') {
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomamenagement, nomcategorieamenagement, SUM(superficieciblee)
                    AS superficietotal, extract(year from periodedebut) as annee, typemesuresite FROM requete1 WHERE $where GROUP BY nomregion, nomprovince,
                    nomcommune, nomlocalite, nomamenagement, nomcategorieamenagement, annee,typemesuresite";
    }else{
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomamenagement, nomcategorieamenagement, SUM(superficieciblee)
                    AS superficietotal, extract(year from periodedebut) as annee,typemesuresite FROM requete1 GROUP BY nomregion, nomprovince,
                    nomcommune, nomlocalite, nomamenagement, nomcategorieamenagement, annee,typemesuresite";
    }

    $resultat = Bd_Requetes::ListeRequete1($requete);
    $requeBd=new Bd_Requetes();
    $nbre=$requeBd->CompterResultat($requete);
    $reg=1; $pro=2; $com=3; $lo=4; $amen=5; $cat=6; $sup=7; $ann=8;$typ=9; $taille=9;
    ?>
    <input type="button" class="pull-right btn btn-primary" value="<?php $s=''; if($nbre>1){
        $s='s';
    } echo $nbre.' Resultat'.$s.' trouvé'.$s; ?>" style="background-color: #006600; color: #fff; font-weight: bold">
    <table class="table table-striped myTable" >
        <thead style="background-color: #060; color: #FFF;">
        <th>Région</th>
        <th>Province</th>
        <th>Commune</th>
        <th>Localité</th>
        <th>Catégorie d'aménagement</th>
        <th>Aménagement</th>
        <th>Mesure Totale</th>
        <th>année</th>
        </thead>
        <tbody>
        <?php
        foreach ($resultat as $tab):
            $nomReg=$tab[$reg];
            $reg=$reg+$taille;
            $nomPro=$tab[$pro];
            $pro=$pro+$taille;
            $nomCom=$tab[$com];
            $com=$com+$taille;
            $nomLoca=$tab[$lo];
            $lo=$lo+$taille;
            $nomAmen=$tab[$amen];
            $amen=$amen+$taille;
            $nomCat=$tab[$cat];
            $cat=$cat+$taille;
            $superficie=$tab[$sup];
            $sup=$sup+$taille;
            $annee=$tab[$ann];
            $ann=$ann+$taille;
            $type=$tab[$typ];
            $typ=$typ+$taille;
            ?>
            <tr>
                <td><?php echo $nomReg; ?></td>
                <td><?php echo $nomPro; ?></td>
                <td><?php echo $nomCom; ?></td>
                <td><?php echo $nomLoca; ?></td>
                <td><?php echo $nomCat; ?></td>
                <td><?php echo $nomAmen; ?></td>
                <td><?php  if($type=='longueur'){
                        echo $superficie." Km";
                    }else{
                        echo $superficie." ha";
                    }   ?></td>
                <td><?php echo $annee?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <br><br>
    <a href="<?php echo $RACINE_REQUETES;?>requetes/amenagement/exportExcel.php?where=<?php echo $where; ?>" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>
    <?php

}

?>
<?php ?>

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
