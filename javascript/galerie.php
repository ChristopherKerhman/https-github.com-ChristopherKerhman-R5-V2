<?php
$lireImage = "SELECT `nomImage`, `description`, `alt` FROM `images` WHERE `valide` = 1";
$param = [];
$lireImage = new readDB($lireImage, $param);
$dataImage = $lireImage->read();
// Trie des données

 ?>
<?php if (!empty($dataImage)) {
  $arrayImage = array();
  $arrayCommentaire = array();
  foreach ($dataImage as $key => $value) {
    array_push($arrayImage, $value['nomImage']);
    array_push($arrayCommentaire, $value['description']);
  }
  // mise en forme pour la lecture en javascirpt.
  $images = JSON_encode($arrayImage);
  $commentaires = JSON_encode($arrayCommentaire);
  // Premier image de la galerie
  $firstImage =  $dataImage[0]['nomImage'];

  ?>
<article class="flex-ligne">
  <div class="galerie" id="GALERIE">
    <figure>
    <img class="images" :src="name" alt="image de R5" v-on:click="galerie0">
    <figcaption>{{commentaire[index]}}</figcaption>
    </figure>
</article>

  <script>
    const GALERIE = Vue.createApp({
        data () {
          return {
            index: 0,
            name: 'images/galerieFront/<?php echo $firstImage; ?>',
            images: <?php echo $images; ?>,
            commentaire: <?php echo $commentaires; ?>

          }
        },
        methods: {
          galerie0 () {
            if(this.index >= this.images.length-1) {
              this.index = -1
            }
            this.index = this.index + 1
            this.name = 'images/galerieFront/' + this.images[this.index]
          }
        }
    })
    GALERIE.mount('#GALERIE')
  </script>
<?php } ?>
