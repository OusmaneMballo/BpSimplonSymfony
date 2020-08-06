class Compte{
    constructor(){};
    initialize = function (id, type, clients, frai){
        this.id = id;
        this.type = type;
        this.clients = clients;
        this.frai = frai;
    }
}
class TypeCompte{
    constructor(){};
    initialize = function (id, libelle){
        this.id = id;
        this.libelle = libelle;
    }
}


//Fonction de verification des champs input compte
function verificationCompte() {

    let typeCompte = document.getElementById("typecp");
    let choix = typeCompte.selectedIndex;
    let type = typeCompte.options[choix].text;
    if (type ==="--Type Compte--") {
        typeCompte.style("border: solid 1px red;");
        return false;
    }
    let client = document.getElementById("client");
    choix = client.selectedIndex;
    type = client.options[choix].text;
    if (type === "--Clients--") {
        client.style("border: solid 1px red;");
        return false;
    }

    return true;
}

///
//Attribution de frais
///
function frais(){
    
    let typeCompte = document.getElementById("typecp");
    let choix = typeCompte.selectedIndex;
    let type = typeCompte.options[choix].text;

    if (type === "Epargne") {
        document.getElementById('frai').innerHTML = "450F cfa";
    }
    else {
        if (type === "Courant") {
            document.getElementById('frai').innerHTML = '700F cfa';
        }
        else {
            if(type === "Xewel")
            {
                document.getElementById('frai').innerHTML = '400F cfa';
            }
            else{
                document.getElementById('frai').innerHTML = '0F cfa';
            }
        }
    }
}

///
//Methode de validation de formulaire
///
function post() {
    if (verificationCompte()) {

    }
    else{
        alert('Merci de renseigner les champs actives');
        return false;
    }
}