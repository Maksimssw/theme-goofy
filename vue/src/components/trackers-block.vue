<template>
    <div v-if="getOptions" id="trackers-block">
        <div class="row">
            <h5 class="title">Поддерживаемые трекеры</h5>
            <div class="line">
                <span v-for="item in getOptions.trackers.split(',')" :key="item">
                   {{ trackers[item] }}<sup>({{ item }})</sup>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            trackers:{
                fbq: "FaceBook",
                ttq: "TikTok",
                snaptr: "SnapChat",
                gtag: "Google Tag",
                vk: "VK"
            }
        }
    },
    computed: {
        getOptions() {
            return this.$store.getters.GET_OPTIONS;
        }
    },
}
</script>