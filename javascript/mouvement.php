<script type="text/javascript">
const COURSE = Vue.createApp({
  data () {
    return {
    mouvement: 0,
    course: 0
    }
  },
  updated () {
    this.course = Math.floor(this.mouvement * 1.5)
    if(this.mouvement > 12) {
      this.mouvement = 12
    }
    if(this.mouvement < 0) {
      this.mouvement = 0
    }
  }
})
COURSE.mount('#COURSE')
</script>
