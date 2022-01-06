<script type="text/javascript">
const COURSE = Vue.createApp({
  data () {
    return {
    mouvement: 0,
    course: 0
    }
  },
  updated () {
    this.course = Math.floor(this.mouvement * 1.75)
    if(this.mouvement > 28) {
      this.mouvement = 28
    }
    if(this.mouvement < 0) {
      this.mouvement = 0
    }
  }
})
COURSE.mount('#COURSE')
</script>
