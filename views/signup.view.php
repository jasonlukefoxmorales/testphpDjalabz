<?php

// Comme on envoit/modifie des en-tetes successivement (avec les include et le header(location) plus bas)
// On crée à partir de cette ligne une zone tampon qui se termine après notre redirection 
// Cela permet d'envoyer en une seule pièce le code ci-dessous
ob_start();

include "../partials/header.php";
include "../config/db_config.php";
include "../utils/functions.php";

// On vérifie que le form ait été soumis
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm'])) {

        $name = htmlspecialchars($_POST['name']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];

        if ($password === $confirm) {

            // On vérifie le format de l'email 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Le format de l'email n'est pas bon";
                die();
            }

            // Validation, selon les critères de la CNIL, du format du mot de passe

            $regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{12,}$/";
            $passValid = preg_match($regex, $password);

            if ($passValid) {
                // On vérifie que le mdp correspone aux critères de la CNIL (12 car, au moins 1 chiffre, 1 Maj, 1 min et 1 caractère spécial)
                // Fonction pour vérifier une regex sur une string preg_match()

                // Avant d'envoyer le mdp en bdd il faut le hasher !
                $hash = password_hash($password, PASSWORD_DEFAULT);

                // Avec checkExists (importée depuis functions.php) on vérifie si le name ou email 
                // n'existe pas déjà en BDD
                if (checkExists('name', $name, $pdo)) {
                    $error = "Le nom est déjà pris";
                } else if (checkExists('email', $email, $pdo)) {
                    $error = "L'email est déjà pris";
                } else {
                    // Écrire une requete préparée avec pdo
                    $sql = "INSERT INTO signup(name, email, password) VALUES(?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $result = $stmt->execute([$name, $email, $hash]);

                    // Afficher les erreurs si il y en a, sinon un message de succès 
                    if ($result) {
                        // On redirige vers une page de succès 
                        header('Location: signup-succes.view.php');
                        // On termine notre zone tampon
                        ob_end_flush();
                    } else {
                        $error = "Erreur pendant l'ajout : " . $stmt->errorInfo();
                    }
                }
            } else {
                $error = "Le format du mot de passe n'est pas le bon. Il doit faire 12 caractères au minimum et inclure une minuscule, une majuscule, un chiffre et un des caractères spéciaux suivants : #?!@$ %^&*-";
            }

        } else {
            $error = "Les mots de passe doivent etre identiques";
        }
    } else {
        $error = "Veuillez remplir tous les champs";
    }
}
?>

?>


<h1>SIGNUP</h1>
<section>
    <form class="signup-form" method="POST">
        <label for="nom">Nom</label>
        <input type="text" name="name" placeholder="Votre pseudo ici ...">

        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Votre email ici ...">

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Votre mot de passe ici ...">

        <input type="password" name="confirm" placeholder="Votre confirmation du mot de passe...">

        <input class="submit" type="submit" name="submit" value="signup">
    </form>
</section>



<?php if (isset($error)): ?>
    <p class="error">
        <?= $error ?>
    </p>
<?php endif ?>

<?php

include "../partials/footer.php";

?>