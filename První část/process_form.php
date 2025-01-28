<?php
$data = [
    'firstName' => $_POST['firstName'] ?? '',
    'lastName' => $_POST['lastName'] ?? '',
    'email' => $_POST['email'] ?? '',
    'dob' => $_POST['dob'] ?? '',
    'note' => $_POST['note'] ?? ''
];

$file = 'data.csv';
if (is_writable($file)) {
    file_put_contents($file, implode(',', $data) . PHP_EOL, FILE_APPEND);
} else {
    throw new Exception("Nemám oprávnění zapisovat do souboru $file");
}

// Redirect to index.php
header('Location: index.php');
exit;
function sendDiscordNotification($webhookUrl, $message) {
    $data = json_encode(['content' => $message]);

    $ch = curl_init($webhookUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        throw new Exception('cURL error: ' . curl_error($ch));
    }
    
    curl_close($ch);
    return $response;
}

// Usage example
try {
    $webhookUrl = 'YOUR_DISCORD_WEBHOOK_URL';
    $message = "Nová zpráva z formuláře: Jméno: {$data['firstName']} {$data['lastName']}, Email: {$data['email']}, Poznámka: {$data['note']}";
    sendDiscordNotification($webhookUrl, $message);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

function validateData($data) {
    $result = [];
    foreach ($data as $d) {
        $name = $d['name'];
        $surname = $d['surname'];
        $email = $d['email'];
        $result[] = [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'result' => isReal($name, $surname, $email) ? 'real' : 'unreal'
        ];
    }
    return $result;
}

function isReal($name, $surname, $email) {
    $domains = ['gmail.com', 'seznam.cz', 'email.cz'];
    $name = mb_strtolower($name, 'UTF-8');
    $surname = mb_strtolower($surname, 'UTF-8');
    $emailParts = explode('@', $email);
    if (count($emailParts) != 2) return false;
    if (!in_array($emailParts[1], $domains)) return false;
    if (preg_match('/^[a-z0-9\.\+\-]+$/i', $emailParts[0])) {
        $words = explode(' ', $name);
        foreach ($words as $word) {
            if (preg_match('/^[a-z]+$/i', $word)) {
                $words = explode(' ', $surname);
                foreach ($words as $word) {
                    if (preg_match('/^[a-z]+$/i', $word)) {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}