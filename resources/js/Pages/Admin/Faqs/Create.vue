<template>
  <head>
        <title>Админ панель | Жиі қойылатын сұрақ қосу</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жиі қойылатын сұрақ қосу</h1>
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
                                Жиі қойылатын сұрақтар тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Жиі қойылатын сұрақ қосу
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
                            <label for="">Сұрақ(қазақша)</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="faq.question.kk"
                                name="question_kk"
                                placeholder="Сұрақ"
                            />
                            <validation-error :field="'question'" />
                        </div>
                        <div class="form-group">
                            <label for="">Сұрақ(орысша)</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="faq.question.ru"
                                name="question_ru"
                                placeholder="Вопрос"
                            />
                            <validation-error :field="'question'" />
                        </div>

                        <div class="form-group">
                            <label for="">Жауап(қазақша)</label>
                            <textarea
                                class="form-control"
                                v-model="faq.answer.kk"
                                placeholder="Жауап"
                                name="answer_kk"
                                cols="30"
                                rows="5"
                            >
                            </textarea>
                            <validation-error :field="'answer'" />
                        </div>
                        <div class="form-group">
                            <label for="">Жауап(орысша)</label>
                            <textarea
                                class="form-control"
                                v-model="faq.answer.ru"
                                placeholder="Жауап"
                                name="answer_ru"
                                cols="30"
                                rows="5"
                            >
                            </textarea>
                            <validation-error :field="'answer'" />
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
        Head
    },
    data() {
        return {
            faq: {
                question: {
                    kk: '',
                    ru: ''
                },
                answer: {
                    kk: '',
                    ru: ''
                }
            },
        };
    },
    methods: {
        submit() {
            this.$inertia.post(route("admin.faqs.store"),this.faq);
        },
    },
};
</script>
