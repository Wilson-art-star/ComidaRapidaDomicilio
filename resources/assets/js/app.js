
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
////////////////(TABLAS MAESTRAS)

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('cliente', require('./components/Cliente.vue'));
Vue.component('producto', require('./components/Producto.vue'));
Vue.component('cargo', require('./components/Cargo.vue'));
Vue.component('tipoinsumo', require('./components/TipoInsumo.vue'));
Vue.component('entradainventario', require('./components/EntradaInventario.vue'));

////////////////(TABLAS FORANEAS

Vue.component('insumo', require('./components/Insumo.vue'));
Vue.component('empleado', require('./components/Empleado.vue'));

///////////////(DETALLES MAESTRO)

Vue.component('pedido', require('./components/Pedido.vue'));
Vue.component('factura', require('./components/Factura.vue'));


const app = new Vue({
    el: '#app',
    data:{
        menu:0
    }
});
