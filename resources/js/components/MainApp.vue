<template>
    <div id="main">
        <Nav />
        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
import Nav from "./Nav.vue";
export default {
    name: "main-app",
    components: { Nav }
};
</script>
