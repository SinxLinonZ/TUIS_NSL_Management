<template>
    
</template>

<script>
    export default {
        mounted() {
            console.log('Error Session Detected')
            this.detect()
        },

        props:['err'],

        methods: {

            detect() {
                if (this.err == 'ip-addr' || this.err == 'ip-registered') {
                    this.reopenAddIpModal()
                } else if (this.err == 'del-err') {
                    this.reopenDelIpModal()
                } else if (this.err == 'edit-err') {
                    this.reopenEditIpModal()
                }
            },

            reopenAddIpModal() {
                $('#addIp').modal('show')
            },

            reopenDelIpModal() {
                $('#delIp').modal('show')
            },
            
            reopenEditIpModal() {
                $('#editIp').modal('show')
            }
        
        }
    }
</script>
