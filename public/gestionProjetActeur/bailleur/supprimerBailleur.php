<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 12/07/2018
 * Time: 21:23
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$id=0;
if(isset($_POST['idbailleur'])){
    $id=$_POST['idbailleur'];

}
?>

<div class="modal" id="deleteBailleur">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer ce Bailleur ?</span>
                <input type="hidden" id="idbailleur" value="<?php echo $id ?>">
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerBailleur" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerBailleur" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
    <div id="accepter">

    </div>
</div>

<script>

    $("#validerBailleur").click(function(){

        var idbailleur=$('#idbailleur').val();
        var data='idbai='+idbailleur;

        $.ajax({
            type:"GET",
            url:"./gestionProjetActeur/bailleur/traitement.php",
            data:data,
            success: function (reponse) {
                $('#accepter').html(reponse).show();
                var etat=$('#echec').val();
                if(etat!=''){
                    $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php");
                    etatdeinsertion("supp");
                }else{
                    $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php");
                    notification(1);
                }

            }
        });



    });


    $('#annulerBailleur').click(function(){
        $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php");
    });
</script>

<?php }?>