<template>
    <div class="row mt-3">

        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white text-center">
                    <h4>Cliente espefícifico</h4>
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <label v-text="nombre" class="form-control"></label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fa-solid fa-at"></i>
                        </span>
                        <label v-text="correo" class="form-control"></label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fa-solid fa-phone"></i>
                        </span>
                        <label v-text="telefono" class="form-control"></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="d-grid col-4 mx-auto mb-3">
        <router-link :to="{ path: '/' }" class="btn btn-info">
            <i class="fa-solid fa-arrow-left"></i> Regresar
        </router-link>
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
    mounted() {//se ejecuta al cargar la página
        const route = useRoute();
        this.id = route.params.id;//obtenemos el id del cliente que se envía por la url
        this.url = this.url + '/' + this.id;//concatenamos el id a la url
        this.getCliente();

    },
    methods: {
        getCliente() {
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
            if (this.nombre.trim() === '') {
                mostrarAlerta('El campo nombre no puede ir vacío', 'warning', 'nombre');
            } else if (this.correo.trim() === '') {
                mostrarAlerta('El campo correo no puede ir vacío', 'warning', 'correo');
            } else if (this.telefono.trim() === '') {
                mostrarAlerta('El campo telefono no puede ir vacío', 'warning', 'telefono');
            } else {
                var parametros = {
                    nombre: this.nombre.trim(),
                    correo: this.correo.trim(),
                    telefono: this.telefono.trim()
                };
                enviarSolicitud('PUT', parametros, this.url, 'Datos actualizados');
            }
            this.cargando = true;

        },

    }
}
</script>