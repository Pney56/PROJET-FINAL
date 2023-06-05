<?php

require_once 'config.php';
class ApiController {
    private function generateRandomString($length = 64) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public function redirectToApi() {
        
        // Génération du code_verifier et du code_challenge
        $code_verifier = $this->generateRandomString();
        $code_challenge = $code_verifier;       
        // Stockage du code_verifier dans la session
        $_SESSION['code_verifier'] = $code_verifier;
        // Construction de l'URL d'autorisation pour l'API de MyAnimeList
        $authorizeUrl = 'https://myanimelist.net/v1/oauth2/authorize' .
            '?response_type=code' .
            '&client_id=' . CLIENT_ID .
            '&state=' . 'YOUR_STATE' .
            '&redirect_uri=' . urlencode(REDIRECT_URI) .
            '&code_challenge=' . urlencode($code_challenge) .
            '&code_challenge_method=plain';            
        // Redirection vers l'URL d'autorisation
        header('Location: ' . $authorizeUrl);
        exit();
     //   echo($authorizeUrl);
    }
    public function handleApiCallback() {
        require_once 'config.php';
        // Initialisation de la session
        
        // Récupération du code d'autorisation OAuth2
        $code = $_GET['code'];
        // Récupération du code_verifier à partir de la session
        if (!isset($_SESSION['code_verifier'])) {
            echo "Erreur : code_verifier introuvable dans la session";
            exit();
        }
        $code_verifier = $_SESSION['code_verifier'];
        // Envoi d'une demande POST à l'API de MyAnimeList pour échanger le code d'autorisation contre un jeton d'accès OAuth2
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://myanimelist.net/v1/oauth2/token');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'client_id' => CLIENT_ID,
            'client_secret' => CLIENT_SECRET,
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => REDIRECT_URI,
            'code_verifier' => $code_verifier,
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Traitement de la réponse de l'API de MyAnimeList
        $tokenData = json_decode($response, true);
        if (isset($tokenData['access_token'])) {
            // Stockage du jeton d'accès OAuth2 et du jeton de rafraîchissement OAuth2 dans la session
            $_SESSION['access_token'] = $tokenData['access_token'];
            $_SESSION['refresh_token'] = $tokenData['refresh_token'];  
            // Redirection vers la page d'accueil "accueil.php"
            header('Location: accueil');
            exit();             
        } else {
            // Affichage d'un message d'erreur avec le contenu de la réponse en cas d'erreur
            echo "Erreur : " . $response;
        }
    }
    
}
