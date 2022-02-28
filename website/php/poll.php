<?php

require_once 'app/init.php';

if (!isset($_GET['poll'])) {

    header('Location: index.php');
} else {

    $id = (int)$_GET['poll'];

    // Get general poll information
    $pollQuery = $db->prepare("
        SELECT id, question
        FROM polls
        WHERE id = :poll
    ");

    $pollQuery->execute([
        'poll' => $id
    ]);

    $poll = $pollQuery->fetchObject();

    // Get the user answer for this poll
    $answerQuery = $db->prepare("
        SELECT polls_choices.id AS choice_id, polls_choices.name AS choice_name
        FROM polls_answers
        JOIN polls_choices
        ON polls_answers.choice = polls_choices.id
        WHERE polls_answers.user = :user
        AND polls_answers.poll = :poll
    ");

    $answerQuery->execute([
        'user' => $_SESSION['user_id'],
        'poll' => $id
    ]);

    //Has the user completed the poll ?
    $completed = $answerQuery->rowCount() ? true : false;

    if($completed) {
        // Get all answers
    } else {
        // Get poll choices
        $choicesQuery = $db->prepare("
            SELECT polls.id, polls_choices.id AS choice_id, polls_choices.name
            FROM polls
            JOIN polls_choices
            ON polls.id = polls_choices.poll
            WHERE polls.id = :poll
        ");

        $choicesQuery->execute([
            'poll' => $id
        ]);

        //Extract choices
        while($row = $choicesQuery->fetchObject()) {
            $choices[] = $row;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions list</title>

    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <?php if (!$poll) : ?>
        <p>Cette question n'existe pas</p>
    <?php else : ?>
        <div class="poll">
            <div class="poll-question">
                <?php echo $poll->question; ?>
            </div>

            <?php if($completed): ?>
                <P>Tu a déjà répondu à cette question, merci.</P>
            <?php else: ?>
                <?php if(!empty($choices)): ?>
                <form action="vote.php" method="post">
                    <div class="poll-options">

                        <?php foreach($choices as $index => $choice): ?>
                            <div class="poll-option">
                                <input type="radio" name="choice" value="<?php echo $choice->choice_id ?>" id="c<?php echo $index; ?>">
                                <label for="c<?php echo $index; ?>"><?php echo $choice->name; ?></label>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <input type="submit" value="Envoyer la réponse">
                    <input type="hidden" name="poll" value="<?php echo $id; ?>">
                </form>
                <?php else: ?>
                    <p>Il n'y a pas de choix pour l'instant.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>

    <?php endif; ?>
</body>

</html>