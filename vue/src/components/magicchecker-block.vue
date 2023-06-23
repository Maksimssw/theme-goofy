<template>
    <div v-if="getCampaigns">
        <div class="row">
            <h5 class="title">MagicChecker</h5>
            <div class="line" v-for="(item, index) in campaigns" :key="index">
                <div class="input" :class="{ disabled: getCampaigns.find(el => el.key == campaigns[index].key)}">
                    <input type="text"  v-model.trim="campaigns[index].key" placeholder="UTM" @change="checkKey">
                    <div class="border"></div>
                </div>
                <div class="input w100">
                    <input type="text" v-model.trim="campaigns[index].value" placeholder="Campaign ID">
                    <div class="border"></div>
                </div>
                <button class="button border-only" @click="campaigns.splice(index, 1);">
                    <i class="material-icons-outlined">delete</i>
                </button>
            </div>
            <div class="line" v-if="!campaigns[0]">
                <p>Список кампаний пуст</p>
            </div>
        </div>
        <div class="row btns">
            <button class="button blue" @click="addNew">Добавить новую</button>
            <button class="button" @click="saveCampaigns">Сохранить</button>
        </div>
    </div>
</template>
<script>

export default {
    data() {
        return {
            campaigns: []
        }
    },
    computed: {
        getCampaigns() {
            return this.$store.getters.GET_MC;
        },
    },
     created() {
        this.$store.dispatch("LOAD_MC").then(()=>{
            this.campaigns = Object.assign([], this.$store.state.MagicChecker.campaigns);
        });
    },
    methods:{
        addNew() {
            if(!this.campaigns.find(item => item.key == "")){
                this.campaigns.push({ key: "", value: "" });
            }
        },
        checkKey(e){
            if(this.campaigns.filter(item => item.key == e.target.value).length>1){
                alert('Ключ "' + e.target.value + '" уже используется');
            }
        },
        saveCampaigns(){
            for (let i = 0; i < this.campaigns.length; i++) {
                if( this.campaigns.filter(item => item.key == this.campaigns[i].key).length > 1){
                    alert('Ошибка обновления кампаний. Обнаружены одинаковые UTM кампаний.');
                    return;                       
                }
            }
            this.$store.dispatch('UPDATE_MC', this.campaigns).then(()=>{
                alert("Кампании были успешно обновлены!");
            });
        }
    }
}
</script>