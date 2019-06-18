<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 14/10/2018
 * Time: 14:44
 */

include_once('../../../Databases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else{

    $parametr=new Bd_parametre();
    $idf=0;
    $libelle="";
    if(isset($_POST['id'])){
        $idf=$_POST['id'];
        $libelle=$parametr->RecupererLibelleTypecollectif($idf);
    }else{
        if($_POST){
            $id=$_POST['idele'];
            $param=new Bd_parametre();
            $param->supprimerTypeCollectif($id);
        }
    }
    ?>

    <div class="modal" id="deletecategorie">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $idf?>" id="ident">
                    <input type="hidden" value="<?php echo $libelle?>" id="libel">
                    <span>Etes-vous sur de vouloir supprimer ce type de collectif ?</span>
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
            var libelle=$('#libel').val();
            var data='idele='+ident;
            var table="gestionnaire";
            var attrib="typecollectif";
            var doneverif='idcaract='+libelle+"&attr="+attrib+"&table="+table;

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
                            url: "./parametre/typeducollectif/supprimerTypecollectif.php",
                            data: data,
                            success: function () {
                                $("#corps").load("./parametre/typeducollectif/typeducollectif.php");
                                notification(1);
                            }
                        });
                    }
                    else{
                        //alert("Impossible de supprimer cette catégorie !!!");
                        etatdeinsertion('supp');

                    }
                }
            });
        });


        $('#annulerSupp').click(function(){
            $("#corps").load("./parametre/typeducollectif/typeducollectif.php");
        });
    </script>
<?php }?>