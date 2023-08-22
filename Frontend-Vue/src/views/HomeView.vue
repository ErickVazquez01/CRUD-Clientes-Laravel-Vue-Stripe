<template>
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Correo</th>
              <th scope="col">Teléfono</th>
              <th scope="col" class="col-auto">Opciones</th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id="contenido">
            
            <tr v-if="this.cargando">
              <td colspan="6"><h4>Obteniendo datos...</h4></td>
            </tr>
            <tr v-else v-for="client, i in this.clientes" :key="client.id">
              <td v-text="(i+1)"></td>
              <td v-text="client.id"></td>
              <td v-text="client.nombre"></td>
              <td v-text="client.correo"></td>
              <td v-text="client.telefono"></td>
              <td>
                <router-link :to="{path:'viewC/'+client.id}" class="btn btn-info"> <!-- :to="{path:'view/'+client.id}" hace referencia a la ruta view y le pasa el id del cliente-->
                  <i class="fa-solid fa-eye"></i>
                </router-link>
                
                <router-link :to="{path:'editC/'+client.id}" class="btn btn-warning"> <!-- :to="{path:'view/'+client.id}" hace referencia a la ruta view y le pasa el id del cliente-->
                  <i class="fa-solid fa-edit"></i>
                </router-link>

                <button class="btn btn-danger" v-on:click="eliminar(client.id, client.nombre)">
                  <i class="fa-solid fa-trash"></i>
                </button>
                &nbsp;
                <router-link :to="{path:'checkout/'+client.id}" class="btn btn-success"> <!-- :to="{path:'view/'+client.id}" hace referencia a la ruta view y le pasa el id del cliente-->
                  <i class="fa-solid fa-money-bill"></i> Pagar
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';//importamos axios para hacer las peticiones http
  import {confirmar} from '../funciones'

  export default {
    data(){
      return {
        clientes:null,
        cargando:false
      }
    },
    mounted(){//metodo que se carga al renderizar la página completa
      this.getClientes();
    },
    methods:{
      getClientes(){
        this.cargando = true;
        axios.get('http://crudpai.test/api/v1/clientes').then(//hace petición
        //luego de hacer petición:
          res => {
            this.clientes = res.data;//asignamos los datos obtenidos a la variable clientes
            this.cargando = false;
          }
        );
      },
      eliminar(id,nombre){
        confirmar('http://crudpai.test/api/v1/clientes/',id, 'Eliminar cliente', '¿Está seguro que desea eliminar el cliente '+nombre+'?');
        this.cargando = false;
      }
    }
  }
</script>
