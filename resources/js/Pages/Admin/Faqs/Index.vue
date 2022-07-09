<template>
       <head>
        <title>Админ панель | Жиі қойылатын сұрақтар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жиі қойылатын сұрақтар тізімі</h1>
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
                            Жиі қойылатын сұрақтар тізімі
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link class="btn btn-primary mr-2" :href="route('admin.faqs.create')">
                    <i class="fa fa-plus"></i> Қосу
                </Link>

                <Link
                    class="btn btn-danger"
                    :href="route('admin.faqs.index')"
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
                                        <th>Сұрақ</th>
                                        <th>Жауап</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input
                                                v-model="filter.question"
                                                class="form-control"
                                                placeholder="Сұрақ"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <input
                                                v-model="filter.answer"
                                                class="form-control"
                                                placeholder="Жауап"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(
                                            faq, index
                                        ) in faqs.data"
                                        :key="'faq' + faq.id"
                                    >
                                        <td>
                                            {{
                                                faqs.from
                                                    ? faqs.from + index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>{{ faq.question }}</td>
                                        <td>{{ faq.answer }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.faqs.edit',
                                                            faq
                                                        )
                                                    "
                                                    class="btn btn-primary"
                                                    title="Изменить"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </Link>

                                                <button
                                                    @click.prevent="
                                                        deleteData(faq.id)
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
                    <Pagination :links="faqs.links" />
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
        "faqs",
    ],
    data() {
        return {
            filter: {
                question: route().params.question ?? null,
                answer: route().params.answer ?? null,
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
                this.$inertia.delete(route("admin.faqs.destroy", id));
                }
            });

        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route("admin.faqs.index"), params);
        },
    },
};
</script>
