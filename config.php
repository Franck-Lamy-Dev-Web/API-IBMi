<?php
// Paramètres de connexion à la base de données
$database = "*LOCAL"; 
$user = "CCHASSANG";  
$password = "ASUS25";
$options = array();

// Fonction pour établir une connexion à la base de données
function connectDB() {
    global $database, $user, $password, $options;
    
    // Connexion à la base de données DB2
    $db2 = db2_connect($database, $user, $password, $options);
    
    // Vérification de la connexion
    if (!$db2) {
        die("Erreur de connexion à la base de données : (Config) " . db2_conn_errormsg());
        echo'Erreur de connexion';
    }
    
    return $db2;
}
?>

