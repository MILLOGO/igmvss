<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 25/07/2018
 * Time: 12:31
 */
include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{
$id="";
if(isset($_POST['idamenager'])){
    $id=$_POST['idamenager'];

}else{
    if($_POST){
        $idAm=$_POST['idamen'];
        $Amenager=new Bd_GestionAmenagement();
        $Amenager->supprimeEspeceAmenager($idAm);
        $Amenager->supprimeVegetalisationAmenager($idAm);
        $Amenager->supprimeAmenager($idAm);
    }
}
?>


<div class="modal" id="deleteAmenager">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer cet Amenagement ?</span>
                <input type="hidden" id="idamenager" value="<?php echo $id ?>">
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerSuppSit" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerSupp" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
</div>
<script>

    $("#validerSupp").click(function(){

        var idamenager=$('#idamenager').val();
        var data='idamen='+idamenager;
                    $.ajax({
                        type: "POST",
                        url: "./gestionAmenagement/amenager/supprimerAmenager.php",
                        data: data,
                        success: function () {
                            $("#corps").load("./gestionAmenagement/amenager/listeAmenager.php");
                            notification(1);
                        }
                    });
    });


    $('#annulerSuppSit').click(function(){
        $("#corps").load("./gestionAmenagement/amenager/listeAmenager.php");
    });
</script>
<?php }?>

