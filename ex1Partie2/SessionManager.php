<?php
class SessionManager {
    public function __construct() {
        session_start();
        if (!isset($_SESSION['visits'])) {
            $_SESSION['visits'] = 1;
            $_SESSION['message'] = "Bienvenue à notre plateforme.";
        } else {
            $_SESSION['visits']++;
            $_SESSION['message'] = "Merci pour votre fidélité, c'est votre {$_SESSION['visits']}ème visite.";
        }
    }

    public function getMessage() {
        return $_SESSION['message'];
    }

    public function reset() {
        session_destroy();
        header("Location: index.php");
    }
}
?>
