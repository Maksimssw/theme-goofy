<template>
    <div id="app">
        <Header />
        <main id="content">
            <div class="wrap">
                <options_block class="app-block"/>
                <mc_block class="app-block"/>
                <trackers_block class="app-block"/>
            </div>
        </main>
        <Footer />
        <transition name="fade">
            <Overlay v-if="modalData" :modal="modalData" />
        </transition>
        <transition name="fade">
            <Preloader v-if="!dataLoaded" />
        </transition>
    </div>
</template>

<script>

import Header from './components/layout/Header.vue';
import Footer from './components/layout/Footer.vue';
import Overlay from './components/Overlay.vue';

import options_block from './components/options-block.vue';
import trackers_block from './components/trackers-block.vue';
import mc_block from './components/magicchecker-block.vue';

export default {
    name: 'App',
    components: {
        Header, Footer, Overlay, options_block, trackers_block, mc_block
    },
    data() {
        return {
            dataLoaded: false
        }
    },
    computed: {
        modalData() {
            return this.$store.getters.MODAL;
        },
    },
    mounted() {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches && (!localStorage.getItem('theme') || localStorage.getItem('theme') == 'dark')) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
        setTimeout(() => this.dataLoaded = true, 500);
    },
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-active {
    transition-delay: 0.2s;
}

.fade-enter,
.fade-leave-active {
    opacity: 0;
}
</style>

