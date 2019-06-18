<?php

include_once('../DataBases/FichierBD.php');

if(!$_SESSION){
    header('location:../');
}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<meta http-equiv='Content-Type' content='text/html;' charset="utf-8" />
<head>
    <title>Public</title>

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
    <script type="application/javascript" src="../style/js/jquery.rtnotify.js"></script>
    <script type="application/javascript" src="../style/js/jquery.validate.js"></script>
    <script type="application/javascript" src="../style/js/jquery-ui.min.js"></script>
    <script type="application/javascript" src="../style/js/datepicker.js"></script>
    <script type="application/javascript" src="../style/js/scripts.js"></script>
    <script type="application/javascript" src="../style/js/chargerPage.js"></script>
    <script type="application/javascript" src="../style/js/messageBd.js"></script>

</head>
<body>
<div class="container-fluid" >
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12 banniere">
            <div class="col-sm-1 col-lg-1 col-md-1">
                <a href="../public/"><img src="../style/images/logo.png"  height="100px"  alt="Logo"></a>
            </div>
            <div class="col-sm-6 col-lg-6 col-md-6" style="width: 57%; margin-left: 7%;">
                <h1 class="police" style="font-size: 20pt; text-align: center">Initiative de la Grande Muraille Verte pour le Sahara et le Sahel au Burkina Faso</h1>
            </div>
            <div class="col-sm-2 col-lg-2 col-md-2 date" style="width: auto">
                    <span style="color: #000; font-weight: bold;border-bottom: 5px solid;">
						<?php //$dat=date('D d M Y'); //echo $dat;
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
            <!-- <?php if($_SESSION['profil']==1){?>
                <a href="../backend/" title="paramètrer"><i class="fa-2x fa fa-cogs"></i></a>
            <?php }?>-->
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="text-align:right; margin-bottom:0px;">
            <?php echo ("Bienvenue "); ?>  <strong class="maj"><?php echo $_SESSION['prenom']." ". $_SESSION['nom']; ?></strong> &nbsp; - &nbsp;Votre profil (<span style="font-weight: bold">
					<?php if($_SESSION['profil']==1){
                        echo "Administrateur";
                    }else{ echo "utilisateur simple";} ?>
				</span>)&nbsp; - &nbsp;<a href="../logout.php" style="color: #ff0000; text-decoration: none">Se déconnecter <i class="fa fa-power-off"></i></a>
        </div> <!-- col md 12 -->
    </div>
        <div class="col-md-2 col-sm-2 col-lg-2" style="padding-right: 5px; padding-left: 0px;">
            <a href="#"></a>
            <div class="panel-group" id="accordion">
                <div class="panel panel-menu">
                    <div class="panel-heading">
                        <h2 class="panel-title" style="text-align: center">
                            <a data-toggle="collapse" data-parent="#accordion" href="#gestionpro" >Gestion des projets et acteurs</a>
                        </h2>
                    </div> <!--Pannel Heading-->
                    <div id="gestionpro" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table" style="">
                                <tr id="ligne0" onclick="Activer(this.id);" class="centrer active"><td><a class="menu-vertical" href="#" id="bailleur">Bailleur</a></td></tr>
                                <tr id="ligne1" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="operateur">Opérateurs</a></td></tr>
                                <tr id="ligne2" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="projet">Projet</a></td></tr>
                                <tr id="ligne3" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="finance">Financer un Opérateur</a></td></tr>
                            </table>
                        </div>
                    </div>
                </div> <!-- pannel -->
                <div class="panel panel-menu">
                    <div class="panel-heading">
                        <h2 class="panel-title" style="text-align: center">
                            <a data-toggle="collapse" data-parent="#accordion" href="#gestionsite">Gestion des sites</a>
                        </h2>
                    </div> <!--Pannel Heading-->
                    <div id="gestionsite" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr id="ligne7" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="gestionnaire">Gestionnaire</a></td></tr>
                                <tr id="ligne4" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="site">Site</a></td></tr>
                                <tr id="ligne5" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="collecteur">Collecteur</a></td></tr>
                                <tr id="ligne6" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="collection">Observation site</a></td></tr>
                                <tr id="ligne8" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="revenu">Revenu gestionnaire </a></td></tr>
                                <tr id="ligne9" onclick="Activer(this.id);" class="centrer"><td><a class="menu-vertical" href="#" id="gestionnairOp">Appui au gestionnaire </a></td></tr>
                            </table>
                        </div>
                    </div>
                </div> <!-- pannel -->
                <div class="panel panel-menu">
                    <div class="panel-heading">
                        <h5 class="panel-title" style="text-align: center">
                            <a data-toggle="collapse" data-parent="#accordion" href="#gestionAmen">Gestion des aménagements</a>
                        </h5>
                    </div> <!--Pannel Heading-->
                    <div id="gestionAmen" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr id="ligne10" onclick="Activer(this.id);"><td><a href="#" id="amenager">Aménager un site</a></td></tr>
                            </table>
                        </div>
                    </div>
                </div> <!-- pannel -->
                <div class="panel panel-menu">
                    <div class="panel-heading">
                        <h5 class="panel-title" style="text-align: center">
                            <a data-toggle="collapse" data-parent="#accordion" href="#requetes">Requêtes</a>
                        </h5>
                    </div> <!--Pannel Heading-->
                    <div id="requetes" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr id="ligne11" onclick="Activer(this.id);" class="centrer"><td><a href="#" id="reqAmenagement" rel="tooltip" title="Ceci est une infobulle!">Aménagement</a></td></tr>
                                <tr id="ligne12" onclick="Activer(this.id);" title="teste" class="centrer"><td><a href="#" id="reqProjetoperateur">Projet Opérateur</a></td></tr>
                                <tr id="ligne13" onclick="Activer(this.id);" class="centrer"><td><a href="#" id="reqProjetmontant">Projet Bailleur</a></td></tr>
                                <tr id="ligne14" onclick="Activer(this.id);" class="centrer"><td><a href="#" id="reqOperateurmontant">Opérateur Bailleur</a></td></tr>
                                <tr id="ligne15" onclick="Activer(this.id);" class="centrer"><td><a href="#" id="reqProjetzone">Projet par zone géographique</a></td></tr>
                                <tr id="ligne16" onclick="Activer(this.id);" class="centrer"><td><a href="#" id="reqGestionnairerevenu">Revenu Gestionnaire </a></td></tr>
                                <tr id="ligne17" onclick="Activer(this.id);" class="centrer"><td><a href="#" id="reqvocation">Vocation</a></td></tr>
                                <tr id="ligne18" onclick="Activer(this.id);" class="centrer"><td><a href="#" id="reqappuis">Appuis</a></td></tr>
                                <tr id="ligne19" onclick="Activer(this.id);" class="centrer"><td><a href="#" id="reqbailOptProj">Bailleur Opérateur Projet</a></td></tr>
                                <tr id="ligne20" onclick="Activer(this.id);" class="centrer"><td><a href="#" id="reqespecevege">Espèce et Végétalisation</a></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-menu">
                    <div class="panel-heading">
                        <h5 class="panel-title" style="text-align: center">
                            <a data-toggle="collapse" data-parent="#accordion" href="#Aides">Aide</a>
                        </h5>
                    </div> <!--Pannel Heading-->
                    <div id="Aides" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr id="ligne21" onclick="Activer(this.id);" class="centrer"><td><a href="./docs/Guide_d_utilisation.pdf" target="blank" id="aide">Guide d'utilisation</a></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if($_SESSION['profil']==1){?>
                <div class="panel panel-menu">
                    <div class="panel-heading">
                        <h5 class="panel-title" style="text-align: center">
                            <a data-toggle="collapse" data-parent="#accordion" href="#Admin">Administration</a>
                        </h5>
                    </div> <!--Pannel Heading-->
                    <div id="Admin" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr id="ligne22" onclick="Activer(this.id);" class="centrer"><td><a href="../backend/" id="aide">Paramètres</a></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div> <!-- pannel group -->
        </div>
        <div class="col-md-10 col-sm-10 col-lg-10" id="corps">

        </div>
    </div> <!--row-->
