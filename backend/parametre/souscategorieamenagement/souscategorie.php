<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 27/06/2018
 * Time: 16:22
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

    $tabRegion=Bd_parametre::ListeSousCategorie();
    $idregion=1;
    $no=2;

/*if($_POST){
    $nom=$_POST['nom'];
    $newfacteur=new Bd_parametre();
    $newfacteur->InsererSousCategorie($nom);
}*/

?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Sous catégories d'aménagements</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="nvosous" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th></th>
            <th style="text-align: center">Nom du sous catégorie </th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            foreach ($tabRegion as $tab):
                $id=$tab[$idregion];
                $idregion=$idregion+2;
                $nom=$tab[$no];
                $no=$no+2;

                ?>
                <tr>
                    <td></td>
                    <td style="text-align: center"><?php echo $nom; ?></td>
                    <td style="text-align: right"><a href="#" onclick="$('#envoi').load('./parametre/souscategorieamenagement/modifierSouscategorie.php',{id : <?php echo $id; ?>},function(){
                            $('#updatesous').modal();});" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a  onclick="$('#envoi').load('./parametre/souscategorieamenagement/supprimerSouscategorie.php',{id :<?php echo $id; ?>, libelle: <?php echo "'".$nom."'"; ?>},function(){
                            $('#deletesous').modal();});" href="#" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php  endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./parametre/souscategorieAmenagement/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

</div>

<div id="envoi"> </div>
<div class="modal" id="newsous" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--<h4 style="font-weight: bold">Ajouter les taches</h4>-->
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'une Sous Catégorie</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <fieldset>
                        <legend>Nouvelle sous catégorie</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label for="SousCat">Nom de la sous catégorie <span style="color: red">*</span></label><br />
                                            <input type="text" name="SousCat" id="SousCat"  required class="formulaire" onchange="EnleverFocus(this.id)">
                                        <br />
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="validerSous" name="enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annulerSous" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
    </div>

    <div id="Etatenregistrement"></div>
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

    $('#nvosous').on('click',function(){
        $("#newsous").modal();
    });

    $('#annulerSous').on('click',function(){
        $("#corps").load("./parametre/souscategorieamenagement/souscategorie.php");
    });


    $("#validerSous").click(function(){

        var nom=$('#SousCat').val();
        var data='nom='+nom+'&type=ajout';
        if(nom==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/souscategorieamenagement/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/souscategorieamenagement/souscategorie.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/souscategorieamenagement/souscategorie.php");
                        notification(1);
                    }
                }
            });
        }
    });

    function MettreFocus(){
        var nom=$('#SousCat');
        if(nom.val()==''){
            nom.css('background-color', '#FDD');
        }else{
            nom.removeAttrs('style');
        }
    }
</script>
<?php }?>
