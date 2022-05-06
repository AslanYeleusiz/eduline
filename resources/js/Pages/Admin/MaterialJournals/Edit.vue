<template>
    <head>
        <title>Админ панель | Жинақ материалын өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        Жинақ № {{ materialJournal.id }}
                    </h1>
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
                            <a :href="route('admin.materialJournals.index')">
                                <i class="fas fa-dashboard"></i>
                                Жинақтар тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Жинақ № {{ materialJournal.id }}
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Жинақты жайлы ақпарат</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div
                            class="col-12 col-md-12 col-lg-8 order-2 order-md-1"
                        >
                            <div class="row">
                                <div class="col-12">
                                    <h4>Материал</h4>
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
                                                            materialJournal
                                                                .material.id
                                                        )
                                                    "
                                                    >{{
                                                        materialJournal.material
                                                            .title
                                                    }}
                                                </Link>
                                            </span>
                                            <span
                                                class="description"
                                                style="
                                                    margin-left: 0 !important;
                                                "
                                                >Жарияланған уақыты -
                                                {{
                                                    materialJournal.material
                                                        .created_at
                                                        ? new Date(
                                                              materialJournal.material.created_at
                                                          ).toLocaleDateString()
                                                        : "Анықталмады"
                                                }}</span
                                            >
                                        </div>

                                        <p class="mb-0">
                                            <b>Түсініктеме:</b>
                                            {{
                                                materialJournal.material
                                                    .description
                                            }}
                                        </p>

                                        <p class="mb-0">
                                            <b>Пәні:</b>
                                            {{
                                                materialJournal.material.subject
                                                    .name
                                            }}
                                        </p>

                                        <p class="mb-0">
                                            <b>Бағыты:</b>
                                            {{
                                                materialJournal.material
                                                    .direction.name
                                            }}
                                        </p>

                                        <p class="mb-0">
                                            <b>Сыныбы:</b>
                                            {{
                                                materialJournal.material.class
                                                    .name
                                            }}
                                        </p>
                                        <p>
                                            <a
                                                target="_blank"
                                                :href="
                                                    route(
                                                        'materials.download',
                                                        materialJournal.material
                                                            .id
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
                                    <h4>Автор</h4>
                                    <div class="post">
                                        <div class="user-block">
                                            <img
                                                class="img-circle img-bordered-sm"
                                                :src="
                                                    materialJournal.material
                                                        .user.avatar
                                                        ? route('index') +
                                                          '/storage/images/avatars/' +
                                                          materialJournal
                                                              .material.user
                                                              .avatar
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
                                                            materialJournal
                                                                .material.user
                                                                .id
                                                        )
                                                    "
                                                >
                                                    {{
                                                        materialJournal.material
                                                            .user.full_name
                                                    }}
                                                </Link>
                                            </span>
                                            <span class="description"
                                                >Тіркелген уақыты -
                                                {{
                                                    materialJournal.material
                                                        .user.created_at
                                                        ? new Date(
                                                              materialJournal.material.user.created_at
                                                          ).toLocaleDateString()
                                                        : "Анықталмады"
                                                }}</span
                                            >
                                        </div>

                                        <p>
                                            <b>Жұмыс орны:</b>
                                            {{
                                                materialJournal.material.user
                                                    .place_work ??
                                                "Толтырылмаған"
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-12 col-md-12 col-lg-4 order-1 order-md-2"
                        >
                            <h3 class="text-primary">
                                <i class="fas fa-user"></i> Қолданушы
                            </h3>
                            <div class="text-muted">
                                <p class="text-sm">
                                    Аты-жөні
                                    <Link
                                        :href="
                                            route(
                                                'admin.users.edit',
                                                materialJournal.user.id
                                            )
                                        "
                                    >
                                        <b class="d-block">{{
                                            materialJournal.user.full_name
                                        }}</b>
                                    </Link>
                                </p>

                                <p class="text-sm mb-0">
                                    Тіркелген уақыты
                                    <b class="d-block">
                                        {{
                                            materialJournal.user.created_at
                                                ? new Date(
                                                      materialJournal.user.created_at
                                                  ).toLocaleDateString()
                                                : "Анықталмады"
                                        }}
                                    </b>
                                </p>

                                
                                <p class="text-sm">
                                    Жұмыс орны:
                                    <b class="d-block">{{
                                        materialJournal.user.place_work ??
                                        "Толтырылмаған"
                                    }}</b>
                                </p>
                                <p class="text-sm ">
                                    Жинаққа жіберген уақыты
                                    <b class="d-block">
                                        {{
                                            materialJournal.created_at
                                                ? new Date(
                                                      materialJournal.created_at
                                                  ).toLocaleDateString()
                                                : "Анықталмады"
                                        }}
                                    </b>
                                </p>
                            </div>
                            <br />


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
                                <select class="form-control" 
                                v-model="materialJournal.status">
                                    <option :value="null">Қаралмады</option>
                                    <option value="1">Қабылданбады</option>
                                    <option value="2">Қабылданды</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button
                                    @click.prevent="back()"
                                    class="btn mr-2 btn-danger"
                                >
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
    props: ["materialJournal"],
    methods: {
        submit() {
            let data = {}
            data["_method"] = "put";
            data.status = this.materialJournal.status 
            this.$inertia.post(
                route("admin.materialJournals.update", this.materialJournal.id),
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