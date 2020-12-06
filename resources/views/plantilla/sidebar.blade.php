<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="main.html"><i class="fa fa-cog"></i> Panel de Control</a>
                    </li>
                    <li class="nav-title">
                      Datos Generales
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-inbox"></i>MERCANCIA</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item" @click="menu=1">
                                <a class="nav-link" href="#"><i class="fa fa-truck"></i>Entrada Inventario</a>
                            </li>
                            <li class="nav-item" @click="menu=3">
                                <a class="nav-link" href="#"><i class="fa fa-cube"></i>Productos</a>
                            </li>
                            <li class="nav-item" @click="menu=11">
                                <a class="nav-link" href="#"><i class="fa fa-cubes"></i>Insumos</a>
                            </li>
                            <li class="nav-item" @click="menu=2">
                                <a class="nav-link" href="#"><i class="fa fa-tags"></i>Tipos de Insumos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-pie-chart"></i>Arreglo</a>
                            </li>
                            
                            
                          
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user-circle-o"></i>EMPLEADOS</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item" @click="menu=4">
                                <a class="nav-link" href="#"><i class="fa fa-address-card-o"></i>Datos de Empleados</a>
                            </li>
                            <li class="nav-item" @click="menu=5">
                                <a class="nav-link" href="#"><i class="fa fa-wrench"></i>Cargo por Empleado</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-usd"></i>VENTAS</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item" @click="menu=6">
                                <a class="nav-link" href="#"><i class="fa fa-motorcycle"></i>Pedido</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-pencil-square-o"></i>Factura</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user-o"></i>CLIENTES</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item" @click="menu=8">
                                <a class="nav-link" href="i#"><i class="fa fa-address-card"></i>Datos de Cliente</a>
                            </li>
                        </ul>
                    </li>
                    
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>