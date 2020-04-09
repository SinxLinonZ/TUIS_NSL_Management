<template>

</template>

<script>
    export default {
        mounted() {
            console.log('Component nslOverview mounted.')
            this.changeOverviewTable()
        },

        props:['registeredips', 'ipusers'],

        methods: {
            changeOverviewTable() {
                var ips = this.registeredips.split(',');
                var users = this.ipusers.split(',');
                ips.pop();
                users.pop();
                
                ips.forEach((ip, index) => {
                    document.getElementById('ip-'+ip).classList.add('table-primary')
                    document.getElementById('ip-'+ip).setAttribute(
                        "title",
                        "IP: 172.22.1." + ip +
`
`+
                        "使用者: " + users[index]
                    ); 
                });

            }
        
        }
    }
</script>
