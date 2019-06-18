<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 19/07/2018
 * Time: 18:14
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_GestionAmenagement::ListeAmenager();

$cle=1;
$noSite=9;
$super=10;
$supercible=5;
$noPro=13;
$loc=11;
$op=24;
$ipr=8;
$typemes=34;
$typeamenager=35;


?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Sites aménagés</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="nvoamenager" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th>Nom de l'opérateur</th>
            <th>Nom du projet</th>
            <th>Nom du site</th>
            <th>Mesure du site</th>
            <th>Mesure ciblée</th>
            <th>Localité</th>
            <th>Détails </th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            $taille=35;
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+$taille;
                $idprojet=$tab[$ipr];
                $ipr=$ipr+$taille;
                $site=$tab[$noSite];
                $noSite=$noSite+$taille;
                $superficie=$tab[$super];
                $super=$super+$taille;
                $superficiecible=$tab[$supercible];
                $supercible=$supercible+$taille;
                $nomPro=$tab[$noPro];
                $noPro=$noPro+$taille;
                $nomOp=$tab[$op];
                $op=$op+$taille;
                $localite=$tab[$loc];
                $loc=$loc+$taille;
                $typemesure=$tab[$typemes];
                $typemes=$typemes+$taille;
                $typeamenagersite=$tab[$typeamenager];
                $typeamenager=$typeamenager+$taille;

                ?>
                <tr>
                    <td><?php echo $nomOp; ?></td>
                    <td><?php echo $nomPro; ?></td>
                    <td><?php echo $site ?></td>
                    <td><?php if($typemesure=='longueur'){
                            if($superficie!=0){
                                echo $superficie." Km";
                            }else{
                                echo 'inconnue';
                            }

                        }else{
                            if($typemesure=='superficie') {
                                if($superficie!=0){
                                    echo $superficie . " ha";
                                }else{
                                    echo 'inconnue';
                                }

                            }else{
                                echo 'inconnue';
                            }
                        }
                        ?></td>
                    <td>
                        <?php if($typeamenagersite=='longueur'){
                            if($superficiecible!=0){
                                echo $superficiecible." Km";
                            }else{
                                echo 'inconnue';
                            }

                        }else{
                            if($typeamenagersite=='superficie') {
                                if($superficiecible!=0){
                                    echo $superficiecible . " ha";
                                }else{
                                    echo 'inconnue';
                                }

                            }else{
                                echo 'inconnue';
                            }
                        }
                        ?></td>
                    <td><?php echo $localite; ?> </td>
                    <td><a href="#" onclick="$('#envoiSite').load('./gestionAmenagement/amenager/detailAmenager.php',{idamenager : <?php echo $id; ?>, idprojet: <?php echo $idprojet; ?>},function(){
                            $('#detailAmenager').modal();});" >Détails</a></td>
                    <td><a href="#" onclick="$('#envoiSite').load('./gestionAmenagement/amenager/modifierAmenager.php',{idamenager : <?php echo $id; ?>, idprojet: <?php echo $idprojet; ?>},function(){
                            $('#updateAmenager').modal();});" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a href="#" onclick="$('#envoiSite').load('./gestionAmenagement/amenager/supprimerAmenager.php',{idamenager : <?php echo $id; ?>},function(){
                            $('#deleteAmenager').modal();});" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
                <?php endforeach ?>
            <?php
            $tableau=Bd_GestionAmenagement::ListeAmenagerSansProjet();

            $cle=10;
            $noSite=8;
            $super=9;
            $supercible=12;
            $loc=3;
            $op=16;
            $ipr=15;
            $typemes=24;
            $typeamenager=25;
            $tail=25;
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+$tail;
                $idprojet=$tab[$ipr];
                $ipr=$ipr+$tail;
                $site=$tab[$noSite];
                $noSite=$noSite+$tail;
                $superficie=$tab[$super];
                $super=$super+$tail;
                $superficiecible=$tab[$supercible];
                $supercible=$supercible+$tail;
                $nomOp=$tab[$op];
                $op=$op+$tail;
                $localite=$tab[$loc];
                $loc=$loc+$tail;
                $typemesure=$tab[$typemes];
                $typemes=$typemes+$tail;
                $typeamenagersite=$tab[$typeamenager];
                $typeamenager=$typeamenager+$tail;
                ?>
                <tr>
                    <td><?php echo $nomOp; ?></td>
                    <td><?php echo 'Aucun projet'; ?></td>
                    <td><?php echo $site ?></td>
                    <td><?php if($typemesure=='longueur'){
                            if($superficie!=0){
                                echo $superficie." Km";
                            }else{
                                echo 'inconnue';
                            }

                        }else{
                            if($typemesure=='superficie') {
                                if($superficie!=0){
                                    echo $superficie . " ha";
                                }else{
                                    echo 'inconnue';
                                }

                            }else{
                                echo 'inconnue';
                            }
                        }
                         ?></td>
                    <td><?php if($typeamenagersite=='longueur'){
                            if($superficiecible!=0){
                                echo $superficiecible." Km";
                            }else{
                                echo 'inconnue';
                            }

                        }else{
                            if($typeamenagersite=='superficie') {
                                if($superficiecible!=0){
                                    echo $superficiecible . " ha";
                                }else{
                                    echo 'inconnue';
                                }

                            }else{
                                echo 'inconnue';
                            }
                        }
                        ?></td>
                    <td><?php echo $localite; ?> </td>
                    <td><a href="#" onclick="$('#envoiSite').load('./gestionAmenagement/amenager/detailAmenager.php',{idamenager : <?php echo $id; ?>,  idprojet: <?php echo $idprojet; ?>},function(){
                            $('#detailAmenager').modal();});" >Détails</a></td>
                    <td><a href="#" onclick="$('#envoiSite').load('./gestionAmenagement/amenager/modifierAmenager.php',{idamenager : <?php echo $id; ?>,  idprojet: <?php echo $idprojet; ?>},function(){
                            $('#updateAmenager').modal();});" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a href="#" onclick="$('#envoiSite').load('./gestionAmenagement/amenager/supprimerAmenager.php',{idamenager : <?php echo $id; ?>},function(){
                            $('#deleteAmenager').modal();});" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./gestionAmenagement/amenager/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

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

    $("#nvoamenager").on('click',function(){
        $('#envoiSite').load("./gestionAmenagement/amenager/ajouterAmenager.php",function(){
            $("#newamenager").modal();
        });

    });
</script>
<?php }?>