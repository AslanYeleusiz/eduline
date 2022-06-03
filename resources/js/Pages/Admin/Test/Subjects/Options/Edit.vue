<template>
    <head>
        <title>Админ панель | Нұсқаны өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0"> 
                        {{ subject.name }}
                        <br> 
                         Нұсқаны өзгерту №{{subject.id}}
                         </h5>
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
                     {{ subject.name }} - Нұсқаны өзгерту №{{option.id}}
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
                                v-model="option.name"
                                name="name"
                                placeholder="Аты"
                            />
                            <validation-error :field="'name'" />
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
import AdminLayout from "../../../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../../../Components/Pagination.vue";
import ValidationError from "../../../../../Components/ValidationError.vue";

export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        ValidationError,
        Head,
    },
    props: ["subject", "option"],
    methods: {
        submit() {
            this.$inertia.put(
                route("admin.test.subjectOptions.update", {subject:this.subject.id, option: this.option.id}),
                this.option,
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
