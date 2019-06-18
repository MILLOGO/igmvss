/**
 * Created by somda on 14/07/2018.
 */

$(document).ready(function() {

    //charger la page des bailleurs par defaut au chargement de la page
    $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php");
//chargement des bailleurs
    $("#bailleur").on('click', function () {
        $("#corps").load("./gestionProjetActeur/bailleur/listeBailleur.php")
    });

//chargement des projets
    $("#projet").on('click', function () {
        $("#corps").load("./gestionProjetActeur/projet/listeProjet.php")
    });

//chargement des opérateur
    $("#operateur").on('click', function () {
        $("#corps").load("./gestionProjetActeur/operateur/listeOperateur.php")
    });

    $("#finance").on('click', function () {
        $("#corps").load("./gestionProjetActeur/financerBailleurOperateur/listeFinancement.php");
    });

//chargement des collecteurs
    $("#collecteur").on('click', function () {
        $("#corps").load("./gestionSite/collecteur/listeCollecteur.php")
    });

//chargement des espèces
    $("#gestionnaire").on('click', function () {
        $("#corps").load("./gestionSite/gestionnaire/listeGestionnaire.php")
    });

//chargement des revenu
    $("#revenu").on('click', function () {
        $("#corps").load("./gestionSite/revenuGestionnaire/listeRevenu.php")
    });

    $("#gestionnairOp").on('click', function () {
        $("#corps").load("./gestionSite/gestionnaireOperateur/listeGestionOperateur.php");
    });

    $("#site").on('click', function () {
        $("#corps").load("./gestionSite/site/listeSite.php")
    });

    $("#collection").on('click', function () {
        $("#corps").load("./gestionSite/collection/listeCollection.php")
    });

    $("#amenager").on('click', function () {
        $("#corps").load("./gestionAmenagement/amenager/listeAmenager.php", function () {
            $("#newamenager").modal();
        });
    });

    //partie des requetes

    $("#reqAmenagement").on('click', function () {
        $("#corps").load("./requetes/amenagement/amenagement.php");
    });

    $("#reqProjetoperateur").on('click', function () {
        $("#corps").load("./requetes/projetoperateur/projetoperateur.php");
    });

    $("#reqProjetmontant").on('click', function () {
        $("#corps").load("./requetes/projetmontant/projetmontant.php");
    });

    $("#reqOperateurmontant").on('click', function () {
            $("#corps").load("./requetes/operateurmontant/operateurmontant.php");
        });

    $("#reqGestionnairerevenu").on('click', function () {
            $("#corps").load("./requetes/gestionnaireRevenu/gestionnairerevenu.php");
    });

    $("#reqProjetzone").on('click', function () {
            $("#corps").load("./requetes/projetParGeographie/projetParGeographie.php");
    });

    $("#reqvocation").on('click', function () {
        $("#corps").load("./requetes/vocation/vocation.php");
    });

    $("#reqappuis").on('click', function () {
        $("#corps").load("./requetes/appuis/appuis.php");
    });

    $("#reqappuis2").on('click', function () {
            $("#corps").load("./requetes/appuis2/appuis.php");
        });

   $("#reqbailOptProj").on('click', function () {
        $("#corps").load("./requetes/bailleurOperateurProjet/bailleurOperateurProjet.php");
    });

    $("#reqespecevege").on('click', function () {
        $("#corps").load("./requetes/especeVegetalisation/especevegetalisation.php");
    });




    function MettreFocus(nomB,nomC,prenom,num){
        if(nomB==''){
            $('#nomB').css('background-color', '#FDD');
        }

        if(nomC==''){
            $('#nomC').css('background-color', '#FDD');
        }

        if(prenom==''){

            $('#prenom').css('background-color', '#FDD');
        }

        if(num==''){
            $('#num').css('background-color', '#FDD');
        }

    }
});