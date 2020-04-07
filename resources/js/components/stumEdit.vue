<template>
    <div>

        <a
        :href="'/admin/stum/' + studentname" 
        v-bind:id="'edit-' + studentname">
        Details</a>

        &nbsp;
        <a type="button" 
        data-toggle="modal" 
        data-target="#delStudent" 
        href="#" 
        v-bind:id="'del-' + studentname"
        @click="delActive(studentname)">
        Delete</a>
            
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component myip action button mounted.')
        },

        props:['studentname'],

        methods: {
            delActive(studentname) {
                $("#del-student").val(studentname)
            }
        }
        
    }
</script>
