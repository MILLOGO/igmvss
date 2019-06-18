<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 01/07/2018
 * Time: 23:01
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_parametre::ListeEspece();
$cle=1;
$no=2;
$des=3;

/*
if($_POST){
    $nom=$_POST['nom'];
    $description=$_POST['description'];

    $newfacteur=new Bd_parametre();
    $newfacteur->InsererEspece($nom,$description);
}*/

?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Espèces</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="nvoespece" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th style="text-align: center">Type d'espèce</th>
            <th style="text-align: center">Description</th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+3;
                $nom=$tab[$no];
                $no=$no+3;
                $descrip=$tab[$des];
                $des=$des+3;
                ?>
                <tr>
                    <td style="text-align: center"><?php echo $nom; ?></td>
                    <td style="text-align: center"><?php echo $descrip; ?></td>
                    <td style="text-align: right"><a href="#" onclick="$('#envoi').load('./parametre/espece/modifierEspece.php',{id : <?php echo $id; ?>},function(){
                            $('#updateespece').modal();});" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a href="#" onclick="$('#envoi').load('./parametre/espece/supprimerEspece.php',{id : <?php echo $id; ?>},function(){
                            $('#deleteespece').modal();});" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./parametre/espece/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

</div>

<div class="modal" id="newespece" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--<h4 style="font-weight: bold">Ajouter les taches</h4>-->
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'une espèce</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <fieldset>
                        <legend>Espèce</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="nomEspece">Nom de l'espèce <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <input type="text" name="nomEspece" id="nomEspece"
                                                   class="formulaire" placeholder="Saisir le nom de l'espèce" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div><br />
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="descrip">Description de l'espèce </label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <textarea name="descrip" id="descrip" class="formulaire" style="height: 100px"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="valider" name="enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annuler" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>

</div>
<div id="envoi"></div>
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

    $('#nvoespece').on('click',function(){
        $("#newespece").modal();
    });

    $('#annuler').on('click',function(){
        $("#corps").load("./parametre/espece/espece.php");
    });


    $("#valider").click(function(){

        var nom=$('#nomEspece').val();
        var description=$('#descrip').val();
        var data='nom='+nom+'&description='+description+'&type=ajout';
        if(nom==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/espece/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/espece/espece.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/espece/espece.php");
                        notification(1);
                    }

                }
            });
        }
    });

    function MettreFocus(){
        var nom=$('#nomEspece');
        if(nom.val()==''){
            nom.css('background-color', '#FDD');
        }else{
            nom.removeAttrs('style');
        }
    }

</script>
<?php }?>
