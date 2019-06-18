<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 22/07/2018
 * Time: 10:00
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$id='';
if(isset($_POST['id'])){
    $id=$_POST['id'];

}else{
    if($_POST){
        $id=$_POST['ident'];
        $gestion=new Bd_GestionSite();
        $gestion->supprimerGestionnaireOperateurAppui($id);
    }
}
?>

<div class="modal" id="deleteAppuiGestionnaire">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer cet appui ?</span>
                <input type="hidden" id="identifiant" value="<?php echo $id; ?>">
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerSuppAppui" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerSupp" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
</div>
<script>

    $("#validerSupp").click(function(){

        var id=$('#identifiant').val();
        var data='ident='+id;

        $.ajax({
            type:"POST",
            url:"./gestionSite/gestionnaireOperateur/supprimerGestionOperateur.php",
            data:data,
            success: function(){
                $("#corps").load("./gestionSite/gestionnaireOperateur/listeGestionOperateur.php");
                notification(1);
            }
        });
    });

    $('#annulerSuppAppui').click(function(){
        $("#corps").load("./gestionSite/gestionnaireOperateur/listeGestionOperateur.php");
    });
</script>

<?php }?>