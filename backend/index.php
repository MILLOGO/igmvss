<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 25/06/2018
 * Time: 21:18
 */

include_once('../DataBases/FichierBD.php');

if(!$_SESSION){
    header('location:../');
}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<meta http-equiv='Content-Type' content='text/html;' charset="utf-8" />
<head>
    <title>Configuration</title>

    <link rel="stylesheet" type="text/css" href="../style/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../style/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../style/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="../style/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../style/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="../style/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="../style/css/jquery.rtnotify.css"/>
    <link rel="stylesheet" type="text/css" href="../style/css/jquery-ui.css"/>
    <link rel="icon" type="image/x-icon" href="../style/images/tst.png" />
    <link rel="stylesheet" type="text/css" href="../style/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="../style/css/backend.css"/>

    <script type="application/javascript" src="../style/js/jquery-3.1.0.min.js"></script>
    <script type="application/javascript" src="../style/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="../style/js/dataTables.bootstrap.min.js"></script>
    <script type="application/javascript" src="../style/js/jquery.dataTables.min.js"></script>
    <script type="application/javascript" src="../style/js/datepicker.js"></script>
    <script type="application/javascript" src="../style/js/jquery.rtnotify.js"></script>
    <script type="application/javascript" src="../style/js/jquery.validate.js"></script>
     <script type="application/javascript" src="../style/js/jquery-ui.min.js"></script>
    <script type="application/javascript" src="../style/js/scripts.js"></script>
    <script type="application/javascript" src="../style/js/backend.js"></script>
    <script type="application/javascript" src="../style/js/messageBd.js"></script>

</head>
<body>
<div class="container-fluid" >
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12 banniere">
            <div class="col-sm-1 col-lg-1 col-md-1">
                <a href="../public/"><img src="../style/images/logo.png" width="100px" height="100px"  alt="Logo"></a>
            </div>
            <div class="col-sm-6 col-lg-6 col-md-6" style="width: 57%; margin-left: 7%;">
                <h1 class="police" style="font-size: 20pt; text-align: center">Initiative de la Grande Muraille Verte pour le Sahara et le Sahel au Burkina Faso</h1>
            </div>
            <div class="col-sm-2 col-lg-2 col-md-2 date" style="width: auto">
                    <span style="color: #000; font-weight: bold;border-bottom: 5px solid;">
						<?php $dat=date('D d M Y'); //echo $dat;
                        $date1 = date('Y-m-d');
                        setlocale(LC_TIME, "fr_FR","French");
                        $date = new DateTime('UTC');
                        $date = strftime("%A %d %B %Y", strtotime($date1));
                        echo $date;?>
                    </span>
            </div>
            <div class="col-sm-1 col-lg-1 col-md-1 pull-right" style="margin-top: 10px;">
                <img src="../style/images/drapeau.png" width="130%" height="110%"  alt="drapeau">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" style="background-image: url(../style/images/fond1.png); background-repeat: repeat-x;">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <a href="../public/" title="accueil"><i class="fa-2x fa fa-home"></i></a>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="text-align:right; margin-bottom:0px;">
            <?php echo ("Bienvenue "); ?>  <strong class="maj"><?php echo $_SESSION['prenom']." ". $_SESSION['nom']; ?></strong> &nbsp; - &nbsp;Votre profil (<span style="font-weight: bold">
					<?php if($_SESSION['profil']==1){
                        echo "Administrateur";
                    }else{ echo "utilisateur simple";} ?>
				</span>)&nbsp; - &nbsp;<a href="../logout.php" style="color: #ff0000; text-decoration: none">Se déconnecter <i class="fa fa-power-off"></i></a>
        </div> <!-- col md 12 -->
    </div>
        <div class="col-md-2 col-sm-2 col-lg-2" style="padding-right: 10px; padding-left: 0px;">
            <a href="#"></a>
            <div class="panel-group" id="accordion">
                <div class="panel panel-menu">
                    <div class="panel-heading">
                        <h2 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#utilisateur">Utilisateurs</a>
                        </h2>
                    </div> <!--Pannel Heading-->
                    <div id="utilisateur" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">
                                <tr id="ligne0" onclick="Activer(this.id);" class="active centrer"><td><a class="menu-vertical" href="#" id="user">Liste des utilisateurs</a></td></tr>
                            </table>
                        </div>
                    </div>
                </div> <!-- pannel -->
                <div class="panel panel-menu">
                    <div class="panel-heading">
                        <h2 class="panel-title">
                            <a data-toggle="collapse"  data-parent="#accordion" href="#GroupeMenu2">Paramètres</a>
                        </h2>
                    </div> <!--Pannel Heading-->
                    <div id="GroupeMenu2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr id="ligne1" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="region">Région</a></td></tr>
                                <tr id="ligne2" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="province">Province</a></td></tr>
                                <tr id="ligne3" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="commune">Commune</a></td></tr>
                                <tr id="ligne4" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="localite">Localité</a></td></tr>
                                <tr id="ligne5" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="facteur">Facteur de production</a></td></tr>
                                <tr id="ligne6" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="appui">Type d'appuis</a></td></tr>
                                <tr id="ligne7" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="espece">Espèces</a></td></tr>
                                <tr id="ligne8" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="typeRe">Reconnaissance</a></td></tr>
                                <tr id="ligne9" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="typeEx">Exploitation</a></td></tr>
                                <tr id="ligne10" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="catAm">Catégorie d'aménagement</a></td></tr>
                                <tr id="ligne11" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="Souscat">Sous catégorie</a></td></tr>
                                <tr id="ligne12" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="amenagement">Aménagement</a></td></tr>
                                <tr id="ligne13" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="vegetalisation">Végétalisation</a></td></tr>
                                <tr id="ligne14" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="catVo">Catégorie de vocation</a></td></tr>
                                <tr id="ligne15" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="vocation">Vocation</a></td></tr>
                                <tr id="ligne16" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="typecollectif">Type du collectif</a></td></tr>
                            </table>
                        </div>
                    </div>
                </div> <!-- pannel -->
                <!--<div class="panel panel-menu">
                    <div class="panel-heading">
                        <h2 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#accueil">Retourner</a>
                        </h2>
                    </div> <!--Pannel Heading-->
                <!--<div id="accueil" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr id="ligne16" onclick="Activer(this.id);" ><td><a class="menu-vertical" href="../public/" id="accueil">Accueil</a></td></tr>
                        </table>
                    </div>
                </div>
            </div> -->
            </div> <!-- pannel group -->
        </div>
        <div class="col-md-10 col-sm-10 col-lg-10" id="corps">

        </div>
    </div> <!--row-->
</body>
</html>

<?php }?>

<script type="application/javascript">

    function Activer(selectorElement){
        $('tr').each(function(){
            $(this).removeAttrs('class');
        });

        $('#'+selectorElement).attr('class','active');

        $("#typecollectif").on('click', function () {
            $("#corps").load("./parametre/typeducollectif/typeducollectif.php")
        });

    }

    function EnleverFocus(idelement){
        var contenu=$('#'+idelement).val();
        if(contenu!=''){
            $('#'+idelement).removeAttrs('style');
        }
    }
</script>

