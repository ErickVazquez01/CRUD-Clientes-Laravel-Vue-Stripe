<template>
    <div class="row mt-3">

        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-success text-white text-center">
                    <h4>Realiza pago</h4>
                </div>
                <div class="card-body">
                    <h4>Datos del cliente:</h4>
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
                    <br>
                    <h4>Ingresa los siguiente datos:</h4>

                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <b>Método de pago:</b>
                        </span>
                        &nbsp;
                        <button class="btn btn-secondary" v-if="metodo == ''" v-on:click="metodo = 'credito'" id="credito">
                            <i class="fa-solid fa-credit-card"></i>
                            &nbsp;
                            Crédito
                        </button>
                        <button class="btn btn-secondary" v-if="metodo == ''" v-on:click="metodo = 'debito'" id="debito">
                            <i class="fa-solid fa-credit-card"></i>
                            &nbsp;
                            Débito
                        </button>
                        <button class="btn btn-primary" v-if="metodo == 'credito'" v-on:click="metodo = 'credito'"
                            id="credito">
                            <i class="fa-solid fa-credit-card"></i>
                            &nbsp;
                            Crédito
                        </button>
                        <button class="btn btn-secondary" v-if="metodo == 'credito'" v-on:click="metodo = 'debito'"
                            id="debito">
                            <i class="fa-solid fa-credit-card"></i>
                            &nbsp;
                            Débito
                        </button>
                        <button class="btn btn-secondary" v-if="metodo == 'debito'" v-on:click="metodo = 'credito'"
                            id="credito">
                            <i class="fa-solid fa-credit-card"></i>
                            &nbsp;
                            Crédito
                        </button>
                        <button class="btn btn-primary" v-if="metodo == 'debito'" v-on:click="metodo = 'debito'"
                            id="debito">
                            <i class="fa-solid fa-credit-card"></i>
                            &nbsp;
                            Débito
                        </button>
                    </div>
                    <form v-on:submit="pagar" id="payment-form">
                        <div id="payment-element">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <b>Monto:</b>
                                &nbsp;
                                <i class="fa-solid fa-dollar-sign"></i>
                            </span>
                            <input type="number" v-model="monto" id="monto" placeholder="Ingresa el monto (mínimo $100)"
                                class="form-control" required min="100">
                        </div>
                        <div class="d-grid col-6 mx-auto mb-3">
                            <button class="btn btn-success" id="submit">
                                <div class="spinner hidden" id="spinner"></div>
                                <i class="fa-solid fa-check-to-slot"></i>
                                &nbsp;
                                Proceder pago
                            </button>
                            <div id="payment-message" class="hidden"></div>
                        </div>

                    </form>
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
import { mensajeRedireccion} from '../funciones';
import { initialize, checkStatus } from '../checkout';
import { useRoute } from 'vue-router';

export default {
    data() {
        return {
            id: 0,
            nombre: '',
            correo: '',
            telefono: '',
            monto: '',
            metodo: '',
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
        pagar() {
            event.preventDefault();

            // This is your test publishable API key.
            const stripe = Stripe(
                "pk_test_51NhNXhIkNFXyIz1gC9SitV3REAB8R8ndLHzgeCyOjSw62iOPl2BcWYujsU6z0Dv55neNQ5F6HJk5DY0BHsxcrpUg00eV2CcS2x"
            );

            // The items the customer wants to buy
            const items = {
                nombre: this.nombre,
                correo: this.correo,
                monto: this.monto,
                payment_method: "pm_card_visa",
            };
            var clientSecret = '';

            initialize();

            // Fetches a payment intent and captures the client secret
            async function initialize() {
                axios({
                    method: 'POST',
                    url: 'http://crudpai.test/api/v1/stripe',
                    data: items
                }).then(function (response) {
                    console.log(response);
                    clientSecret = response.data.clientSecret;
                    console.log('clientSecret: ', clientSecret);

                    
                    if (response.status == 200) {
                        mensajeRedireccion('El pago se realizó correctamente', 'success', true);
                    } else {
                        mensajeRedireccion('El pago se realizó correctamente', 'danger');
                    }
                })



            }
        },
    }
}
</script>