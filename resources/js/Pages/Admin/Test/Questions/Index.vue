<template>
    <head>
        <title>Админ панель | Сұрақтар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Сұрақтар тізімі</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Сұрақтар тізімі</li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-primary mr-2"
                    :href="route('admin.test.questions.create')"
                >
                    <i class="fa fa-plus"></i> Қосу
                </Link>

                <Link class="btn btn-danger" :href="route('admin.test.questions.index')">
                    <i class="fa fa-trash"></i> Фильтрді тазалау
                </Link>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table
                             class="table table-hover table-bordered table-striped dataTable dtr-inline"
                            >
                                <thead>
                                    <tr role="row">
                                        <th>№</th>
                                        <th>Сұрақ</th>
                                        <th>Пән</th>
                                        <th>Белсенді/Белсенді емес</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input
                                                v-model="filter.text"
                                                class="form-control"
                                                placeholder="Сұрақ"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        
                                        <td>
                                            <select
                                                v-model="filter.subject_id"
                                                class="form-control"
                                                placeholder="Пән"
                                                @change.prevent="search"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option v-for="subject in subjects"
                                                :key="'subject' + subject.id">
                                                    {{ subject.name }}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select
                                                v-model="filter.is_active"
                                                class="form-control"
                                                placeholder="Белсенді/Белсенді емес"
                                                @change.prevent="search"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option value="false">
                                                    Иә
                                                </option>
                                                <option value="true">
                                                    Жоқ
                                                </option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(question, index) in questions.data"
                                        :key="'question' + question.id"
                                    >
                                        <td>
                                            {{
                                                questions.from
                                                    ? questions.from + index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>{{ question.text }}</td>
                                        <td>
                                            {{ question.subject.name}}
                                        </td>
                                        <td>
                                            {{ question.is_active ? "Иә" : "Жоқ" }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.test.questions.edit',
                                                            question
                                                        )
                                                    "
                                                    class="btn btn-primary"
                                                    title="Изменить"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </Link>

                                                <button
                                                    @click.prevent="
                                                        deleteData(question.id)
                                                    "
                                                    class="btn btn-danger"
                                                    title="Жою"
                                                >
                                                    <i
                                                        class="fas fa-times"
                                                    ></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                                        <Pagination :links="questions.links" />

                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../../Components/Pagination.vue";

export default {
    components: {
        AdminLayout,
        Link,
        Head,
        Pagination
    },
    props: ["questions"],
    data() {
        return {
            filter: {
                text: route().params.text ?? null,
                subject_id: route().params.subject_id ?? null,
                is_active: route().params.is_active ?? null,
            },
        };
    },
    methods: {
        deleteData(id) {
            Swal.fire({
                title: "Жоюға сенімдісіз бе?",
                text: "Қайтып қалпына келмеуі мүмкін!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Иә, жоямын!",
                cancelButtonText: "Жоқ"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(route('admin.test.questions.destroy', id))

                }
            });
        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route("admin.test.questions.index"), params);
        },
    },
};
</script>
