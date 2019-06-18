<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 16/07/2018
 * Time: 14:45
 */
include_once('../../../Databases/FichierBD.php');
if($_SESSION){
    $RACINE_REQUETES='';
}
?><br>
<div class="row" >
    <input type="button" class="pull-right btn btn-primary" value="Aide" id="aider" style="background-color: #006600; color: #fff">
</div >
<br>
<div class="row zone_filtre">
    <div class="row">
    <form action="" id="RequeteProMont">
        <div class="col-md-4 col-lg-4 col-sm-4">
            <fieldset>
                <legend>Projet</legend>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" id="blocProjet">
                        <label for="nomPro">Projet</label><br>
                        <select class="formulaire" id="nomPro" name="nomPro">
                            <option value="">Sélectionner le projet</option>
                            <?php
                            $operateur=Bd_GestionProjetActeur::ListerTousProjet();
                            $cle=1; $nom=2;
                            foreach($operateur as $Opt):
                                $id=$Opt[$cle];
                                $cle=$cle+12;
                                $nomOpt=$Opt[$nom];
                                $nom=$nom+12;
                                ?>
                                <option value="<?php echo $id ?>"><?php echo $nomOpt; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <fieldset>
                <legend>Bailleur</legend>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" id="blocBailleur">
                        <label for="ListeBailleur">Nom du bailleur</label><br>
                        <select name="ListeBailleur" id="ListeBailleur" class="formulaire">
                            <option value="">Sélectionner un bailleur </option>
                            <?php
                            $liste=Bd_GestionProjetActeur::ListeTousBailleur();
                            $cle=1;
                            $no=2;
                            foreach ($liste as $bailleur):
                                $id=$bailleur[$cle];
                                $cle=$cle+7;
                                $nom=$bailleur[$no];
                                $no=$no+7;
                                ?>
                                <option value="<?php echo $id; ?>" ><?php echo $nom; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <!--<fieldset>
                <legend>Période</legend>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <input type="checkbox" id="debutbouton" name="debutbouton" style="margin-right: 5px"><label for="debutbouton">Date de début</label>
                        <input id="debutCocher" value="" type="hidden">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <input type="checkbox" id="finbouton" name="finbouton" style="margin-right: 5px"><label for="finbouton">Date de fin</label>
                        <input id="finCocher" value="0" type="hidden">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6" id="blocDebut">
                        <input type="text" class="formulaire calendrier" id="datedebut">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6" id="blocFin">
                        <input type="text" class="formulaire calendrier" id="datefin">
                    </div>
                </div>
            </fieldset>-->
        </div>
    </form>
</div>
    <div class="row">
        <input type="button" class="pull-right btn btn-primary" value="Afficher" id="valider" style="margin-right: 20px; background-color: #007fff; border-radius: 0px">
        <input type="button" class="pull-right btn btn-primary" value="Reinitialiser" id="Reinitialiser" style=" margin-right: 20px; background-color: #ff0000; border-radius: 0px">
    </div>
</div>
<div class="modal" id="details" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header" style="border-color: #E4F6EA; background-color: #FFFFFF; margin-top: 0px; padding: 0px; border-bottom: 5px solid #4C9ED9; min-height: 20px">
                <button type="button" style="margin-top: 10px;margin-right:10px ;" class="close"  id="closeagentm" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br />
                <h3 style="padding-left: 5px; padding-top: 5px;" >Aide</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" style="margin-top: 10px" action="">
                    <fieldset>
                        <legend>Projet bailleur</legend>
                        <div class="row">
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                   Cette permet de lister les montants globaux et GMV<br />
                                    o	Par bailleur<br />
                                    o	Par projet<br />
                                   Ainsi que les dates de début et fin des projets
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer" style="text-align:center; padding-top: 7px; border-color: #4C9ED9; background-color: #99CCCC">
                <input type="button" id="annuler" name="fermer" data-dismiss="modal" value="J'ai compris" class="btn btn-primary" style="border: 1px solid #FFFFFF; background-color: #ff0000; border-radius: 0px;"/>
            </div>
        </div>
    </div>
</div>
<div class="row" id="resultat">

</div>
<script type="application/javascript">

    $('#aider').on('click',function(){
        $("#details").modal();
    });

    $( ".calendrier" ).datepicker({
        onClose: function (selectedDate) {
        }
    });

    $('#valider').click(function(){
        var bailleur=$('#ListeBailleur').val();
        var projet=$('#nomPro').val();
        var data="bailleur="+bailleur+"&projet="+projet;
        $.ajax({
            type: "GET",
            url:"<?php echo $RACINE_REQUETES;?>requetes/projetmontant/traitementRecherche.php",
            data:data,
            success: function(reponse){
                $('#resultat').html(reponse).show();
            }
        });
    });

    $('#Reinitialiser').click(function(){
        effacer("RequeteProMont");
    });

    function effacer(idformulaire){
        $(':input','#'+idformulaire)
            .not(':button, :submit, :hidden, :reset')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    }
</script>
