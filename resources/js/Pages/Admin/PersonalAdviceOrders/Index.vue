<template>
    <head>
        <title>Админ панель | Жеке кеңеске тапсырыстар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жеке кеңеске тапсырыстар</h1>
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
                            Жеке кеңеске тапсырыстар
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-danger"
                    :href="route('admin.personalAdviceOrders.index')"
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
                                        <th>Аты-жөні</th>
                                        <th>Телефон</th>
                                        <th>Жеке кеңес</th>
                                        <th>Комментария(заметка)</th>
                                        <th>Уақыты</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input
                                                v-model="filter.full_name"
                                                class="form-control"
                                                placeholder="Аты-жөні"
                                                type="text"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <input
                                                type="text"
                                                v-model="filter.phone"
                                                class="form-control"
                                                placeholder="Телефон"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <select
                                                placeholder="Скидка"
                                                v-model="filter.personal_advice_id"
                                                @change="search"
                                                class="form-control"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option
                                                    :key="
                                                        'personalAdvicesItems' + index
                                                    "
                                                    :value="personalAdviceItem.id"
                                                    v-for="(
                                                        personalAdviceItem, index
                                                    ) in personalAdvices"
                                                >
                                                    {{ personalAdviceItem.title.kk }}
                                                </option>
                                            </select>
                                        </td>

                                        <td>
                                            <input
                                                v-model="filter.comment_for_note"
                                                class="form-control"
                                                placeholder="Комментария"
                                                type="text"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(
                                            personalAdviceOrder, index
                                        ) in personalAdviceOrders.data"
                                        :key="'personalAdviceOrder' + personalAdviceOrder.id"
                                    >
                                        <td>
                                            {{
                                                personalAdviceOrders.from
                                                    ? personalAdviceOrders.from + index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>{{ personalAdviceOrder.full_name }}</td>
                                        <td>{{ personalAdviceOrder.phone }}</td>
                                        <td>{{ personalAdviceOrder.personal_advice.title.kk }}</td>
                                      <td>
                                           {{ personalAdviceOrder.comment_for_note }}
                                        </td>   
                                        <td>
                                           {{ personalAdviceOrder.created_at ?  (new Date(personalAdviceOrder.created_at).toLocaleDateString()): 'Анықталмады'  }}
                                        </td>
                                      
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.personalAdviceOrders.edit',
                                                            personalAdviceOrder
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
                                                            personalAdviceOrder.id
                                                        )
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
                    <Pagination :links="personalAdviceOrders.links" />
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
    props: ["personalAdviceOrders", "personalAdvices"],
    data() {
        return {
            filter: {
                full_name: route().params.full_name ? route().params.full_name : null,
                phone: route().params.phone ? route().params.phone : null,
                personal_advice_id: route().params.personal_advice_id ? route().params.personal_advice_id : null,
                 comment_for_note: route().params.comment_for_note ? route().params.comment_for_note : null,
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
                 this.$inertia.delete(route("admin.personalAdviceOrders.destroy", id));
                }
            });
         
        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route("admin.personalAdviceOrders.index"), params);
        },
    },
};
</script>
