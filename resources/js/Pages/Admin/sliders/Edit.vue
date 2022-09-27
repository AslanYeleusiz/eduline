<template>

    <head>
        <title>Админ панель | Слайдер өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Слайдер № {{ slider.id }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a :href="route('admin.slider.index')">
                                <i class="fas fa-dashboard"></i>
                                Слайдер тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Слайдер № {{ slider.id }}
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="post" @submit.prevent="submit">
                    <div class="card-body">
                        <div class="form-group file-upload">
                            <label for="">Сурет</label>
                            <div class="ml-2">
                                <div class="ml-2">
                                    <label for="">RU</label>
                                    <br>
                                    <img v-if="slider.image && slider.image.ru && !image_ru.file" :src="route('index') +'/storage/images/sliders/'+ slider.image.ru" height="300" alt="" style="padding-bottom: 10px" />
                                    <img v-show="image_ru.preview" :src="image_ru.preview" height="300" style="padding-bottom: 10px" />
                                    <div class="file-input" style="margin-right: 10px">
                                        <input type="file" hidden name="image_ru" @change="handleImageRuUpload()" ref="image_ru" accept="image/jpeg,image/png" class="file" id="image_ru" />
                                        <label for="image_ru"> Загрузить </label>
                                    </div>
                                </div>
                                <div class="ml-2">
                                    <label for="Ru">KK</label>
                                    <br>
                                    <img v-if="slider.image.kk && !image_kk.file" :src="route('index')+'/storage/images/sliders/' +  slider.image.kk" height="300" alt="image" style="padding-bottom: 10px" />
                                    <img v-show="image_kk.preview" :src="image_kk.preview" height="300" style="padding-bottom: 10px" />
                                    <div class="file-input" style="margin-right: 10px">
                                        <input type="file" hidden name="image_kk" @change="handleImageKzUpload()" ref="image_kk" accept="image/jpeg,image/png" class="file" id="image_kk" />
                                        <label for="image_kk"> Загрузить </label>
                                    </div>
                                </div>
                            </div>

                            <validation-error :field="'image.kk'" />
                            <validation-error :field="'image.ru'" />
                        </div>

                        <div class="form-group mt-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" v-model="slider.in_app" value="0" @change="clearSetLink">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Сілтеме
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" v-model="slider.in_app" value="1" @change="clearSetLink">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Жеке кеңес сілтеме
                                </label>
                            </div>
                        </div>

                        <div v-if="slider.in_app==1" class="form-group">
                            <label for="">Сілтемені таңдаңыз</label>
                            <select class="form-control" v-model="slider.linkToAdvice" name="slider" required>
                                <option :value="null" hidden>Сілтемені таңдаңыз</option>
                                <option v-for="advice in personalAdvice" :value="advice.id" :key="'advice' + advice.id">
                                    {{ advice.title.kk }}
                                </option>
                            </select>
                            <validation-error :field="'link'" />
                        </div>
                        <div v-else class="form-group">
                            <label for="">Сілтемені енгізіңіз</label>
                            <input v-model="slider.link" type="text" class="form-control">
                            <validation-error :field="'link'" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-1">
                            Сақтау
                        </button>
                        <button type="button" class="btn btn-danger" @click.prevent="back()">
                            Артқа
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
    import AdminLayout from "../../../Layouts/AdminLayout.vue";
    import {
        Link,
        Head
    } from "@inertiajs/inertia-vue3";
    import Pagination from "../../../Components/Pagination.vue";
    import ValidationError from "../../../Components/ValidationError.vue";
    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

    export default {
        components: {
            AdminLayout,
            Link,
            Pagination,
            ValidationError,
            Head,
        },
        props: ["slider", "personalAdvice"],
        data() {
            return {
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                },
                image_ru: {
                    file: "",
                    preview: "",
                },
                image_kk: {
                    file: "",
                    preview: "",
                },
                setLink: 0,
            };
        },
        methods: {
            submit() {
                if (this.image_ru.file) {
                    this.slider.image.ru = this.image_ru.file;
                }
                if (this.image_kk.file) {
                    this.slider.image.kk = this.image_kk.file;
                }
                this.slider["_method"] = "put";
                this.$inertia.post(
                    route("admin.slider.update", this.slider.id),
                    this.slider, {
                        forceFormData: true,
                        // onError: () => console.log("An error has occurred"),
                        // onSuccess: () =>
                        //     console.log("The new contact has been saved"),
                    }
                );
            },
            clearSetLink() {
                this.slider.link = null
                this.slider.linkToAdvice = null
            },
            handleImageRuUpload() {
                this.image_ru.file = this.$refs.image_ru.files[0];
                if (this.image_ru.file) {
                    const reader = new FileReader();
                    reader.onloadend = (file) => {
                        this.image_ru.preview = reader.result;
                    };
                    reader.readAsDataURL(this.image_ru.file);
                    this.$refs.image_ru.value = "";
                } else {
                    this.slider.image.ru = "";
                    this.image_ru.file = "";
                    this.image_ru.preview = "";
                }
            },
            handleImageKzUpload() {
                this.image_kk.file = this.$refs.image_kk.files[0];
                if (this.image_kk.file) {
                    const reader = new FileReader();
                    reader.onloadend = (file) => {
                        this.image_kk.preview = reader.result;
                    };
                    reader.readAsDataURL(this.image_kk.file);
                    this.$refs.image_kk.value = "";
                } else {
                    this.slider.image.kk = "";
                    this.image_kk.file = "";
                    this.image_kk.preview = "";
                }
            },
        },
        mounted() {
            if(this.slider.link == null) this.setLink = 1;
            else this.setLink = 0;
            this.$refs.image_kk.value = "";
            this.$refs.image_ru.value = "";
            console.log(this.slider)
            console.log(this.personalAdvice)
        },
    };

</script>
<style lang="scss">
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        height: auto;
    }

    .file-upload {
        .file {
            opacity: 0;
            width: 0.1px;
            height: 0.1px;
        }

        .file-input label {
            width: 158px;
            height: 40px;
            border-radius: 5px;
            border-color: #ddd;
            background: #eee;
            box-shadow: 0 3px 4px rgb(0 0 0 / 40%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            cursor: pointer;
            transition: transform 0.2s ease-out;
        }

        input:hover+label,
        input:focus+label {
            transform: scale(1.02);
        }
    }

    /* Firefox */

</style>
