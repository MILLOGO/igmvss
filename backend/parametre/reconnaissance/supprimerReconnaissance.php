<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 04/07/2018
 * Time: 19:06
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idrec='';
$libelle='';
if(isset($_POST['id'])){
    $idrec=$_POST['id'];
    $libelle=$_POST['libelle'];

}else{
    if($_POST){
        $id=$_POST['idreg'];
        $parametre=new Bd_parametre();
        $parametre->supprimerReconnaissance($id);
    }
}
?>

<div class="modal" id="deletereconnaissance">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer cette reconnaissance ?</span>
                <input type="hidden" id="idRegion" value="<?php echo $idrec; ?>">
                <input type="hidden" id="libell" value="<?php echo $libelle; ?>">
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

        var idregion=$('#idRegion').val();
        var libelle=$('#libell').val();
        var data='idreg='+idregion;
        var table="statutfoncier";
        var attrib="typereconnaissance";
        var doneverif="idcaract="+libelle+"&attr="+attrib+"&table="+table;

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
                        url: "./parametre/reconnaissance/supprimerReconnaissance.php",
                        data: data,
                        success: function () {
                            $("#corps").load("./parametre/reconnaissance/reconnaissance.php");
                            notification(1);
                        }
                    });
                }
                else{
                    alert("Impossible de supprimer cette reconnaissance !!!");

                }
            }
        });
    });


    $('#annulerSupp').click(function(){
        $("#corps").load("./parametre/reconnaissance/reconnaissance.php");
    });
</script>
<?php }?>

