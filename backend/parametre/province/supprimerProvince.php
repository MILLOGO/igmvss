<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 04/07/2018
 * Time: 22:25
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$idProvince='';
if(isset($_POST['id'])){
    $idProvince=$_POST['id'];

}else{
    if($_POST){
        $id=$_POST['idpro'];
            $parametre=new Bd_parametre();
            $parametre->SupprimerProvince($id);

    }
}
?>

<div class="modal" id="confirmationProvince">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer cet élément ?</span>
                <input type="hidden" id="idProvince" value="<?php echo $idProvince; ?>">
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerProvince" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerProvince" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
</div>
<div id="accepter">

</div>
<script>

    $("#validerProvince").click(function(){

        var idprovince=$('#idProvince').val();
        var data='idpro='+idprovince;

        var table="commune";
        var attrib="idprovince";
        var doneverif='id='+idprovince+"&attr="+attrib+"&table="+table;

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
                        url: "./parametre/province/supprimerProvince.php",
                        data: data,
                        success: function () {
                            $("#corps").load("./parametre/province/province.php");
                            notification(1);
                        }
                    });
                }
                else{
                    alert("Impossible de supprimer cette province !!!");

                }
            }
        });
    });


    $('#annulerProvince').click(function(){
        $("#corps").load("./parametre/province/province.php");
    });
</script>
<?php }?>


