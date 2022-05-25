<template>
    <head>
        <title>Админ панель | Жеке кеңесті қосу</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жеке кеңес қосу</h1>
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
                            <a :href="route('admin.personalAdvice.index')">
                                <i class="fas fa-dashboard"></i>
                                Жеке кеңес тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Жеке кеңес қосу
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
                            <label for="">Тақырып</label>
                            <div class="ml-2">
                                <div class="form-group">
                                    <label for="">KK</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="personalAdvice.title.kk"
                                        name="title.kk"
                                        placeholder="Тақырып"
                                         required
                                    />
                                    <validation-error :field="'title.kk'" />
                                </div>
                                <div class="form-group">
                                    <label for="">RU</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="personalAdvice.title.ru"
                                        name="title.ru"
                                        placeholder="Тақырып"
                                        required
                                    />
                                    <validation-error :field="'title.ru'" />
                                </div>
                            </div>
                        </div>
                             
                       <div class="form-group">
                            <label for="">Түсініктеме</label>
                            <div class="ml-2">
                                <div class="form-group">
                                    <label for="">KK</label>
                                <textarea 
                                    class="form-control"
                                    v-model="personalAdvice.description.kk"
                                    required
                                     id="" cols="10" rows="5">
                                    </textarea>
                                    <validation-error :field="'description.kk'" />
                                </div>
                                 <div class="form-group">
                                    <label for="">RU</label>
                                    <textarea name=""
                                    class="form-control"
                                    v-model="personalAdvice.description.ru"
                                    required
                                     id="" cols="10" rows="5">
                                    </textarea>
                                    <validation-error :field="'description.ru'" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Бағасы</label>
                            <input
                                type="number"
                                class="form-control"
                                v-model="personalAdvice.price"
                                name="price"
                                placeholder="Бағасы"
                                required
                            />
                            <validation-error :field="'price'" />
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    v-model="personalAdvice.is_discount"
                                    class="custom-control-input"
                                    id="customSwitch1"
                                />
                                <label
                                    class="custom-control-label"
                                    for="customSwitch1"
                                    >Скидка ({{
                                        personalAdvice.is_discount
                                            ? "Бар"
                                            : "Жоқ"
                                    }})</label
                                >
                            </div>
                            <validation-error :field="'is_discount'" />
                        </div>

                        <div
                            class="form-group"
                            v-if="personalAdvice.is_discount"
                        >
                            <label for="">Скидка поценті</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="personalAdvice.discount_percentage"
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
                                    v-model="personalAdvice.is_active"
                                    class="custom-control-input"
                                    id="customSwitch2"
                                />
                                <label
                                    class="custom-control-label"
                                    for="customSwitch2"
                                    >Белсенді ({{
                                        personalAdvice.is_active ? "Иә" : "Жоқ"
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
    data() {
        return {
            personalAdvice: {
                title: {
                    kk: null,
                    ru: null
                },
                price: null,
                is_discount: false,
                discount_percentage: null,
                is_active: false,
            },
        };
    },
    methods: {
        submit() {
            this.$inertia.post(
                route("admin.personalAdvice.store"),
                this.personalAdvice,
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
