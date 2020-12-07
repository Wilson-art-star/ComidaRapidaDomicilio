@extends('principal')
@section('contenido')

@if (Auth::check())

<template v-if="menu==1">

<entradainventario></entradainventario>

</template>

<template v-if="menu==11">

<insumo></insumo>

</template>

<template v-if="menu==2">

<tipoinsumo></tipoinsumo>

</template>

<template v-if="menu==3">

<producto></producto>

</template>

<template v-if="menu==4">

<empleado></empleado>

</template>


<template v-if="menu==5">

<cargo></cargo>

</template>

<template v-if="menu==6">

<pedido></pedido>

</template>

<template v-if="menu==7">

<factura></factura>

</template>

<template v-if="menu==8">

<cliente></cliente>

</template>

@endif







@endsection