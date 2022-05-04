<template>
    <head>
        <title>Админ панель | Жойылған материалдар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жойылған материалдар тізімі</h1>
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
                            Жойылған материалдар тізімі
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-danger"
                    :href="route('admin.deletedMaterials.index')"
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
                                        <th>Инфо</th>
                                        <th>Жою себебі</th>
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
                                        <td></td>
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
                                            <button
                                                class="btn btn-success d-flex align-items-center"
                                                @click.prevent="search()"
                                            >
                                                <i
                                                    class="fas fa-search mr-2"
                                                ></i>
                                                Іздеу
                                            </button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(
                                            material, index
                                        ) in deletedMaterials.data"
                                        :key="'material' + material.id"
                                    >
                                        <td>
                                            {{
                                                deletedMaterials.from
                                                    ? deletedMaterials.from +
                                                      index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>
                                            {{ material.user.full_name }}
                                        </td>
                                        <td>
                                            {{ material.title }}
                                        </td>
                                        <td>
                                            <b>Пән:</b>
                                            {{ material.subject.name }}
                                            <br />
                                            <b>Бағыт:</b>
                                            {{ material.direction.name }}
                                            <br />
                                            <b>Сынып:</b>
                                            {{ material.class.name }}
                                        </td>
                                        <td>
                                            {{
                                                material.comment_when_deleted ??
                                                "Толтырылмаған"
                                            }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-success"
                                                :class="{
                                                    'badge-success':
                                                        material.status_deleted ==
                                                        3,
                                                    'badge-danger':
                                                        material.status_deleted ==
                                                        2,
                                                    'badge-warning':
                                                        material.status_deleted ==
                                                        1,
                                                }"
                                            >
                                                {{
                                                    getStatusText(
                                                        material.status_deleted
                                                    )
                                                }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.deletedMaterials.edit',
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
                    <Pagination :links="deletedMaterials.links" />
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
        "deletedMaterials",
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
                subject_id: route().params.subject_id
                    ? route().params.subject_id
                    : null,
                direction_id: route().params.direction_id
                    ? route().params.direction_id
                    : null,
                class_id: route().params.class_id
                    ? route().params.class_id
                    : null,

                status: route().params.status ? route().params.status : "all",
            },
        };
    },
    methods: {
        getStatusText(status) {
            if (!status) {
                return "Жоюға жіберілмеген";
            }

            if (status == 1) {
                return "Қаралмаған";
            }
            if (status == 2) {
                return "Қабылданбады";
            }
            if (status == 3) {
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
                    this.$inertia.delete(
                        route("admin.deletedMaterials.destroy", id)
                    );
                }
            });
        },
        search() {
            const params = this.clearParams(this.filter);
            console.log("params", params);
            this.$inertia.get(route("admin.deletedMaterials.index"), params);
        },
    },
};
</script>
