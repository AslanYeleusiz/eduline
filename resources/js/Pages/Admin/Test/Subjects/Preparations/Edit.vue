<template>
    <head>
        <title>Админ панель | Дайындық тақырыбын өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0"> 
                        {{ subject.name }}
                        <br> 
                         Дайындық тақырыбын өзгерту №{{preparation.id}}
                         </h5>
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
                            <a :href="route('admin.test.subjects.index')">
                                <i class="fas fa-dashboard"></i>
                                Пәндер тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                     {{ subject.name }} - Дайындық тақырыбын өзгерту №{{preparation.id}}
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="post" @submit.prevent="submit">
                    <div class="card-body">
                   <div class="form-group">
                            <label for="">Тақырып</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="preparation.title"
                                name="title"
                                placeholder="Тақырып"
                            />
                            <validation-error :field="'title'" />
                        </div>
                        <div class="form-group">
                            <label for="">Видео ссылка</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="preparation.video_link"
                                name="video_link"
                                placeholder="Видео ссылка"
                            />
                            <validation-error :field="'video_link'" />
                        </div>
                        <div class="form-group">
                            <label for="">Негізгі тақырып</label>
                            <select v-model="preparation.parent_id" class="form-control">
                                <option v-for="parentPreparation in parentPreparations"
                                    :value="parentPreparation.id"
                                    :key="'parentPreparation' + parentPreparation.id">
                                    {{ parentPreparation.title}}
                                </option>  
                                <option :value="null">Жоқ</option>
                            </select>
                            <validation-error :field="'parent_id'" />
                        </div>
                        <div class="form-group">
                            <label for="">Түсініктеме</label>
                            <textarea
                                v-model="preparation.description"
                                class="form-control"
                                row="20"
                                placeholder="Түсініктеме"
                                col="10"
                            >
                            </textarea>
                            <validation-error :field="'description'" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-1">
                            Сақтау
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click.prevent="back()"
                        >
                            Артқа
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../../../Components/Pagination.vue";
import ValidationError from "../../../../../Components/ValidationError.vue";

export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        ValidationError,
        Head,
    },
    props: ["subject", "preparation", "parentPreparations"],
    methods: {
        submit() {
            this.$inertia.put(
                route("admin.test.subjectPreparations.update", {subject:this.subject.id, preparation: this.preparation.id}),
                this.preparation,
                {
                    onError: () => console.log("An error has occurred"),
                    onSuccess: () =>
                        console.log("The new contact has been saved"),
                }
            );
        },
    },
};
</script>
