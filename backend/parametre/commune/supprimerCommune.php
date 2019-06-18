<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 23/07/2018
 * Time: 01:03
 */
include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{
$idCommune="";
if(isset($_POST['id'])){
    $idCommune=$_POST['id'];

}else{
    if($_POST){
        $id=$_POST['idcom'];
            $parametre=new Bd_parametre();
            $parametre->SupprimerCommune($id);
    }
}
?>

<div class="modal" id="deletecommune">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer cette commune ?</span>
                <input type="hidden" id="idCommune" value="<?php echo $idCommune; ?>">
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

        var idcommune=$('#idCommune').val();
        var data='idcom='+idcommune;

        var table="localite";
        var attrib="idcommune";
        var doneverif='id='+idcommune+"&attr="+attrib+"&table="+table;

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
                        url: "./parametre/commune/supprimerCommune.php",
                        data: data,
                        success: function () {
                            $("#corps").load("./parametre/commune/commune.php");
                            notification(1);
                        }
                    });
                }
                else{
                    //alert("Impossible de supprimer cette commune !!!");
                    etatdeinsertion("supp");
                }
            }
        });
    });


    $('#annulerSupp').click(function(){
        $("#corps").load("./parametre/commune/commune.php");
    });
</script>

<?php }?>
