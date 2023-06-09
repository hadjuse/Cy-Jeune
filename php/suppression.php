<?php
//print_r($_GET);
//cette partie permet de renvoyer à la console javascript les réponses du script afin de vérifier si tout fonctionne
echo $_GET["q"];
echo $_GET["f"];
echo $_GET["u"];
//---------------

$s = (int)$_GET["q"]; // indice de l'utilisateur quand il faut supprimer simplement l'utilisateur

$u = (int)$_GET["u"]; // indice de l'utilisateur quand il faut supprimer le referent
$f = $_GET['f']; // indice du referent
function supprimer_referent($idUtilisateur, $idReferent) {
    $jsonData = file_get_contents('utilisateurs.json'); // Charger les données JSON depuis le fichier
    $data = json_decode($jsonData, true); // Décoder les données JSON en un tableau associatif

    $idUtilisateur = (int) $idUtilisateur; // Convertir l'indice de l'utilisateur en entier

    foreach ($data['utilisateurs'] as &$utilisateur) { // Parcourir chaque utilisateur
        if ($utilisateur['indice'] === $idUtilisateur) {
            $referents = &$utilisateur['referent']; // Référence au tableau des référents de l'utilisateur

            $referentsCount = count($referents);
            for ($i = 0; $i < $referentsCount; $i++) {
                if ($referents[$i]['indice'] == $idReferent) {
                    unset($referents[$i]); // Supprimer le référent du tableau
                    $referents = array_values($referents); // Réorganiser les indices du tableau des référents
                    $utilisateur['referent'] = $referents; // Mettre à jour le tableau des référents de l'utilisateur
                    break;
                }
            }
            
            break;
        }
    }

    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('utilisateurs.json', $jsonData);
}





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
    while($data['utilisateurs'][$index] !=NULL){// réorganise les indices afin d'évitez les beugues.
        $data['utilisateurs'][$index]['indice']-=1;
        $index++;
    }

}
if(isset($s)){
    supprimer($s);
}
if(isset($u) && isset($f)){
    supprimer_referent($u, $f);
}
?>
