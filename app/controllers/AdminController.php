<?php
class AdminController extends Controller {
    public function displayLogin() {
        $this->view("login");
    }

    public function login() {
        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";

        $adminModel = new Admin();
        $admin = $adminModel->getAdminByEmail($email);

        if ($admin && password_verify($password, $admin["password"])) {
            $_SESSION["admin"] = [
                "id" => $admin["id"],
                "nom" => $admin["nom"],
                "email" => $admin["email"]
            ];

            $this->redirect("dashboard");
        }

        $_SESSION["login_error"] = "Email ou mot de passe incorrect.";
        $this->redirect("login");
    }

    public function logout() {
        session_unset();
        session_destroy();

        $this->redirect("login");
    }

    public function displaySetup() {
        $adminModel = new Admin();

        if ($adminModel->countAdmins() > 0) {
            $this->redirect("login");
        }

        $this->view("login", ["setup" => true]);
    }

    public function createFirstAdmin() {
        $adminModel = new Admin();

        if ($adminModel->countAdmins() > 0) {
            $this->redirect("login");
        }

        $nom = $_POST["nom"] ?? "";
        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";

        if ($nom === "" || $email === "" || $password === "") {
            $_SESSION["login_error"] = "Veuillez remplir tous les champs.";
            $this->redirect("setup");
        }

        $adminModel->addAdmin($nom, $email, $password);

        $_SESSION["login_success"] = "Premier admin créé. Vous pouvez vous connecter.";
        $this->redirect("login");
    }
}
