<template>
    <head>
        <title>Админ панель | Нұсқалар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5  class="m-0">
                        {{ subject.name}}
                        <br>
                        Нұсқалар тізімі

                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </Link>
                        </li>
                        
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.test.subjects.index')">
                                <i class="fas fa-dashboard"></i>
                                Пәндер тізімі
                            </Link>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ subject.name }} - Нұсқалар
                            
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-primary mr-2"
                    :href="route('admin.test.subjectOptions.create', subject.id)"
                >
                    <i class="fa fa-plus"></i> Қосу
                </Link>

                <Link class="btn btn-danger" :href="route('admin.test.subjectOptions.index', subject.id)">
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
                                        <th>Аты</th>
                                        <th>Сұрақтар саны</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input
                                                v-model="filter.name"
                                                class="form-control"
                                                placeholder="Аты"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(optionItem, index) in options.data"
                                        :key="'optionItem' + optionItem.id"
                                    >
                                        <td>
                                            {{
                                                options.from
                                                    ? options.from + index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>{{ optionItem.name }}</td>
                                        <td>
                                            {{ optionItem.questions_count }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                

                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.test.subjectOptions.edit',
                                                           {subject: subject.id, option: optionItem.id}
                                                        )
                                                    "
                                                    class="btn btn-primary"
                                                    title="Изменить"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </Link>

                                                <button
                                                    @click.prevent="
                                                        deleteData(optionItem.id)
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
                    <Pagination :links="options.links" />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../../../Components/Pagination.vue";

export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        Head,
    },
    props: ["options", "subject"],
    data() {
        return {
            filter: {
                name: route().params.name ?? null,
                description: route().params.description ?? null,
                questions_count: route().params.questions_count ?? null,
                language_id: route().params.language_id ?? null,
                is_pedagogy: route().params.is_pedagogy ?? null,
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
                    this.$inertia.delete(route('admin.test.subjectOptions.destroy', {subject: this.subject.id, option:id}))

                }
            });
        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route("admin.test.subjectOptions.index", this.subject.id), params);
        },
    },
};
</script>
