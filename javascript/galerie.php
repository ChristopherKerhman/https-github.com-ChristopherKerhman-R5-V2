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
          name: 'images/R5-1.png',
          images: ['R5-1.png', 'R5-3.png', 'R5-5.png', 'R5-6.png', 'R5-7.png', 'R5-8.png',
          'R5-9.png', 'R5-10.png', 'R5-11.png', 'R5-12.png', 'R5-14.png', 'R5-17.png',
           'R5-19.png', 'R5-20.png', 'R5-23.png', 'R51.png', 'R54.png'],
          commentaire: ['Mise en place de la zone de combat', 'Déployement des troupes', 'L\'action commence',
          'Premier hors combat', 'Visualiser les lignes de vue.',
          'Les combattants se préparent.','Percer des troupes', 'Une table avec du décors.',
          'Tir depuis un point haut.', 'Monter sur la haute avec un mouvement tactique.',
          'Courir quand il le faut.', 'Visualiser les lignes de vue.',
          'Detail de la bataille.', 'Fin des combats.','Encore un mort', 'Chasseur de fantômes',
          'Tous les univers sont possible avec R5' ]

        }
      },
      methods: {
        galerie0 () {
          if(this.index >= this.images.length-1) {
            this.index = -1
          }
          this.index = this.index + 1
          this.name = 'images/' + this.images[this.index]
        }
      }
  })
  GALERIE.mount('#GALERIE')
</script>
