<template>
    <nav>
        <ul class="pagination">
            <li class="page-item" v-for="page in pagination.last_page">
                <router-link :to="{ name: `${name}`, query : { page : page } }"  class="page-link" >{{ page }}</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "PaginationComponent",
    props: {
        pagination : {
            type: Object,
            default: []
        },
        name : {
            type: String
        }
    },
}
</script>

<style scoped>
    .pagination a.router-link-exact-active{
        color: #fff;
        background-color: #20a8d8;
        border-color: #20a8d8;
    }
</style>
