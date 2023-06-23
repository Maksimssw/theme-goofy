<template>
    <div id="overlay" @click="checkClick">
        <div class="modal" ref="wrap" :id="modal.type">
            <component :is="`modal_${modal.type}`" :data="modal.data" @confirm="confirmModal" @close="closeModal"></component>
        </div>
    </div>
</template>

<script lang="js">

import modal_edit_template from "@/components/modals/modal_edit_template.vue";
import modal_download from "@/components/modals/modal_download.vue";

export default {
    props: ['modal'],
    data() {
        return {
            active: false,
            confirm: false
        }
    },
    components: {
        modal_edit_template, modal_download
    },
    methods:{
        closeOverlay(){
            this.$store.dispatch('INIT_MODAL', null);
        },
        checkClick(e){
            if(this.$store.getters.MODAL){
                if(!this.$refs.wrap.contains(e.target)){
                    if(this.confirm){
                        if (confirm("Данные, которые вы ввели, не сохранятся. Вы уверены, что хотите закрыть окно?") == true) {
                            this.closeOverlay();
                        }
                    }else{
                        this.closeOverlay();
                    }
                }
            }
        },
        confirmModal(data){
            if(data.confirm) this.confirm = true;
        },
        closeModal(data){
            if(!data.active){
                this.closeOverlay();
            }
        }
    }
}
</script>