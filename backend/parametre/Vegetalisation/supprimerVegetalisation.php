<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 24/07/2018
 * Time: 17:37
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
        $param->SupprimerVegetalisation($id);
    }
}
?>

<div class="modal" id="deletevegetalisation">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <input type="hidden" value="<?php echo $idf?>" id="ident">
                <span>Etes-vous sur de vouloir supprimer cette végétalisation ?</span>
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
<script type="application/javascript">

    $("#validerSupp").click(function(){
        var ident=$('#ident').val();
        var data='idele='+ident;
        var table="amenager_vegetalisation";
        var attrib="idvegetalisation";
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
                        url: "./parametre/vegetalisation/supprimerVegetalisation.php",
                        data: data,
                        success: function () {
                            $("#corps").load("./parametre/vegetalisation/vegetalisation.php");
                            notification(1);
                        }
                    });
                }
                else{
                    alert("Impossible de supprimer cette végétalisation !!!");

                }
            }
        });
    });

    $('#annulerSupp').click(function(){
        $("#corps").load("./parametre/vegetalisation/vegetalisation.php");
    });
</script>
<?php }?>