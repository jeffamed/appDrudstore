<template>
    <nav>
        <ul class="pagination">
            <li class="page-item" v-for="page in pagination.last_page">
                <router-link :to="{ name: 'presentation', query : { page : page } }"  class="page-link" >{{ page }}</router-link>
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
    },
}
</script>

<style scoped>

</style>
