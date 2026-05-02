<?php
session_start();

include "../core/Controller.php";
include "../core/Model.php";
include "../app/controllers/EmployeController.php";
include "../app/controllers/AdminController.php";
include "../app/models/Employe.php";
include "../app/models/Admin.php";

$page = $_POST['page'] ?? $_GET['page'] ?? 'dashboard';

$adminModel = new Admin();
$hasAdmin = $adminModel->countAdmins() > 0;
$pagesPubliques = ['login', 'loginPost', 'setup', 'setupPost'];

if (!$hasAdmin && !in_array($page, ['setup', 'setupPost'], true)) {
    header("Location: ?page=setup");
    exit();
}

if ($hasAdmin && !isset($_SESSION['admin']) && !in_array($page, $pagesPubliques, true)) {
    header("Location: ?page=login");
    exit();
}

$employe = new EmployeController();
$admin = new AdminController();

if($page == "login"){
    $admin->displayLogin();
} elseif($page == "loginPost"){
    $admin->login();
} elseif($page == "setup"){
    $admin->displaySetup();
} elseif($page == "setupPost"){
    $admin->createFirstAdmin();
} elseif($page == "logout"){
    $admin->logout();
} elseif($page == "insererEmploye"){
    $employe->displayAddEmploye();
} elseif($page == "liste"){
    $employe->displayEmploye();
} elseif($page == "insert"){
    $employe->insertEmploye();
} elseif($page == "edit"){
    $employe->displayEditEmploye();
} elseif($page == "update"){
    $employe->updateEmploye();
} elseif($page == "delete"){
    $employe->deleteEmploye();
} elseif($page == "dashboard"){
    $employe->displayDashboard();
} else {
    $employe->displayDashboard();
}
