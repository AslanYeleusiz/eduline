<template>
    <head>
        <title>Админ панель | Жеке кеңес</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жеке кеңес</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Жеке кеңес</li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-primary mr-2"
                    :href="route('admin.personalAdvice.create')"
                >
                    <i class="fa fa-plus"></i> Қосу
                </Link>

                <Link
                    class="btn btn-danger"
                    :href="route('admin.personalAdvice.index')"
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
                                        <th>Тақырып</th>
                                        <th>Бағасы</th>
                                        <th>Скидка</th>
                                        <th>Белсенді</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input
                                                v-model="filter.title"
                                                class="form-control"
                                                placeholder="Тақырып"
                                                type="text"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <input
                                                type="number"
                                                v-model="filter.price"
                                                class="form-control"
                                                placeholder="Бағасы"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                     <td>
                                            <select
                                                placeholder="Скидка"
                                                v-model="filter.is_discount"
                                                @change="search"
                                                class="form-control"
                                            >
                                                <option  :value="null">
                                                    Барлығы
                                                </option>
                                                <option value="false">
                                                    Жоқ
                                                </option>
                                                <option value="true">
                                                    Бар
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select
                                                placeholder="Белсенді"
                                               @change="search"
                                                v-model="filter.is_active"
                                                class="form-control"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option value="false">
                                                    Жоқ
                                                </option>
                                                <option value="true">
                                                    Бар
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
                                            personalAdvice, index
                                        ) in personalAdvices.data"
                                        :key="'personalAdvice' + personalAdvice.id"
                                    >
                                        <td>
                                            {{
                                                personalAdvices.from
                                                    ? personalAdvices.from + index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>{{ personalAdvice.title.kk }}</td>
                                        <td>{{ personalAdvice.price }} тг.</td>
                                        <td>
                                            {{
                                                personalAdvice.is_discount
                                                    ? "Иә"
                                                    : "Жоқ"
                                            }}
                                            <template
                                                v-if="personalAdvice.is_discount"
                                            >
                                                <br />
                                                {{
                                                    personalAdvice.discount_percentage
                                                }}%
                                            </template>
                                        </td>
                                          <td>
                                              <span class="badge"
                                              :class="[personalAdvice.is_active ? 'bg-success' : 'bg-warning']"
                                              >
                                            {{
                                                personalAdvice.is_active
                                                    ? "Белсенді"
                                                    : "Белсенді емес"
                                            }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.personalAdvice.edit',
                                                            personalAdvice
                                                        )
                                                    "
                                                    class="btn btn-primary"
                                                    title="Изменить"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </Link>

                                                <button
                                                    @click.prevent="
                                                        deleteData(
                                                            personalAdvice.id
                                                        )
                                                    "
                                                    class="btn btn-danger"
                                                    title="Жою"
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
                    <Pagination :links="personalAdvices.links" />
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
    props: ["personalAdvices"],
    data() {
        return {
            filter: {
                title: route().params.title ? route().params.title : null,
                price: route().params.price ? route().params.price : null,
                is_discount: route().params.is_discount
                    ? route().params.is_discount
                    : null,
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
                cancelButtonText: "Жоқ",
            }).then((result) => {
                if (result.isConfirmed) {
                     this.$inertia.delete(route("admin.personalAdvice.destroy", id));
                }
            });
          
        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route("admin.personalAdvice.index"), params);
        },
    },
};
</script>
