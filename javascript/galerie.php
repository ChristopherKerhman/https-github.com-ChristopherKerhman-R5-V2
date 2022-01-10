<article class="flex-ligne">
  <div class="galerie" id="GALERIE">
    <figure>
    <img :src="name" alt="image de R5" v-on:click="galerie0">
    <figcaption>Quelques images du jeu R5</figcaption>
    </figure>
</article>
<script>
  const GALERIE = Vue.createApp({
      data () {
        return {
          index: 0,
          name: 'images/R50.jpg',
          images: ['R50.jpg', 'R51.png', 'R54.png']
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
