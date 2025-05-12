<?php
// Inclusion du fichier de configuration
require_once('config.php');

// Établir la connexion
$db2 = connectDB();

// Requête SQL
$req = "SELECT IDmeubl, nom, prix, image FROM lamy.meubles";

// Préparation de la requête
$stmt = db2_prepare($db2, $req);

// Exécution de la requête
$success = db2_execute($stmt);

// Tableau pour stocker les résultats
$meubles = [];

// Récupération des données
while ($result = db2_fetch_assoc($stmt)) {
    $meubles[] = $result;
}

// Debuggage - Afficher le contenu d'un enregistrement pour vérifier
// Décommentez cette ligne pour voir les données retournées
// var_dump($meubles[0]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Meubles</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; }
        .meubles-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); 
            gap: 20px; 
        }
        .meuble-item { 
            border: 1px solid #ddd; 
            padding: 15px; 
            text-align: center; 
            transition: transform 0.3s ease;
        }
        .meuble-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .meuble-image { 
            max-width: 100%; 
            height: 250px; 
            object-fit: cover; 
        }
        .meuble-details {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Notre Collection de Meubles</h1>
    
    <!-- Décommentez cette ligne pour déboguer les chemins d'images -->
    <!-- <div>Exemple de chemin d'image: <?php echo "http://178.255.128.61:2512/Franck_L/Testmeubles/image/" . ($meubles[0]['IMAGE'] ?? ''); ?></div> -->
    
    <div class="meubles-grid">
        <?php foreach ($meubles as $meuble): 
            // Vérifier si la clé 'IMAGE' existe et n'est pas vide
            $imageFilename = !empty($meuble['IMAGE']) ? $meuble['IMAGE'] : 
                         (!empty($meuble['image']) ? $meuble['image'] : '');
            
            // Chemin de l'image
            $cheminImage = "http://178.255.128.61:2512/Franck_L/Testmeubles/image/" . $imageFilename;
        ?>
            <div class="meuble-item">
                <img src="<?= htmlspecialchars($cheminImage) ?>" 
                     alt="<?= htmlspecialchars($meuble['NOM'] ?? $meuble['nom'] ?? 'Meuble') ?>" 
                     class="meuble-image"
                     onerror="this.onerror=null; this.src='placeholder.jpg'; this.alt='Image non disponible';">
                
                <div class="meuble-details">
                    <h3><?= htmlspecialchars($meuble['NOM'] ?? $meuble['nom'] ?? 'Meuble') ?></h3>
                    <p>Prix : <?= number_format($meuble['PRIX'] ?? $meuble['prix'] ?? 0, 2) ?> €</p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>