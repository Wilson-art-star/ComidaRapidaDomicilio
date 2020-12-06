@extends('principal')
@section('contenido')

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

<template v-if="menu==8">

<cliente></cliente>

</template>





@endsection