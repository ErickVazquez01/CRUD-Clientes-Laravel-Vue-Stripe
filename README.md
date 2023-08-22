# CRUD DE CLIENTES (Laravel, Vue y Stripe)

Proyecto hecho con Laragon para poder hacer uso de los frameworks Laravel y Vue.
CRUD de clientes con la posibilidad de realizar pagos por cliente conectados a STRIPE, con un monto mínimo de $100 pesos.

## Installation

Se hizo uso de la api de [STRIPE](https://stripe.com/docs/payments/quickstart#fetch-payment-intent).

```bash
composer require stripe/stripe-php
```

## Contributing

Se hizo uso de herramientas como:
* Bootstrap (CSS)
* Axios (Peticiones al backend)
* Fontawesome (Iconos)
* Sweet alert (ventanas emergentes)
* Stripe Elements.js

## Previsualización

![index](https://github.com/ErickVazquez01/CRUD-Clientes-Laravel-Vue-Stripe/assets/34389204/bce16aee-4856-4929-95d6-1711aef46821)
Visualización de la vista principal del proyecto

![info](https://github.com/ErickVazquez01/CRUD-Clientes-Laravel-Vue-Stripe/assets/34389204/fb699e0d-7a13-40e3-a616-52b597671d3b)
Visualización de la información detallada de un cliente

![delete](https://github.com/ErickVazquez01/CRUD-Clientes-Laravel-Vue-Stripe/assets/34389204/f30a7539-26d0-47fa-83f9-fa9668c0bacc)
Ventana de confirmación de un cliente

![update](https://github.com/ErickVazquez01/CRUD-Clientes-Laravel-Vue-Stripe/assets/34389204/d7c36ba9-90ac-4241-940c-b50a89ae0ce4)
Ventana de actualización de datos del cliente

![checkout](https://github.com/ErickVazquez01/CRUD-Clientes-Laravel-Vue-Stripe/assets/34389204/53aa2949-9af2-4f54-bfee-04727b642712)
Ventana para realizar pago de un cliente en específico

![paymentIntent](https://github.com/ErickVazquez01/CRUD-Clientes-Laravel-Vue-Stripe/assets/34389204/f9bb7525-b78b-47a7-bf51-41fab7f5d089)
Mensaje de confirmación de pago realizado en STRIPE (requiere cuenta, llave pública y privada)



