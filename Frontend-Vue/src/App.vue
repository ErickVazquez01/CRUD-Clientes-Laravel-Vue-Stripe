<template>
  <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #5e23bd;">
    <div class="container-fluid">
      <a class="navbar-brand">
        Gestión de clientes
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page">
              <router-link class="dropdown-item" to="/">
                Inicio
              </router-link>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Clientes
            </a>
            <ul class="dropdown-menu">
              <li>
                <router-link class="dropdown-item" to="/">Listar
                  clientes</router-link><!--  Hace referencia a la ruta HOME (raíz)-->
              </li>
              <li>
                <router-link class="dropdown-item" to="/createC">Registrar
                  cliente</router-link><!--  Hace referencia a la ruta HOME (raíz)-->
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>
  <div class="container-fluid"> <!-- Aquí se renderiza el componente que se seleccione en el menú-->
    <router-view />
  </div>
</template>
