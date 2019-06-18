<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 01/08/2018
 * Time: 20:58
 */


include_once('../../../Databases/FichierBD.php');

if($_SESSION){
    $RACINE_REQUETES='';
}

if(isset($_GET['region']) && isset($_GET['province']) && isset($_GET['commune']) && isset($_GET['filtre'])){
    $region=$_GET['region'];
    $province=$_GET['province'];
    $commune=$_GET['commune'];
    $filtre=$_GET['filtre'];
    $flitrerPar=explode(',',$filtre);
    $terminer=''; $encours='';
    if(count($flitrerPar)==2){
        $terminer='';
        $encours='';
    }else{
        if(count($flitrerPar)==1){
            if($flitrerPar[0]=='terminer'){
                $terminer=$flitrerPar[0];
            }else{
                $encours=$flitrerPar[0];
            }
        }
    }
    $requete='';

    $requet=new RequetesFunction();
    $where=$requet->ProjetZoneGeographique($region,$province,$commune,$terminer,$encours);

    if($where!='') {
        $requete = "SELECT DISTINCT nomregion, nomprovince, nomcommune, nomprojet, datedebutprojet, datefinprojet FROM requete8 WHERE $where";
    }else{
        $requete = "SELECT DISTINCT nomregion, nomprovince, nomcommune, nomprojet, datedebutprojet, datefinprojet FROM requete8";
    }

    $resultat = Bd_Requetes::ListeRequete1($requete);
    $requeBd=new Bd_Requetes();
    $nbre=$requeBd->CompterResultat($requete);
    $reg=1; $pro=2; $com=3; $deb=5; $fin=6; $proj=4;
    ?><br>
    <input type="button" class="pull-right btn btn-primary" value="<?php $s=''; if($nbre>1){
        $s='s';
    } echo $nbre.' Resultat'.$s.' trouvé'.$s; ?>" style="background-color: #006600; color: #fff; font-weight: bold">
    <br>
    <table class="table table-striped myTable" >
        <thead style="background-color: #060; color: #FFF;">
        <th>Région</th>
        <th>Province</th>
        <th>Commune</th>
        <th>Projet</th>
        <th>Date de début</th>
        <th>Date de Fin</th>
        </thead>
        <tbody>
        <?php
        foreach ($resultat as $tab):
            $nomReg=$tab[$reg];
            $reg=$reg+6;
            $nomPro=$tab[$pro];
            $pro=$pro+6;
            $nomCom=$tab[$com];
            $com=$com+6;
            $datedeb=$tab[$deb];
            $deb=$deb+6;
            $datefin=$tab[$fin];
            $fin=$fin+6;
            $nomprojet=$tab[$proj];
            $proj=$proj+6;
            ?>
            <tr>
                <td><?php echo $nomReg; ?></td>
                <td><?php echo $nomPro; ?></td>
                <td><?php echo $nomCom; ?></td>
                <td><?php echo $nomprojet; ?></td>
                <td><?php echo $datedeb; ?></td>
                <td><?php echo $datefin; ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <br><br>
    <a href="<?php echo $RACINE_REQUETES;?>requetes/projetParGeographie/exportExcel.php?where=<?php echo $where; ?>" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

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
       // "bInfo": false

    });

</script>
