<template>
    <head>
        <title>Админ панель | Бағыт қосу</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Бағыт қосу</h1>
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
                            <a :href="route('admin.test.directions.index')">
                                <i class="fas fa-dashboard"></i>
                                Бағыт тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Бағыт қосу
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
                                v-model="direction.name"
                                name="name"
                                placeholder="Аты"
                            />
                            <validation-error :field="'name'" />
                        </div>
                        <div class="form-group">
                            <label for="description">Пәднер</label>
                            <div class="input-group mb-3">
                                <input
                                    class="form-control"
                                    v-model="subject_search"
                                    placeholder="Пән іздеу"
                                />
                                <span class="input-group-btn">
                                    <button
                                        class="btn btn-danger"
                                        type="button"
                                        title="Очистить"
                                        @click="subject_search = ''"
                                    >
                                        <i
                                            class="fas fa-trash-alt"
                                            aria-hidden="true"
                                        ></i>
                                    </button>
                                </span>
                            </div>

                            <ul class="ul-li-no-style">
                                <li>
                                    <input
                                        type="checkbox"
                                        v-model="selectAllSubjects"
                                    />
                                    <label class="ml-1">Барлығы</label>
                                </li>
                                <li
                                    v-for="subject in subjects"
                                    v-show="
                                        subject.name
                                            .toLowerCase()
                                            .indexOf(
                                                subject_search.toLowerCase()
                                            ) > -1
                                    "
                                    :key="'subject' + subject.id"
                                >
                                    <input
                                        :id="'subject' + subject.name"
                                        v-model="subject_ids"
                                        type="checkbox"
                                        :value="subject.id"
                                    />
                                    <label
                                        class="ml-1"
                                        :for="'subject' + subject.name"
                                    >
                                        {{ subject.name }} {{ subject.description ? '(' + subject.description +')' : ''}}
                                        ({{ subject.language.name}})
                                        </label
                                    >
                                </li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    v-model="direction.is_active"
                                    class="custom-control-input"
                                    id="customSwitch1"
                                />
                                <label
                                    class="custom-control-label"
                                    for="customSwitch1"
                                    >Белсенді/Белсенді емес</label
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
    props: ["subjects"],

    data() {
        return {
            direction: {},
            subject_search: "",
            selectAllSubjects: false,
            subject_ids: []
        };
    },
    methods: {
        submit() {
            this.direction.subject_ids = this.subject_ids
            this.$inertia.post(
                route("admin.test.directions.store"),
                this.direction,
                {
                    onError: () => console.log("An error has occurred"),
                    onSuccess: () =>
                        console.log("The new contact has been saved"),
                }
            );
        },
    },
    watch: {
        selectAllSubjects: {
            handler(val, oldVal) {
                if (val) {
                    this.subject_ids = this.subjects.map((item) => item.id);
                } else {
                    this.subject_ids = [];
                }
            },
        },
    },
};
</script>
<style scoped>
li {
    list-style: none;
}
ul {
    padding-left: 20px !importantx;
}
</style>
