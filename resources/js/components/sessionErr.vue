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
                } else if (this.err == 'student-registered') {
                    this.repoenAddStudentModal()
                }
            },

            reopenAddIpModal() {
                $('#addIp').modal('show')
            },

            repoenAddStudentModal() {
                $('#addStudent').modal('show')
            }

            
        
        }
    }
</script>
