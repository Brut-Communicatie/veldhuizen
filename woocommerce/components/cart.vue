<template>
    <div>
        <div class="hello">Hello {{who}}</div>
        <div v-if="data">
            {{data}}
        </div>
        <div v-else>
            Loading producten..
        </div>
    </div>
</template>

<script>
module.exports = {
    data: function() {
        return {
            who: 'Andres',
            data: null
        }
    },
    created () {
        this.fetchApi();
    },
    methods: {
        fetchApi() {
            var myHeaders = new Headers();
            myHeaders.append("Authorization", "Basic Y2tfODU5Mzg4MDMxNjk1YjM3ODVlZDJmNTI5Mzc1ZmVjMjIzOTYwMzg4ODpjc181MmQxOWVmOGI3ZDc4OWIzYTFkYjI5NDM1MGI1MGY0OGZhMDRkNjlk");

            const url = "https://veldhuizen.local/wp-json/wc/v3/products?consumer_key=ck_7751b29fe89c4d4936462bc3c144b4ba14bcc2c3&consumer_secret=cs_abdfc32414741555a838a11427a5068128154145"
            fetch(url)
            .then(res => res.json())
            .then(result => this.data = result)
        }
    }
}
</script>

<style scoped>
.hello {
    background-color: #ffe;
}
</style>