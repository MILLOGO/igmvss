<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 23/07/2018
 * Time: 23:07
 */
include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idf=0;
if(isset($_POST['id'])){
    $idf=$_POST['id'];
}else{
    if($_POST){
        $id=$_POST['idele'];
        $param=new Bd_parametre();
        $param->supprimeTypeAppui($id);
    }
}
?>

<div class="modal" id="deleteappui">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <input type="hidden" value="<?php echo $idf?>" id="ident">
                <span>Etes-vous sur de vouloir supprimer ce type d'appui ?</span>
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerSupp" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerSupp" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
</div>

<div id="accepter">

</div>
<script>

    $("#validerSupp").click(function(){

        var ident=$('#ident').val();
        var data='idele='+ident;

        var table="recevoir_appui_gest_op";
        var attrib="idappui";
        var doneverif='id='+ident+"&attr="+attrib+"&table="+table;

        $.ajax({
            type:"GET",
            url:"./parametre/traitement/traitementSupp.php",
            data:doneverif,
            success: function(reponse) {
                $('#accepter').html(reponse).show();
                var num = $('#supprimer').val();
                if (num == 0) {
                    $.ajax({
                        type: "POST",
                        url: "./parametre/appui/supprimerAppui.php",
                        data: data,
                        success: function () {
                            $("#corps").load("./parametre/appui/appui.php");
                            notification(1);
                        }
                    });
                }
                else{
                    etatdeinsertion("supp");

                }
            }
        });
    });


    $('#annulerSupp').click(function(){
        $("#corps").load("./parametre/appui/appui.php");
    });
</script>

<?php }?>