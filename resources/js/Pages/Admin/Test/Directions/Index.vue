<template>
    <head>
        <title>Админ панель | Бағыт</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Бағыт тізімі</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Бағыт тізімі</li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-primary mr-2"
                    :href="route('admin.test.directions.create')"
                >
                    <i class="fa fa-plus"></i> Қосу
                </Link>

                <Link class="btn btn-danger" :href="route('admin.test.directions.index')">
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
                                        <th>Белсенді/Белсенді емес</th>
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
                                        v-for="(direction, index) in directions"
                                        :key="'direction' + direction.id"
                                    >
                                        <td>
                                            {{ index + 1 }}
                                        </td>
                                        <td>{{ direction.name.kk }}</td>
                                        <td>
                                            {{ direction.is_active ? "Иә" : "Жоқ" }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.test.directions.edit',
                                                            direction
                                                        )
                                                    "
                                                    class="btn btn-primary"
                                                    title="Изменить"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </Link>

                                                <button
                                                    @click.prevent="
                                                        deleteData(direction.id)
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
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
export default {
    components: {
        AdminLayout,
        Link,
        Head,
    },
    props: ["directions"],
    data() {
        return {
            filter: {
                name: route().params.name ? route().params.name : null,
                is_active: route().params.is_active
                    ? route().params.is_active
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
                cancelButtonText: "Жоқ"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(route('admin.test.directions.destroy', id))

                }
            });
        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route("admin.test.directions.index"), params);
        },
    },
};
</script>
