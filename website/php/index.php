<?php

// require_once 'app/init.php';

// $pollsQuery = $db->query("
//     SELECT id, question
//     FROM polls
// ");

// while ($row = $pollsQuery->fetchObject()) {
//     $polls[] = $row;
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des questions</title>

    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <form name='registration' action='process.php' method='POST'>
    <label for 'Nom'>Nom: </label>
    <input type="text" name="Nom" />

    <label for 'Prenom'>Prenom: </label>
    <input type="text" name="Prenom" />

    <label for 'Email'>Email: </label>
    <input type="number" name="Email" />

    <button type="submit">Submit</button>
    </form>
</body>

</html>
