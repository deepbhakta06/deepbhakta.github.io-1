<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Google Sheet ID
    $sheetId = "your_sheet_id_here";
    
    // Google API Key
    $apiKey = "your_api_key_here";

    $data = [
        "values" => [
            [$firstname, $lastname, $email, $subject, $message]
        ]
    ];

    $options = [
        "http" => [
            "header" => "Authorization: Bearer " . $apiKey,
            "method" => "POST",
            "content" => json_encode($data)
        ]
    ];

    $context = stream_context_create($options);

    // URL to Google API
    $url = "https://sheets.googleapis.com/v4/spreadsheets/$sheetId/values/Sheet1:append?valueInputOption=RAW";
    
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        die("Error occurred");
    }
    
    echo "Form submitted and data saved in Google Sheet";
}
?>
