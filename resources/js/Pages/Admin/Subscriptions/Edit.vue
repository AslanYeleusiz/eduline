<template>
    <head>
        <title>Админ панель | Жазылымды өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жазылымды № {{ subscription.id }}</h1>
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
                            <a :href="route('admin.subscriptions.index')">
                                <i class="fas fa-dashboard"></i>
                                Жазылымдар тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Жазылым № {{ subscription.id }}
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
                                v-model="subscription.name"
                                name="name"
                                placeholder="Аты"
                                required
                            />
                            <validation-error :field="'name'" />
                        </div>
                        <div class="form-group">
                            <label for="">Бағасы</label>
                            <input
                                type="number"
                                class="form-control"
                                v-model="subscription.price"
                                name="price"
                                placeholder="Бағасы"
                                required
                            />
                            <validation-error :field="'price'" />
                        </div>

                        <div class="form-group">
                            <label for="">Жазылым уақыт ұзақтығы</label>
                            <input
                                type="number"
                                class="form-control"
                                v-model="subscription.duration"
                                name="duration"
                                placeholder="Жазылым уақыт ұзақтығы"
                                required
                            />
                            <validation-error :field="'price'" />
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    v-model="subscription.is_discount"
                                    class="custom-control-input"
                                    id="customSwitch1"
                                />
                                <label
                                    class="custom-control-label"
                                    for="customSwitch1"
                                    >Скидка ({{ subscription.is_discount ? 'Бар': 'Жоқ'}})</label
                                >
                            </div>
                            <validation-error :field="'is_discount'" />
                        </div>
                        
                        <div class="form-group" v-if="subscription.is_discount">
                            <label for="">Скидка поценті</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="subscription.discount_percentage"
                                name="discount_percentage"
                                placeholder="Скидка поценті"
                                required
                            />
                            <validation-error :field="'discount_percentage'" />
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    v-model="subscription.is_active"
                                    class="custom-control-input"
                                    id="customSwitch2"
                                />
                                <label
                                    class="custom-control-label"
                                    for="customSwitch2"
                                    >Белсенді ({{ subscription.is_active ? 'Иә': 'Жоқ'}})</label
                                >
                            </div>
                            <validation-error :field="'is_active'" />
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
    props: ["subscription"],
    methods: {
        submit() {
            this.$inertia.put(
                route("admin.subscriptions.update", this.subscription.id),
                this.subscription,
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
