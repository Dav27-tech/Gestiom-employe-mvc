<?php
class Admin extends Model {
  public $id;
  public $nom;
  public $email;
  public $password;

  public function addAdmin($nom, $email, $password) {
    $options = [
      'cost' => 12
    ];

    $this->nom = $nom;
    $this->email = $email;
    $this->password = password_hash($password, PASSWORD_BCRYPT, $options);

    $requette = $this->db -> prepare("INSERT INTO tbl_admins
    (nom, email, password) VALUES (?, ?, ?)");
    $requette -> execute([$this->nom, $this->email, $this->password]);
  }

  public function getAdminByEmail($email) {
    $requette = $this->db->prepare("SELECT * FROM tbl_admins WHERE email=?");
    $requette->execute([$email]);
    return $requette->fetch();
  }

  public function countAdmins() {
    $requette = $this->db->prepare("SELECT COUNT(*) FROM tbl_admins");
    $requette->execute();
    return (int) $requette->fetchColumn();
  }

}
