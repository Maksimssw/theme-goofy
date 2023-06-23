<template>
    <footer id="footer">
        <div class="container">
            <p>Copyright © {{ new Date().getFullYear() }} 2NGeeks.pro. All Rights Reserved</p>
            <p v-if="getOptions">Version: {{ getOptions.version }}</p>
        </div>
    </footer>
</template>
<script>
export default {
    computed:{
        getOptions(){
            return this.$store.getters.GET_OPTIONS;
        }
    }
}
</script>