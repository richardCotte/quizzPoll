<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if (!empty($polls)) : ?>
        <ul>
            <?php foreach ($polls as $poll) : ?>
                <li><a href="poll.php?poll=<?php echo $poll->id; ?>"><?php echo $poll->question; ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Désolé, pas de questions disponibles pour le moment</p>
    <?php endif; ?>


    <button onclick="window.location.href='https://calendly.com/d/ddn2-zzpj/ipi-lyon-rdv-conseil'">Nous Contacter</button>
</body>

</html>