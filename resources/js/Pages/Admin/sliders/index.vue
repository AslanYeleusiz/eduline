<template>
  <head>
        <title>Админ панель | Жаңалықтар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Слайдер</h1>
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
                            Слайдер тізімі
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link class="btn btn-primary mr-2" :href="route('admin.slider.create')">
                    <i class="fa fa-plus"></i> Қосу
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
                                        <th>Сурет</th>
                                        <th>Сілтеме</th>
                                        <th>in_app</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(slider, index) in sliders.data"
                                        :key="'slider' + slider.id"
                                    >
                                        <td>
                                            {{
                                                index + 1
                                            }}
                                        </td>
                                        <td>{{ slider.image.kk }}</td>
                                        <td>{{
                                           slider.linkToAdvice ?
                                            slider.advice.title.kk :
                                             slider.link
                                        }}</td>
                                        <td>{{ slider.in_app == 1 ? 'true' : 'false' }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">

                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.slider.edit',
                                                            {'slider':slider}
                                                        )
                                                    "
                                                    class="btn btn-primary"
                                                    title="Изменить"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </Link>

                                                <button
                                                @click.prevent="deleteData(slider.id)"
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
                    <Pagination :links="sliders.links" />
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
    props: ["sliders"],
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
                 this.$inertia.delete(route('admin.slider.destroy', id))
                }
            });
        },
    }
};
</script>
