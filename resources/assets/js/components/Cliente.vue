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
                        <i class="fa fa-user-o"></i> Clientes
                        <button type="button" class="btn btn-secondary" data-toggle="modal" @click="abrirModal('guardar')">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" id="opcion" name="opcion">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" id="texto" name="texto" v-model="buscar" class="form-control" placeholder="Texto a buscar" >
                                    <button type="submit"  @click="listClin(1,criterio,buscar)" class="btn btn-dark"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Ubicación</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="objeto in arrayDatos" :key="objeto.id">
                                    <td v-text="objeto.nombre"></td>
                                    <td v-text="objeto.apellido"></td>
                                    <td v-text="objeto.ubicacion"></td>
                                    <td v-text="objeto.telefono"></td>
                                    <td v-text="objeto.correo"></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar',objeto)">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="eliminarClin(objeto)">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                        <ul class="pagination">
                        <li class="page-item" v-if="pagination.current_page > 1">
                        <a
                        class="page-link"
                        href="#"
                        @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)"
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
                        @click.prevent="cambiarPagina(page,buscar,criterio)"
                        v-text="page"
                        ></a>
                        </li>
                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a
                        class="page-link"
                        href="#"
                        @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)"
                       >Sig</a>
                       </li>
                       </ul>
                       </nav>
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
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" id="nombre" name="nombre" class="form-control" placeholder="Nombre de Cliente">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellido</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellido" id="nombre" name="nombre" class="form-control" placeholder="Apellido de Cliente">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Ubicación</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="ubicacion" id="nombre" name="nombre" class="form-control" placeholder="Ubicación de Cliente">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="telefono" id="nombre" name="nombre" class="form-control" placeholder="Telefono de Cliente">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Correo</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="correo" id="nombre" name="nombre" class="form-control" placeholder="Correo de Cliente">
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal" data-dismiss="modal">Cerrar</button>
                            <button v-show="accion==0" type="button" @click="regClin" class="btn btn-dark">Guardar</button>
                            <button v-show="accion==1" type="button" @click="actClin" class="btn btn-dark">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar la categoría?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" @click="eliminarClin()" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal Eliminar -->
        </main>
</template>

<script>
    export default {

        data(){
            return{
                arrayDatos:[],
                idClin:0,
                nombre:'',
                apellido:'',
                ubicacion:'',
                telefono:'',
                correo:'',

                ///(para las modales)
                modal:0,
                titulo:'',
                accion:0,

                //////(para la paginacion)
                offset:3,
                buscar:'',
                criterio:'nombre',

                pagination:{
                    total:0,
                    current_page:0,
                    per_page:0,
                    last_page:0,
                    from:0,
                    to:0,

                }

            }
            
        },
        methods: {
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //va al la pagina actual
                me.pagination.current_page= page;
                //envia el metodo para enviar los datos
                me.listClin(page,criterio,buscar);

            },

            /////////////////////////(mostrar interfaz)
            listClin(page,criterio,buscar){
                let me = this;
                var url="/clientes?page="+ page + '&criterio='+ criterio + '&buscar=' + buscar;
                axios.get(url)
                .then(function(response){
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.clientes.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            },

            /////////////////////////(metodo Registrar)
            regClin() {
                let me = this;
                var url="/clientes/registrar";
                axios.post(url,{
                    nombre : this.nombre,
                    apellido : this.apellido,
                    ubicacion : this.ubicacion,
                    telefono : this.telefono,
                    correo : this.correo
                }).then(function(response){
                    me.listClin(1, me.criterio, me.buscar);
                    me.mensajeRegistro();
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });
                
            },

            /////////////////////////(metodo Actualizar)
            actClin(){
                let me = this;
                var url="/clientes/actualizar";
                axios.put(url,{
                    id: this.idClin,
                    nombre : this.nombre,
                    apellido : this.apellido,
                    ubicacion : this.ubicacion,
                    telefono : this.telefono,
                    correo : this.correo
                })
                .then(function(response){
                    me.listClin(1, me.criterio, me.buscar);
                    me.mensajeActualizar();
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });
            },

            /////////////////////////(metodo Eliminar)
            eliminarClin(data=[]){
                let me = this;
                var url="/clientes/eliminar";
                axios.post(url,{
                    id:data['id']
                })
                .then(function(response){
                    me.listClin(1, me.criterio, me.buscar);
                     me.mesnajeEliminar();
                    
                })
                .catch(function(error){
                    console.log(error);
                });
                
            },

           //////////////////////(Para las Modales Agregar y Registrar)
            abrirModal(accion,data=[]){
                switch (accion) {
                    case 'guardar':
                        this.titulo='Registrar Cliente'
                        this.accion=0;
                        this.limpiar();
                        break;

                    case 'editar':
                        this.titulo='Editar datos del Cliente'
                        this.accion=1;
                        this.idClin= data['id'];
                        this.nombre= data['nombre'];
                        this.apellido= data['apellido'];
                        this.ubicacion= data['ubicacion'];
                        this.telefono= data['telefono'];
                        this.correo= data['correo'];
                        break;
                
                    default:
                        break;
                }
                this.modal=1;
            },

            cerrarModal(){
                this.modal=0;
            },
            limpiar(){
                this.nombre='';
                this.apellido='';
                this.ubicacion='';
                this.telefono='';
                this.correo='';

            },
            
            mensajeRegistro(){
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Se guardo correctamente',
            showConfirmButton: false,
            timer: 1500
            })
            },

            mensajeActualizar(){
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Se actualizo correctamente',
            showConfirmButton: false,
            timer: 1500
            })
            },

            mesnajeEliminar(){
            Swal.fire({
            title: 'Esta Seguro?',
            text: "La accion sera irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#FF8B00',
            confirmButtonText: 'Eliminar'
            }).then((result) => {
            if (result.isConfirmed) {
            Swal.fire(
            'Eliminado!',
            'Fue eliminado correctamente.',
            'success'
             )
             }
             })
            }
        },

    computed: {
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
      }
        },
        mounted() {
            console.log('Component mounted.')
            this.listClin(1,this.criterio,this.buscar);
        }
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