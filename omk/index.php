<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Omeka S Items Display</title>
</head>
<body>
    <h1>Articles de la collection Omeka S</h1>
    <?php
    // URL de l'API Omeka S
    $api_url = "http://localhost/omeka-s/api/items";
    
    // Utiliser file_get_contents pour obtenir les données de l'API
    $json_data = file_get_contents($api_url);
    
    // Décoder le JSON en PHP
    $items = json_decode($json_data, true);
    
    // Vérifier si des éléments ont été récupérés
    if(!empty($items)) {
        // Boucle à travers chaque élément
        foreach($items as $item) {
            echo "<div>";
            echo "<h2>" . htmlspecialchars($item['o:title']) . "</h2>";
            echo "<p>" . nl2br(htmlspecialchars($item['dcterms:description'][0]['@value'])) . "</p>";
            // Afficher l'image si disponible
            if(isset($item['thumbnail_display_urls'])) {
                echo "<img src='" . htmlspecialchars($item['thumbnail_display_urls']['medium']) . "' alt='" . htmlspecialchars($item['o:title']) . "'>";
            }
            echo "</div>";
        }
    } else {
        echo "<p>Aucun élément trouvé.</p>";
    }
    ?>
</body>
</html>
