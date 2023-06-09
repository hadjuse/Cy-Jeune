<?php
print_r($_GET);
echo $_GET["q"];
global $s;
$s = (int)$_GET["q"];
function supprimer($id)
{
    $jsonData = file_get_contents('utilisateurs.json'); // Charger les données JSON depuis le fichier
    $data = json_decode($jsonData, true); // Décoder les données JSON en un tableau associatif

    $cle_utilisateur = $id; // Clé du compte à supprimer
    $index = -1; // Index du compte dans le tableau des données JSON

    foreach ($data['utilisateurs'] as $cle => $account) { // Parcourir chaque compte
        if ($account['indice'] === $cle_utilisateur) { // Vérifier si la clé correspond
            $index = $cle; // Stocker l'index du compte à supprimer
            break;
        }
    }

    if ($index !== -1) { // Si l'index du compte a été trouvé
        unset($data['utilisateurs'][$index]); // Supprimer le compte du tableau
        $data['utilisateurs'] = array_values($data['utilisateurs']); // Réorganiser les index du tableau
    }

    $jsonData = json_encode($data, JSON_PRETTY_PRINT); // Encoder les données au format JSON
    file_put_contents('utilisateurs.json', $jsonData); // Enregistrer les modifications dans le fichier

}
supprimer($s);
?>

