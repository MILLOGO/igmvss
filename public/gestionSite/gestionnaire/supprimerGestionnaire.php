<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 22/07/2018
 * Time: 13:54
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{
$id=0;
if(isset($_POST['idgest'])){
    $id=$_POST['idgest'];

}else{
    if($_POST){
        $idB=$_POST['idgestionnaire'];
        $gestion=new Bd_GestionSite();
        $gestion->supprimerFacteurParGestionnaire($idB);
        $gestion->supprimerGestionnaire($idB);

    }
}
?>


<div class="modal" id="deleteGestionnaire">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer ce gestionnaire ?</span>
                <input type="hidden" id="iddugest" value="<?php echo $id ?>">
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerSuppSit" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerSuppSit" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
    <div id="accepter">

    </div>
</div>
<script>
    $("#validerSuppSit").click(function(){

        var iddugest=$('#iddugest').val();
        var data='idgestionnaire='+iddugest;

        $.ajax({
            type:"GET",
            url:"./gestionSite/gestionnaire/traitement.php",
            data:data,
            success: function(reponse) {
                $('#accepter').html(reponse).show();
                var numgest = $('#supprimerGest').val();
                if (numgest == 0) {
                    $.ajax({
                        type: "POST",
                        url: "./gestionSite/gestionnaire/supprimerGestionnaire.php",
                        data: data,
                        success: function () {
                            $("#corps").load("./gestionSite/gestionnaire/listeGestionnaire.php");
                            notification(1);
                        }
                    });
                }
                else{
                    etatdeinsertion('supp');
                    //alert("Impossible de supprimer ce Gestionnaire!!!");

                }
            }
        });



    });


    $('#annulerSuppSit').click(function(){
        $("#corps").load("./gestionSite/gestionnaire/listeGestionnaire.php");
    });
</script>
<?php }?>
