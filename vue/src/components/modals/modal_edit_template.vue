<template>
    <div class="app-block">
        <div class="row">
            <h5 class="title">Выбрать шаблон</h5>
            <div class="select">
                <select v-model="template">
                    <option v-for="item in getTemplates" :key="item" :value="item">{{item}}</option>
                </select>
                <div class="border"></div>
            </div>
        </div>
        <div class="row">
            <h5 class="title">Загрузить шаблон</h5>
            <div class="upload">
                <div class="dragdrop" ref="filedrag" :class="{selected: file}">
                    <span class="close" @click="resetFile">
                        <i></i>
                        <i></i>
                    </span>
                    <div class="icon">
                        <i class="material-icons-outlined">folder_zip</i>
                        <span v-if="file" v-text="file.name"></span>
                        <span v-else>Drag & Drop File here to upload</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row btns">
            <input type="file" ref="file" accept=".zip" @change="handleFileUpload()" style="display: none" />
            <button class="button blue" @click="submitFile()" :class="{noactive: uploading}">
                    <span v-show="!uploading" v-text="(file ? 'Загрузить' : 'Выбрать') + ' файл'"></span>
                    <div v-if="uploading" class="small-loader"></div>
            </button>
            <button class="button" @click="saveData" :class="{disabled: data.current == template}">Сохранить</button>
        </div>
    </div>
</template>
<script>

import axios from 'axios';

export default {
    props:['data'],
    data() {
        return {
            template: this.data.current,
            dragAndDropCapable: false,
            file: null,
            uploading: false
        }
    },
    computed:{
        getTemplates() {
            return this.$store.getters.GET_TEMPLATES;
        }
    },
    watch: {
        template(){
            this.$emit('confirm', {
                confirm: true
            });
        }
    },
    created() {
        this.$store.dispatch("LOAD_TEMPLATES").catch(error => {
            console.log(error);
        });
    },
    mounted(){
        this.dragAndDropCapable = this.determineDragAndDropCapable();
        if (this.dragAndDropCapable) {
            ['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'].forEach(function (evt) {
                this.$refs.filedrag.addEventListener(evt, function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                }.bind(this), false);
            }.bind(this));

            ['dragenter', 'dragover'].forEach(function (event) {
                this.$refs.filedrag.addEventListener(event, () => {
                    this.$refs.filedrag.classList.add('highlight');
                }, false)
            }.bind(this));
            ['dragleave', 'drop'].forEach(function (event) {
                this.$refs.filedrag.addEventListener(event, () => {
                    this.$refs.filedrag.classList.remove('highlight')
                }, false)
            }.bind(this));

            this.$refs.filedrag.addEventListener('drop', function (e) {
                if (e.dataTransfer.files[0].type == 'application/zip') {
                    this.file = e.dataTransfer.files[0];
                } else {
                    alert('Неподерживаемый формат файла. Выберете другой файл для загрузки');
                }
            }.bind(this));
        }
    },
    methods:{
        eventClose(){
            this.$emit('close', {
                active: false
            })
        },
        saveData(){
            if(this.template != this.data.current){
                this.$store.dispatch('UPDATE_OPTIONS', {template: this.template}).then(()=>{
                    this.eventClose();
                });
            }
        },
        determineDragAndDropCapable() {
            var div = document.createElement('div');
            return (('draggable' in div)
                || ('ondragstart' in div && 'ondrop' in div))
                && 'FormData' in window
                && 'FileReader' in window;
        },
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        },
        submitFile() {
            if (this.file) {
                this.uploading = true;
                let formData = new FormData();
                formData.append('file', this.file);
                axios.post(`/api/upload?template_name=${this.file.name.split(".zip")[0]}`,
                    formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                ).then(() => {
                    this.$store.dispatch('LOAD_TEMPLATES');
                    this.file = null;
                    this.uploading = false;
                    alert("Шаблон был успешно загружен.");
                }).catch(error => {
                    this.uploading = false;
                    switch (error.response.status) {
                        case 409:
                            alert("[409] Ошибка загрузки. Шаблон с таким именем уже существует.");
                            break;
                        case 406:
                            alert ("[406] Ошибка файла. Архив пустой.")
                            break;
                        case 415:
                            alert("[415] Ошибка загрузки. Неподходящий формат файла.");
                            break;
                        default:
                            console.log(error.message);
                    }
                });
            } else {
                this.$refs.file.click()
            }
        },
        resetFile(){
            this.file = null;
        }
    }
}
</script>