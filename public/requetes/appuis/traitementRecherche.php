<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 10/08/2018
 * Time: 22:43
 */

include_once('../../../Databases/FichierBD.php');

if($_SESSION){
    $RACINE_REQUETES='';
}

if(isset($_GET['region']) && isset($_GET['province']) && isset($_GET['commune']) && isset($_GET['localite'])
    && isset($_GET['projet']) && isset($_GET['nomOpt']) && isset($_GET['gestionnaire']) && isset($_GET['type'])
    && isset($_GET['debut']) && isset($_GET['fin'])){
    $region=$_GET['region'];
    $province=$_GET['province'];
    $commune=$_GET['commune'];
    $local=$_GET['localite'];
    $projet=$_GET['projet'];
    $gestionnaire=$_GET['gestionnaire'];
    $type=$_GET['type'];
    $operateur=$_GET['nomOpt'];
    $debut=$_GET['debut'];
    $fin=$_GET['fin'];
    $requete='';

    $requet=new RequetesFunction();
    $where=$requet->requeteAppuis($region,$province,$commune,$local,$gestionnaire,$type,$projet,$operateur,$debut,$fin);

    if($where!='') {
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomgestionnaire, prenomgestionnaire, nomprojet, nomoperateur, typegestionnaire,typeappui,datedebutappui,datefinappui,nomsite
                    FROM requete9 WHERE $where";
    }else{
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomgestionnaire, prenomgestionnaire, nomprojet, nomoperateur, typegestionnaire,typeappui,datedebutappui,datefinappui,nomsite
                    FROM requete9";
    }

    $resultat = Bd_Requetes::ListeRequete1($requete);
    $requeBd=new Bd_Requetes();
    $nbre=$requeBd->CompterResultat($requete);
    $reg=1; $pro=2; $com=3; $lo=4; $nogest=5; $pregest=6; $proj=7; $opt=8; $typgest=9; $typappui=10; $deb=11; $fi=12; $nomsit=13;
    $taille=13;
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
        <th>Site</th>
        <th>Nom et prénom(s)</th>
        <th>Type</th>
        <th>Projet</th>
        <th>Opérateur</th>
        <th>Type appui</th>
        <th>Début</th>
        <th>Fin</th>
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
            $nomAmen=$tab[$nogest];
            $nogest=$nogest+$taille;
            $nomCat=$tab[$pregest];
            $pregest=$pregest+$taille;
            $nomprojet=$tab[$proj];
            $proj=$proj+$taille;
            $nomOpt=$tab[$opt];
            $opt=$opt+$taille;
            $typegest=$tab[$typgest];
            $typgest=$typgest+$taille;
            $typeappui=$tab[$typappui];
            $typappui=$typappui+$taille;
            $debut=$tab[$deb];
            $deb=$deb+$taille;
            $fin=$tab[$fi];
            $fi=$fi+$taille;
            $nomdusite=$tab[$nomsit];
            $nomsit=$nomsit+$taille;
            ?>
            <tr>
                <td><?php echo $nomReg; ?></td>
                <td><?php echo $nomPro; ?></td>
                <td><?php echo $nomCom; ?></td>
                <td><?php echo $nomLoca; ?></td>
                <td><?php echo $nomdusite; ?></td>
                <td><?php echo '<span class="maj">'. $nomAmen.'</span> '.$nomCat; ?></td>
                <td><?php echo $typegest; ?></td>
                <td><?php echo $nomprojet; ?></td>
                <td><?php echo strtoupper($nomOpt); ?></td>
                <td><?php echo $typeappui; ?></td>
                <td><?php echo $debut; ?></td>
                <td><?php echo $fin; ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <br><br>
    <a href="<?php echo $RACINE_REQUETES;?>requetes/appuis/exportExcel.php?where=<?php echo $where; ?>" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

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