</body>
</html>

<?php }?>
<script type="application/javascript">

   /* $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });*/

    $(document).ready(function(){
        $('tr.centrer').mouseover(function(){
            $(this).tooltip('show');
        });
    });

    function Activer(selectorElement){
        $('tr').each(function(){
            $(this).removeAttrs('class');
        });
        $('#'+selectorElement).attr('class','active');
    }

    function EnleverFocus(idelement){
        var contenu=$('#'+idelement).val();
        if(contenu!=''){
            $('#'+idelement).removeAttrs('style');
        }
    }



</script>

<script type="text/javascript">

   /* $(document).ready(function() {

        // Sélectionner tous les liens ayant l'attribut rel valant tooltip
        $('a[rel=tooltip]').mouseover(function(e) {
            // Récupérer la valeur de l'attribut title et l'assigner à une variable
            var tip = $(this).attr('title');

            // Supprimer la valeur de l'attribut title pour éviter l'infobulle native
            $(this).attr('title','');

            // Insérer notre infobulle avec son texte dans la page
            $(this).append('<div id="tooltip"><div class="tipHeader"></div><div class="tipBody">' + tip + '</div><div class="tipFooter"></div></div>');
            // Ajuster les coordonnées de l'infobulle
            $('#tooltip').css('top',  10 );
            $('#tooltip').css('left', e.pageX + 20 );

            // Faire apparaitre l'infobulle avec un effet fadeIn
            $('#tooltip').fadeIn('500');
            $('#tooltip').fadeTo('10',0.8);

        }).mousemove(function(e) {

            // Ajuster la position de l'infobulle au déplacement de la souris
            $('#tooltip').css('top', e.pageY);
            $('#tooltip').css('left',0);

        }).mouseout(function() {

            // Réaffecter la valeur de l'attribut title
            $(this).attr('title',$('.tipBody').html());

            // Supprimer notre infobulle
            $(this).children('div#tooltip').remove();

        });

    });*/

</script>