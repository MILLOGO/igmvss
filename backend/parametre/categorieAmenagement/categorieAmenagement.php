<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 06/07/2018
 * Time: 09:24
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_parametre::ListeCatAmenagement();
$cle=1;
$no=2;
/*
if($_POST){
    $nom=$_POST['categorie'];
    $newCatAm=new Bd_parametre();
    $newCatAm->InsererCatAm($nom);
}
*/
?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Catégories d'aménagements</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="nvocatam" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th></th>
            <th style="text-align: center">Nom de la catégorie amenagement</th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php $i=0;
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+2;
                $nom=$tab[$no];
                $no=$no+2;

                ?>
                <tr>
                    <td><input type="hidden" id="idcatAm<?php echo $i; ?>" value="<?php echo $id; ?>"></td>
                    <td style="text-align: center"><?php echo $nom; ?></td>
                    <td style="text-align: right"><a href="#" onclick="$('#envoi').load('./parametre/categorieAmenagement/modifierCategorieAmenagement.php',{id : <?php echo $id; ?>},function(){
                            $('#updatecategorie').modal();});" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a  href="#" onclick="$('#envoi').load('./parametre/categorieAmenagement/supprimerCategorieAmenagement.php',{id : <?php echo $id; ?>},function(){
                            $('#deletecategorie').modal();});" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
                <?php $i++; endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./parametre/categorieAmenagement/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

</div>

<div id="envoi"> </div>

<div class="modal" id="newcatam" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--<h4 style="font-weight: bold">Ajouter les taches</h4>-->
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'une catégorie d'amenagement</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <fieldset>
                        <legend>Nouvelle Catégorie Amenagement</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="nomCatAm">Nom de la catégorie d'aménagement <span style="color: red">*</span></label><br />
                                    <input type="text" name="nomCatAm" id="nomCatAm" class="formulaire" onchange="EnleverFocus(this.id)">
                                    <br />
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="validerCatAm" name="enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annuler" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
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

    $('#nvocatam').on('click',function(){
        $("#newcatam").modal();
    });


    $("#validerCatAm").click(function(){

        var Catam=$('#nomCatAm').val();

        var data='categorie='+Catam+'&type=ajout';

        if(Catam==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/categorieAmenagement/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/categorieAmenagement/categorieAmenagement.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/categorieAmenagement/categorieAmenagement.php");
                        notification(1);
                    }

                }
            });
        }
    });


    function MettreFocus(){

        var Catam=$('#nomCatAm');
        if(Catam.val()==''){
            Catam.css('background-color', '#FDD');
        }else{
            Catam.removeAttrs('style');
        }

    }

</script>
<?php }?>