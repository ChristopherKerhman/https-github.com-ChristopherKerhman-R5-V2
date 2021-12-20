<?php
class FicheUser {
  private $idUser;
  private $nom;
  private $prenom;
  private $login;
  private $valide;
  private $role;

  public function __construct($dataUser) {
    $this->idUser = $dataUser[0]['idUser'];
    $this->nom = $dataUser[0]['nom'];
    $this->prenom = $dataUser[0]['prenom'];
    $this->login = $dataUser[0]['login'];
    $this->valide = $dataUser[0]['valide'];
    $this->role = $dataUser[0]['role'];
    $this->roles = $roles = ['Non valide', 'utilisateur', 'gestionnaire', 'administrateur'];
    $this->yes = $yes = ['Non', 'Oui'];
  }
  public function fiche() {
    echo '<ul>
    <li>Nom : '.$this->nom.'</li>
    <li>Prenom : '.$this->prenom.'</li>
    <li>Login : '.$this->login.'</li>
    <li>valide : '.$this->yes[$this->valide].'</li>
    <li>Role : '.$this->roles[$this->role].'</li>
    </ul>';
  }
  public function administrationFiche () {
    echo '<form action="CUD/Update/ficheUser.php" method="post">
            <label for="nom">Nom</label>
            <input id="nom" type="text" name="nom" value="'.$this->nom.'">
            <label for="prenom">Prenom</label>
            <input id="prenom" type="text" name="prenom" value="'.$this->prenom.'">
            <label for="login">Login</label>
            <input id="login" type="text" name="login" value="'.$this->login.'">
            <label for="valide">Compte valide ?</label>
            <select di="valide" name="valide">
              <option value="0">Non</option>
              <option value="1" selected>Oui</option>
            </select>
            <label for="role">Role ?</label>
            <select name="role">
                <option value="1">Utilisateur</option>
                <option value="2">Gestionnaire</option>
                <option value="3">Administrateur</option>
            </select>
          <input type="hidden" name="idUser" value="'.$this->idUser.'" />
          <button type="submit" name="button">Modifier fiche</button>
      </form>
      <form action="CUD/Delette/user.php" method="post">
            <input type="hidden" name="idUser" value="'.$this->idUser.'" />
            <button type="submit" name="button">Effacer</button>
        </form>';
  }
  public function modUserFiche () {
    echo '<form action="CUD/Update/ficheUser.php" method="post">
            <label for="nom">Nom</label>
            <input id="nom" type="text" name="nom" value="'.$this->nom.'">
            <label for="prenom">Prenom</label>
            <input id="prenom"  type="text" name="prenom" value="'.$this->prenom.'">
            <label for="login">Login</label>
            <input id="login"  type="text" name="login" value="'.$this->login.'">
            <input type="hidden" name="idUser" value="'.$this->idUser.'" />
            <button  type="submit" name="button">Modifier fiche</button>
      </form>';
  }
}
?>
