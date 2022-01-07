<?php
require_once 'class/GuestBook.php';
require_once 'class/Message.php';
$guestBook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . "messages");

if (isset($_POST['username'])) {
    if (!empty($_POST['username'])) {
        if (isset($_POST['message']) && !empty($_POST['message'])) {

            $username = htmlspecialchars($_POST['username']);
            $message = htmlspecialchars($_POST['message']);
            $date = new DateTime();
            $message = new Message($username, $message, $date);
            if ($message->isValid()) {
                $guestBook->addMessage($message);
                $msg_success = "Votre message a bien été enregistré";
            } else {
                $msg_errors = $message->getErrors()[0];
            }
        } else {
            $msg_errors = "Vous devez entrer un message";
        }
    } else {
        $msg_errors = "Vous devez entrer un nom d'utilisateur";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Livre d'or</title>
</head>

<body>
    <div class="container">
        <br>
        <!-- <div class="alert alert-success">
            Merci pour votre message
        </div> -->
        <?php if (isset($msg_errors)) : ?>
            <div class="alert alert-danger">
                <?= $msg_errors ?>
            </div>
        <?php endif; ?>
        <h2>Livre d'or</h2>
        <form action="" method="post" class="form-group">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Votre pseudo</label>
                <input type="text" name="username" class="form-control" id="exampleFormControlInput1" placeholder="Votre pseudo">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <br>
        <h2>Vos messages:</h2>
        <br>
        <?php if ($guestBook->getMessage() != []) : ?>
            <?php foreach ($guestBook->getMessage() as $msg) : ?>
                <?= $msg->toHTML() ?>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</body>
<footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</footer>

</html>