<?php

require __DIR__ . '/vendor/autoload.php';
$c = 0;
$client = new \Google_Client();
$client->setApplicationName('FantaSanta');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = "1YmQVkt-DzebpUg3hnlBKJyMntWuktsviLP11M6hZg1g";
//per poter estrarre da tabella: 
$range = "Classifica!B1:D201";
$response = $service->spreadsheets_values->get($spreadsheetId,$range);
$values = $response->getValues();
if(empty($values)){
    print "No data found.\n";
}else{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SantaNet</title>
        <link rel="stylesheet" href="style.css">
        <h1> Classifica complessiva dell'oratorio di Santa Teresina </h1>
    </head>
    <body>


        <table class="container">


    <?php
    //$mask =  %s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t 
    foreach($values as $row){
        $i = 0;
        if($c == 0){
            echo "<thead>
            <tr>
                <th>&nbsp$row[0]&nbsp</th>
                <th>&nbsp$row[1]&nbsp</th>
                <th>&nbsp$row[2]&nbsp</th>
            </tr>
            </thead><tbody>";
        }else{
            echo "<tr><td>$row[0]</td>
            <td>$row[1]  </td>
            <td>$row[2]  </td></tr>";
       
    }

    $c++;
}
}
?>
</tbody></table></div></body>
</html>

<?php
/*
//per poter scrivere su tabella: (modifica primi 2 nome e cognome)
/* 
$range2 = "Foglio1!A2:B2"

$range2 = "Foglio1!A2:B3";
$values2 = [
    ["Pietro", "Troisio"],
    ["Zio", "Pera"],
];
$body = new Google_Service_Sheets_ValueRange([
    'values' => $values2
]);
$params = [
    'valueInputOption' => 'RAW'
];
$result = $service->spreadsheets_values->update(
    $spreadsheetId,
    $range2,
    $body,
    $params
);

*/
?>
