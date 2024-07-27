<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = strip_tags(trim($_POST["nom"]));
    $prenom = strip_tags(trim($_POST["prenom"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    if (empty($nom) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Veuillez remplir le formulaire et réessayer.";
        exit;
    }

    $recipient = "assiaghelis@yahoo.fr";
    $subject = "Nouveau message de $nom $prenom";
    $email_content = "Nom: $nom\n";
    $email_content .= "Prénom: $prenom\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $headers = "From: $nom <$email>";

    if (mail($recipient, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo "Merci ! Votre message a été envoyé.";
    } else {
        http_response_code(500);
        echo "Oops! Une erreur s'est produite et nous n'avons pas pu envoyer votre message.";
    }
} else {
    http_response_code(403);
    echo "Il y a eu un problème avec votre soumission, veuillez réessayer.";
}
?>