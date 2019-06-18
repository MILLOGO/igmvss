<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 21/07/2018
 * Time: 20:23
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idcollection='';
if(isset($_POST['idcollection'])){
    $idcollection=$_POST['idcollection'];

}else{
    if($_POST){
        $id=$_POST['idcollect'];
            $gestion=new Bd_GestionSite();
            $gestion->supprimerCollection($id);
    }
}
?>

<div class="modal" id="deletecollection">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer cette observation ?</span>
                <input type="hidden" id="idCol" value="<?php echo $idcollection; ?>">
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerSuppCollect" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerSupp" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
</div>
<script>

    $("#validerSupp").click(function(){

        var idCol=$('#idCol').val();
        var data='idcollect='+idCol;

        $.ajax({
            type:"POST",
            url:"./gestionSite/collection/supprimerCollection.php",
            data:data,
            success: function(){
                $("#corps").load("./gestionSite/collection/listeCollection.php");
                notification(1);
            }
        });
    });

    $('#annulerSuppCollect').click(function(){
        $("#corps").load("./gestionSite/collection/listeCollection.php");
    });
</script>
<?php }?>
