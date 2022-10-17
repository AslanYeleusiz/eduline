<template>
    <head>
        <title>Админ панель | Пәнді өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Пән № {{ subject.id }}</h1>
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
                            <a :href="route('admin.test.subjects.index')">
                                <i class="fas fa-dashboard"></i>
                                Пәндер тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Пән № {{ subject.id }}
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
                            <label for="">Аты</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="subject.name"
                                name="name"
                                placeholder="Аты"
                            />
                            <validation-error :field="'name'" />
                        </div>

                        <div class="form-group">
                            <label for="">Түсініктеме</label>
                            <textarea name="" id="" cols="10" rows="5"
                            class="form-control"
                            v-model="subject.description"
                            placeholder="Түсініктеме"
                            ></textarea>
                            <validation-error :field="'desription'" />
                        </div>

                        <div class="form-group">
                            <label for="">Тіл</label>
                            <select v-model="subject.language_id"
                                class="form-control"
                            >
                                <option
                                    :value="language.id"
                                    v-for="language in languages"
                                    :key="'lang' + language.id"
                                >
                                    {{ language.name }}
                                </option>
                            </select>
                            <validation-error :field="'language_id'" />
                        </div>

                        <div class="form-group">
                            <label for="">Сұрақ саны</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="subject.questions_count"
                                name="questions_count"
                                placeholder="Сұрақ саны"
                            />
                            <validation-error :field="'questions_count'" />
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    v-model="subject.is_pedagogy"
                                    class="custom-control-input"
                                    id="customSwitch1"
                                />
                                <label
                                    class="custom-control-label"
                                    for="customSwitch1"
                                    >Педагогика?</label
                                >
                            </div>
                            <validation-error :field="'is_pedagogy'" />
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    v-model="subject.is_soon"
                                    class="custom-control-input"
                                    id="customSwitch2"
                                />
                                <label
                                    class="custom-control-label"
                                    for="customSwitch2"
                                    >Уақытша белсенді емес (Жақында)</label
                                >
                            </div>
                            <validation-error :field="'is_soon'" />
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
import AdminLayout from "../../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../../Components/Pagination.vue";
import ValidationError from "../../../../Components/ValidationError.vue";

export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        ValidationError,
        Head,
    },
    props: ["subject", "languages"],
    methods: {
        submit() {
            this.$inertia.put(
                route("admin.test.subjects.update", this.subject.id),
                this.subject,
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
