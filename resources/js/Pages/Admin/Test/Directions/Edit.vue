<template>
    <head>
        <title>Админ панель | Бағыт өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Бағыт № {{ direction.id }}</h1>
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
                            Бағыт № {{ direction.id }}
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
                            <label for="">Аты (Қазақша)</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="direction.name.kk"
                                name="name_kk"
                                placeholder="Аты"
                            />
                            <validation-error :field="'name'" />
                        </div>
                        <div class="form-group">
                            <label for="">Аты (Орысша)</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="direction.name.ru"
                                name="name_ru"
                                placeholder="Аты"
                            />
                            <validation-error :field="'name'" />
                        </div>



                        <div class="form-group">
                            <label for="description">Пәндер</label>
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
                                        v-model="subjectIds"
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
    props: ["direction", "subjects","subject_ids"],
    data() {
        return {
            subject_search: "",
            selectAllSubjects: false,
            subjectIds: []
        };
    },
    methods: {
        submit() {
            this.direction.subject_ids = this.subjectIds
            this.$inertia.put(
                route("admin.test.directions.update", this.direction.id),
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
                    this.subjectIds = this.subjects.map((item) => item.id);
                } else {
                    this.subjectIds = [];
                }
            },
        },
    },
    created() {
        this.subjectIds = this.clone(this.subject_ids)
        console.log(this.direction)
    }
};
</script>
<style scoped>
li {
    list-style: none;
}
ul {
    padding-left: 20px !important;
}
</style>
