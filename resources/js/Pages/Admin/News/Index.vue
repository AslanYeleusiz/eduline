<template>
  <head>
        <title>Админ панель | Жаңалықтар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жаңалықтар тізімі</h1>
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
                            Жаңалықтар тізімі
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link class="btn btn-primary mr-2" :href="route('admin.news.create')">
                    <i class="fa fa-plus"></i> Қосу 
                </Link>
                
                <Link class="btn btn-danger" :href="route('admin.news.index')">
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
                                        <th>Тақырыбы</th>
                                        <th>Қысқаша түсініктеме</th>
                                        <th>Бағыты</th>
                                        <th>Қаралым саны</th>  
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input
                                                v-model="filter.title"
                                                class="form-control"
                                                placeholder="Тақырыбы"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <input
                                                v-model="filter.short_description"
                                                class="form-control"
                                                placeholder="Қысқаша түсініктеме"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <select
                                                v-model="filter.news_type_id"
                                                class="form-control"
                                                placeholder="Бағыты"
                                                @change.prevent="search"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option :value="newsType.id"
                                                :key="'newsType'+ newsType.id"
                                                v-for="newsType in newsTypes">
                                                    {{ newsType.name.kk }}
                                                </option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(newsItem, index) in news.data"
                                        :key="'newsItem' + newsItem.id"
                                    >
                                        <td>
                                            {{
                                                news.from
                                                    ? news.from + index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>{{ newsItem.title.kk }}</td>
                                        <td v-html="newsItem.short_description.kk"></td>
                                        <td>{{ newsItem.news_type.name.kk }}</td>
                                        <td>{{ newsItem.view }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.news.comments',
                                                           {'id': newsItem.id}
                                                        )
                                                    "
                                                    class="btn btn-success"
                                                    title="Пікірлер"
                                                >
                                                    <i class="fas fa-comment"></i>
                                                </Link>

                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.news.edit',
                                                            newsItem
                                                        )
                                                    "
                                                    class="btn btn-primary"
                                                    title="Изменить"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </Link>

                                                <button
                                                @click.prevent="deleteData(newsItem.id)"
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
                    <Pagination :links="news.links" />
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
    props: ["news", "newsTypes"],
    data() {
        return {
            filter: {
                title: route().params.title ? route().params.title: null,
                short_description: route().params.short_description ? route().params.short_description: null,
                news_type_id: route().params.news_type_id ? route().params.news_type_id : null,
                view: route().params.view ? route().params.view : null,
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
                 this.$inertia.delete(route('admin.news.destroy', id))
                }
            });
       

        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route('admin.news.index'),params)
        },
    }
};
</script>
