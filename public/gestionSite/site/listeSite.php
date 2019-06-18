<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 06/07/2018
 * Time: 14:15
 */


include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_GestionSite::ListeSite();

$cle=1;
$noStie=2;
$super=3;
$noGe=5;
$preno=6;
$sta1=11;
$sta2=12;
$voc=14;
$loca=17;
$typemes=24;

?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Sites</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="nvosite" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th></th>
            <th>Nom du site</th>
            <th>Mesure du site</th>
            <th>Nom et Prénom du gestionnaire</th>
            <th>Statut Foncier</th>
            <th>Vocation</th>
            <th>Localité</th>
            <th>Détails</th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            $taille=24;
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+$taille;
                $site=$tab[$noStie];
                $noStie=$noStie+$taille;
                $superficie=$tab[$super];
                $super=$super+$taille;
                $nomGe=$tab[$noGe];
                $noGe=$noGe+$taille;
                $prenomGe=$tab[$preno];
                $preno=$preno+$taille;
                $reconait=$tab[$sta1];
                $sta1=$sta1+$taille;
                $exploit=$tab[$sta2];
                $sta2=$sta2+$taille;
                $vocation=$tab[$voc];
                $voc=$voc+$taille;
                $localite=$tab[$loca];
                $loca=$loca+$taille;
                $typemesure=$tab[$typemes];
                $typemes=$typemes+$taille;

                ?>
                <tr>
                    <td><input type="hidden" value="<?php echo $id; ?>"></td>
                    <td><?php echo $site; ?></td>
                    <td><?php if($typemesure=='longueur'){
                            if($superficie!=0){
                                echo $superficie." Km";
                            }else{
                                echo 'inconnue';
                            }

                        }else{
                            if($typemesure=='superficie' || $typemesure=='inconnu'){
                                if($superficie!=0){
                                    echo $superficie." ha";
                                }else{
                                    echo 'inconnue';
                                }

                            }else{
                                echo 'inconnue';
                            }

                        }  ?></td>
                    <td><?php echo '<span class="maj">'. $nomGe.'</span> '.$prenomGe; ?></td>
                    <td><?php echo $reconait." ".$exploit; ?></td>
                    <td><?php echo $vocation; ?></td>
                    <td><?php echo $localite; ?> </td>
                    <td><a href="#" onclick="$('#envoiSite').load('./gestionSite/site/detailSite.php',{idsite : <?php echo $id; ?>},function(){
                            $('#detailSite').modal();});" title="modifier">détails</a></td>
                    <td><a href="#" onclick="$('#envoiSite').load('./gestionSite/site/modifierSite.php',{idsite : <?php echo $id; ?>},function(){
                            $('#updateSite').modal();});" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a href="#" onclick="$('#envoiSite').load('./gestionSite/site/supprimerSite.php',{idsite : <?php echo $id; ?>},function(){
                            $('#deleteSite').modal();});"  title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./gestionSite/site/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

</div>

<div id="envoiSite"></div>

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

    $("#nvosite").on('click',function(){
        $('#envoiSite').load("./gestionSite/site/ajouterSite.php",function(){
            $("#newsite").modal();
        });

    });
</script>
<?php }?>