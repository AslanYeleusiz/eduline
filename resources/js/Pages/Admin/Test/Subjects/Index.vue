<template>
    <head>
        <title>Админ панель | Пәндер</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Пәндер тізімі</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Пәндер тізімі</li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-primary mr-2"
                    :href="route('admin.test.subjects.create')"
                >
                    <i class="fa fa-plus"></i> Қосу
                </Link>

                <Link class="btn btn-danger" :href="route('admin.test.subjects.index')">
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
                                        <th>Түсініктеме</th>
                                        <th>Тіл</th>   
                                        <th>Сұрақ саны(Лимит)</th>     
                                        <th>Педагогика?</th>
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
                                        <td>
                                            <input
                                                v-model="filter.description"
                                                class="form-control"
                                                placeholder="Түсініктеме"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        
                                        <td>
                                            <select
                                                v-model="filter.language_id"
                                                class="form-control"
                                                placeholder="Тіл"
                                                @change.prevent="search"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option 
                                                 :value="language.id"
                                                 v-for="language in languages"
                                                 :key="'lang' + language.id">
                                                    {{ language.name }}
                                                </option>
                                            </select>
                                        </td>
                                             <td>
                                            <input
                                                v-model="filter.questions_count"
                                                class="form-control"
                                                placeholder="Сұрақ саны"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <select
                                                v-model="filter.is_pedagogy"
                                                class="form-control"
                                                placeholder="Педагогика?"
                                                @change.prevent="search"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option value="true">
                                                    Иә
                                                </option>
                                                <option value="false">
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
                                        v-for="(subject, index) in subjects.data"
                                        :key="'subject' + subject.id"
                                    >
                                        <td>
                                            {{
                                                subjects.from
                                                    ? subjects.from + index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>{{ subject.name }}</td>
                                        <td>{{ subject.description ?? 'Толтырылмаған' }}</td>
                                        <td>{{ subject.language ? subject.language.name : 'Таңдалмаған' }}</td>
                                        <td>
                                            {{ subject.questions_count }}
                                            <br>
                                            <hr>  
                                             Жалпы сұрақ саны: <b> {{ subject.all_questions_count}}</b>
                                             </td>

                                        <td>
                                            {{ subject.is_pedagogy ? "Иә" : "Жоқ" }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                
                                                <Link
                                                :href="
                                                        route(
                                                            'admin.test.subjectOptions.index',
                                                            subject
                                                        )
                                                    "
                                                    class="btn btn-success"
                                                    title="Нұсқалар"
                                                >
                                                    <i
                                                        class="fas fa-book-open"
                                                    ></i>
                                                </Link>

                                                 <Link
                                                :href="
                                                        route(
                                                            'admin.test.subjectPreparations.index',
                                                            subject
                                                        )
                                                    "
                                                    class="btn btn-success"
                                                    title="Дайындық"
                                                >
                                   <i class="fas fa-book-reader"></i>
                                                </Link>

                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.test.subjects.edit',
                                                            subject
                                                        )
                                                    "
                                                    class="btn btn-primary"
                                                    title="Изменить"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </Link>

                                                <button
                                                    @click.prevent="
                                                        deleteData(subject.id)
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
                    <Pagination :links="subjects.links" />
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
        Pagination,
        Head,
    },
    props: ["directions", "languages", "subjects"],
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
                    this.$inertia.delete(route('admin.test.subjects.destroy', id))

                }
            });
        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route("admin.test.subjects.index"), params);
        },
    },
};
</script>
