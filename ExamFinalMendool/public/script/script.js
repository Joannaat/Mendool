window.addEventListener('DOMContentLoaded', () => {

/******************** Ici j'active mon menu avec mon burger en mobile first *****************/
    
    const burger = document.querySelector('#burger');
    const navLinks = document.querySelector('.nav-links');

    burger.addEventListener('click',()=>{
        navLinks.classList.toggle('mobile_menu')
      });
      
/******************* Ici je fais une fonction pour que mon mdp est un nombre de caracteres suffisant pr la securité***************/
    
    const inscriptionForm = document.getElementById('inscription_form');
    //ici je crée une fonction et je mets ds une var le bouton de connexion et je crée un p dans mon html
    function checkPasswordLength(passwordField) {
        const btnConnexion = document.querySelector(".connexion-btn");
        const elementP = document.createElement('p');
        
        //ici je cree le contenu de mon <p>
        elementP.textContent = "Le mot de passe doit contenir au moins 8 caractères";
        elementP.style.color = "red";
        elementP.style.textAlign= "center"
        elementP .style.display = "none";
        //Ici j'ajoute mon élément <p> juste après le champ de saisie de mdp avec la methode insert.before
        //passwordField.nextSibling sert à insérer le <p> juste après le champ de saisie du mdp
        passwordField.parentNode.insertBefore(elementP , passwordField.nextSibling);
        //Ici j'ecoute l'evenement à la pression sur les touche sur le champs de saisi du mdp
        passwordField.addEventListener('keypress', function(event) {
            //si la valeur entrée ds le champs et <8 caracteres je desactive le bouton de connexion et je montre mon <p>
            if(event.target.value.length<8){
                btnConnexion.disabled = true
                elementP.style.display = "block";
            //sinon je laise mon bouton actif et je desactive la visibiilté du <p>
            }else{
               btnConnexion.disabled = false
               elementP.style.display = "none";
            }
        });
    }
    
    //Iici je verifie que mon form existe bien ds mon html
    if (inscriptionForm) {
        //s'il existe on appelle la fonction checkPasswordLength qui verifie la longueur du mdp
        checkPasswordLength(inscriptionForm.password)
        //ici j'ecoute champ de saisie d'e-mail 
        inscriptionForm.emailInput.addEventListener('keyup', function(event) {
            //ici si l'email est valide on le colorie en vert 
             if(ValidateEmail(event.target.value)) {
                 event.target.style.color = 'green'
            //s'il est invalide on le colorie en rouge
             }else{
                 event.target.style.color = 'red'
             }
        });
        
/******************** Ici je verifie que les adresses mails soient les memes à la soumission du form*****************/
       
        const emailInput = document.querySelector('#emailInput');
        const emailConfirmation = document.querySelector('#emailConfirmation');
          
        // ici j'ajoute un gestionnaire d'événements pour la soumission du formulaire
        inscriptionForm.addEventListener('submit', (event) => {
        // ici j'empêche la soumission du form par défaut
        event.preventDefault();
            
          if (emailInput.value !== emailConfirmation.value) {
            alert("Les adresses e-mail ne correspondent pas.");
            // ici j'efface les champs d'adresse e-mail
            emailInput.value = '';
            emailConfirmation.value = '';
            // ici je met le focus sur le champ emailInput
            emailInput.focus();
             }else{
            // les adresses sont les mêmes je peux donc soumettre le form
            event.target.submit();
             }
        });
    }
/*************************Ici je verifie mon champs email pour voir si on tape vrmt une adressse mail avec un regex**********/
    
   function ValidateEmail(mail) {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){
        return true
      }else{
        return false
        }
    };
    
});
