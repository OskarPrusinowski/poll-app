<template>
    <div>
        <div class="links" style="text-align:center;">
                    <div class="users" style="display: inline-block;">
                        <router-link to="/user/list">Users</router-link>
                    </div>
                    <div class="companys" style="display: inline-block;">
                        <router-link to="/company/list">Companys</router-link>
                    </div>
                </div>
                <router-view></router-view>
    </div>
</template>

<script>
export default {
    
}
</script>