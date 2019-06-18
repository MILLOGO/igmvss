/**
 * Created by somda on 12/10/2018.
 */

function etatdeinsertion($etat){
    if($etat== "echec"){
        $.rtnotify({
            title: "",
            message: " Une erreur est survenue lors de l'enregistrement de vos donn&eacute;es veuillez les verifier puis repprendre ",
            type: "error",
            permanent: false,
            timeout: 5,
            fade: true,
            width: 300
        });
    }
    else if($etat=='supp'){
        $.rtnotify({
            title: "",
            message: " Impossible de supprimer cet &eacute;l&eacute;ment ",
            type: "error",
            permanent: false,
            timeout: 5,
            fade: true,
            width: 300
        });
    }else if($etat=='nbrinvalid'){
        $.rtnotify({
            title: "",
            message: " Le nombre saisi est invalid ",
            type: "error",
            permanent: false,
            timeout: 5,
            fade: true,
            width: 300
        });
    }
}