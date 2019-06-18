<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 20/07/2018
 * Time: 23:16
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

$id=0;
if(isset($_POST['idsite'])){
    $id=$_POST['idsite'];

}else{
    if($_POST){
        $idB=$_POST['idsit'];
            $gestion=new Bd_GestionSite();
           // $gestion->supprimerSiteDansSituerSiteLocalite($idB);
            $gestion->supprimerSite($idB);

    }
}
?>


<div class="modal" id="deleteSite">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span>Etes-vous sur de vouloir supprimer ce site ?</span>
                <input type="hidden" id="iddusite" value="<?php echo $id ?>">
            </div>
            <div class="modal-footer">
                <a href="#"  class="btn btn-default" id="annulerSuppSit" data-dismiss="modal">Non</a>
                <a href="#"  class="btn btn-danger" id="validerSuppSit" data-dismiss="modal">Oui</a>
            </div>
        </div>
    </div>
    <div id="accepter">

    </div>
</div>
<script>

    $( "#dialog").hide();
    $("#validerSuppSit").click(function(){

        var iddusite=$('#iddusite').val();
        var data='idsit='+iddusite;

        $.ajax({
            type:"GET",
            url:"./gestionSite/site/traitement.php",
            data:data,
            success: function(reponse) {
                $('#accepter').html(reponse).show();
                var numsite = $('#supprimerSite').val();
                if (numsite == 0) {
                    $.ajax({
                        type: "POST",
                        url: "./gestionSite/site/supprimerSite.php",
                        data: data,
                        success: function () {
                            $("#corps").load("./gestionSite/site/listeSite.php");
                            notification(1);
                        }
                    });
                }
                else{
                    //alert("Impossible de supprimer ce site !!!");
                    etatdeinsertion('supp');
                }
            }
        });



    });


    $('#annulerSuppSit').click(function(){
        $("#corps").load("./gestionSite/site/listeSite.php");
    });
</script>

<?php }?>
