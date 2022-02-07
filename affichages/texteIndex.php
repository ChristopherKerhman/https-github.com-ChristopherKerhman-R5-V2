<?php
require 'objets/texteIndex.php';
include 'securite/securiterCreateur.php';
$idTexte = filter($_GET['idTexte']);
$texte = new TexteIndex();
 ?>
 <div id="VERROU">


   <button v-if="!cle2" type="button" name="button" v-on:click="cle2 = true">Ouvrir modification</button>
    <button v-else type="button" name="button" v-on:click="cle2 = false">Fermer modification</button>
   <div v-if="cle2">
     <div class="flex-ligne">
     <?php $dataTexte = $texte->modifierTexte($idTexte, $idNav); ?>

    <aside class="articleContexte">
    <h3 class="sousTitre">Aide HTML</h3>

    <ul>
    <li>Titre : class="sousTitre"</li>
    <li>sousTitre : class="sousTitreArticle"</li>
    <li>&ltp class="articleLore"&gt Votre article &lt/p&gt</li>
    <li>&ltp class="articleContexte"&gt Votre article &lt/p&gt</li>
    <li>Saut de ligne &ltbr /&gt</li>
    <li></li>
    </ul>
    </aside>
    </div>
    </div>
    <button v-if="!cle" type="button" name="button" v-on:click="cle = true">Ouvrir texte</button>
    <button v-else type="button" name="button" v-on:click="cle = false">Fermer texte</button>
   <div v-if="cle">
     <?php $dataTexte = $texte->presentationTexte($idTexte, 0); ?>
   </div>
</div>
<?php
include 'javascript/verrou.php';
 ?>
