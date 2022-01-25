<script>
const RS = Vue.createApp({
  data () {
    return {
      cleW: false,
      regleW: <?php echo $dataRulesArmes; ?>,
      regleF: <?php echo $dataRulesFigurines; ?>,
      regleV: <?php echo $dataRulesVehicules; ?>,
      titre: '',
      type: '',
      texteRS: '',
      typeRSp: ['Armes', 'Figurines', 'Véhicules'],
    }
  },
  methods: {
    action($id) {
      // Fonction pour retirer les artefact lier à l'encodage JSON
      function sanitize ($data) {
        for (let i = 0; i < $data.length; i++) {
          $data = $data.replace('&quot;', ' ')
        }
        return $data
      }
      // stockage des données dans les variables pour affichage dans le DOM
        this.titre = $id['nomRules']
        this.titre = sanitize (this.titre)
        this.type = this.typeRSp[$id['typeRules']]
        this.type = sanitize (this.type)
        this.texteRS = $id['descriptionRules']
        this.texteRS = sanitize (this.texteRS)
        this.cleW = true
    }
  }
})
  RS.mount('#RS')
</script>
