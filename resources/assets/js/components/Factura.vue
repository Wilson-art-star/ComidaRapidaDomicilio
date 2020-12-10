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
                        <i class="fa fa-user-o"></i> Facturas
                        <button type="button" class="btn btn-secondary" data-toggle="modal" @click="mostrar()">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>

                    <div class="card-body">
                       
                       <!-- //////////////////////////////////////////////////////////////////////////////////// -->
                       <template v-if="view">

                        <div class="form-group form-inline">
                            <input v-model="buscar" class="form-control col-3" placeholder="Ingrese la ubicación o su codigo" type="text" @keyup.enter="getPedi(buscar)">
                            <button class="btn btn-dark" @click="abrirModal"><i class="fa fa-search"></i></button>
                            <h4 class="text-muted mx-sm-5" v-text="ubicacion"></h4>
                            <button @click="agregarItem2" type="button" class="btn btn-success" data-toggle="modal">
                            <i class="icon-check"></i>
                            </button>
                        </div>

                        <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Cliente</label>
                            <div class="col-md-5">
                            <select v-model="idClin" class="col-md-9 form-control">
                            <option v-for="objeto in arrayClientes" :value="objeto.id" :key="objeto.id" v-text="objeto.nomClin"></option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Total a Pagar</label>
                            <div class="col-md-3">
                            <input v-model="totalF" type="text"  id="nombre" name="nombre" class="form-control" placeholder="Precio Total">
                            </div>
                        </div>

                        </div>

                     <br>
                        
                      
                        <table class="table table-bordered table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Codigo Pedido</th>
                                    <th>Ubicacion</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="objeto in arrayDatos" :key="objeto.id">
                                    <td v-text="objeto.idPedi"></td>
                                    <td v-text="objeto.ubicacion"></td>
                                    <td v-text="objeto.telefono"></td>
                                    <td>
                                         <template v-if="objeto.estado=='Listo'">
                                           <span class="badge badge-success">Listo</span>
                                        </template>
                                        <template v-else>


                                        <template v-if="objeto.estado=='Pendiente'">
                                         <span class="badge badge-warning">Pendiente</span>
                                        </template>

                                        <template v-else>
                                            <span class="badge badge-danger">Anulado</span>
                                        </template>

                                        </template>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" @click="eliminarItem(id,objeto)" data-toggle="modal">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    
                               </tr>

                            </tbody>
                        </table>



                        <button type="button" class="btn btn-dark" data-toggle="modal" @click="regFac()">
                        Guardar
                        </button>
                        
                         <button type="button" class="btn btn-light" data-toggle="modal" @click="ocultar()">
                        Atras
                        </button>      
                           
                       </template>
                       
                       <!-- //////////////////////////////////////////////////////////////////////////////////// -->

                       <!-- //////////////////////////////////////////////////////////////////////////////////// -->

                        <template v-else>
                        <table class="table table-bordered table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#F</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="objeto in arrayMaster" :key="objeto.id">
                                    <td v-text="objeto.id"></td>
                                    <td v-text="objeto.nomClin"></td>
                                    <td v-text="objeto.fecha"></td>
                                    <td v-text="objeto.total"></td>
                                    <td>
                                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" @click="mostrar(objeto)">
                                          <i class="icon-eye"></i>
                                        </button>
                                    </td>
                                    
                                </tr>

                            </tbody>
                        </table>
                            
                        
                    </template>

                       <!-- //////////////////////////////////////////////////////////////////////////////////// -->
                        
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
                                     <button type="button"  @click="listPedi(1,buscar)" class="btn btn-dark"><i class="fa fa-search"></i> Buscar</button>
                                        
                                </div>
                                </div>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Codigo Pedido</th>
                                            <th>Ubicacion</th>
                                            <th>Telefono</th>
                                            <th>Estado</th>
                                            <th>selección</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="objeto in arrayPedidos" :key="objeto.id">
                                            <td v-text="objeto.id"></td>
                                            <td v-text="objeto.ubicacion"></td>
                                            <td v-text="objeto.telefono"></td>
                                            <td v-text="objeto.estado"></td>
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
            arrayPedidos:[],
            arrayGetPedidos:[],
            arrayClientes:[],
            idClin:"",
            idPedi:"",
          

            ////////////////////

            telefono:'',
            ubicacion:'',
            estado:'',
            totalF:0,
            
            ///////////////////

            ///////////////////
            arrayMaster:[],
            view:0,
            idFactura:0,
            ///////////////////
           

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
            me.listPedi(page,buscar);

        },


        listPedi(page,buscar){
            let me = this;
                var url="/pedidos?page="+ page + '&buscar=' + buscar;
                axios.get(url)
                .then(function(response){
                    var respuesta = response.data;
                    me.arrayPedidos = respuesta.pedidos.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
        },

        /////////////////////////////////////////////////////////////////////(LISTAR DATOS)

        listDatos(page){
            let me = this;
                var url="/factura?page="+ page + '&buscar=' + this.idFactura;
                axios.get(url)
                .then(function(response){
                    var respuesta = response.data;
                    me.arrayMaster = respuesta.facturas.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
        },


        listDetDatos(page){
            let me = this;
                var url="/detfactura?page="+ page + '&buscar=' + this.idFactura;
                axios.get(url)
                .then(function(response){
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.facturas.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
        },
///////////////////////////////////////(Buscar por medio de la barra de buscar)
        getPedi(buscar){
            let me = this;
                var url="/getpedi?buscar=" + buscar;
                axios.get(url)
                .then(function(response){
                    var respuesta = response.data;
                    me.arrayGetPedidos = respuesta.pedidos;

                    if (me.arrayGetPedidos.length >0) {
                        me.idPedi=me.arrayGetPedidos[0]['id'];
                        me.ubicacion=me.arrayGetPedidos[0]['ubicacion'];
                        me.telefono=me.arrayGetPedidos[0]['telefono'];
                        me.estado=me.arrayGetPedidos[0]['estado'];

                    }
                    else{
                        me.ubicacion="Verifique la ubicacion"
                    }
             
                })
                .catch(function(error){
                    console.log(error);
                });
        },

    /////////////////////////////////////////////////
        
        getCli(){
            let me= this;
            var url="/getcli"
            axios.get(url)
            .then(function(response){
            var respuesta = response.data;
                me.arrayClientes= respuesta.cli;
            })
        },

         /////////////////////////////////////////////////////////////

        mostrar(data=[]){
            this.view=1;
            this.idClin=data['idClin'];
            this.totalF=data['total'];
            this.idFactura=data['id'];
            this.idPedi=data['idPedi']
             this.listDetDatos(1,"");
            
        },

        ocultar(){
            this.view=0;
        },

        /////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////
        
        agregarItem(data=[]){
            this.arrayDatos.push({id:data['id'],ubicacion:data['ubicacion'],telefono:data['telefono'],estado:data['estado']});
        
        },

        agregarItem2(){
            this.arrayDatos.push({idPedi:this.idPedi,ubicacion:this.ubicacion,telefono:this.telefono,estado:this.estado});
        },

        eliminarItem(data=[]){
            this.arrayDatos.splice(0,1)
        },
        ////////////////////////////////////////////////////////////
        regFac() {
                let me = this;
                var url="/factura/registrar";
                axios.post(url,{
                    idClin: this.idClin,
                    totalF: this.totalF,
                    data:me.arrayDatos
                    
                }).then(function(response){
                   
                    me.mensaje();
                   
                })
                .catch(function(error){
                    console.log(error);
                });
                
            },
        /////////////////////////////////////
        abrirModal(){
            this.modal=1;
            this.titulo="Seleccione el Pedido";
        },

        cerrarModal(){
            this.modal=0;
            this.titulo="";
        },

        mensaje(){
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Se guardo correctamente',
            showConfirmButton: false,
            timer: 1500
            })
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
       
        this.listDatos();
        this.getCli();
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