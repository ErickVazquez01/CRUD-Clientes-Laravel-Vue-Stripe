<template>
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white text-center">
                    <h4>Editar cliente</h4>
                </div>
                <div class="card-body">
                    <form v-on:submit="actualizar">
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input type="text" v-model="nombre" id="nombre" placeholder="Ingresa el nombre"
                                class="form-control" required maxlength="30">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-at"></i>
                            </span>
                            <input type="email" v-model="correo" id="correo" placeholder="Ingresa el correo"
                                class="form-control" required maxlength="30">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <input type="text" v-model="telefono" id="telefono" placeholder="Ingresa el numero de teléfono"
                                class="form-control" required maxlength="10">
                        </div>
                        <div class="d-grid col-6 mx-auto mb-3">
                            <button class="btn btn-success">
                                <i class="fa-solid fa-refresh"></i>
                                &nbsp;
                                Actualizar datos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';//importamos axios para hacer las peticiones http
import { mostrarAlerta, enviarSolicitud } from '../funciones';
import { useRoute } from 'vue-router';

export default {
    data() {
        return {
            id: 0,
            nombre: '',
            correo: '',
            telefono: '',
            cargando: false,
            url: 'http://crudpai.test/api/v1/clientes'
        }
    },
    mounted(){//se ejecuta al cargar la página
        const route = useRoute();
        this.id = route.params.id;//obtenemos el id del cliente que se envía por la url
        this.url = this.url+'/'+this.id;//concatenamos el id a la url
        this.getCliente();

    },
    methods: {
        getCliente(){
            axios.get(this.url).then(
                (resultado) => {
                    this.nombre = resultado.data.data.nombre;
                    this.correo = resultado.data.data.correo;
                    this.telefono = resultado.data.data.telefono;
                    this.cargando = false;
                }
            ).catch(
                (error) => {
                    console.log(error);
                    this.cargando = false;
                }
            );
        },
        actualizar() {
            event.preventDefault();//evita que se recargue la página al enviar el formulario
            if(this.nombre.trim() === ''){
                mostrarAlerta('El campo nombre no puede ir vacío', 'warning','nombre');
            }else if(this.correo.trim() === ''){
                mostrarAlerta('El campo correo no puede ir vacío', 'warning','correo');
            }else if(this.telefono.trim() === ''){
                mostrarAlerta('El campo telefono no puede ir vacío', 'warning','telefono');
            }else{
                var parametros = {
                    nombre: this.nombre.trim(),
                    correo: this.correo.trim(),
                    telefono: this.telefono.trim()
                };
                enviarSolicitud('PUT',parametros,this.url,'Datos actualizados');
            }
            this.cargando = true;
            
        },

    }
}
</script>