<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 28/07/2018
 * Time: 07:55
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_user::ListerTousUser();

$cle=1;
$no=2;
$preno=3;
$fct=4;
$serv=5;
$tel=6;
$ema=7;
$ident=8;
$pro=10;
?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Utilisateurs</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="nvouser" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th></th>
            <th>Nom et Prenom de l'utilisateur</th>
            <th>Identifiant</th>
            <th>Numéro</th>
            <th>Fonction</th>
            <th>Service </th>
            <th>Email</th>
            <th>Profil</th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+10;
                $numero=$tab[$tel];
                $tel=$tel+10;
                $nom=$tab[$no];
                $no=$no+10;
                $prenom=$tab[$preno];
                $preno=$preno+10;
                $fonction=$tab[$fct];
                $fct=$fct+10;
                $service=$tab[$serv];
                $serv=$serv+10;
                $email=$tab[$ema];
                $ema=$ema+10;
                $identifiant=$tab[$ident];
                $ident=$ident+10;
                $profil=$tab[$pro];
                $pro=$pro+10;

                ?>
                <tr>
                    <td></td>
                    <td><?php echo '<span class="maj">'. $nom.'</span> '.$prenom; ?></td>
                    <td><?php echo $identifiant; ?></td>
                    <td><?php echo $numero; ?></td>
                    <td><?php echo $fonction; ?></td>
                    <td><?php echo $service; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php if($profil==1){echo "Administrateur";}else{ echo "Utilisateur simple";} ?></td>
                    <td><a onclick="$('#lancer').load('./parametre/utilisateur/modifierUser.php',{iduser : <?php echo $id; ?>},function(){
                            $('#updateuser').modal();});" href="#" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a onclick="$('#lancer').load('./parametre/utilisateur/supprimerUser.php',{iduser : <?php echo $id; ?>},function(){
                            $('#deleteuser').modal();});"  href="#" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./parametre/utilisateur/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

</div>
<div id="lancer">
</div>

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


    $("#nvouser").on('click',function(){
        $("#lancer").load("./parametre/utilisateur/ajouterUser.php", function(){
            $('#newuser').modal();
        });
    });

</script>
<?php }?>