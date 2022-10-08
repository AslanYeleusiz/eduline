<template>
       <head>
        <title>Админ панель | Материалдар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Материалдар тізімі</h1>
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
                            Материалдар тізімі
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-danger"
                    :href="route('admin.materials.index')"
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
                                        <th>Тақырыбы</th>
                                        <th>Түсініктеме</th>
                                        <th>Пән</th>
                                        <th>Бағыты</th>
                                        <th>Сынып</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
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
                                                v-model="filter.description"
                                                class="form-control"
                                                placeholder="Түсініктеме"
                                                @keyup.enter="search"
                                            />
                                        </td>

                                        <td>
                                            <select
                                                v-model="filter.subject_id"
                                                class="form-control"
                                                placeholder="Пәні"
                                                @change.prevent="search"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option
                                                    :value="materialSubject.id"
                                                    :key="
                                                        'materialSubject' +
                                                        materialSubject.id
                                                    "
                                                    v-for="materialSubject in materialSubjects"
                                                >
                                                    {{ materialSubject.name }}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select
                                                v-model="filter.direction_id"
                                                class="form-control"
                                                placeholder="Бағыты"
                                                @change.prevent="search"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option
                                                    :value="
                                                        materialDirection.id
                                                    "
                                                    :key="
                                                        'materialDirection' +
                                                        materialDirection.id
                                                    "
                                                    v-for="materialDirection in materialDirections"
                                                >
                                                    {{ materialDirection.name }}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select
                                                v-model="filter.class_id"
                                                class="form-control"
                                                placeholder="Сыныбы"
                                                @change.prevent="search"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option
                                                    :value="materialClass.id"
                                                    :key="
                                                        'materialClass' +
                                                        materialClass.id
                                                    "
                                                    v-for="materialClass in materialClasses"
                                                >
                                                    {{ materialClass.name }}
                                                </option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(
                                            material, index
                                        ) in materials.data"
                                        :key="'material' + material.id"
                                    >
                                        <td>
                                            {{
                                                materials.from
                                                    ? materials.from + index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>{{ material.title }}</td>
                                        <td>{{ material.description }}</td>
                                        <td>{{ material.subject.name }}</td>
                                        <td>{{ material.direction.name }}</td>
                                        <td>{{ material.class.name }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
<!--
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.materials.comments',
                                                            { id: material.id }
                                                        )
                                                    "
                                                    class="btn btn-success"
                                                    title="Пікірлер"
                                                >
                                                    <i
                                                        class="fas fa-comment"
                                                    ></i>
                                                </Link>
-->
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.materials.edit',
                                                            material
                                                        )
                                                    "
                                                    class="btn btn-primary"
                                                    title="Изменить"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </Link>

                                                <button
                                                    @click.prevent="
                                                        deleteData(material.id)
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
                    <Pagination :links="materials.links" />
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
        "materials",
        "materialSubjects",
        "materialDirections",
        "materialClasses",
    ],
    data() {
        return {
            filter: {
                title: route().params.title ? route().params.title : null,
                description: route().params.description
                    ? route().params.description
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
                cancelButtonText: "Жоқ",
            }).then((result) => {
                if (result.isConfirmed) {
                this.$inertia.delete(route("admin.materials.destroy", id));
                }
            });

        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route("admin.materials.index"), params);
        },
    },
};
</script>
