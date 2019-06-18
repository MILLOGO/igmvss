<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 21/07/2018
 * Time: 18:09
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$id=0;
if(isset($_POST['idcollecteur'])){
    $id=$_POST['idcollecteur'];

}else{
    if($_POST){
        $id=$_POST['idcoll'];
            $gestion=new Bd_GestionSite();
            $gestion->supprimerCollecteur($id);
    }
}
?>

<div class="modal" id="deleteCollecteur">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer ce Collecteur ?</span>
                <input type="hidden" id="idcollecteur" value="<?php echo $id ?>">
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerModif" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="ModifierCollecteur" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
    <div id="accepter">

    </div>
</div>

<script>

    $("#ModifierCollecteur").click(function(){

        var idcollecteur=$('#idcollecteur').val();
        var data='idcoll='+idcollecteur;

        $.ajax({
            type:"GET",
            url:"./gestionSite/collecteur/traitement.php",
            data:data,
            success: function(reponse) {
                $('#accepter').html(reponse).show();
                var collecteur = $('#supprimer').val();
                if (collecteur == 0) {
                    $.ajax({
                        type: "POST",
                        url: "./gestionSite/collecteur/supprimerCollecteur.php",
                        data: data,
                        success: function () {
                            $("#corps").load("./gestionSite/collecteur/listeCollecteur.php");
                            notification(1);
                        }
                    });
                }
                else{
                    //alert("Impossible de supprimer ce collecteur!!!");
                    etatdeinsertion("supp");
                }
            }
        });

    });


    $('#annulerBailleur').click(function(){
        $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php");
    });
</script>

<?php }?>
