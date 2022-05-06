<template>
    <head>
        <title>Админ панель | Жаңалық өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жаңалық № {{ news.id }}</h1>
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
                            <a :href="route('admin.news.index')">
                                <i class="fas fa-dashboard"></i>
                                Жаңалықтар тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Жаңалық № {{ news.id }}
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="post" @submit.prevent="submit">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Тақырыбы</label>
                            <div class="ml-2">
                                <div class="form-group">
                                    <label for="">KK</label>
                                    <div class="ml-2"></div>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="news.title.kk"
                                        name="title"
                                        placeholder="Тақырыбы"
                                    />
                                    <validation-error :field="'title.kk'" />
                                </div>

                                <div class="form-group">
                                    <label for="">RU</label>
                                    <div class="ml-2"></div>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="news.title.ru"
                                        name="title"
                                        placeholder="Тақырыбы"
                                    />
                                    <validation-error :field="'title.ru'" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Қысқаша түсініктеме</label>
                            <div class="ml-2">
                                <div class="form-group">
                                    <label for="">KK</label>
                                    <!-- <textarea
                                        class="form-control"
                                        v-model="news.short_description.kk"
                                        placeholder="Қысқаша түсініктеме"
                                        name="short_description"
                                        cols="30"
                                        rows="5"
                                    >
                                    </textarea> -->
                                    <ckeditor
                                        :editor="editor"
                                        v-model="news.short_description.kk"
                                        :config="editorConfig"
                                    ></ckeditor>

                                    <validation-error
                                        :field="'short_description.kk'"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="">RU</label>
                                  <ckeditor
                                        :editor="editor"
                                        v-model="news.short_description.ru"
                                        :config="editorConfig"
                                    ></ckeditor>

                                    <validation-error
                                        :field="'short_description.ru'"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Түсініктеме</label>

                            <div class="ml-2">
                                <div class="form-group">
                                    <label for="">KK</label>
                                     <ckeditor
                                        :editor="editor"
                                        v-model="news.description.kk"
                                        :config="editorConfig"
                                    ></ckeditor>
                                    <validation-error
                                        :field="'description.kk'"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="">RU</label>                                     <ckeditor
                                        :editor="editor"
                                        v-model="news.description.ru"
                                        :config="editorConfig"
                                    ></ckeditor>
                                    <validation-error
                                        :field="'description.ru'"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Бағыты</label>
                            <select
                                class="form-control"
                                v-model="news.news_types_id"
                                name="news_types_id"
                                required
                            >
                                <option :value="null">Бағытын таңдаңыз</option>
                                <option
                                    :value="newsType.id"
                                    v-for="newsType in newsTypes"
                                    :key="'newsType' + newsType.id"
                                >
                                    {{ newsType.name.kk }}
                                </option>
                            </select>
                            <validation-error :field="'news_types_id'" />
                        </div>
                        <div class="form-group file-upload">
                            <label for="">Сурет</label>
                            <div class="ml-2">
                                <div class="ml-2">
                                    <label for="">RU</label>
                                    <br />
                                    <img
                                        v-if="
                                            news.image &&
                                            news.image.ru &&
                                            !image_ru.file
                                        "
                                        :src="
                                            route('index') +
                                            '/storage/images/news/' +
                                            news.image.ru
                                        "
                                        height="300"
                                        alt=""
                                        style="padding-bottom: 10px"
                                    />
                                    <img
                                        v-show="image_ru.preview"
                                        :src="image_ru.preview"
                                        height="300"
                                        style="padding-bottom: 10px"
                                    />
                                    <div
                                        class="file-input"
                                        style="margin-right: 10px"
                                    >
                                        <input
                                            type="file"
                                            hidden
                                            name="image_ru"
                                            @change="handleImageRuUpload()"
                                            ref="image_ru"
                                            accept="image/jpeg,image/png"
                                            class="file"
                                            id="image_ru"
                                        />
                                        <label for="image_ru">
                                            Загрузить
                                        </label>
                                    </div>
                                </div>
                                <div class="ml-2">
                                    <label for="Ru">KK</label>
                                    <br />
                                    <img
                                        v-if="news.image.kk && !image_kk.file"
                                        :src="
                                            route('index') +
                                            '/storage/images/news/' +
                                            news.image.kk
                                        "
                                        height="300"
                                        alt="image"
                                        style="padding-bottom: 10px"
                                    />
                                    <img
                                        v-show="image_kk.preview"
                                        :src="image_kk.preview"
                                        height="300"
                                        style="padding-bottom: 10px"
                                    />
                                    <div
                                        class="file-input"
                                        style="margin-right: 10px"
                                    >
                                        <input
                                            type="file"
                                            hidden
                                            name="image_kk"
                                            @change="handleImageKzUpload()"
                                            ref="image_kk"
                                            accept="image/jpeg,image/png"
                                            class="file"
                                            id="image_kk"
                                        />
                                        <label for="image_kk">
                                            Загрузить
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <validation-error :field="'image.kk'" />
                            <validation-error :field="'image.ru'" />
                        </div>
                        <div class="form-group">
                            <label for="">Қаралым саны</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="news.view"
                                name="view"
                                placeholder="Қаралым саны"
                            />
                            <validation-error :field="'view'" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-1">
                            Сақтау
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click.prevent="back()"
                        >
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
import { Link, Head } from "@inertiajs/inertia-vue3";
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
    props: ["newsTypes", "news"],
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
        };
    },
    methods: {
        getStatus(status) {
            if (!status) {
                return "Қаралмаған";
            }
            if (status == 1) {
                return "Қабылданбады";
            }
            if (status == 2) {
                return "Қабылданды";
            }
            return "Анықталмаған";
        },
        submit() {
            if (this.image_ru.file) {
                this.news.image.ru = this.image_ru.file;
            }
            if (this.image_kk.file) {
                this.news.image.kk = this.image_kk.file;
            }
            this.news["_method"] = "put";
            this.$inertia.post(
                route("admin.news.update", this.news.id),
                this.news,
                {
                    forceFormData: true,
                    // onError: () => console.log("An error has occurred"),
                    // onSuccess: () =>
                    //     console.log("The new contact has been saved"),
                }
            );
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
                this.news.image.ru = "";
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
                this.news.image.kk = "";
                this.image_kk.file = "";
                this.image_kk.preview = "";
            }
        },
    },
    mounted() {
        this.$refs.image_kk.value = "";
        this.$refs.image_ru.value = "";
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
    input:hover + label,
    input:focus + label {
        transform: scale(1.02);
    }
}
/* Firefox */
</style>
