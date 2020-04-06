<template>
    <div class="container">
        <h6 id="datetime">--/--/----, --:--:-- --</h6>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            this.getTime()
        },

        methods: {
            getTime() {
                setInterval("document.getElementById('datetime').innerHTML=new Date().toLocaleString();", 1000);
            }
        }
        
    }
</script>
