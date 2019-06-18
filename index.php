<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 23/06/2018
 * Time: 21:16
 */
include_once('./DataBases/FichierBD.php');
if($_SESSION){
    header('location:./public/');
}else{
?>
<?php

if(isset($_POST['connexion'])){
    $identifiant=$_POST['loginuser'];
    $pw=$_POST['passeuser'];
    $user= new Bd_user(" "," "," ",$identifiant,$pw," "," "," ","");
    $exit=$user->Est_Utilisateur();
    if($exit[0]!=" ") {
            if ($exit[0] == 1) {
                $user->connexion();
                header('location:./backend/');
            }else{
                if($exit[0]==2){
                $user->connexion();
                header('location:./public/');
            }
            }
    }else{
        echo '<script language="JavaScript">alert("identifiant et/ou mot de passe incorrecte")</script>';
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<meta http-equiv='Content-Type' content='text/html;' charset="utf-8" />
<head>
    <title>Connexion</title>

    <link rel="stylesheet" type="text/css" href="./style/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="./style/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="./style/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="./style/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="./style/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="./style/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="./style/css/jquery.rtnotify.css"/>
    <link rel="stylesheet" type="text/css" href="./style/css/jquery-ui.css"/>
    <link rel="icon" type="image/x-icon" href="./style/images/tst.png" />
    <link rel="stylesheet" type="text/css" href="./style/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="./style/css/backend.css"/>

    <script type="application/javascript" src="./style/js/jquery-3.1.0.min.js"></script>
    <script type="application/javascript" src="./style/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="./style/js/dataTables.bootstrap.min.js"></script>
    <script type="application/javascript" src="style/js/datepicker.js"></script>
    <script type="application/javascript" src="./style/js/jquery.rtnotify.js"></script>
    <script type="application/javascript" src="./style/js/jquery.validate.js"></script>
    <script type="application/javascript" src="./style/js/jquery-ui.min.js"></script>
    <script type="application/javascript" src="./style/js/scripts.js"></script>

</head>
<body class="login-page" style="background-image: url('./style/images/format.png'); background-repeat: no-repeat; background-position: center">
<div class="container" >
    <div class="row" style="margin-bottom: 50px">&nbsp;</div>
    <div class="col-xs-12 col-sm-12 col-md-12 container-fluid" style="text-align: center">&nbsp;</div>

    <div class="row">
    <div class="col-md-2"> </div>
    <div class="col-md-8"  >
        <div  style=" padding-left: 35px;
        padding-top:15px; margin-bottom:0px; --">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: left; padding-left: 0px;">

                </div>
            </div> <!-- row -->

            <div class="row">

                <div class="col-md-3" style="margin-top: 200px;">
                    <div style="font-size: 11px; bottom: 0px;" class="hidden-xs hidden-sm">

                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="row" style="text-align: center"><h4 style="margin-top: 5px; margin-bottom: 10px; font-size: 14pt; color: #006600">Se connecter</h4></div>
                    <div id="zoneConnexion" class="well well-lg" style="border: 1px solid #B8B8B8; background-image: url('./style/images/tst.png'); background-repeat: no-repeat; background-position: center ">
                        <form id="frmConnect" method="post" action="" >
                            <div class="row">
                                <div class="form-group">
                                    <span class="" style="font-weight: bold;">Identifiant</span>
                                    <input type="text" placeholder="Votre compte utilisateur" name="loginuser" class="form-control" id="loginuser"  />

                                </div>
                            </div> <!-- ROW -->
                            <div class="row" style="">
                                <div class="form-group">
                                    <span class="" style="font-weight: bold;">Mot de passe</span>
                                    <input type="password" style="width: " placeholder="Votre mot de passe" name="passeuser" class="form-control" id="passeuser" />
                                </div>
                            </div>
                            <div class="row" style="margin-top:5%;margin-left:">
                                <input  class="btn btn-success" type="submit" value="Connexion" name="connexion"/>
                                <a href="visualiser.php" style="color: #29553F"><input  class="btn btn-warning pull-right" type="button" value="Visualiser" name="Visualiser"/></a>
                            </div>
                        </form>
                        <div class="page-header" style="margin:0px; margin-top:5px; margin-bottom:3px; border-color:#B8B8B8"></div>
                        <div style="text-align: center"><a href="" style="color: #29553F">Vous avez oublié votre mot de passe ?</a></div>
                    </div> <!-- zone connexion -->
                </div> <!-- cold md 8 -->
                <div class="col-md-3"></div>
            </div>
        </div>
        <div class="row">
            <div style="text-align:right; color: #29553F; font-size:0.85em"></div>
        </div>

    </div> <!-- MD6 -->
    <div class="col-md-2"> </div>
    </div>
</div>
<?php } ?>
</body>
</html>
