<template>
    <main class="main" id="app">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-user-o"></i> Pedidos
                        <button type="button" class="btn btn-secondary" data-toggle="modal" @click="abrirModal('guardar')">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>

                    <div class="card-body">
                       
                       <div class="form-group form-inline">
                            <input v-model="buscar" class="form-control col-3" placeholder="Ingrese el codigo del Producto" type="text" @keyup.enter="getProc(buscar)">
                            <button class="btn btn-dark" @click="abrirModal"><i class="fa fa-search"></i></button>
                            <h4 class="text-muted mx-sm-5" v-text="nomProducto"></h4>
                            <label class="mx-sm-3">Cantidad</label>
                            <input v-model="cantidad" type="number" class="form-control" placeholder="Cantidad">
                            <button @click="agregarItem2" type="button" class="btn btn-success" data-toggle="modal">
                            <i class="icon-check"></i>
                            </button>
                        </div>

                        <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Empleado</label>
                            <div class="col-md-5">
                            <select v-model="idEmple" class="col-md-9 form-control">
                            <option v-for="objeto in arrayEmpleados" :value="objeto.id" :key="objeto.id" v-text="objeto.nomCom"></option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                            <div class="col-md-3">
                            <input type="text" v-model="telefono" id="nombre" name="nombre" class="form-control" placeholder="Telefono de contacto">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Ubicación</label>
                            <div class="col-md-3">
                            <input type="text" v-model="ubicacion" id="nombre" name="nombre" class="form-control" placeholder="Ubicacion de entrega">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Estado Pedido</label>
                            <div class="col-md-4">
                            <select v-model="estadoP" class="col-md-9 form-control">
                            <option>Listo</option>
                            <option>Pendiente</option>
                            <option>Anulado</option>
                            </select>
                            </div>
                        </div>

                      

                        </div>

                     <br>
                        
                      
                        <table class="table table-bordered table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre del Producto</th>
                                    <th>Valor por Unidad</th>
                                    <th>Cantidad</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="objeto in arrayDatos" :key="objeto.id">
                                    <td v-text="objeto.nombre"></td>
                                    <td v-text="objeto.valor"></td>
                                    <td v-text="objeto.cantidad"></td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" @click="eliminarItem(id,objeto)" data-toggle="modal">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    
                                </tr>
                                 <tr style="background-color:beige;">
                                 <td colspan="3" align="center">Total del Pedido</td>
                                <td>{{total}}</td>
                                                               
                               </tr>

                            </tbody>
                        </table>



                        <button type="button" class="btn btn-dark" data-toggle="modal" @click="regPed()">
                        Guardar
                        </button>
                        
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" id="modalNuevo" :class="{'mostrar':modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="titulo"></h4>
                            <button type="button" class="close" @click="cerrarModal" aria-label="Close">
                              <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                <div class="col-md-6">
                                <div class="input-group">
                                    
                                     <input type="text" id="texto" name="texto" v-model="buscar" class="form-control" placeholder="Producto a buscar" >
                                     <button type="button"  @click="listProc(1,buscar)" class="btn btn-dark"><i class="fa fa-search"></i> Buscar</button>
                                     <label class="mx-sm-3">Cantidad</label>
                                     <input v-model="cantidad" type="number" class="form-control" placeholder="Cantidad">
                                 
           
                                     
                                </div>
                                </div>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Valor</th>
                                            <th>selección</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="objeto in arrayProductos" :key="objeto.id">
                                            <td v-text="objeto.nombre"></td>
                                            <td v-text="objeto.valor"></td>
                                            <td style="width-20px;"><button type="button" class="btn btn-success" @click="agregarItem(objeto)">OK</button></td>
                                        </tr>

                                    </tbody>
                                </table>
                                <nav>
                                <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                <a
                                class="page-link"
                                href="#"
                                @click.prevent="cambiarPagina(pagination.current_page - 1,buscar)"
                               >Ant</a>
                               </li>
                               <li
                               class="page-item"
                               v-for="page in pagesNumber"
                               :key="page"
                               :class="[page == isActived ? 'active' : '']"
                               >
                               <a
                               class="page-link"
                               href="#"
                              @click.prevent="cambiarPagina(page,buscar)"
                              v-text="page"
                              ></a>
                              </li>
                              <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                              <a
                              class="page-link"
                              href="#"
                             @click.prevent="cambiarPagina(pagination.current_page + 1,buscar)"
                            >Sig</a>
                            </li>
                            </ul>
                            </nav>



                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" @click="cerrarModal" data-dismiss="modal">Cerrar</button>
                            
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
          
        </main>
</template>
<script>
export default {
    data() {
        return {
            arrayDatos:[],
            arrayProductos:[],
            arrayGetProductos:[],
            arrayEmpleados:[],
            idEmple:"",
            idProduc:"",
          

            ////////////////////
            telefono:'',
            ubicacion:'',
            estadoP:'',
            cantidad:1,
            precio:'',
            
            ///////////////////

            nomProducto:"",
            valor:0,

            ////////////////
            offset:3,
            buscar:'',
            pagination:{
                    total:0,
                    current_page:0,
                    per_page:0,
                    last_page:0,
                    from:0,
                    to:0,

                },

            ///(para las modales)
                modal:0,
                titulo:'',
                
         
            
        }
    },
    methods: {

        cambiarPagina(page,buscar){
            let me = this;
            //va al la pagina actual
            me.pagination.current_page= page;
            //envia el metodo para enviar los datos
            me.listProc(page,buscar);

        },


        listProc(page,buscar){
            let me = this;
                var url="/producto?page="+ page + '&buscar=' + buscar;
                axios.get(url)
                .then(function(response){
                    var respuesta = response.data;
                    me.arrayProductos = respuesta.producto.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
        },
///////////////////////////////////////(Buscar por medio de la barra de buscar)
        getProc(buscar){
            let me = this;
                var url="/getproduc?buscar=" + buscar;
                axios.get(url)
                .then(function(response){
                    var respuesta = response.data;
                    me.arrayGetProductos = respuesta.producto;

                    if (me.arrayGetProductos.length >0) {
                        me.idProduc=me.arrayGetProductos[0]['id'];
                        me.nomProducto=me.arrayGetProductos[0]['nombre'];
                        me.valor=me.arrayGetProductos[0]['valor'];

                    }
                    else{
                        me.nomProducto="Verifique el código o nombre"
                    }
             
                })
                .catch(function(error){
                    console.log(error);
                });
        },

    /////////////////////////////////////////////////
        
        getEmp(){
            let me= this;
            var url="/getemp"
            axios.get(url)
            .then(function(response){
                var respuesta = response.data;
                me.arrayEmpleados= respuesta.emp;
            })
        },
        /////////////////////////////////////////////////////////////
        
        agregarItem(data=[]){
            this.arrayDatos.push({id:data['id'],nombre:data['nombre'],valor:data['valor'],cantidad:this.cantidad});
        
        },

        agregarItem2(){
            this.arrayDatos.push({id:this.idProduc,nombre:this.nomProducto,valor:this.valor,cantidad:this.cantidad});
        },

        eliminarItem(data=[]){
            this.arrayDatos.splice(0,1)
        },
        ////////////////////////////////////////////////////////////
        regPed() {
                let me = this;
                var url="/pedido/registrar";
                axios.post(url,{
                    idEmple: this.idEmple,
                    telefono: this.telefono,
                    ubicacion: this.ubicacion,
                    estadoP: this.estadoP,
                    data:me.arrayDatos
                    
                }).then(function(response){
                    //me.listCar(1, me.criterio, me.buscar);
                    alert('Se guardo correctamente');
                   
                })
                .catch(function(error){
                    console.log(error);
                });
                
            },
        /////////////////////////////////////
        abrirModal(){
            this.modal=1;
            this.titulo="Seleccione el Producto";
        },

        cerrarModal(){
            this.modal=0;
            this.titulo="";
        }
    },

    computed: {

        total :function(){
            var total=0;
            for (let i = 0; i < this.arrayDatos.length; i++) {
                total = total + parseInt(this.arrayDatos[i].valor*this.arrayDatos[i].cantidad);
                
            }
            return total;
        },

      isActived: function() {
      return this.pagination.current_page;
      },
      //Calcula los elementos de la paginación
      pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }

      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
      pagesArray.push(from);
      from++;
      }
        return pagesArray;
      },

      
        },
    mounted() {
        this.listProc(1,this.buscar);
        this.getEmp();
    },
}
</script>

<style>

.modal-content{
    width: 100% !important;
    position: absolute;
}

.mostrar{
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: #3c29297a;
}
</style>