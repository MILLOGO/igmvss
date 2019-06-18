/**
 * Created by somda on 06/07/2018.
 */
$(document).ready(function() {
    //chargements des données par défaut
    $("#corps").load("./parametre/utilisateur/listeUtilisateur.php");

    //chargement des utilisateurs
    $("#user").on('click', function () {
        $("#corps").load("./parametre/utilisateur/listeUtilisateur.php")
    });

    //chargement des regions
    $("#region").on('click', function () {
        $("#corps").load("./parametre/region/region.php")
    });

    //chargement des provinces
    $("#province").on('click', function () {
        $("#corps").load("./parametre/province/province.php")
    });

    //chargement des commune
    $("#commune").on('click', function () {
        $("#corps").load("./parametre/commune/commune.php")
    });

    //chargement des appuis
    $("#appui").on('click', function () {
        $("#corps").load("./parametre/appui/appui.php")
    });

    //chargement des espèces
    $("#espece").on('click', function () {
        $("#corps").load("./parametre/espece/espece.php")
    });

    //chargement des status foncier
    $("#typeRe").on('click', function () {
        $("#corps").load("./parametre/reconnaissance/reconnaissance.php")
    });

    $("#typeEx").on('click', function () {
        $("#corps").load("./parametre/exploitation/exploitation.php")
    });

    //chargement des facteurs de production
    $("#facteur").on('click', function () {
        $("#corps").load("./parametre/facteurproduction/listefacteurproduction.php")
    });

    //chargement des catégorie d'amenagement
    $("#catAm").on('click', function () {
        $("#corps").load("./parametre/categorieAmenagement/categorieAmenagement.php")
    });

    $("#Souscat").on('click', function () {
        $("#corps").load("./parametre/souscategorieamenagement/souscategorie.php")
    });

    //Amenagement
    $("#amenagement").on('click', function () {
        $("#corps").load("./parametre/amenagement/amenagement.php")
    });

    //végétalisation
    $("#vegetalisation").on('click', function () {
        $("#corps").load("./parametre/vegetalisation/vegetalisation.php")
    });

    //Localité
    $("#localite").on('click', function () {
        $("#corps").load("./parametre/localite/localite.php")
    });

    //categorie vocation
    $("#catVo").on('click', function () {
        $("#corps").load("./parametre/categorieVocation/categorieVocation.php")
    });


    //categorie vocation
    $("#vocation").on('click', function () {
        $("#corps").load("./parametre/vocation/vocation.php")
    });



});
