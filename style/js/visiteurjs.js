/**
 * Created by somda on 21/09/2018.
 */


$(document).ready(function() {

    $("#reqAmenagement").on('click', function () {
        $("#corps").load("./public/requetes/amenagement/amenagement.php");
    });

    $("#reqProjetoperateur").on('click', function () {
        $("#corps").load("./public/requetes/projetoperateur/projetoperateur.php");
    });

    $("#reqProjetmontant").on('click', function () {
        $("#corps").load("./public/requetes/projetmontant/projetmontant.php");
    });

    $("#reqOperateurmontant").on('click', function () {
        $("#corps").load("./public/requetes/operateurmontant/operateurmontant.php");
    });

    $("#reqGestionnairerevenu").on('click', function () {
        $("#corps").load("./public/requetes/gestionnaireRevenu/gestionnairerevenu.php");
    });

    $("#reqProjetzone").on('click', function () {
        $("#corps").load("./public/requetes/projetParGeographie/projetParGeographie.php");
    });

    $("#reqvocation").on('click', function () {
        $("#corps").load("./public/requetes/vocation/vocation.php");
    });

    $("#reqappuis").on('click', function () {
        $("#corps").load("./public/requetes/appuis/appuis.php");
    });

    $("#reqbailOptProj").on('click', function () {
        $("#corps").load("./public/requetes/bailleurOperateurProjet/bailleurOperateurProjet.php");
    });

    $("#reqespecevege").on('click', function () {
        $("#corps").load("./public/requetes/especeVegetalisation/especevegetalisation.php");
    });


});