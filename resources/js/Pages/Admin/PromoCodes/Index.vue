<template>
    <head>
        <title>Админ панель | Промо кодтар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Промо кодтар</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Промо кодтар</li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-primary mr-2"
                    :href="route('admin.promoCodes.create')"
                >
                    <i class="fa fa-plus"></i> Қосу
                </Link>

                <Link
                    class="btn btn-danger"
                    :href="route('admin.promoCodes.index')"
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
                                        <th>Код</th>
                                        <th>Скидка</th>
                                        <th>Жарамдылық уақыты</th>
                                        <th>Қолданылған саны</th>
                                        <th>Белсенді</th>
                                        <th>Әрекет</th>
                                        <!--       
                                            $table->id();
            $table->string('code')->unique();
            $table->integer('discount_percentage');
            $table->date('completion_date');
            $table->integer('used_counts')->default(0);
            $table->boolean('is_active')->default(false);
            $table->softDeletes();
            $table->timestamps();
             -->
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input
                                                v-model="filter.code"
                                                class="form-control"
                                                placeholder="Код"
                                                type="text"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <input
                                                type="number"
                                                v-model="filter.discount_percentage"
                                                class="form-control"
                                                placeholder="Скидка"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <input
                                                type="date"
                                                v-model="filter.from_date"
                                                class="form-control"
                                                placeholder="от"
                                                @keyup.enter="search"
                                            />
                                             <input
                                                type="date"
                                                v-model="filter.to_date"
                                                class="form-control mt-2"
                                                placeholder="до"
                                                @keyup.enter="search"
                                            />
                                        </td>

                                        <td>
                                             <input
                                                type="number"
                                                v-model="filter.used_counts"
                                                class="form-control"
                                                placeholder="Қолданылған саны"
                                                @keyup.enter="search"
                                            />
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
                                        <td>
                                            <button class="btn btn-success"
                                             @click.prevent="search()">
                                                <i class="fa fa-search"></i>
                                                 Іздеу
                                            </button>  

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd" v-for="(promoCode, index) in promoCodes.data"
                                     :key="'promoCode' + promoCode.id">
                                        <td>
                                            {{
                                                promoCodes.from
                                                    ? promoCodes.from + index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>{{ promoCode.code }}</td>
                                        <td>{{ promoCode.discount_percentage }} %</td>
                                        <td> {{ promoCode.from_date}} - {{ promoCode.to_date }} </td>
                                        <td>
                                            {{
                                                promoCode.used_counts
                                            }}
                                           
                                        </td>
                                          <td>
                                              <span class="badge"
                                              :class="[promoCode.is_active ? 'bg-success' : 'bg-warning']"
                                              >
                                            {{
                                                promoCode.is_active
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
                                                            'admin.promoCodes.edit',
                                                            promoCode
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
                                                            promoCode.id
                                                        )
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
                    <Pagination :links="promoCodes.links" />
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
    props: ["promoCodes"],
    data() {
        return {
            filter: {
                code: route().params.code ? route().params.code : null,
                discount_percentage: route().params.discount_percentage ? route().params.discount_percentage : null,
                from_date: route().params.from_date
                    ? route().params.from_date
                    : null,
                to_date: route().params.to_date
                    ? route().params.to_date
                    : null,
                used_counts: route().params.used_counts
                    ? route().params.used_counts
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
                    this.$inertia.delete(route("admin.promoCodes.destroy", id));
                }
            });
        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route("admin.promoCodes.index"), params);
        },
    },
};
</script>
