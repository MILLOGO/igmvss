<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 04/07/2018
 * Time: 14:13
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_parametre::ListeProvince();
$cle=1;
$idregion=2;
$des=3;

/*
if($_POST){
    $id=$_POST['idregion'];
    $nom=$_POST['nomProv'];

    $newprovince=new Bd_parametre();
    $newprovince->InsererProvince($id,$nom);
}
*/
?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Provinces</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="nvoprovince" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th></th>
            <th style="text-align: center">Nom de la Province</th>
            <th style="text-align: center">Nom de la Région</th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            $region=new Bd_parametre();
            $i=0;
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+3;
                $regi=$tab[$idregion];
                $nomregion=$region->RecupererNomRegion($regi);
                $idregion=$idregion+3;
                $nomprovince=$tab[$des];
                $des=$des+3;

                ?>
                <tr>
                    <td><input type="hidden" id="id<?php echo $i; ?>" value="<?php echo $id; ?>"></td>
                    <td style="text-align: center"><?php echo $nomprovince; ?></td>
                    <td style="text-align: center"><?php echo $nomregion; ?></td>
                    <td style="text-align: right"><a onclick="$('#envoi').load('./parametre/province/modifierProvince.php',{id : <?php echo $id; ?>},function(){
                        $('#updateprovince').modal();});" href="#" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a onclick="$('#envoi').load('./parametre/province/supprimerProvince.php',{id : <?php echo $id; ?>},function(){
                            $('#confirmationProvince').modal();});"  href="#" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php $i++;  endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./parametre/province/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

</div>



<div class="modal" id="newprovince" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'une province</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <fieldset>
                        <legend>Province</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="nomRegion">Nom de la région <span style="color: red">*</span></label>
                                        </div>
                                        <?php
                                            $region=Bd_parametre::ListeRegion();
                                            $id=1;
                                            $no=2;
                                        ?>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <select class="formulaire" name="nomRegion" id="nomRegion" onchange="EnleverFocus(this.id)">
                                                <option value=""></option>
                                                <?php
                                                foreach ($region as $tab):
                                                $pri=$tab[$id];//id de la région
                                                $id=$id+2;
                                                    $libelle=$tab[$no]; //NNom de la région
                                                    $no=$no+2;
                                                ?>
                                                <option value="<?php echo $pri;?>"><?php echo $libelle;?></option>
                                                <?php
                                                endforeach
                                                ?>
                                            </select>
                                        </div>
                                    </div><br />
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="nomProv">Nom de la province <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <input type="text" name="nomProv" id="nomProv" required class="formulaire" placeholder="saisir la province" onchange="EnleverFocus(this.id)">
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
<div id="envoi"> </div>
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



    $('#nvoprovince').on('click',function(){
        $("#newprovince").modal();
    });

    $("#valider").click(function(){

        var idregion=$('#nomRegion').val();
        var nomprovince=$('#nomProv').val();
        var data='idregion='+idregion+'&nomProv='+nomprovince+'&type=ajout';
        if(idregion==''|| nomprovince==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/province/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/province/province.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/province/province.php");
                        notification(1);
                    }

                }
            });
        }
    });

    function MettreFocus(){

        var idregion=$('#nomRegion');
        var nomprovince=$('#nomProv');

        if(idregion.val()==''){
            idregion.css('background-color', '#FDD');
        }else{
            idregion.removeAttrs('style');
        }

        if(nomprovince.val()==''){
            nomprovince.css('background-color', '#FDD');
        }else{
            nomprovince.removeAttrs('style');
        }
    }

</script>
<?php }?>
