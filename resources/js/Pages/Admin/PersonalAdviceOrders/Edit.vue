<template>
    <head>
        <title>Админ панель | Жеке кеңеске тапсырысты өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жеке кеңеске тапсырыс № {{ personalAdviceOrder.id }}</h1>
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
                            <a :href="route('admin.personalAdviceOrders.index')">
                                <i class="fas fa-dashboard"></i>
                                Жеке кеңеске тапсырыстар тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Жеке кеңеске тапсырыс № {{ personalAdviceOrder.id }}
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
                            <label for="">Аты-жөні</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="personalAdviceOrder.full_name"
                                name="name"
                                placeholder="Аты"
                                disabled
                            />
                            <validation-error :field="'Аты-жөні'" />
                        </div>
                        <div class="form-group">
                            <label for="">Телефон</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="personalAdviceOrder.phone"
                                name="phone"
                                placeholder="Телефон"
                                disabled
                            />
                            <validation-error :field="'phone'" />
                        </div>
                        <div class="form-group">
                            <label for="">Уақыты : {{ personalAdviceOrder.created_at ?? 'Анықталмады'}}</label>
                        </div>
                        <div class="form-group">
                            <label for="">Комментария (заметка)</label>
                            <textarea
                            v-model="personalAdviceOrder.comment_for_note"
                            placeholder="Комментария (заметка)"
                              cols="30" rows="5" class="form-control">
                            </textarea>
                            <validation-error :field="'phone'" />
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-1">
                            Сохранить
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click.prevent="back()"
                        >
                            Назад
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
    props: ["personalAdviceOrder"],
    methods: {
        submit() {
            this.$inertia.put(
                route("admin.personalAdviceOrders.update", this.personalAdviceOrder.id),
                this.personalAdviceOrder,
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
