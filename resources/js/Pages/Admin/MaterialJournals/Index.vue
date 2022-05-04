<template>
    <head>
        <title>Админ панель | Жинақтар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жинақтар тізімі</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Жинақтар тізімі
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-danger"
                    :href="route('admin.materialJournals.index')"
                >
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
                                        <th>Қолданушы</th>
                                        <th>Тақырыбы</th>
                                        <th>Авторы</th>
                                        <th>Инфо</th>
                                        <th>Статус</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input
                                                v-model="filter.full_name"
                                                class="form-control"
                                                placeholder="Қолданушы"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <input
                                                v-model="filter.title"
                                                class="form-control"
                                                placeholder="Тақырыбы"
                                                @keyup.enter="search"
                                            />
                                        </td>

                                        <td>
                                            <input
                                                v-model="filter.author_name"
                                                class="form-control"
                                                placeholder="Авторы"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <select
                                                class="form-control"
                                                @change.prevent="search()"
                                                v-model="filter.subject_id"
                                                placeholder="Пән"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option
                                                    :value="materialSubject.id"
                                                    v-for="(
                                                        materialSubject,
                                                        subject_index
                                                    ) in materialSubjects"
                                                    :key="
                                                        'subject_index' +
                                                        subject_index
                                                    "
                                                >
                                                    {{ materialSubject.name }}
                                                </option>
                                            </select>
                                            <select
                                                class="form-control mt-2 mb-2"
                                                @change.prevent="search()"
                                                v-model="filter.direction_id"
                                                placeholder="Бағыты"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option
                                                    :value="
                                                        materialDirection.id
                                                    "
                                                    v-for="(
                                                        materialDirection,
                                                        direction_index
                                                    ) in materialDirections"
                                                    :key="
                                                        'direction_index' +
                                                        direction_index
                                                    "
                                                >
                                                    {{ materialDirection.name }}
                                                </option>
                                            </select>

                                            <select
                                                class="form-control"
                                                @change.prevent="search()"
                                                v-model="filter.class_id"
                                                placeholder="Сынып"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option
                                                    :value="materialClass.id"
                                                    v-for="(
                                                        materialClass,
                                                        class_index
                                                    ) in materialClasses"
                                                    :key="
                                                        'class_index' +
                                                        class_index
                                                    "
                                                >
                                                    {{ materialClass.name }}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select
                                                class="form-control"
                                                @change.prevent="search()"
                                                v-model="filter.status"
                                                placeholder="Статус"
                                            >
                                                <option :value="'all'">
                                                    Барлығы
                                                </option>
                                                
                                                <option :value="null">
                                                    Қаралмаған
                                                </option>
                                                <option value="1">
                                                    Қабылданбады
                                                </option>
                                                <option value="2">
                                                    Қабылданды
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <button class="btn btn-success d-flex align-items-center" @click.prevent="search()">
                                                <i class="fas fa-search mr-2"></i>
                                                Іздеу
                                            </button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(
                                            materialJournal, index
                                        ) in materialJournals.data"
                                        :key="
                                            'materialJournal' +
                                            materialJournal.id
                                        "
                                    >
                                        <td>
                                            {{
                                                materialJournals.from
                                                    ? materialJournals.from +
                                                      index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>
                                            {{ materialJournal.user.full_name }}
                                        </td>
                                        <td>
                                            {{ materialJournal.material.title }}
                                        </td>
                                        <td>
                                            {{
                                                materialJournal.material.user
                                                    .full_name
                                            }}
                                        </td>
                                        <td>
                                            <b>Пән:</b>
                                            {{
                                                materialJournal.material.subject
                                                    .name
                                            }}
                                            <br />
                                            <b>Бағыт:</b>
                                            {{
                                                materialJournal.material
                                                    .direction.name
                                            }}
                                            <br />
                                            <b>Сынып:</b>
                                            {{
                                                materialJournal.material.class
                                                    .name
                                            }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-success"
                                                :class="{
                                                'badge-success': materialJournal.status == 2,
                                                'badge-danger': materialJournal.status == 1,
                                                'badge-warning':! materialJournal.status ,
                                                }"
                                                
                                            >
                                                {{
                                                    getStatusText(
                                                        materialJournal.status
                                                    )
                                                }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.materialJournals.edit',
                                                            materialJournal
                                                        )
                                                    "
                                                    class="btn btn-primary"
                                                    title="Изменить"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </Link>

                                                <button
                                                    @click.prevent="
                                                        deleteData(
                                                            materialJournal.id
                                                        )
                                                    "
                                                    class="btn btn-danger"
                                                    title="Удалить"
                                                >
                                                    <i
                                                        class="fas fa-times red"
                                                    ></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <Pagination :links="materialJournals.links" />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../Components/Pagination.vue";
export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        Head,
    },
    props: [
        "materialJournals",
        "materialSubjects",
        "materialDirections",
        "materialClasses",
    ],
    data() {
        return {
            filter: {
                title: route().params.title ? route().params.title : null,
                full_name: route().params.full_name
                    ? route().params.full_name
                    : null,
                author_name: route().params.author_name
                    ? route().params.author_name
                    : null,
                subject_id: route().params.subject_id
                    ? route().params.subject_id
                    : null,
                direction_id: route().params.direction_id
                    ? route().params.direction_id
                    : null,
                class_id: route().params.class_id
                    ? route().params.class_id
                    : null,
                    
                status: route().params.status
                    ? route().params.status
                    : 'all',
            },
        };
    },
    methods: {
        getStatusText(status) {
            if (!status) {
                return "Қаралмаған";
            }
            if (status == 1) {
                return "Қабылданбады";
            }
            if (status == 2) {
                return "Қабылданды";
            }
            return "Анықталмаған";
        },
        deleteData(id) {  
             Swal.fire({
                title: "Жоюға сенімдісіз бе?",
                text: "Қайтып қалпына келмеуі мүмкін!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Иә, жоямын!",
                cancelButtonText: "Жоқ",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(route("admin.materialJournals.destroy", id));
                }
            });
        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route("admin.materialJournals.index"), params);
        },
    },
};
</script>
