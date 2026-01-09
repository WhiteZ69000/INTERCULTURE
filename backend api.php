<?php
// api_intercultura.php
// Este ficheiro conecta à Base de Dados e devolve JSON para o HTML

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Permite pedidos locais durante desenvolvimento

// Configurações da Base de Dados (Ajuste conforme o seu servidor local/XAMPP)
$host = 'localhost';
$db   = 'religioes_mundo_db';
$user = 'root';      // Utilizador padrão do XAMPP/WAMP
$pass = '';          // Senha padrão geralmente é vazia
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // 1. Buscar as Religiões principais
    // Usamos 'AS' para renomear as colunas do SQL para os nomes que o Javascript já usa (ex: people_img_url -> peopleImg)
    $stmt = $pdo->query("
        SELECT 
            id, 
            name, 
            icon, 
            followers, 
            people_img_url as peopleImg, 
            food_img_url as foodImg, 
            description, 
            details, 
            origin, 
            holy_book as holyBook, 
            philosophy 
        FROM religions
    ");
    $religioes = $stmt->fetchAll();

    // 2. Buscar as Tags para cada religião
    foreach ($religioes as &$religiao) {
        $stmtTags = $pdo->prepare("SELECT tag_name FROM religion_tags WHERE religion_id = ?");
        $stmtTags->execute([$religiao['id']]);
        // Transforma o resultado num array simples: ["Tag1", "Tag2"]
        $religiao['tags'] = $stmtTags->fetchAll(PDO::FETCH_COLUMN);
    }

    // 3. Devolver tudo como JSON
    echo json_encode($religioes);

} catch (\PDOException $e) {
    // Em caso de erro, devolve JSON com a mensagem
    echo json_encode(['error' => true, 'message' => $e->getMessage()]);
}
?>