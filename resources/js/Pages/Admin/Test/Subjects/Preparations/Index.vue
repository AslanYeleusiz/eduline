<template>
    <head>
        <title>Админ панель | Дайындық</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0">
                        {{ subject.name }}
                        <br />
                        Дайындық
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </Link>
                        </li>

                        <li class="breadcrumb-item">
                            <Link :href="route('admin.test.subjects.index')">
                                <i class="fas fa-dashboard"></i>
                                Пәндер тізімі
                            </Link>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ subject.name }} - Дайындық
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-primary mr-2"
                    :href="
                        route(
                            'admin.test.subjectPreparations.create',
                            subject.id
                        )
                    "
                >
                    <i class="fa fa-plus"></i> Қосу
                </Link>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover">
                                <tbody>
                                    <template
                                        v-for="preparation in preparations"
                                        :key="'prep' + preparation.id"
                                    >
                                        <tr
                                            data-widget="expandable-table"
                                            aria-expanded="true"
                                        >
                                            <td>
                                                <i
                                                    class="expandable-table-caret fas fa-caret-right fa-fw"
                                                ></i>
                                                {{ preparation.title }}
                                                <button
                                                    @click.prevent="
                                                        deleteData(
                                                            preparation.id
                                                        )
                                                    "
                                                    class="btn ml-2 btn-sm btn-danger"
                                                    title="Жою"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="expandable-body">
                                            <td>
                                                <div class="p-0" style="">
                                                    <table
                                                        class="table mt-2 mb-3 table-hover table-bordered table-striped dataTable dtr-inline"
                                                    >
                                                        <thead>
                                                            <tr role="row">
                                                                <th>№</th>
                                                                <th>
                                                                    Тақырыпшасы
                                                                </th>
                                                                <th>
                                                                    Түсініктеме
                                                                </th>
                                                                <th>
                                                                    Видео
                                                                    ссылкасы
                                                                </th>
                                                                <th>Әрекет</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr
                                                                class="odd"
                                                                v-for="(
                                                                    preparationItem,
                                                                    index
                                                                ) in preparation.childs"
                                                                :key="
                                                                    'preparationItem' +
                                                                    preparationItem.id
                                                                "
                                                            >
                                                                <td>
                                                                    {{
                                                                        index +
                                                                        1
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        preparationItem.title
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        preparationItem.description
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        preparationItem.video_link
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    <div
                                                                        class="btn-group btn-group-sm"
                                                                    >
                                                                        <Link
                                                                            :href="
                                                                                route(
                                                                                    'admin.test.subjectPreparations.edit',
                                                                                    {
                                                                                        subject:
                                                                                            subject.id,
                                                                                        preparation:
                                                                                            preparationItem.id,
                                                                                    }
                                                                                )
                                                                            "
                                                                            class="btn btn-primary"
                                                                            title="Сұрақтар"
                                                                        >
                                                                            <i
                                                                                class="fas fa-edit"
                                                                            ></i>
                                                                        </Link>

                                                                        <button
                                                                            @click.prevent="
                                                                                deleteData(
                                                                                    preparationItem.id
                                                                                )
                                                                            "
                                                                            class="btn btn-danger"
                                                                            title="Жою"
                                                                        >
                                                                            <i
                                                                                class="fas fa-trash"
                                                                            ></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
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
import AdminLayout from "../../../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";

export default {
    components: {
        AdminLayout,
        Link,
        Head,
    },
    props: ["preparations", "subject", "testClasses"],
    methods: {
        // openAddTestClassPreparationModal(testClass) {
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
                        route("admin.test.subjectPreparations.destroy", {
                            subject: this.subject.id,
                            preparation: id,
                        })
                    );
                }
            });
        },
        search() {
            this.$inertia.get(
                route("admin.test.subjectPreparations.index", this.subject.id)
            );
        },
    },
};
</script>
