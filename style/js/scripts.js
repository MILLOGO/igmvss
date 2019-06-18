
// gestion des erreur dans les formulaires
function notification($etat){
	if($etat == 1){
	   $.rtnotify({
            title: "",
            message: "op&eacute;ration reussie",
            type: "success",
            permanent: false,
            timeout: 2,
            fade: true,
            width: 300
       });
    }
    else if($etat == -1){
       $.rtnotify({
            title: "",
            message: " Espece ou nombre de plant non renseign&eacute;",
            type: "error",
            permanent: false,
            timeout: 2,
            fade: true,
            width: 300
       });
    }
    else if($etat == "vide"){
        $.rtnotify({
            title: "",
            message: "Veuillez remplir les champs obligatoires",
            type: "error",
            permanent: false,
            timeout: 2,
            fade: true,
            width: 300
        });
    }
    else if($etat == "droit") {
        $.rtnotify({
            title: "",
            message: "Date de d&eacute;but ou de fin incorrecte!",
            type: "error",
            permanent: false,
            timeout: 2,
            fade: true,
            width: 350
        });
    }
    else{
        $.rtnotify({
                title: "",
                message: "champ esp&egrave;ce ou quantit&eacute; ou encore v&eacute;g&eacute;talisation non renseign&eacute;",
                type: "error",
                permanent: false,
                timeout: 5,
                fade: true,
                width: 300
            });
    }	
}


