<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 29/06/2018
 * Time: 15:57
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_parametre::ListeCommune();
$cle=1;
$idpro=2;
$nocom=3;
$nbrH=4;
$nbrF=5;
$totaPo=6;
$nbreM=7;
    $nompro=8;
    $nomre=9;
    $taille=9;
?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Communes</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="nvocommune" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th>Nom de la région</th>
            <th>Nom de la province</th>
            <th>Nom de la commune</th>
            <th>Nombre d'homme</th>
            <th>Nombre de femme</th>
            <th>Nombre de menage</th>
            <th>Population total</th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            $province=new Bd_parametre(); //pour recuppere le nom de la prvince dans la BD
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+$taille;
                $nomprovince=$tab[$nompro];
                $nompro=$nompro+$taille;
                $nomReg=$tab[$nomre];
                $nomre=$nomre+$taille;
                $nomCom=$tab[$nocom];
                $nocom=$nocom+$taille;
                $nbreHomme=$tab[$nbrH];
                $nbrH=$nbrH+$taille;
                $nbreFemme=$tab[$nbrF];
                $nbrF=$nbrF+$taille;
                $population=$tab[$totaPo];
                $totaPo=$totaPo+$taille;
                $nombreMenage=$tab[$nbreM];
                $nbreM=$nbreM+$taille;
                ?>
                <tr>
                    <td><?php echo $nomReg; ?></td>
                    <td><?php echo $nomprovince; ?></td>
                    <td><?php echo $nomCom ?></td>
                    <td><?php echo $nbreHomme; ?></td>
                    <td><?php echo $nbreFemme; ?></td>
                    <td><?php echo $nombreMenage; ?></td>
                    <td><?php echo $population; ?></td>
                    <td><a href="#" onclick="$('#envoi').load('./parametre/commune/modifierCommune.php',{id : <?php echo $id; ?>},function(){
                            $('#updatecommune').modal();});" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a href="#" onclick="$('#envoi').load('./parametre/commune/supprimerCommune.php',{id : <?php echo $id; ?>},function(){
                            $('#deletecommune').modal();});" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./parametre/commune/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

</div>

<div class="modal" id="newcommune" data-backdrop="static" >
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'une commune</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <fieldset>
                        <legend>Nouvelle commune</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                            <div class="col-md-3 col-lg-3 col-sm-3">
                                                <label for="regionR">Région <span style="color: red">*</span></label>
                                                <select id="regionR" name="regionR" class="formulaire" title="sélectionner une région" onchange="EnleverFocus(this.id)">
                                                    <option value=""></option>
                                                    <?php $region=Bd_parametre::ListeRegion();
                                                    $cle=1; $nom=2;
                                                    foreach($region as $listeRegion):
                                                        $id=$listeRegion[$cle];
                                                        $cle=$cle+2;
                                                        $nomRegion=$listeRegion[$nom];
                                                        $nom=$nom+2;
                                                        ?>
                                                        <option value="<?php echo $id ?>"><?php echo $nomRegion ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-sm-3">
                                                <label for="nomProvince">Province <span style="color: red">*</span></label>
                                                <select id="nomProvince" name="nomProvince" class="formulaire" title="sélectionner une province" onchange="EnleverFocus(this.id)">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label for="nomCommune">Nom de la commune <span style="color: red">*</span></label><br />
                                            <input type="text" name="nomCommune" id="nomCommune"  required class="formulaire" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label for="nombreH">Nombre d'homme <span style="color: red">*</span></label><br />
                                            <input type="number"  name="nombreH" id="nombreH" required  class="formulaire" min="0" onchange="EnleverFocus(this.id)">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label for="nombreF">Nombre de femme <span style="color: red">*</span></label><br />
                                            <input type="number" name="nombreF" id="nombreF"  required class="formulaire" min="0" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label for="nombreMenage">Nombre de ménage <span style="color: red">*</span></label><br />
                                            <input type="number"  name="nombreMenage" id="nombreMenage" required class="formulaire" min="0" onchange="EnleverFocus(this.id)">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label for="popTotal">Population Totale <span style="color: red">*</span></label><br />
                                            <input type="number" name="popTotal" id="popTotal"  required class="formulaire" min="0" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="valider" name="enregistrer"  value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annuler" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>

<div id="envoi"></div>
    <div id="Etatenregistrement"></div>

<script type="application/javascript">
    //$(document).ready(function() {

        $('#regionR').change(function(){
            var idregion=$(this).val();
            var donne="idregion="+idregion;
            $.ajax({
                type:"GET",
                url:"./parametre/traitement/traitement.php",
                data:donne,
                success: function(server_response){
                    $("#nomProvince").html(server_response).show();
                }
            });
        });

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

        $('#nvocommune').on('click',function(){
            $("#newcommune").modal();
        });

        $('#annuler').on('click',function(){
            $("#corps").load("./parametre/commune/commune.php");
        });

    $("#valider").click(function(){

        var nomprovince=$('#nomProvince').val();
        var nomcommune=$('#nomCommune').val();
        var nbreH=$('#nombreH').val();
        var nbreF=$('#nombreF').val();
        var nbreMena=$('#nombreMenage').val();
        var poptotal=$('#popTotal').val();

        var data='nomProvince='+nomprovince+'&nomCommune='+nomcommune+'&nombreH='+nbreH+'&nombreF='+nbreF+'&nombreMenage='+nbreMena+'&popTotal='+poptotal+'&type=ajout';

        if(nomprovince==''||nomcommune==''||nbreH==''||nbreF==''||nbreMena==''||poptotal==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/commune/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/commune/commune.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/commune/commune.php");
                        notification(1);
                    }

                }
            });
        }
    });

    function MettreFocus(){

        var idcommune=$('#nomCommune');
        var idprovince=$('#nomProvince');
        var idregion=$('#regionR');
        var nbreH=$('#nombreH');
        var nbreF=$('#nombreF');
        var nbreMena=$('#nombreMenage');
        var poptotal=$('#popTotal');

        if(idcommune.val()==''){
            idcommune.css('background-color', '#FDD');
        }else{
            idcommune.removeAttrs('style');
        }

        if(idprovince.val()==''){
            idprovince.css('background-color', '#FDD');
        }else{
            idprovince.removeAttrs('style');
        }

        if(idregion.val()==''){
            idregion.css('background-color', '#FDD');
        }else{
            idregion.removeAttrs('style');
        }

        if(nbreH.val()==''){
            nbreH.css('background-color', '#FDD');
        }else{
            nbreH.removeAttrs('style');
        }

        if(nbreF.val()==''){
            nbreF.css('background-color', '#FDD');
        }else{
            nbreF.removeAttrs('style');
        }

        if(nbreMena.val()==''){
            nbreMena.css('background-color', '#FDD');
        }else{
            nbreMena.removeAttrs('style');
        }

        if(poptotal.val()==''){
            poptotal.css('background-color', '#FDD');
        }else{
            poptotal.removeAttrs('style');
        }
    }
   // });
</script>
<?php }?>