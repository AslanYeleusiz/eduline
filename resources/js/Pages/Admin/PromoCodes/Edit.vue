<template>
    <head>
        <title>Админ панель | Промо кодты өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Промо кодты № {{ promoCode.id }}</h1>
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
                            <a :href="route('admin.promoCodes.index')">
                                <i class="fas fa-dashboard"></i>
                                Промо кодтар тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Промо код № {{ promoCode.id }}
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
                            <label for="">Код</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="promoCode.code"
                                name="code"
                                placeholder="Код"
                                required
                            />
                            <validation-error :field="'code'" />
                        </div>

                        <div class="form-group">
                            <label for="">Күн</label>
                            <input
                                type="number"
                                class="form-control"
                                v-model="promoCode.day"
                                name="day"
                                placeholder="Күн"
                                required
                            />
                            <validation-error :field="'day'" />
                        </div>
                        <div class="form-group">
                            <label for="">Жарамдылық уақыты</label>
                            <div class="d-flex">
                                <input
                                    type="date"
                                    class="form-control"
                                    v-model="promoCode.from_date"
                                    name="from_date"
                                    placeholder="От"
                                    required
                                />
                                <input
                                    type="date"
                                    class="form-control ml-2"
                                    v-model="promoCode.to_date"
                                    name="to_date"
                                    placeholder="До"
                                    required
                                />
                            </div>
                            <validation-error :field="'from_date'" />
                            <validation-error :field="'to_date'" />
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    v-model="promoCode.is_active"
                                    class="custom-control-input"
                                    id="customSwitch2"
                                />
                                <label
                                    class="custom-control-label"
                                    for="customSwitch2"
                                    >Белсенді ({{
                                        promoCode.is_active ? "Иә" : "Жоқ"
                                    }})</label
                                >
                            </div>
                            <validation-error :field="'is_active'" />
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
    props: ["promoCode"],
    methods: {
        submit() {
            this.$inertia.put(
                route("admin.promoCodes.update", this.promoCode.id),
                this.promoCode,
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
