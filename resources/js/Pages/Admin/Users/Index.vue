<template>
  <head>
        <title>Админ панель | Қолданушылар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Қолданушылар тізімі</h1>
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
                            Қолданушылар тізімі
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-primary mr-2"
                    :href="route('admin.users.create')"
                >
                    <i class="fa fa-plus"></i> Қосу
                </Link>

                <Link class="btn btn-danger" :href="route('admin.users.index')">
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
                                        <th>Имя</th>
                                        <th>Почта</th>
                                        <th>Телефон</th>
                                        <th>Пароль</th>
                                        <th>Роль</th>
                                        <th>Действия</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input
                                                v-model="filter.full_name"
                                                class="form-control"
                                                placeholder="Имя"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <input
                                                v-model="filter.email"
                                                class="form-control"
                                                placeholder="Email"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <input
                                                v-model="filter.phone"
                                                class="form-control"
                                                placeholder="Телефон"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(user, index) in users.data"
                                        :key="'user' + user.id"
                                    >
                                        <td>
                                            {{
                                                users.from
                                                    ? users.from + index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>{{ user.full_name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.phone }}</td>
                                        <td>{{ user.real_password }}</td>
                                        <td>
                                            {{ user.role.name }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.users.subscriptions',
                                                            user.id
                                                        )
                                                    "
                                                    class="btn btn-success"
                                                    title="Жазылымдар"
                                                >
                                                    <i class="fas fa-rocket"></i>
                                                </Link>
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.users.edit',
                                                            user
                                                        )
                                                    "
                                                    class="btn btn-primary"
                                                    title="Изменить"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </Link>

                                                <button
                                                @click.prevent="deleteData(user.id)"
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
                    <Pagination :links="users.links" />
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
        Head
    },
    props: ["users"],
    data() {
        return {
            filter: {
                full_name: route().params.full_name
                    ? route().params.full_name
                    : null,
                email: route().params.email ? route().params.email : null,
                phone: route().params.phone ? route().params.phone : null,
                sex: route().params.sex ? route().params.sex : null,
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
                      this.$inertia.delete(route("admin.users.destroy", id));
                }
            });
        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route("admin.users.index"), params);
        },
    },
};
</script>
