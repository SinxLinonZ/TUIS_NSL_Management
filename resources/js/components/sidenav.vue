<template>

    <nav class="navbar bg-light">

        <!-- Links -->
        <ul class="navbar-nav">
            
            <li class="nav-item">
                <a class="nav-link" id="home" v-bind:href="home">Home</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="nsl" v-bind:href="nsl">NSL Detail</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="myip" v-bind:href="myip">My IPs</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="profile" v-bind:href="profile">Profile</a>
            </li>
            
            <hr>
            
            <li class="nav-item">
                <a class="nav-link" id="admin-ipm" v-bind:href="admin_ipm">IP Addr.s Management</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="admin-stum" v-bind:href="admin_stum">Students Management</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="admin-sysm" v-bind:href="admin_sysm">System Properties</a>
            </li>

        </ul>

    </nav>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            this.initnav()
        },

        methods: {
            initnav() {
                var currentUrl = window.location.pathname;

                for (const url in this.$data) {
                    if (this.$data.hasOwnProperty(url) && this.$data[url] == currentUrl) {
                        this.$data[url] = '#';
                        document.getElementById(url).innerHTML = "<strong>" + document.getElementById(url).innerHTML + "</strong>";
                        document.getElementById(url).classList.add('text-dark');
                    }
                }


            }
        },

        data() {
            return {
                home: "/home",
                nsl: "/home/nsl",
                myip: "/home/myip",
                profile: "/home/profile",
                admin_ipm: "/home/admin/ipm",
                admin_stum: "/home/admin/stum",
                admin_sysm: "/home/admin/sysm",
            }
        }
    }
</script>
