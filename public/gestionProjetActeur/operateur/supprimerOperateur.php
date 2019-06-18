<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 13/07/2018
 * Time: 00:00
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$id=0;
if(isset($_POST['idoperateur'])){
    $id=$_POST['idoperateur'];

}/*else{
    if($_POST){
        $idOp=$_POST['idOp'];
            $gestionProjetActeur=new Bd_GestionProjetActeur();
            $gestionProjetActeur->supprimerOperateur($idOp);

    }
}*/
?>

<div class="modal" id="deleteOperateur">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer cet Opérateur ?</span>
                <input type="hidden" id="idoperateur" value="<?php echo $id ?>">
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerSuppOperateur" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerSuppOperateur" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
    <div id="accepter">

    </div>
</div>
<script>

    $("#validerSuppOperateur").click(function(){

        var idoperateur=$('#idoperateur').val();
        var data='idOp='+idoperateur;

        $.ajax({
            type:"GET",
            url:"./gestionProjetActeur/operateur/traitement.php",
            data:data,
            success: function (reponse) {
                $('#accepter').html(reponse).show();
                var etat=$('#echec').val();
                if(etat!=''){
                    $("#corps").load("./gestionProjetActeur/operateur/listeOperateur.php");
                    etatdeinsertion("supp");
                }else{
                    $("#corps").load("./gestionProjetActeur/operateur/listeOperateur.php");
                    notification(1);
                }

            }
        });

    });


    $('#annulerSuppOperateur').click(function(){
        $("#corps").load("./gestionProjetActeur/operateur/listeOperateur.php");
    });

    $('#closeSuppOperateur').click(function(){
        $("#corps").load("./gestionProjetActeur/operateur/listeOperateur.php");
    });
</script>
<?php }?>


