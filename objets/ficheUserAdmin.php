<?php
class FicheUserAdmin extends FicheUser {

  public function modUserFicheAdmin($idNav) {
    echo '<form class="flex-colonne" action="CUD/Update/ficheUser.php" method="post">
            <label for="nom">Nom</label>
            <input id="nom" type="text" name="nom" value="'.$this->nom.'">
            <label for="prenom">Prenom</label>
            <input id="prenom"  type="text" name="prenom" value="'.$this->prenom.'">
            <label for="login">Login</label>
            <input id="login"  type="text" name="login" value="'.$this->login.'">
            <label for="univers">Univers</label>
            <input id="univers" type="text" name="universLibre" value="'.$this->universLibre.'">
            <label for="valide">Valide</label>
            <select id="valide" name="valide">
            <option value="0">Non</option>
            <option value="1" selected>Oui</option>
            </select>
            <label for="role">Rôle</label>
            <select id="role" name="role">';
              for ($i=0; $i < count($this->roles) ; $i++) {
                if ($i == $this->role) {
                  echo '<option value="'.$i.'" selected>
                  '.$this->roles[$i].'
                  </option>';
                } else {
                  echo '<option value="'.$i.'">
                  '.$this->roles[$i].'
                  </option>';
                }

              }
            echo '</select>
            <input type="hidden" name="idUser" value="'.$this->idUser.'" />
            <button  type="submit" name="button">Administrer la fiche</button>
      </form>';
  }
}
