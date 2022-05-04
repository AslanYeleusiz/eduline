<template>
    <div>
        <AdminLayout>
            <template #breadcrumbs></template>
            <template #header>
                <div class="btn-group">
                    <a
                        class="btn btn-success"
                        href="{{route('admin.specifications.create')}}"
                    >
                        <i class="fa fa-plus"></i>
                        Добавить
                    </a>
                    <a
                        class="btn btn-danger ml-2"
                        href="{{route('admin.specifications.index')}}"
                    >
                        <i class="fa fa-trash"></i>
                        Очистить фильтр
                    </a>
                </div>
            </template>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body p-0">
                        <Head>{{ title }}</Head>
                        <h1>{{ title }}</h1>
                        <Link :href="route('admin.about')"> About</Link>
                        
                        <Link :href="route('admin.users.index')"> Users</Link>
                    </div>
                </div>
            </div>
        </AdminLayout>
    </div>
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AdminLayout from "../Layouts/AdminLayout";

export default {
    components: {
        Link,
        Head,
        AdminLayout,
    },
    props: {
        title: String,
    },
};
</script>
