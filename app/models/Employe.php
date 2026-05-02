<?php
class Employe extends Model {
  public $id;
  public $nom;
  public $poste;
  public $salaire;
  public $departement;
  public $email;
  public $sexe;

  public function getAllEmployee() {
    $requette = $this->db->prepare("SELECT * FROM tbl_employes");
    $requette -> execute([]);
    return $resultat = $requette -> fetchAll();
  }

  public function addEmployee($nom, $poste, $salaire, $departement, $email, $sexe) {
    $this->nom = $nom;
    $this->poste = $poste;
    $this->salaire = $salaire;
    $this->departement = $departement;
    $this->email = $email;
    $this->sexe = $sexe;

    $requette = $this->db -> prepare("INSERT INTO tbl_employes 
    (nom, poste, salaire, departement, email, sexe) VALUES (?, ?, ?, ?, ?, ?)");
    $requette -> execute([$this->nom, $this->poste, $this->salaire, $this->departement, $this->email, $this->sexe]);
  }

  public function updateEmployee($id, $nom, $poste, $salaire, $departement, $email, $sexe) {
    $this->id = $id;
    $this->nom = $nom;
    $this->poste = $poste;
    $this->salaire = $salaire;
    $this->departement = $departement;
    $this->email = $email;
    $this->sexe = $sexe;

    $requette = $this->db->prepare("UPDATE tbl_employes SET nom=?, poste=?, salaire=?, departement=?, email=?, sexe=?
    WHERE id=?");
    $requette->execute([$this->nom, $this->poste, $this->salaire, $this->departement, $this->email, $this->sexe, $this->id]);
  }

  public function getEmployeeById($id) {
    $requette = $this->db->prepare("SELECT * FROM tbl_employes WHERE id=?");
    $requette->execute([$id]);
    return $requette->fetch();
  }

  public function deleteEmployee($id) {
    $this->id = $id;

    $requette = $this->db->prepare("DELETE FROM tbl_employes WHERE id=?");
    $requette -> execute([$this->id]);
  }
  
}
