<template>
  <head>
        <title>Админ панель | Материал сыныптары</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Материал пәндер тізімі</h1>
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
                            Материал пәндер тізімі
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link class="btn btn-primary mr-2" :href="route('admin.materialSubjects.create')">
                    <i class="fa fa-plus"></i> Қосу 
                </Link>
                
                <Link class="btn btn-danger" :href="route('admin.materialSubjects.index')">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(materialSubject, index) in materialSubjects.data"
                                        :key="'materialSubject' + materialSubject.id"
                                    >
                                        <td>
                                            {{
                                                materialSubjects.from
                                                    ? materialSubjects.from + index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>{{ materialSubject.name }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.materialSubjects.edit',
                                                            materialSubject
                                                        )
                                                    "
                                                    class="btn btn-primary"
                                                    title="Изменить"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </Link>

                                                <button
                                                @click.prevent="deleteData(materialSubject.id)"
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
                    <Pagination :links="materialSubjects.links" />
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
    props: ["materialSubjects"],
    data() {
        return {
            filter: {
                name: route().params.name ? route().params.name: null,
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
               this.$inertia.delete(route('admin.materialSubjects.destroy', id))
                }
            });
        

        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route('admin.materialSubjects.index'),params)
        },
    }
};
</script>
