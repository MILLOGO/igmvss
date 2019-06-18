<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 24/07/2018
 * Time: 15:28
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
        $param->SupprimerCatVocation($id);
    }
}
?>

<div class="modal" id="deletecatvoc">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <input type="hidden" value="<?php echo $idf?>" id="ident">
                <span>Etes-vous sur de vouloir supprimer cette catégorie ?</span>
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

        var table="vocation";
        var attrib="idcategorievocation";
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
                        url: "./parametre/categorieVocation/supprimerCatVocation.php",
                        data: data,
                        success: function () {
                            $("#corps").load("./parametre/categorieVocation/categorieVocation.php");
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
        $("#corps").load("./parametre/categorieVocation/categorieVocation.php");
    });
</script>

<?php }?>