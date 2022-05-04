<template>
  <head>
        <title>Админ панель | Жаңалық пікірлері</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs> 
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">№{{this.news.id}} Жаңалық пікірлері</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a :href="route('admin.news.index')">
                                <i class="fas fa-dashboard"></i>
                                Жаңалықтар тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            №{{this.news.id}} Жаңалық пікірлері
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <!-- <Link class="btn btn-primary mr-2" :href="route('admin.news.create')">
                    <i class="fa fa-plus"></i> Қосу 
                </Link> -->
                
                <Link class="btn btn-danger" :href="route('admin.news.comments', this.news.id)">
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
                                        <th>Піңір</th>
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
                                                v-model="filter.text"
                                                class="form-control"
                                                placeholder="Пікір"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(comment, index) in news.comments"
                                        :key="'comment' + comment.id"
                                    >
                                        <td>
                                            {{
                                                index + 1
                                            }}
                                        </td>
                                        <td>{{ comment.user.full_name }}</td>
                                        <td>{{ comment.text }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                @click.prevent="deleteData(comment.id)"
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
    props: ["news"],
    data() {
        return {
            filter: {
                full_name: route().params.full_name ? route().params.full_name: null,
                text: route().params.text ? route().params.text: null,
            },
        };
    },
    methods: {
        deleteData(id) {
            this.$inertia.delete(route('admin.news.commentsDelete', {'id': this.news.id,'comment_id': id}))
        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(route('admin.news.comments', {'id': this.news.id}),params)
        },
    }
};
</script>
