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





// test pop-up 

var mangaCards = document.getElementsByClassName('manga-card');

for (var i = 0; i < mangaCards.length; i++) {
    mangaCards[i].addEventListener('mouseenter', function(e) {
        var mangaPopup = this.querySelector('.manga-popup');
        mangaPopup.innerHTML = e.target.innerHTML;
        mangaPopup.style.display = 'block';

        var desiredLeft = e.target.getBoundingClientRect().right;
        var desiredTop = e.target.getBoundingClientRect().top;

        var overflowRight = desiredLeft + mangaPopup.offsetWidth - window.innerWidth;
        if (overflowRight > 0) {
            desiredLeft -= overflowRight;
        }

        mangaPopup.style.left = desiredLeft + 'px';
        mangaPopup.style.top = desiredTop + 'px';
    });

    mangaCards[i].addEventListener('mouseleave', function() {
        var mangaPopup = this.querySelector('.manga-popup');
        mangaPopup.style.display = 'none';
    });
}
