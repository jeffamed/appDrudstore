<template>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item" v-text="divisor"></li>
        <li class="breadcrumb-item" v-text="folder"></li>
        <li class="breadcrumb-item active" v-show="subfolder != ''" v-text="subfolder"></li>
    </ol>
</template>

<script>
export default {
    name: "BreadcrumbComponent",
    props: {
      divisor : {
         type: String,
         default: 'Mantenimiento'
      } ,
      folder : {
          type: String,
      },
      subfolder : {
          type: String,
          default: ''
      }
    }
}
</script>

<style scoped>

</style>
