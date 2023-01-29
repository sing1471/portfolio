function shuffle (src) {
  const copy = [...src]

  const length = copy.length
  for (let i = 0; i < length; i++) {
    const x = copy[i]
    const y = Math.floor(Math.random() * length)
    const z = copy[y]
    copy[i] = z
    copy[y] = x
  }

  if (typeof src === 'string') {
    return copy.join('')
  }

  return copy
}
 const app = Vue.createApp({
  data: function () {
    return {
      title: 'Welcome to Scramble',
      words:['camel','cricket','shoes','alien','canada','fish','bat','vehicle','king','moon',''],
      game:{
        active: false,
        wrds:['camel','cricket','shoes','alien','canada','fish','bat','vehicle','king','moon',''],
        strikes:0,
        points:0,
        passes:3,
        guess:'',
        message:'',
        cls:'',
        win:false,
        lose:false
      }
    }
  },
  created: function () {
    const game = localStorage.getItem('scramble')

    if (game) {
      this.game = JSON.parse(game)
    }
  },
  computed:{
    word: function (){
      return this.game. wrds[0]
    },
    scrambled: function (){
      return shuffle(this.word)
    }
  },
  methods:{
    verifyGuess: function (){
      if(this.word===this.game.guess.toLowerCase()){
        this.game.points++
        this.game.wrds.shift()
        this.game.message="Correct. Next word"
        this.game.guess=""
        this.cls="alert-success"
        if(this.game.points>9){
          this.game.message="Congratulations. You Win!."
          this.cls="alert-success"
          this.game.guess=""
          this.game.win=true

        }
      }
      else {
        this.game.strikes++
        this.game.message="Wrong. Try again."
        this.cls="alert-danger"
        if(this.game.strikes>2){
          this.game.message="You Lost!."
          this.cls="alert-danger"
          this.game.guess=""
          this.game.lose=true
        }
      }
    },
    pass: function(){
      if(this.game.passes>0){
        this.game.passes--
        this.game.wrds.shift()
        this.game.guess=""
        this.game.message="You Passed. Next word."
        this.cls="alert-info"
      }
    },
    resetGame: function () {
        this.game.message = ''
        this.game.guess = ''
        this.game.active = false
        this.game.strikes=0
        this.game.points=0
        this.game.passes=3
        this.game.win=false
        this.game.lose=false
        this.game.wrds=this.words
      }
  },
    
   watch: {
    game: {
      deep: true,
      handler: function (game) {
        localStorage.setItem('scramble', JSON.stringify(game))
      }
    }
  }


})

    const vm = app.mount('#app')
