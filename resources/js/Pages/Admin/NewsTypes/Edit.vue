<template>
  <head>
        <title>Админ панель | Жаңалық түрін өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жаңалық бағыты № {{ newsType.id }}</h1>
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
                            <a :href="route('admin.newsTypes.index')">
                                <i class="fas fa-dashboard"></i>
                                Жаңалықтар бағыты
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Жаңалық бағыты № {{ newsType.id }}
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
                            <div class="ml-2">
                                <div class="form-group">
                                    <label for="">KK</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="newsType.name.kk"
                                        name="name.kk"
                                        placeholder="Аты"
                                        required
                                    />
                                    <validation-error :field="'name.kk'" />
                                </div>
                                 <div class="form-group">
                                    <label for="">RU</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="newsType.name.ru"
                                        name="name.ru"
                                        placeholder="Аты"
                                        required
                                    />
                                    <validation-error :field="'name.ru'" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    v-model="newsType.is_main"
                                    class="custom-control-input"
                                    id="customSwitch1"
                                />
                                <label
                                    class="custom-control-label"
                                    for="customSwitch1"
                                    >Басты бөлім</label
                                >
                            </div>
                            <validation-error :field="'is_general'" />
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
        Head
    },
    props: ["newsType"],
    methods: {
        submit() {
            this.$inertia.put(
                route("admin.newsTypes.update", this.newsType.id),
                this.newsType,
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
