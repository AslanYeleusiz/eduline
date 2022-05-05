<template>
    <head>
        <title>Админ панель | Материалды өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Материал № {{ material.id }}</h1>
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
                            <a :href="route('admin.materials.index')">
                                <i class="fas fa-dashboard"></i>
                                Материалдар тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Материал № {{ material.id }}
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
                            <label for=""
                                >Автор
                                <Link
                                    class="ml-2"
                                    :href="
                                        route(
                                            'admin.users.edit',
                                            material.user.id
                                        )
                                    "
                                >
                                    <i class="fas fa-link"></i>
                                </Link>
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="material.user.full_name"
                                name="user_id"
                                placeholder="Автор"
                                disabled
                            />
                            <validation-error :field="'title'" />
                        </div>
                        <div class="form-group">
                            <label for="">Тақырыбы</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="material.title"
                                name="title"
                                placeholder="Тақырыбы"
                            />
                            <validation-error :field="'title'" />
                        </div>
                        <div class="form-group">
                            <label for="">Түсініктеме</label>
                            <textarea
                                class="form-control"
                                v-model="material.description"
                                placeholder="Түсініктеме"
                                name="description"
                                cols="30"
                                rows="5"
                            >
                            </textarea>
                            <validation-error :field="'description'" />
                        </div>

                        <div class="form-group">
                            <label for="">Пәні</label>
                            <select
                                class="form-control"
                                v-model="material.subject_id"
                                name="subject_id"
                            >
                                <option :value="null">Пәнін таңдаңыз</option>
                                <option
                                    :value="subject.id"
                                    v-for="subject in materialSubjects"
                                    :key="'subject' + subject.id"
                                >
                                    {{ subject.name }}
                                </option>
                            </select>
                            <validation-error :field="'subject_id'" />
                        </div>

                        <div class="form-group">
                            <label for="">Бағыты</label>
                            <select
                                class="form-control"
                                v-model="material.direction_id"
                                name="direction_id"
                            >
                                <option :value="null">Бағытын таңдаңыз</option>
                                <option
                                    :value="direction.id"
                                    v-for="direction in materialDirections"
                                    :key="'direction' + direction.id"
                                >
                                    {{ direction.name }}
                                </option>
                            </select>
                            <validation-error :field="'direction_id'" />
                        </div>

                        <div class="form-group">
                            <label for="">Сыныбы</label>
                            <select
                                class="form-control"
                                v-model="material.class_id"
                                name="class_id"
                            >
                                <option :value="null">Сыныбын таңдаңыз</option>
                                <option
                                    :value="classItem.id"
                                    v-for="classItem in materialClasses"
                                    :key="'classItem' + classItem.id"
                                >
                                    {{ classItem.name }}
                                </option>
                            </select>
                            <validation-error :field="'class_id'" />
                        </div>
                        <div class="form-group">
                            <label for="">Жүктелген уақыты</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="material.date"
                                name="date"
                                placeholder="Жүктелген уақыты"
                            />
                            <validation-error :field="'date'" />
                        </div>

                        <div class="form-group file-upload">
                            <label for="">Файл</label>
                            <div class="ml-2">
                                <p
                                    v-if="material.file_name && !file.file"
                                    v-html="material.file_name"
                                    style="padding-bottom: 10px"
                                ></p>
                                <p
                                    v-show="file.file"
                                    v-html="file.file.name"
                                    style="padding-bottom: 10px"
                                ></p>
                                <div
                                    class="file-input"
                                    style="margin-right: 10px"
                                >
                                    <input
                                        type="file"
                                        hidden
                                        name="file_name"
                                        @change="handleImageUpload()"
                                        ref="file"
                                        class="file"
                                        id="image"
                                    />
                                    <label for="image"> Загрузить </label>
                                </div>
                            </div>
                            <validation-error :field="'file_name'" />
                        </div>
                        <div class="form-group">
                            <label for="">Қаралым саны</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="material.view"
                                name="title"
                                placeholder="Қаралым саны"
                            />
                            <validation-error :field="'view'" />
                        </div>

                        <div class="form-group">
                            <label for="">Жүктеулер саны</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="material.download"
                                name="title"
                                placeholder="Жүктеулер саны"
                            />
                            <validation-error :field="'download'" />
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

export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        ValidationError,
        Head,
    },
    props: [
        "material",
        "materialClasses",
        "materialSubjects",
        "materialDirections",
    ],
    data() {
        return {
            file: {
                file: "",
            },
        };
    },
    methods: {
        submit() {
            if (this.file.file) {
                this.material.file_name = this.file.file;
            }
            this.material["_method"] = "put";
            this.$inertia.post(
                route("admin.materials.update", this.material.id),
                this.material,
                {
                    forceFormData: true,
                    onError: () => console.log("An error has occurred"),
                    onSuccess: (res) => {
                        this.file = {
                            file: "",
                        };
                        console.log("res", res);
                        console.log("The new contact has been saved");
                    },
                }
            );
        },
        handleImageUpload() {
            this.file.file = this.$refs.file.files[0];
            console.log("file.file0", this.file.file);
            if (this.file.file) {
                this.$refs.file.value = "";
            } else {
                this.material.file_name = "";
                this.file.file = "";
            }
        },
    },
    mounted() {
        // this.$refs.file.value = "";
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
