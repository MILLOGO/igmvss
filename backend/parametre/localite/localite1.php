<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 06/07/2018
 * Time: 12:02
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$tableau=Bd_parametre::ListeLocalite();
$cle=1;
$idobj=2;
$des=3;

/*
if($_POST){
    $id=$_POST['idcommune'];
    $nom=$_POST['nomLocalite'];

    $newLocalite=new Bd_parametre();
    $newLocalite->InsererLocalite($id,$nom);
}*/

?>
    <br>
    <div class="row zone_filtre" style="text-align: center">
        <label style="font-size: 18pt">Liste des Localités</label>
    </div>
<br>
<div class="row">
    <div >
        <input type="button" class="pull-right btn btn-primary" value="Nouveau" id="nvolocalite" style="background-color: #006600; color: #fff">
    </div >
    <div >
        <table class="table table-striped myTable" >
            <thead style="background-color: #060; color: #FFF;">
            <th style="text-align: center">Nom de la Région</th>
            <th style="text-align: center">Nom de la Province</th>
            <th style="text-align: center">Nom de la Commune</th>
            <th style="text-align: center">Nom de la localité</th>
            <th> </th>
            <th> </th>
            </thead>
            <tbody>
            <?php
            $parametr=new Bd_parametre();
            $i=0;
            foreach ($tableau as $tab):
                $id=$tab[$cle];
                $cle=$cle+3;
                $com=$tab[$idobj]; //recuperer l'id de la commune
                $nomcommune=$parametr->RecupererNomCommune($com); //trouver le nom de la commune
                $idpr=$parametr->RecupererIdProvince($com);
                $nomprovince=$parametr->RecupererNomProvince($idpr);
                $idregion=$parametr->RecupererIdRegion($idpr);
                $nomReg=$parametr->RecupererNomRegion($idregion);
                $idobj=$idobj+3;
                $nomlocalite=$tab[$des];
                $des=$des+3;
                ?>
                <tr>
                    <td style="text-align: center"><?php echo $nomReg; ?></td>
                    <td style="text-align: center"><?php echo $nomprovince; ?></td>
                    <td style="text-align: center"><?php echo $nomcommune; ?></td>
                    <td style="text-align: center"><?php echo $nomlocalite; ?></td>
                    <td style="text-align: right"><a onclick="$('#envoi').load('./parametre/localite/modifierLocalite.php',{id : <?php echo $id; ?>},function(){
                            $('#updatelocalite').modal();});" href="#" title="modifier"><i class="fa fa-pencil" style="color: #060"></i></a></td>
                    <td><a onclick="$('#envoi').load('./parametre/localite/supprimerLocalite.php',{id : <?php echo $id; ?>},function(){
                            $('#suppLocalite').modal();});" href="#" title="Supprimer"><i class="fa fa-trash" style="color: #F00"></i></a></td>
                </tr>
                <?php $i++; endforeach ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="./parametre/localite/exportExcel.php" title="Exporter"><input type="button" value="Exporter la liste" class="pull-right btn btn-primary"></a>

</div>

<!-- formulaire d'ajout d'une nouvelle localité-->
<div class="modal" id="newlocalite" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Ajout d'une Localité</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <fieldset>
                        <legend>Localité</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="regionR">Région <span style="color: red">*</span></label>
                                            <select id="regionR" name="regionR" class="formulaire" title="sélectionner une région" onchange="EnleverFocus(this.id)">
                                                <option></option>
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
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="nomProvince">Province <span style="color: red">*</span></label>
                                            <select id="nomProvince" name="nomProvince" class="formulaire" title="sélectionner une province" onchange="EnleverFocus(this.id)">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div><br />
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="nomCommune">Nom de la commune <span style="color: red">*</span></label><br />
                                            <select class="formulaire" name="nomCommune" id="nomCommune" onchange="EnleverFocus(this.id)">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label for="nomLocalite">Nom de la localité <span style="color: red">*</span></label><br />
                                            <input type="text" name="nomLocalite" id="nomLocalite" required class="formulaire" placeholder="saisir la localité" onchange="EnleverFocus(this.id)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="validerLoca" name="enregistrer" value="Enregistrer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #11A94D; border-radius: 0px;" />
                <input type="button" id="annuler" name="fermer" data-dismiss="modal" value="Fermer" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
<div id="envoi"> </div>
    <div id="Etatenregistrement"></div>
<script type="application/javascript">

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

    $('#nomProvince').change(function(){
        var idprovince=$(this).val();
        var donne="idprovince="+idprovince;
        $('#localite').val("");
        $.ajax({
            type:"GET",
            url:"./parametre/traitement/traitement.php",
            data:donne,
            success: function(server_response){
                $("#nomCommune").html(server_response).show();
            }
        })
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

    //appel du formulaire d'ajout
    $('#nvolocalite').on('click',function(){
        $("#newlocalite").modal();
    });

    $('#annuler').on('click',function(){
        $("#corps").load("./parametre/localite/localite.php");
    });

    //vaidation des donnees
    $("#validerLoca").click(function(){

        var idcommune=$('#nomCommune').val();
        var nomlocalite=$('#nomLocalite').val();
        var data='idcommune='+idcommune+'&nomLocalite='+nomlocalite+'&type=ajout';
        if(idcommune==''|| nomlocalite==''){
            notification("vide");
            MettreFocus();
        }else{
            $(this).attr('data-dismiss', 'modal');
            $.ajax({
                type:"POST",
                url:"./parametre/localite/enregistrement.php",
                data:data,
                success: function (reponse) {
                    $('#Etatenregistrement').html(reponse).show();
                    var etat=$('#echec').val();
                    if(etat!=''){
                        $("#corps").load("./parametre/localite/localite.php");
                        etatdeinsertion("echec");
                    }else{
                        $("#corps").load("./parametre/localite/localite.php");
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
        var nomlocalite=$('#nomLocalite');

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

        if(nomlocalite.val()==''){
            nomlocalite.css('background-color', '#FDD');
        }else{
            nomlocalite.removeAttrs('style');
        }
    }
</script>
<?php }?>
