<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 20/07/2018
 * Time: 22:53
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$id=0;
if(isset($_POST['idfinance'])){
    $id=$_POST['idfinance'];

}/*else{
    if($_POST){
        $idB=$_POST['idfina'];
        try{
            $gestionProjetActeur=new Bd_GestionProjetActeur();
            $gestionProjetActeur->supprimerFinancementOperateur($idB);
        }catch (Exception $e){
            echo"<script>alert(".$e->getMessage().")</script>";

        }
    }
}*/
?>

<div class="modal" id="deleteFinacement">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer ce Financement ?</span>
                <input type="hidden" id="idfinanc" value="<?php echo $id ?>">
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerSupp" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerSupp" data-dismiss="modal" >Oui</a>
            </div>
        </div>
    </div>

</div>
    <div id="accepter">

    </div>
<script>

    $("#validerSupp").click(function(){

        var id=$('#idfinanc').val();
        var data='idfina='+id;
             $.ajax({
                 type: "POST",
                 url: "./gestionProjetActeur/financerBailleurOperateur/traitement.php",
                 data: data,
                 success: function (reponse) {
                     $('#accepter').html(reponse).show();
                     var etat=$('#echec').val();
                     if(etat!=''){
                         $("#corps").load("./gestionProjetActeur/financerBailleurOperateur/listeFinancement.php");
                         etatdeinsertion("supp");
                     }else{
                         $("#corps").load("./gestionProjetActeur/financerBailleurOperateur/listeFinancement.php");
                         notification(1);
                     }

                 }
             });
    });


    $('#annulerSupp').click(function(){
        $("#corps").load("./gestionProjetActeur/financerBailleurOperateur/listeFinancement.php");
    });
</script>

<?php }?>
