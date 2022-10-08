<template>

    <head>
        <title>Админ панель | Дайындық апеляция</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Дайындық апеляция тізімі</h1>
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
                            Дайындық апеляция тізімі
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link class="btn btn-danger" :href="route('admin.test.preparationAppeals.index')">
                <i class="fa fa-trash"></i> Фильтрді тазалау
                </Link>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover table-bordered table-striped dataTable dtr-inline">
                                <thead>
                                    <tr role="row">
                                        <th>№</th>
                                        <th>Аты-жөні</th>
                                        <th>Дайындық</th>
                                        <th>Қате түрі</th>
                                        <th>Комментария</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input v-model="filter.user_name" class="form-control" placeholder="Аты-жөні" @keyup.enter="search" />
                                        </td>
                                        <td>
                                            <input v-model="filter.title" class="form-control" placeholder="Дайындық" @keyup.enter="search" />
                                        </td>
                                        <td>
                                            <select v-model="filter.appeal_type" class="form-control" @change.prevent="search">
                                                <option :value="null" selected> Барлығы</option>
                                                <option :value="appeal_type_item.id" v-for=" (appeal_type_item, index) in appeal_types" :key="'appeal_types' + index ">
                                                    {{ appeal_type_item.name }}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <input v-model="filter.comment" class="form-control" placeholder="Комментария" @keyup.enter="search" />
                                        </td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd" v-for="(appeal, index) in appeals.data" :key="'appeal' + appeal.id">
                                        <td>
                                            {{
                                                appeals.from
                                                    ? appeals.from + index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>{{ appeal.user?.full_name }}</td>
                                        <td>{{ appeal.preparation.title }}</td>
                                        <td>
                                            <template v-for="(appeal_type_foreach, indexForeach ) in appeal_types" :key="'appeal_foreach' + indexForeach">
                                                <template v-if="appeal_type_foreach.id == appeal.type">
                                                    {{ appeal_type_foreach.name }}
                                                </template>
                                            </template>
                                        </td>
                                        <td>{{ appeal.comment }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link :href="route('admin.test.subjectPreparations.edit',
                                                    {
                                                        subject: appeal.preparation.subject_id,
                                                        preparation: appeal.preparation.id,
                                                    }
                                                )" class="btn btn-primary" title="Сұрақтар">
                                                <i class="fas fa-edit"></i>
                                                </Link>


                                                <button @click.prevent="
                                                        deleteData(appeal.id)
                                                    " class="btn btn-danger" title="Жою">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <Pagination :links="appeals.links" />

                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
    import AdminLayout from "../../../../Layouts/AdminLayout.vue";
    import {
        Link,
        Head
    } from "@inertiajs/inertia-vue3";
    import Pagination from "../../../../Components/Pagination.vue";

    export default {
        components: {
            AdminLayout,
            Link,
            Head,
            Pagination
        },
        props: ["appeals", "appeal_types"],
        data() {
            return {
                filter: {
                    user_name: route().params.user_name ?? null,
                    title: route().params.title ?? null,
                    appeal_type: route().params.appeal_type ?? null,
                    comment: route().params.comment ?? null,
                },
            };
        },
        mounted() {
            console.log(this.appeals)
            console.log(this.appeal_types)
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
                        this.$inertia.delete(
                            route("admin.test.preparationAppeals.destroy", id)
                        );
                    }
                });
            },
            search() {
                const params = this.clearParams(this.filter);
                this.$inertia.get(route("admin.test.preparationAppeals.index"), params);
            },
        },
    };

</script>
