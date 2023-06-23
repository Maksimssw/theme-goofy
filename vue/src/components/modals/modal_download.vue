<template>
    <div class="app-block" id="moad">
        <div class="row">
            <h5 class="title">Выбрать шаблон для скачивания</h5>
            <div class="line">
                <div class="select w100" v-if="getTemplates">
                    <select v-model="template">
                        <option v-for="item in getTemplates" :key="item" :value="item">{{ item }}</option>
                    </select>
                    <div class="border"></div>
                </div>
                <button class="button border-only" @click="getFile(template)">
                    <i class="material-icons-outlined">download</i>
                </button>
            </div>
            
        </div>
    </div>
</template>
<script>

import axios from 'axios';

export default {
    props: ['data'],
    data() {
        return {
            template: this.data.current
        }
    },
    computed: {
        getTemplates() {
            return this.$store.getters.GET_TEMPLATES;
        }
    },
    created(){
        this.$store.dispatch("LOAD_TEMPLATES").catch(error => {
            console.log(error);
        });
    },
    methods:{
        getFile(file_name) {
            axios({
                url: `/api/download?template_name=${file_name}`,
                method: 'GET',
                responseType: 'blob',
            }).then((response) => {
                const href = URL.createObjectURL(response.data);
                const link = document.createElement('a');
                link.href = href;
                link.setAttribute('download', `${file_name}.zip`);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(href);
            });
        }
    }
}
</script>