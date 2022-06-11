<template>
    <head>
        <title>Админ панель | жоюға жіберілген материалды өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Өзгерген материал № {{ material.id }}</h1>
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
                            <a :href="route('admin.editedMaterials.index')">
                                <i class="fas fa-dashboard"></i>
                                Өзгертуге жіберілген материалдар тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Өзгерген материал № {{ material.id }}
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Өзгертуге жіберілген материал жайлы ақпарат
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div
                            class="col-12 col-md-12 col-lg-12 order-2 order-md-1"
                        >
                            <div class="row">
                                <div class="col-6">
                                    <h4>Бұрыңғы версиясы</h4>
                                    <div class="post">
                                        <div class="user-block">
                                            <span
                                                class="username"
                                                style="
                                                    margin-left: 0 !important;
                                                "
                                            >
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.materials.edit',
                                                            material.id
                                                        )
                                                    "
                                                    >{{ oldMaterial.title }}
                                                </Link>
                                            </span>
                                            <span
                                                class="description"
                                                style="
                                                    margin-left: 0 !important;
                                                "
                                                >Жарияланған уақыты -
                                                {{
                                                    oldMaterial.created_at
                                                        ? new Date(
                                                              oldMaterial.created_at
                                                          ).toLocaleDateString()
                                                        : "Анықталмады"
                                                }}</span
                                            >
                                        </div>

                                        <p class="mb-0">
                                            <b>Түсініктеме:</b>
                                            {{ oldMaterial.description }}
                                        </p>

                                        <p class="mb-0">
                                            <b>Пәні:</b>
                                            {{ oldMaterial.subject.name }}
                                        </p>

                                        <p class="mb-0">
                                            <b>Бағыты:</b>
                                            {{ oldMaterial.direction.name }}
                                        </p>

                                        <p class="mb-0">
                                            <b>Сыныбы:</b>
                                            {{ oldMaterial.class.name }}
                                        </p>
                                        <p>
                                            <a
                                                target="_blank"
                                                :href="
                                                    route(
                                                        'materials.download',
                                                        oldMaterial.id
                                                    )
                                                "
                                                class="link-black text-sm"
                                                ><i
                                                    class="fas fa-link mr-1"
                                                ></i>
                                                Материалды ашу</a
                                            >
                                        </p>
                                    </div>
                                    <h4>Қолданушы</h4>
                                    <div class="post">
                                        <div class="user-block">
                                            <img
                                                class="img-circle img-bordered-sm"
                                                :src="
                                                    material.user.avatar
                                                        ? route('index') +
                                                          '/storage/images/avatars/' +
                                                          material.user.avatar
                                                        : route('index') +
                                                          '/images/user.png'
                                                "
                                                alt="user image"
                                            />
                                            <span class="username">
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.users.edit',

                                                            material.user.id
                                                        )
                                                    "
                                                >
                                                    {{
                                                        material.user.full_name
                                                    }}
                                                </Link>
                                            </span>
                                            <span class="description"
                                                >Тіркелген уақыты -
                                                {{
                                                    material.user.created_at
                                                        ? new Date(
                                                              material.user.created_at
                                                          ).toLocaleDateString()
                                                        : "Анықталмады"
                                                }}</span
                                            >
                                        </div>

                                        <p>
                                            <b>Жұмыс орны:</b>
                                            {{
                                                material.user.place_work ??
                                                "Толтырылмаған"
                                            }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h4>Өзгерген версиясы</h4>
                                    <div class="post">
                                        <div class="user-block">
                                            <span
                                                class="username"
                                                style="
                                                    margin-left: 0 !important;
                                                "
                                            >
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.materials.edit',
                                                            material.id
                                                        )
                                                    "
                                                    >{{ material.title }}
                                                </Link>
                                            </span>
                                            <span
                                                class="description"
                                                style="
                                                    margin-left: 0 !important;
                                                "
                                                >Жарияланған уақыты -
                                                {{
                                                    material.created_at
                                                        ? new Date(
                                                              material.created_at
                                                          ).toLocaleDateString()
                                                        : "Анықталмады"
                                                }}</span
                                            >
                                        </div>

                                        <p class="mb-0">
                                            <b>Түсініктеме:</b>
                                            {{ material.description }}
                                        </p>

                                        <p class="mb-0">
                                            <b>Пәні:</b>
                                            {{ material.subject.name }}
                                        </p>

                                        <p class="mb-0">
                                            <b>Бағыты:</b>
                                            {{ material.direction.name }}
                                        </p>

                                        <p class="mb-0">
                                            <b>Сыныбы:</b>
                                            {{ material.class.name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Жинақты өзгерту</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Статус</label>
                                <select
                                    class="form-control"
                                    v-model="material.status_edited"
                                >
                                    <option value="1">Қаралмады</option>
                                    <option value="2">Қабылданбады</option>
                                    <option value="3">Қабылданды</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button @click.prevent="back()" class="btn mr-2 btn-danger">
                        Артқа
                    </button>
                    <button class="btn btn-success" @click.prevent="submit()">
                        Сақтау
                    </button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../Components/Pagination.vue";
import ValidationError from "../../../Components/ValidationError.vue";

export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        ValidationError,
        Head,
    },
    props: ["material","oldMaterial"],
    methods: {
        submit() {
            let data = {};
            data["_method"] = "put";
            data.status_edited = this.material.status_edited;
            data.title = this.material.title;
            data.description = this.material.description;
            data.subject_id = this.material.subject_id;
            data.direction_id = this.material.direction_id;
            data.class_id = this.material.class_id;
            this.$inertia.post(
                route("admin.editedMaterials.update", this.material.id),
                data,
                {
                    forceFormData: true,
                    onError: () => console.log("An error has occurred"),
                    onSuccess: (res) => {
                        console.log("res", res);
                        console.log("The new contact has been saved");
                    },
                }
            );
        },

    },
};
</script>
