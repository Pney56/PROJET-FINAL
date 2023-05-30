
// Récupération des éléments HTML dont nous avons besoin
const signInForm = document.querySelector(".sign-in");
const signUpForm = document.querySelector("#signup-form");
const signUpBtn = document.querySelector("#signup-btn");
const termsCheckbox = document.querySelector("#accept-terms");

// Éléments pour l'affichage et la fermeture du bloc de connexion
const loginBtn = document.querySelector("#login-btn");
const closeLoginBtn = document.querySelector("#close-login-btn");
const loginContainer = document.querySelector("#login-container");

// Au chargement de la page, on cache le formulaire d'inscription
signUpForm.style.display = "none";

// Lorsque l'utilisateur clique sur le lien "Pas de compte ? Inscris-toi !"
signUpBtn.addEventListener("click", () => {
  // On cache le formulaire de connexion
  signInForm.style.display = "none";
  // On affiche le formulaire d'inscription
  signUpForm.style.display = "block";
});

const backToLoginLink = document.querySelector("#back-to-login-link");

backToLoginLink.addEventListener("click", () => {
  signUpForm.style.display = "none";
  signInForm.style.display = "block";
});

signUpForm.addEventListener("submit", (event) => {
  if (!termsCheckbox.checked) {
    event.preventDefault(); // Empêche le formulaire d'être soumis
    alert("Vous devez accepter les conditions d'utilisation pour vous inscrire.");
  }
});

// Affiche le bloc de connexion lorsque l'utilisateur clique sur le bouton de connexion
loginBtn.addEventListener("click", () => {
  loginContainer.style.display = "flex";
});

// Cache le bloc de connexion lorsque l'utilisateur clique sur le bouton de fermeture
closeLoginBtn.addEventListener("click", () => {
  loginContainer.style.display = "none";
});






// ---------------------------------------------Bouton retour page précédente selon l'histoirique ---------
function goBack() {
  window.history.back();
}
// --------------------------------------------------------------------------------------------------------





// GESTION MISE EN AVANT ADMINISTRATEUR 



// -----------------------------------------------------------------------------