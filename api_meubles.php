<?php
require_once('config.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // CORS

$db2 = connectDB();
$req = "SELECT IDmeubl AS id, nom, prix, image FROM lamy.meubles";
$stmt = db2_prepare($db2, $req);
db2_execute($stmt);

$meubles = [];

while ($row = db2_fetch_assoc($stmt)) {
    $meubles[] = [
        'id'    => (int) $row['ID'],                      // Cast ID en entier
        'nom'   => trim($row['NOM']),                     // Trim pour enlever les espaces
        'prix'  => (float) $row['PRIX'],                  // Cast en float
        'image' => trim($row['IMAGE'])                    // Trim image
    ];
}

echo json_encode($meubles);
