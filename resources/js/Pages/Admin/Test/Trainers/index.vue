<template>

    <head>
        <title>Админ панель | Тренерлермен дайындық</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Тренерлермен дайындық</h1>
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
                            Тренерлермен дайындық тізімі
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link class="btn btn-primary mr-2" :href="route('admin.test.trainers.create')">
                <i class="fa fa-plus"></i> Қосу
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
                                        <th>Пән</th>
                                        <th>Бағасы</th>
                                        <th>Артықшылықтары</th>
                                        <th>Бөліп төлеу (ай)</th>
                                        <th>Белсенді</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd" v-for="(trainer, index) in trainers.data" :key="'trainer' + trainer.id">
                                        <td>
                                            {{
                                                index + 1
                                            }}
                                        </td>
                                        <td>{{ trainer.subject.kk }}</td>
                                        <td>{{ trainer.price }}</td>
                                        <td>{{ trainer.description.kk }}</td>
                                        <td>{{ trainer.installments }}</td>
                                        <td>{{ trainer.is_active }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link :href="
                                                        route(
                                                            'admin.test.trainers.edit',
                                                            {'trainer':trainer}
                                                        )
                                                    " class="btn btn-primary" title="Изменить">
                                                <i class="fas fa-edit"></i>
                                                </Link>

                                                <button @click.prevent="deleteData(trainer.id)" class="btn btn-danger" title="Жою">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <Pagination :links="trainers.links" />
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
            Pagination,
            Head
        },
        props: ["trainers"],
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
                        this.$inertia.delete(route('admin.test.trainers.destroy', id))
                    }
                });
            },
        }
    };

</script>
