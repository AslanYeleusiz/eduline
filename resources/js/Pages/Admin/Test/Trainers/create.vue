<template>
   <head>
        <title>Админ панель | Тренерлермен дайындық қосу</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
              <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Тренерлермен дайындық қосу</h1>
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
                            <a :href="route('admin.test.classes.index')">
                                <i class="fas fa-dashboard"></i>
                                Тренерлермен дайындық тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Тренерлермен дайындық қосу</li>
                    </ol>
                </div>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="post" @submit.prevent="submit">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Пәні (қазақша)</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="trainerItem.subject.kk"
                                name="subject_kk"
                                placeholder="Пәнді енгізіңіз"
                            />
                            <validation-error :field="'subject.kk'" />
                        </div>
                        <div class="form-group">
                            <label for="">Пәні (орысша)</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="trainerItem.subject.ru"
                                name="subject_ru"
                                placeholder="Пәнді енгізіңіз"
                            />
                            <validation-error :field="'subject.ru'" />
                        </div>
                        <div class="form-group">
                            <label for="">Бағасы</label>
                            <input
                                type="number"
                                class="form-control"
                                v-model="trainerItem.price"
                                name="price"
                                placeholder="Бағасын енгізіңіз"
                            />
                            <validation-error :field="'price'" />
                        </div>

                        <div class="form-group">
                            <label for="">Түсініктеме</label>

                            <div class="ml-2">
                                <div class="form-group">
                                    <label for="">KK</label>
                                     <ckeditor
                                        :editor="editor"
                                        v-model="trainerItem.description.kk"
                                        :config="editorConfig"
                                    ></ckeditor>
                                    <validation-error
                                        :field="'description.kk'"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="">RU</label>
                                    <ckeditor
                                        :editor="editor"
                                        v-model="trainerItem.description.ru"
                                        :config="editorConfig"
                                    ></ckeditor>
                                    <validation-error
                                        :field="'description.ru'"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Бөліп төлеу</label>
                            <select class="form-control" v-model="trainerItem.installments" name="slider" required>
                                <option value=null hidden>Бөліп тәсілін таңдаңыз</option>
                                <option value="0">Бөліп төлеусіз</option>
                                <option value="3">3 ай</option>
                                <option value="6">6 ай</option>
                                <option value="9">9 ай</option>
                                <option value="12">12 ай</option>
                            </select>
                            <validation-error :field="'installments'" />
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    v-model="trainerItem.is_active"
                                    class="custom-control-input"
                                    id="customSwitch2"
                                />
                                <label
                                    class="custom-control-label"
                                    for="customSwitch2"
                                    >Белсенді ({{
                                        trainerItem.is_active ? "Иә" : "Жоқ"
                                    }})</label
                                >
                            </div>
                            <validation-error :field="'is_discount'" />
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
import AdminLayout from "../../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../../Components/Pagination.vue";
import ValidationError from "../../../../Components/ValidationError.vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";


export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        ValidationError,
        Head
    },
    data() {
        return {
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },
            trainerItem: {
                subject: {
                    kk: '',
                    ru: '',
                },
                price: null,
                description: {
                    kk: '',
                    ru: '',
                },
                installments: null,
                is_active: 0,
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.post(
                route("admin.test.trainers.store"),
                this.trainerItem,
                {
                    onError: () => console.log("An error has occurred"),
                    onSuccess: () =>
                        console.log("The new contact has been saved"),
                }
            );
        },
    },
};
</script>
