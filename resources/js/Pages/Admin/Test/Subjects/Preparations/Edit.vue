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
                        <br />
                        Дайындық тақырыбын өзгерту №{{ preparation.id }}
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
                                Пәндер
                            </a>
                        </li>
                           <li class="breadcrumb-item">
                            <a :href="route('admin.test.subjectPreparations.index', {subject: subject.id})">
                                <i class="fas fa-dashboard"></i>
                                {{ subject.name }} - Дайындық
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Тақырып өзгерту №{{
                                preparation.id
                            }}
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
                            <label for="">Негізгі тақырып (Родительская)</label>
                            <select
                                v-model="preparation.parent_id"
                                class="form-control"
                            >
                                <option
                                    v-for="parentPreparation in parentPreparations"
                                    :value="parentPreparation.id"
                                    :key="
                                        'parentPreparation' +
                                        parentPreparation.id
                                    "
                                >
                                    {{ parentPreparation.title }}
                                </option>
                                <option :value="null">Жоқ</option>
                            </select>
                            <validation-error :field="'parent_id'" />
                        </div>
                        <div class="form-group">
                            <label for="">{{ !preparation.parent_id ? 'Тақырыпша' : 'Тақырып'}}</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="preparation.title"
                                name="title"
                                placeholder="Тақырып"
                            />
                            <validation-error :field="'title'" />
                        </div>
                        <template v-if="preparation.parent_id">
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
                        <div class="form-group">
                            <label>Сыныптар</label>
                            <ul class="ul-li-no-style">
                                <li>
                                    <input
                                        type="checkbox"
                                        v-model="selectAllClassItems"
                                    />
                                    <label class="ml-1">Барлығы</label>
                                </li>
                                <li
                                    v-for="classItem in classItems"
                                    :key="'classItem' + classItem.id"
                                >
                                    <input
                                        :id="'classItem' + classItem.name"
                                        v-model="classIds"
                                        type="checkbox"
                                        :value="classItem.id"
                                    />
                                    <label
                                        class="ml-1"
                                        :for="'classItem' + classItem.name"
                                    >
                                        {{ classItem.name }}
                                    </label>
                                </li>
                            </ul>
                        </div>
                            </template>    
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
    props: ["subject", "preparation", "class_ids",
     "parentPreparations", "classItems"],
    data() {
        return {
            classIds: [],
            selectAllClassItems: false
        };
    },
    methods: {
        submit() {
            this.preparation.class_ids = this.classIds;
            this.$inertia.put(
                route("admin.test.subjectPreparations.update", {
                    subject: this.subject.id,
                    preparation: this.preparation.id,
                }),
                this.preparation,
                {
                    onError: () => console.log("An error has occurred"),
                    onSuccess: () =>
                        console.log("The new contact has been saved"),
                }
            );
        },
    },
    watch: {
        selectAllClassItems: {
            handler(val, oldVal) {
                if (val) {
                    this.classIds = this.classItems.map((item) => item.id);
                } else {
                    this.classIds = [];
                }
            },
        },
    },
    created() {
        this.classIds = this.clone(this.class_ids);
    }
};
</script>

<style>
li {
    list-style: none;
}
ul {
    padding-left: 20px !important;
}
</style>