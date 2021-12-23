<?php
class lienNav {
  public $tri = "SELECT `idNav`, `nomLien`, `cheminNav`, `valide`, `levelAdmi`, `ordre`, `centrale`, `classement`
  FROM `nav`
  ORDER BY `levelAdmi` ASC, `ordre`";
  public $parametre = [];
  public $yes = ['non', 'oui'];
  public $admin = ['Visiteur', 'Utilisateur', 'Createur', 'Administrateur' ];
  public function readNav () {
    $dataNav = new readDB ($this->tri, $this->parametre);
    return $dataNav->read();
  }
  public function liens ($dataNav, $levelA) {
    foreach ($dataNav as $key) {
      if ($key['levelAdmi'] == $levelA) {
        echo '<li>
        Id menu :'.$key['idNav'].'- Nom '.$key['nomLien'].'- chemin ='.$key['cheminNav'].'-
        Valide ='.$this->yes[$key['valide']].'-'.$this->admin[$key['levelAdmi']].'- Ordre'.$key['ordre'].'
        - menu centrale '.$key['centrale'].' - Ordre centrale'.$key['classement'].'
        </li>';
      }
    }
  }
  public function formulaire ($dataNav, $levelA, $idNavigation) {

    foreach ($dataNav as $key) {
      if ($key['levelAdmi'] == $levelA) {
      echo '<li>
        <form  class="colonne" action="CUD/Update/lien.php" method="post">
          <input type="hidden" name="idNav" value="'.$key['idNav'].'">
          <label for="nomLien">Nom Lien</label>
          <input id="nomLien" type="text" name="nomLien" value="'.$key['nomLien'].'">
          <label for="Chemin">Chemin</label>
          <input id="Chemin" type="text" name="cheminNav" value="'.$key['cheminNav'].'">
          <label for="valide">Valide ?</label>
          <select class="inputFormulaire" name="valide">
            <option value="0">Non</option>
            <option value="1" selected>Oui</option>
          </select>
          <label for="levelAdmi">Niveau d\'administration</label>
          <select name="levelAdmi">';
          if($levelA == 0) {
            echo '<option value="0" selected>Visiteur</option>
            <option value="1">Utilisateur</option>
            <option value="2">Createur</option>
            <option value="3">Administrateur</option>';
          }
          if($levelA == 1) {
            echo '<option value="0">Visiteur</option>
            <option value="1" selected>Utilisateur</option>
            <option value="2">Createur</option>
            <option value="3">Administrateur</option>';
          }
          if($levelA == 2) {
            echo '<option value="0">Visiteur</option>
            <option value="1">Utilisateur</option>
            <option value="2" selected>Createur</option>
            <option value="3">Administrateur</option>';
          }
          if($levelA == 3) {
            echo '<option value="0">Visiteur</option>
            <option value="1">Utilisateur</option>
            <option value="2">Createur</option>
            <option value="3" selected>Administrateur</option>';
          }
          echo '</select>
          <label for="ordre">ordre</label>
          <input id="ordre" type="number" min="0" max="10" name="ordre" value="'.$key['ordre'].'">
          <label for="centrale">Lien au centre de la page</label>
          <input id="centrale" type="number" min="0" max="10" name="centrale" value="'.$key['centrale'].'">
          <label for="classement">Classement du lien au centre de la page</label>
          <input id="classement" type="number" min="0" max="10" name="classement" value="'.$key['classement'].'">
          <input type="hidden" name="idNavigation" value="'.$idNavigation.'">
          <button type="submit" name="button">Modifier</button>
        </form>
        <form action="CUD/Delette/lien.php" method="post">
          <input type="hidden" name="idNav" value="'.$key['idNav'].'">
          <input type="hidden" name="idNavigation" value="'.$idNavigation.'">
          <button type="submit" name="button">Supprimer</button>
        </form>
      </li>';
      }
    }
  }
}
