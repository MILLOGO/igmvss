<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 12/07/2018
 * Time: 18:35
 */
include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idloc=0;
if(isset($_POST['id'])){
    $idloc=$_POST['id'];
}/*else{
    if($_POST){
        $id=$_POST['idlocali'];
        $param=new Bd_parametre();
        $param->SupprimerLocalite($id);
    }
}*/
?>

<div class="modal" id="suppLocalite">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <input type="hidden" value="<?php echo $idloc?>" id="ident">
                <span>Etes-vous sur de vouloir supprimer cette localit&eacute; ?</span>
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerLocalite" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerLocalite" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
</div>
<div id="accepter"></div>
<script type="application/javascript">

    $('#validerLocalite').on ('click', function(){
        var ident=$('#ident').val();
        var data="idlocali="+ident;

        $.ajax({
            type:"POST",
            url:"./parametre/localite/suppression.php",
            data:data,
            success: function (reponse) {
                $('#accepter').html(reponse).show();
                var etat=$('#echec').val();
                if(etat!=''){
                    $("#corps").load("./parametre/localite/localite.php");
                    etatdeinsertion("supp");
                }else{
                    $("#corps").load("./parametre/localite/localite.php");
                    notification(1);
                }

            }
        });
    });

    $('#annulerLocalite').click(function(){
        $("#corps").load("./parametre/localite/localite.php");
    });
</script>
<?php }?>