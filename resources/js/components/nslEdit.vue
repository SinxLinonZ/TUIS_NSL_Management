<template>
    <div>

        <a type="button" 
        data-toggle="modal" 
        data-target="#editIp" 
        href="#" 
        v-bind:id="'edit-' + tagid" 
        @click="editActive(tagid)"
        >Edit</a>

        &nbsp;
        <a type="button" 
        data-toggle="modal" 
        data-target="#delIp" 
        href="#" 
        v-bind:id="'del-' + tagid"
        @click="delActive(tagid)"
        >Delete</a>
            
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component myip action button mounted.')
        },

        props:['tagid'],

        methods: {
            editActive(tagid) {
                $("#edit-ip").val("172.22.1."+tagid);
                $("#edit-hostname").val(
                    document.getElementById('hostname-'+tagid).innerHTML
                );
            },


            delActive(tagid) {
                $("#del-ip").val("172.22.1."+tagid)
            },

        }
        
    }
</script>
