<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div id="app">
        <div class="container mt-3">
            <h2>DBZ</h2>
            <div class="mt-4 p-5 bg-primary text-white rounded">
                <h1>{{titulo}}</h1>
                <img src="../imagenes/goku.jpg">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat..</p>
                <button type="button" class="btn btn-dark" @click="guardar">Primary</button>
            </div>
        </div>
    </div>
    <!-- Importamos la CDN de VUE JS -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>
        vm = new Vue({
            el: "#app",
            //data sirve para declarar variables
            data: {
                titulo:''
            },
            //funciones que sirven automaticamente
            mounted: function() {

                this.cargar()
                this.api()

            },
            //declaramos funciones 
            methods: {
                guardar: function() {
                    alert("Presiono el boton")
                },
                cargar:function(){
                    this.titulo= 'Hola soy Goku!'
                },
                api:function(){

                    fetch('https://catfact.ninja/fact',{
                        method: "GET", //or 'PUT' para modificar, 
                        headers:{ 
                            'Content-Type': 'application/json',
                            'Accept':'application/json'

                        },
                    })
                    .then(response=> response.json()
                    )
                    .then(data => {
                        console.log(data)
                        this.titulo=data.fact
                    })
                    .catch((error)=> {
                        console.error(error)
                    })

                }

            },
        })
    </script>

</body>

</html>