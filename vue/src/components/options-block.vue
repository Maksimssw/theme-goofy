<template>
    <div v-if="getOptions">
        <div class="row">
            <h5 class="title">Ключ доступа к API</h5>
            <div class="line">
                <div class="input w100">
                    <input type="text" v-model.trim="api_key" @change="updateKey">
                    <div class="border"></div>
                </div>
                <button class="button border-only" @click="updateKey">
                    <i class="material-icons-outlined">refresh</i>
                </button>
            </div>
        </div>
        <div class="row">
            <h5 class="title">UTM метка для активации кампании</h5>
            <div class="input">
                <input type="text" v-model.trim="utm_key" @change="updateUTM">
                <div class="border"></div>
            </div>
        </div>
        <div class="row">
            <h5 class="title">Активный шаблон</h5>
            <div class="line">
                <div class="input disabled w100">
                    <input type="text" :value="getOptions.template">
                    <div class="border"></div>
                </div>
                <div class="btns">
                    <button class="button border-only" @click="$store.dispatch('INIT_MODAL', { type: 'download', data: { current: getOptions.template } })">
                        <i class="material-icons-outlined">download</i>
                    </button>
                    <button class="button border-only"
                        @click="$store.dispatch('INIT_MODAL', { type: 'edit_template', data:{current: getOptions.template} })">
                        <i class="material-icons-outlined">edit</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            api_key: "",
            utm_key: ""
        }
    },
    computed: {
        getOptions() {
            return this.$store.getters.GET_OPTIONS;
        }
    },
    created() {
        this.$store.dispatch("LOAD_OPTIONS").then(() => {
            this.api_key = this.getOptions.api_key;
            this.utm_key = this.getOptions.utm_key;
        }).catch(error => {
            console.log(error);
        });
    },
    methods: {
        generateUUID() {
            var d = new Date().getTime();
            if (window.performance && typeof window.performance.now === "function") {
                d += performance.now();
            }
            var uuid = 'xxxxxxxx-xxxx-xxxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
                var r = (d + Math.random() * 16) % 16 | 0;
                d = Math.floor(d / 16);
                return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
            });

            this.api_key = uuid;
        },
        updateKey(){
            if(confirm('Вы уверены, что хотите обновить ключ доступа?') == true){
                this.generateUUID();
                this.$store.dispatch("UPDATE_OPTIONS", {api_key: this.api_key});
            }else{
                this.api_key = this.getOptions['api_key']
            }
        },
        updateUTM(){
            if (confirm('Вы уверены, что хотите изменить UTM метку? Ссылки со старой меткой перестануть работать.') == true) {
                this.$store.dispatch("UPDATE_OPTIONS", { utm_key: this.utm_key });
            } else {
                this.utm_key = this.getOptions['utm_key']
            }
        }
        
    }
}
</script>