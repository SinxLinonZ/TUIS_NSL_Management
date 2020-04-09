<template>

    <nav class="navbar bg-light">

        <!-- Links -->
        <ul class="navbar-nav">
            
            <li class="nav-item">
                <a class="nav-link" id="home" v-bind:href="home">ホーム</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="nsl" v-bind:href="nsl">NSL 明細</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="myip" v-bind:href="myip">私のIP</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="profile" v-bind:href="profile">プロフィール編集</a>
            </li>
            
            <hr>
            
            <li class="nav-item">
                <a class="nav-link" id="admin_stum" v-bind:href="admin_stum">学生管理</a>
            </li>
            
<!--
            <li class="nav-item">
                <a class="nav-link" id="admin-sysm" v-bind:href="admin_sysm">System Properties</a>
            </li>
-->
        </ul>

    </nav>

</template>

<script>
    export default {
        mounted() {
            console.log('Component sidenav mounted.')
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
                admin_stum: "/admin/stum",
//                admin_sysm: "/home/admin/sysm",
//                admin_stum: "#",
//                admin_sysm: "#",
            }
        }
    }
</script>
