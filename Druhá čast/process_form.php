<?php

// Otevření souboru a zápis údajů do něj
$file = 'data.csv';
if (!file_exists($file)) {
    // Pokud soubor neexistuje, vytvořím ho a nastavím hlavičku
    $fp = fopen($file, 'w');
    fputcsv($fp, ['jméno', 'příjmení', 'email', 'telefon', 'dotaz']);
    fclose($fp);
}

// Otevření souboru a zápis údajů do něj
$fp = fopen($file, 'a');
fputcsv($fp, [
    $_POST['firstName'],
    $_POST['lastName'],
    $_POST['email'],
    $_POST['phone'],
    $_POST['question']
]);
fclose($fp);

// Odeslání notifikace do Discordu
$webhookUrl = 'https://discordapp.com/api/webhooks/...';
$message = "Nová zpráva z formuláře: Jméno: {$_POST['firstName']} {$_POST['lastName']}, Email: {$_POST['email']}, Telefon: {$_POST['phone']}, Dotaz: {$_POST['question']}";

// Volání funkce pro odeslání notifikace
sendDiscordNotification($webhookUrl, $message);

// Přesměrování na index.php s parametrem success=1
header('Location: index.php?success=1');
exit;

// Funkce pro odeslání notifikace do Discordu
function sendDiscordNotification($webhookUrl, $message) {
    // Nastavení dat pro odeslání
    $data = array(
        'content' => $message
    );
    // Nastavení hlavičky a obsahu požadavku
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($data)
        )
    );
    // Vytvoření kontextu pro odeslání
    $context = stream_context_create($options);
    // Odeslání notifikace
    $result = file_get_contents($webhookUrl, false, $context);
    // Pokud se nepodařilo odeslat notifikaci, vrácení chyby
    if ($result === false) {
        throw new Exception('Error sending notification');
    }
}

// Funkce pro volání ChatGPT API
function callChatGPT($prompt, $apiKey, $model = 'gpt-4') {
    // Nastavení URL a dat pro odeslání
    $url = 'https://api.openai.com/v1/chat/completions';
    $data = [
        'model' => $model,
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
            ['role' => 'user', 'content' => $prompt]
        ],
        'max_tokens' => 1000,
        'temperature' => 0.7
    ];

    // Inicializace cURL
    $ch = curl_init($url);
    // Nastavení cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Odeslání požadavku
    $response = curl_exec($ch);

    // Pokud se nepodařilo odeslat požadavek, vrácení chyby
    if (curl_errno($ch)) {
        throw new Exception('cURL error: ' . curl_error($ch));
    }

    // Uzavření cURL
    curl_close($ch);

    // Zpracování odpovědi
    $decodedResponse = json_decode($response, true);

    // Pokud odpověď obsahuje výsledky, vrácení nich
    if (isset($decodedResponse['choices'][0]['message']['content'])) {
        return $decodedResponse['choices'][0]['message']['content'];
    } else {
        // Pokud odpověď neobsahuje výsledky, vrácení chyby
        throw new Exception('Unexpected API response: ' . $response);
    }
}