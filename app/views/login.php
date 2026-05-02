<?php
$setup = $data["setup"] ?? false;
$error = $_SESSION["login_error"] ?? "";
$success = $_SESSION["login_success"] ?? "";
unset($_SESSION["login_error"], $_SESSION["login_success"]);
$esc = fn($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $setup ? "Créer le premier admin" : "Connexion admin"; ?> - FlowStaff</title>
    <script>
        (function () {
            const savedTheme = localStorage.getItem("flowstaff-theme");
            if (savedTheme === "light" || savedTheme === "dark") {
                document.documentElement.setAttribute("data-theme", savedTheme);
            }
        })();
    </script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">
    <main class="auth-shell">
        <section class="auth-panel">
            <div class="auth-content">
                <div class="auth-brand">
                    <span class="brand__mark">F</span>
                    <strong>FlowStaff</strong>
                </div>

                <h1><?php echo $setup ? "Créer le premier admin" : "Connexion admin"; ?></h1>
                <p><?php echo $setup ? "Aucun admin n'existe encore. Créez le premier compte pour protéger l'application." : "Connectez-vous pour accéder à l'espace de gestion."; ?></p>

                <?php if ($error !== "") : ?>
                    <div class="auth-message auth-message--error"><?php echo $esc($error); ?></div>
                <?php endif; ?>

                <?php if ($success !== "") : ?>
                    <div class="auth-message auth-message--success"><?php echo $esc($success); ?></div>
                <?php endif; ?>

                <form action="?page=<?php echo $setup ? "setupPost" : "loginPost"; ?>" method="POST" class="input-group auth-form">
                    <?php if ($setup) : ?>
                        <div class="form-field">
                            <label>Nom</label>
                            <input type="text" name="nom" placeholder="Ex: Admin FlowStaff" required>
                        </div>
                    <?php endif; ?>

                    <div class="form-field">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="admin@email.com" required>
                    </div>

                    <div class="form-field">
                        <label>Mot de passe</label>
                        <input type="password" name="password" placeholder="Votre mot de passe" required>
                    </div>

                    <button class="btn btn-primary" type="submit">
                        <?php echo $setup ? "Créer l'admin" : "Se connecter"; ?>
                    </button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
