<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 21/07/2018
 * Time: 21:44
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idRevenu='';
if(isset($_POST['idRevenu'])){
    $idRevenu=$_POST['idRevenu'];

}else{
    if($_POST){
        $id=$_POST['idrevenu'];
        $gestion=new Bd_GestionSite();
        $gestion->supprimerRevenu($id);
    }
}
?>

<div class="modal" id="deleterevenu">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer cette révenu ?</span>
                <input type="hidden" id="idRe" value="<?php echo $idRevenu; ?>">
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

        var id=$('#idRe').val();
        var data='idrevenu='+id;

        $.ajax({
            type:"POST",
            url:"./gestionSite/revenuGestionnaire/supprimerRevenu.php",
            data:data,
            success: function(){
                $("#corps").load("./gestionSite/revenuGestionnaire/listeRevenu.php");
                notification(1);
            }
        });
    });

    $('#annulerSuppCollect').click(function(){
        $("#corps").load("./gestionSite/revenuGestionnaire/listeRevenu.php");
    });
</script>

<?php }?>