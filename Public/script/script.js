// Récupération des éléments HTML dont nous avons besoin
const signInForm = document.querySelector(".sign-in");
const signUpForm = document.querySelector(".sign-up"); 
const signUpBtn = document.querySelector("#signup-btn");
const termsCheckbox = document.querySelector("#accept-terms");

// Éléments pour l'affichage et la fermeture du bloc de connexion
const loginBtn = document.querySelector("#login-btn");
const closeLoginBtn = document.querySelector("#close-login-btn");
const loginContainer = document.querySelector("#login-container");

// Au chargement de la page, on cache le formulaire d'inscription si existant
if (signUpForm) {
    signUpForm.style.display = "none";
}

// Lorsque l'utilisateur clique sur le lien "Pas de compte ? Inscris-toi !"
if (signUpBtn) {
    signUpBtn.addEventListener("click", () => {
        // On cache le formulaire de connexion
        if (signInForm) {
            signInForm.style.display = "none";
        }
        // On affiche le formulaire d'inscription
        if (signUpForm) {
            signUpForm.style.display = "block";
        }
    });
}

const backToLoginLink = document.querySelector("#back-to-login-link");

if (backToLoginLink) {
    backToLoginLink.addEventListener("click", () => {
        if (signUpForm) {
            signUpForm.style.display = "none";
        }
        if (signInForm) {
            signInForm.style.display = "block";
        }
    });
}

if (signUpForm && termsCheckbox) {
    signUpForm.addEventListener("submit", (event) => {
        if (!termsCheckbox.checked) {
            event.preventDefault(); // Empêche le formulaire d'être soumis
            alert("Vous devez accepter les conditions d'utilisation pour vous inscrire.");
        }
    });
}

// Affiche le bloc de connexion lorsque l'utilisateur clique sur le bouton de connexion
if (loginBtn) {
    loginBtn.addEventListener("click", () => {
        if (loginContainer) {
            loginContainer.style.display = "flex";
        }
    });
}

// Cache le bloc de connexion lorsque l'utilisateur clique sur le bouton de fermeture
if (closeLoginBtn) {
    closeLoginBtn.addEventListener("click", () => {
        if (loginContainer) {
            loginContainer.style.display = "none";
        }
    });
}



// ---------------------------------------------Bouton retour page précédente selon l'histoirique ---------
function goBack() {
  window.history.back();
}
// --------------------------------------------------------------------------------------------------------



