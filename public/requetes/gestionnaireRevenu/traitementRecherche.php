<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 10/08/2018
 * Time: 14:16
 */
include_once('../../../Databases/FichierBD.php');

if($_SESSION){
    $RACINE_REQUETES='';
}

if(isset($_GET['gestionnaire']) && isset($_GET['annee']) && isset($_GET['type']) ){
    $gestionnaire=$_GET['gestionnaire'];
    $annee=$_GET['annee'];
    $type=$_GET['type'];

    $condition=new RequetesFunction();
    $where= $condition->RevenuGestionnaire($gestionnaire,$annee,$type);
    $requete='';

    if($where!='') {
        $requete = "SELECT * FROM Vuerevenuannuelgestionnaire WHERE $where";
    }else{
        $requete = "SELECT * FROM Vuerevenuannuelgestionnaire";
    }

    $resultat = Bd_Requetes::ListeRequete1($requete);
    $requeBd=new Bd_Requetes();
    $nbre=$requeBd->CompterResultat($requete);
    $type=1;
    $noGe=2;
    $preno=3;
    $num=4;
    $mail=5;
    $mont=7;
    $anne=8;
    $cle=9;
    ?>
    <input type="button" class="pull-right btn btn-primary" value="<?php $s=''; if($nbre>1){
        $s='s';
    } echo $nbre.' Resultat'.$s.' trouvé'.$s; ?>" style="background-color: #006600; color: #fff; font-weight: bold">
    <table class="table table-striped myTable" >
        <thead style="background-color: #060; color: #FFF;">
        <th>Nom et Prenom du gestionnaire</th>
        <th>Numéro</th>
        <th>Email </th>
        <th>Type</th>
        <th>Montant annuel</th>
        <th>Année</th>
        </thead>
        <tbody>
        <?php
        foreach ($resultat as $tab):
            $id=$tab[$cle];
            $cle=$cle+9;
            $typeGest=$tab[$type];
            $type=$type+9;
            $numero=$tab[$num];
            $num=$num+9;
            $nomGe=$tab[$noGe];
            $noGe=$noGe+9;
            $prenomGe=$tab[$preno];
            $preno=$preno+9;
            $email=$tab[$mail];
            $mail=$mail+9;
            $montant=$tab[$mont];
            $mont=$mont+9;
            $annee=$tab[$anne];
            $anne=$anne+9;
            ?>
            <tr>
                <td><?php echo '<span class="maj">'. $nomGe.'</span> '.$prenomGe; ?></td>
                <td><?php echo $numero; ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo $typeGest ?></td>
                <td><?php echo $montant.' Fcfa' ; ?></td>
                <td><?php echo $annee; ?> </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <br><br>
    <a href="<?php echo $RACINE_REQUETES;?>requetes/gestionnaireRevenu/exportExcel.php?where=<?php echo $where; ?>" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>
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
