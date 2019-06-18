<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 22/07/2018
 * Time: 23:14
 */


include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$id=0;
if(isset($_POST['id'])){
    $id=$_POST['id'];

}else{
    if($_POST){
        $idB=$_POST['idprojet'];
        $gestion=new Bd_GestionProjetActeur();
        $gestion->SupprimerExecuterProjetCommune($idB);
        $gestion->SupprimerFinancerBailleurProjet($idB);
        $gestion->SupprimerExecuterProjetOperateur($idB);
        $gestion->SupprimerProjet($idB);

    }
}
?>


<div class="modal" id="deleteProjet">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer ce projet ?</span>
                <input type="hidden" id="idduprojet" value="<?php echo $id ?>">
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerSuppSit" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerSupp" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
    <div id="accepter">

    </div>
</div>
<script>
    $("#validerSupp").click(function(){

        var idduprojet=$('#idduprojet').val();
        var data='idprojet='+idduprojet;

        $.ajax({
            type:"GET",
            url:"./gestionProjetActeur/projet/traitement.php",
            data:data,
            success: function(reponse) {
                $('#accepter').html(reponse).show();
                var numprojet = $('#supprimerProjet').val();
                if (numprojet == 0) {
                    $.ajax({
                        type: "POST",
                        url: "./gestionProjetActeur/projet/supprimerProjet.php",
                        data: data,
                        success: function () {
                            $("#corps").load("./gestionProjetActeur/projet/listeProjet.php");
                            notification(1);
                        }
                    });
                }
                else{
                    etatdeinsertion("supp");
                    $("#corps").load("./gestionProjetActeur/projet/listeProjet.php");
                    //alert("Impossible de supprimer ce projet !!!");

                }
            }
        });

    });


    $('#annulerSuppSit').click(function(){
        $("#corps").load("./gestionProjetActeur/projet/listeProjet.php");
    });
</script>
<?php }?>
