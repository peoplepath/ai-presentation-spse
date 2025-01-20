<?php
session_start();
$firstName = $_POST['firstName'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$email = $_POST['email'] ?? '';
$dob = $_POST['dob'] ?? '';
$note = $_POST['note'] ?? '';

$data = [
    'firstName' => $firstName,
    'lastName' => $lastName,
    'email' => $email,
    'dob' => $dob,
    'note' => $note
];

// Použití funkce
try {
    $apiKey = "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"; // Sem vlož svůj API klíč
    $prompt = "Je pravda, že osoba jménem $firstName $lastName narozená $dob má e-mail $email a napsala následující poznámku: $note?";
    $response = callChatGPT($prompt, $apiKey);

} catch (Exception $e) {
    echo "Chyba: " . $e->getMessage();
    exit();
}

$fp = fopen('data.csv', 'a');
fputcsv($fp, array_merge($data, ['chatGPT' => $response]));
fclose($fp);

// Redirect to index.php with a query string parameter
header('Location: index.php?success=1');
exit;


function callChatGPT($prompt, $apiKey, $model = 'gpt-4o-mini-2024-07-18') {
    // Endpoint pro API OpenAI
    $url = 'https://api.openai.com/v1/chat/completions';

    // Data pro požadavek
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

    // Kontrola chyb
    if (curl_errno($ch)) {
        throw new Exception('cURL error: ' . curl_error($ch));
    }

    // Uzavření cURL
    curl_close($ch);

    // Zpracování odpovědi
    $decodedResponse = json_decode($response, true);

    // Zkontroluj, zda odpověď obsahuje výsledek
    if (isset($decodedResponse['choices'][0]['message']['content'])) {
        return $decodedResponse['choices'][0]['message']['content'];
    } else {
        throw new Exception('Unexpected API response: ' . $response);
    }
}
