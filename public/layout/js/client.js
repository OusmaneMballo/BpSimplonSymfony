
//Creation de l'objet client
class Client {
    constructor() { };
    initialize = function (id, nom, prenom, tel, salaire, profession, email, login, passwd, nci, address) {
        this.id = id;
        this.nom = nom;
        this.prenom = prenom;
        this.tel = tel;
        this.salaire = salaire;
        this.profession = profession;
        this.email = email;
        this.login = login;
        this.passwd = passwd;
        this.nci = nci;
        this.address = address;
    }
    addEmployeur = function (employeur) {
        this.employeur = employeur;
    };
} 
//--------Declaration de variables globales------//

var cl = new Client();
var clients = [];
var i = 0;

//------Fin de declaration des variable globales------//

///
//Lea methode addClient permet d'ajout un client dans le tableau de client
///

function optionClient() {
    let slct=document.getElementById('client');
    for (let index = 0; index < clients.length; index++) {
        //let option=document.createElement('option');
        let newOption = new Option(
            clients[index].prenom + " " + clients[index].nom + "-" + clients[index].nci,
            clients[index].id
            );
        slct.options.add(newOption);
        console.log(clients[index].prenom + " " + clients[index].nom + "-" + clients[index].nci);
        //option.attributes('value') = clients[index].id;
        //option.textContent = clients[index].id + "-" + clients[index].prenom + " " + clients[index].nom + "-" + clients[index].nci;
        //slct.append(option);
    }
}

function employeurForm(){

    let client = document.getElementById("employeur");
    let choix = client.selectedIndex;
    let type = client.options[choix].text;
    if (type === "Ajouter son employeur") {
        document.getElementById("cm").hidden = false;
    }else{
        document.getElementById("cm").hidden = true;
    }
}
//Fonction de verification des champs input d'un client moral
function verificationMoral() {

    if (document.getElementById("cm").hidden == false){
       
        if (document.getElementById('nomCM').value === '' || document.getElementById('adresseCM').value === '') {
            return false;
        }
        if (document.getElementById('raisonSocialCM').value === '' || document.getElementById('emailCM').value === ''){
            return false;
        }
        if (document.getElementById('loginCM').value === '' || document.getElementById('passwdCM').value === '') {
            return false;
        }
    }

    return true;
}

/*
//Cette methode permet d'afficher les champs specifiques aux 
//clients physique salaries
*/
function salaryForm(){
    let client = document.getElementById("statutcp");
    let choix = client.selectedIndex;
    let type = client.options[choix].value;
    if(type==='1'){
        document.getElementById("salarier").hidden=false;
    }
    else{
        document.getElementById("salarier").hidden = true;
    }
}

/*
//Cette methode permet de selection le formulaire a afficher
*/
function typeClient() {
    let client = document.getElementById("typeclient");
    let choix = client.selectedIndex;
    let type = client.options[choix].value;
    if (type === "2") {
        document.getElementById("cp").hidden= true;
        document.getElementById("cm").hidden = false;
        document.getElementById("ajout").disabled=false;
        document.getElementById("annuler").disabled = false;
    }
    else {
        if (type === "1") {
            document.getElementById("cm").hidden = true;
            document.getElementById("cp").hidden = false;
            document.getElementById("ajout").disabled = false;
            document.getElementById("annuler").disabled = false;
        }
    }
}

//Fonction de verification des champs input d'un client physique
function verificationPhysique() {

    if (document.getElementById("cp").hidden == false) {

        if (document.getElementById('nomcp').value === '' || document.getElementById('prenomcp').value === '') {
            return false;
        }
        if (document.getElementById('telephonecp').value === '' || document.getElementById('passwdcp').value === '') {
            
            return false;
        }
        if (document.getElementById('emailcp').value === '' || document.getElementById('logincp').value === '') {
            
            return false;
        }
        if (document.getElementById('cnicp').value === '' || document.getElementById('adressecp').value === '') {
            
            return false;
        }
        if (document.getElementById("salarier").hidden === false){
            let client = document.getElementById("employeur");
            let choix = client.selectedIndex;
            let statut = client.options[choix].value;
            if (statut <= 0 || document.getElementById('salairecp').value === '') {
                return false;
            }
        }
        let client = document.getElementById("statutcp");
        let choix = client.selectedIndex;
        let statut = client.options[choix].value;
        if (statut<=0){
            return false;
        }
    }
    return true;
}
//Fonction de validation des champs input
function validation(){
    
    if(verificationMoral()==true && verificationPhysique()==true){
        
        return true;
    }

    return false;
}

function post(){
    if (validation()){
        
        //addClient();
    }
    else{
        alert('Merci de renseigner les champs actives');
        return false;
    }
}
