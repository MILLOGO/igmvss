<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 30/07/2018
 * Time: 21:13
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$iduse=0;
if(isset($_POST['iduser'])){
    $iduse=$_POST['iduser'];
}else{
    if($_POST){
        $id=$_POST['idutili'];
        $user=new Bd_user("","","","","","","","","");
        $user->supprimeUser($id);
    }
}
?>

<div class="modal" id="deleteuser">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <input type="hidden" value="<?php echo $iduse?>" id="ident">
                <span>Etes-vous sur de vouloir supprimer cet utilisateur ?</span>
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerSupp" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerSupp" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">

    $('#validerSupp').on ('click', function(){
        var ident=$('#ident').val();
        var data="idutili="+ident;
        $.ajax({
            type:"POST",
            url:"./parametre/utilisateur/supprimerUser.php",
            data:data,
            success: function(){
                $("#corps").load("./parametre/utilisateur/listeUtilisateur.php");
                notification(1);

            }
        });
        //console.log(data);
    });

    $('#annulerSupp').click(function(){
        $("#corps").load("./parametre/utilisateur/listeUtilisateur.php");
    });
</script>
<?php }?>