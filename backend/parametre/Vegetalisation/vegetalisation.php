<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 06/07/2018
 * Time: 11:34
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_parametre::ListeVegetalisation();
$cle=1;
$no=2;
$des=3;

/*
if($_POST){
    $nom=$_POST['nom'];
    $description=$_POST['description'];

    $newfacteur=new Bd_parametre();
    $newfacteur->InsererVegetalisation($nom,$description);
}*/

?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Végétalisations</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="nvovegetalisation" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th ></th>
            <th style="text-align: center">Type de végétalisation</th>
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
                    <td></td>
                    <td style="text-align: center"><?php echo $nom; ?></td>
                    <td style="text-align: center"><?php echo $descrip; ?></td>
                    <td style="text-align: right"><a href="#" onclick="$('#envoi').load('./parametre/vegetalisation/modifierVegetalisation.php',{id : <?php echo $id; ?>},function(){
                            $('#updatevegetalisation').modal();});" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a href="#" onclick="$('#envoi').load('./parametre/vegetalisation/supprimerVegetalisation.php',{id : <?php echo $id; ?>},function(){
                            $('#deletevegetalisation').modal();});" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./parametre/vegetalisation/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

</div>

<div class="modal" id="newvegetalisation"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--<h4 style="font-weight: bold">Ajouter les taches</h4>-->
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'une végétalisation</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <fieldset>
                        <legend>Végetalisation</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="typeVege">Type de végétalisation <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <input type="text" name="typeVege" id="typeVege" required class="formulaire"
                                                   placeholder="Saisir le nom de la végétalisation" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div><br />
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="descrip">Description de la végétalisation </label>
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
                <input type="button" id="validerVege" name="enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
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

    $('#nvovegetalisation').on('click',function(){
        $("#newvegetalisation").modal();
    });

    $('#annuler').on('click',function(){
        $("#corps").load("./parametre/vegetalisation/vegetalisation.php");
    });


    $("#validerVege").click(function(){

        var nom=$('#typeVege').val();
        var description=$('#descrip').val();
        var data='nom='+nom+'&description='+description+'&type=ajout';
        if(nom==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss','modal');
            $.ajax({
                type:"POST",
                url:"./parametre/vegetalisation/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/vegetalisation/vegetalisation.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/vegetalisation/vegetalisation.php");
                        notification(1);
                    }
                }
            });
        }
    });

    function MettreFocus(){
        var nom=$('#typeVege');
        if(nom.val()==''){
            nom.css('background-color', '#FDD');
        }else{
            nom.removeAttrs('style');
        }
    }

</script>
<?php }?>
