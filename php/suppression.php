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
function supprimer_referent($kdUtilisateur, $kdReferent){
    $jsonData = file_get_contents('utilisateurs.json'); // Charger les données JSON depuis le fichier
    $data = json_decode($jsonData, true); // Décoder les données JSON en un tableau associatif

    $kdUtilisateur = (int) $kdUtilisateur; // Convertir l'indice de l'utilisateur en entier

    foreach ($data['utilisateurs'] as &$utilisateur) { // Parcourir chaque utilisateur
        if ($utilisateur['indice'] === $kdUtilisateur) {
            $referents = &$utilisateur['referent']; // Référence au tableau des référents de l'utilisateur

            foreach ($referents as $kndex => $referent) {
                if ($referent['indice'] === $kdReferent) {
                    unset($referents[$kndex]); // Supprimer le référent du tableau
                    //echo $referent['nom'];
                    break;
                }
            }

            $referents = array_values($referents); // Réorganiser les indices du tableau des référents
            break;
        }
    }

    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('utilisateurs.json', $jsonData);
}

function supprimer($kd)
{
    $jsonData = file_get_contents('utilisateurs.json'); // Charger les données JSON depuis le fichier
    $data = json_decode($jsonData, true); // Décoder les données JSON en un tableau associatif

    $cle_utilisateur = $kd; // Clé du compte à supprimer
    $kndex = -1; // Index du compte dans le tableau des données JSON

    foreach ($data['utilisateurs'] as $cle => $account) { // Parcourir chaque compte
        if ($account['indice'] === $cle_utilisateur) { // Vérifier si la clé correspond
            $kndex = $cle; // Stocker l'index du compte à supprimer
            break;
        }
    }

    if ($kndex !== -1) { // Si l'index du compte a été trouvé
        unset($data['utilisateurs'][$kndex]); // Supprimer le compte du tableau
        $data['utilisateurs'] = array_values($data['utilisateurs']); // Réorganiser les index du tableau
    }

    $jsonData = json_encode($data, JSON_PRETTY_PRINT); // Encoder les données au format JSON
    file_put_contents('utilisateurs.json', $jsonData); // Enregistrer les modifications dans le fichier
    while($data['utilisateurs'][$index] !=NULL){
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
