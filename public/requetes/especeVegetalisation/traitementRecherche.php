<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 12/08/2018
 * Time: 22:22
 */

include_once('../../../Databases/FichierBD.php');

if($_SESSION){
    $RACINE_REQUETES='';
}

if(isset($_GET['region']) && isset($_GET['province']) && isset($_GET['commune']) && isset($_GET['localite'])
    && isset($_GET['espece']) && isset($_GET['vegetal'])){

    $region=$_GET['region'];
    $province=$_GET['province'];
    $commune=$_GET['commune'];
    $local=$_GET['localite'];
    $espece=$_GET['espece'];
    $vegetal=$_GET['vegetal'];

    $condition=new RequetesFunction();
    $where= $condition->EspeceVegetalisation($region,$province,$commune,$local,$espece,$vegetal);
    $requete='';

    if($where!='') {
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomsite,superficieciblee,periodedebut,periodefin, tauxreprise,
                    tauxsurvie,quantitesemis,nbreplant,nomespece,typevegetalisation,typemesuresite FROM requete13 WHERE $where";
    }else{
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomsite,superficieciblee,periodedebut,periodefin, tauxreprise,
                    tauxsurvie,quantitesemis,nbreplant,nomespece,typevegetalisation,typemesuresite FROM requete13";
    }

    $resultat = Bd_Requetes::ListeRequete1($requete);
    $requeBd=new Bd_Requetes();
    $nbre=$requeBd->CompterResultat($requete);
    $reg=1; $pro=2; $com=3; $lo=4; $sit=5; $sup=6; $pdeb=7; $pfin=8; $rep=9; $surv=10; $qtesem=11; $nbreplan=12; $esp=13; $veg=14; $typemes=15;

    $taille=15;
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
        <th>Espèce</th>
        <th>nbre plant</th>
        <th>Qté semis</th>
        <th>Taux survie</th>
        <th>Taux reprise</th>
        <th>Végétalisation</th>
        <th>Site</th>
        <th>Mesure ciblée</th>
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
            $site=$tab[$sit];
            $sit=$sit+$taille;
            $debut=$tab[$pdeb];
            $pdeb=$pdeb+$taille;
            $superficie=$tab[$sup];
            $sup=$sup+$taille;
            $fin=$tab[$pfin];
            $pfin=$pfin+$taille;
            $repris=$tab[$rep];
            $rep=$rep+$taille;
            $survie=$tab[$surv];
            $surv=$surv+$taille;
            $quantite=$tab[$qtesem];
            $qtesem+=$taille;
            $nbreplant=$tab[$nbreplan];
            $nbreplan+=$taille;
            $espece=$tab[$esp];
            $esp+=$taille;
            $vegetalisation=$tab[$veg];
            $veg+=$taille;
            $typemesuresite=$tab[$typemes];
            if($typemesuresite=='longueur'){
                $superficie=$superficie.' km';
            }else{
                $superficie=$superficie.' ha';
            }
            $typemes=$typemes+$taille;
            ?>
            <tr>
                <td><?php echo $nomReg; ?></td>
                <td><?php echo $nomPro; ?></td>
                <td><?php echo $nomCom; ?></td>
                <td><?php echo $nomLoca; ?></td>
                <td><?php echo $espece; ?></td>
                <td><?php echo $nbreplant; ?></td>
                <td><?php echo $quantite; ?></td>
                <td><?php echo $survie; ?></td>
                <td><?php echo $repris; ?></td>
                <td><?php echo $vegetalisation; ?></td>
                <td><?php echo $site; ?></td>
                <td><?php echo $superficie; ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <br><br>
    <a href="<?php echo $RACINE_REQUETES;?>requetes/especeVegetalisation/exportExcel.php?where=<?php echo $where; ?>" title="Exporter">
        <input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>
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
