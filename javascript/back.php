<script>
  const BACK = Vue.createApp({
    data () {
      return {

      }
    },
    methods: {
      backTo(){
        history.back();
      }
    }
  })
  BACK.mount('#BACK')
</script>
