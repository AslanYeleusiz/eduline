<template>
    <head>
        <title>Админ панель | Дайындық</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0">
                        {{ subject.name }}
                        <br />
                        Дайындық
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Басты бет
                            </Link>
                        </li>

                        <li class="breadcrumb-item">
                            <Link :href="route('admin.test.subjects.index')">
                                <i class="fas fa-dashboard"></i>
                                Пәндер тізімі
                            </Link>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ subject.name }} - Дайындық
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-primary mr-2"
                    :href="
                        route(
                            'admin.test.subjectPreparations.create',
                            subject.id
                        )
                    "
                >
                    <i class="fa fa-plus"></i> Қосу
                </Link>

                <Link
                    class="btn btn-danger"
                    :href="
                        route(
                            'admin.test.subjectPreparations.index',
                            subject.id
                        )
                    "
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
                            <table class="table table-hover">
                                <tbody>
                                    <template
                                        v-for="preparation in preparations"
                                        :key="'prep' + preparation.id"
                                    >
                                        <tr
                                            data-widget="expandable-table"
                                            aria-expanded="true"
                                        >
                                            <td>
                                                <i
                                                    class="expandable-table-caret fas fa-caret-right fa-fw"
                                                ></i>
                                                {{ preparation.title }}
                                                <button
                                                    @click.prevent="
                                                        deleteData(
                                                            preparation.id
                                                        )
                                                    "
                                                    class="btn ml-2 btn-sm btn-danger"
                                                    title="Жою"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="expandable-body">
                                            <td>
                                                <div class="p-0" style="">
                                                    <table
                                                        class="table mt-2 table-hover table-bordered table-striped dataTable dtr-inline"
                                                    >
                                                        <thead>
                                                            <tr role="row">
                                                                <th>№</th>
                                                                <th>
                                                                    Тақырыпшасы
                                                                </th>
                                                                <th>
                                                                    Түсініктеме
                                                                </th>
                                                                <th>
                                                                    Видео
                                                                    ссылкасы
                                                                </th>
                                                                <th>Әрекет</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr
                                                                class="odd"
                                                                v-for="(
                                                                    preparationItem,
                                                                    index
                                                                ) in preparation.childs"
                                                                :key="
                                                                    'preparationItem' +
                                                                    preparationItem.id
                                                                "
                                                            >
                                                                <td>
                                                                    {{
                                                                        index +
                                                                        1
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        preparationItem.title
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        preparationItem.description
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        preparationItem.video_link
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    <div
                                                                        class="btn-group btn-group-sm"
                                                                    >
                                                                        <Link
                                                                            :href="
                                                                                route(
                                                                                    'admin.test.subjectPreparationQuestions.index',
                                                                                    {
                                                                                        subject:
                                                                                            subject.id,
                                                                                        preparation:
                                                                                            preparationItem.id,
                                                                                    }
                                                                                )
                                                                            "
                                                                            class="btn btn-success"
                                                                            title="Сұрақтар"
                                                                        >
                                                                            <i
                                                                                class="fas fa-question"
                                                                            ></i>
                                                                        </Link>

                                                                        <Link
                                                                            :href="
                                                                                route(
                                                                                    'admin.test.subjectPreparations.edit',
                                                                                    {
                                                                                        subject:
                                                                                            subject.id,
                                                                                        preparation:
                                                                                            preparationItem.id,
                                                                                    }
                                                                                )
                                                                            "
                                                                            class="btn btn-primary"
                                                                            title="Сұрақтар"
                                                                        >
                                                                            <i
                                                                                class="fas fa-edit"
                                                                            ></i>
                                                                        </Link>

                                                                        <button
                                                                            @click.prevent="
                                                                                deleteData(
                                                                                    preparationItem.id
                                                                                )
                                                                            "
                                                                            class="btn btn-danger"
                                                                            title="Жою"
                                                                        >
                                                                            <i
                                                                                class="fas fa-trash"
                                                                            ></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul
                        class="nav nav-tabs"
                        id="custom-tabs-one-tab"
                        role="tablist"
                    >
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                id="custom-tabs-one-home-tab"
                                data-toggle="pill"
                                href="#custom-tabs-one-home"
                                role="tab"
                                aria-controls="custom-tabs-one-home"
                                aria-selected="false"
                                >Тақырып бойынша</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                id="custom-tabs-one-profile-tab"
                                data-toggle="pill"
                                href="#custom-tabs-one-profile"
                                role="tab"
                                aria-controls="custom-tabs-one-profile"
                                aria-selected="true"
                                >Сынып бойынша</a
                            >
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div
                            class="tab-pane fade"
                            id="custom-tabs-one-home"
                            role="tabpanel"
                            aria-labelledby="custom-tabs-one-home-tab"
                        >
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit. Proin malesuada lacus ullamcorper dui
                            molestie, sit amet congue quam finibus. Etiam
                            ultricies nunc non magna feugiat commodo. Etiam odio
                            magna, mollis auctor felis vitae, ullamcorper ornare
                            ligula. Proin pellentesque tincidunt nisi, vitae
                            ullamcorper felis aliquam id. Pellentesque habitant
                            morbi tristique senectus et netus et malesuada fames
                            ac turpis egestas. Proin id orci eu lectus blandit
                            suscipit. Phasellus porta, ante et varius ornare,
                            sem enim sollicitudin eros, at commodo leo est vitae
                            lacus. Etiam ut porta sem. Proin porttitor porta
                            nisl, id tempor risus rhoncus quis. In in quam a
                            nibh cursus pulvinar non consequat neque. Mauris
                            lacus elit, condimentum ac condimentum at, semper
                            vitae lectus. Cras lacinia erat eget sapien porta
                            consectetur.
                        </div>
                        <div
                            class="tab-pane fade active show"
                            id="custom-tabs-one-profile"
                            role="tabpanel"
                            aria-labelledby="custom-tabs-one-profile-tab"
                        >
                            <table class="table table-hover">
                                <tbody>
                                    <template
                                        v-for="testClass in testClasses"
                                        :key="'test' + testClass.id"
                                    >
                                        <tr
                                            data-widget="expandable-table"
                                            aria-expanded="true"
                                        >
                                            <td>
                                                <i
                                                    class="expandable-table-caret fas fa-caret-right fa-fw"
                                                ></i>
                                                {{ testClass.name }}
                                                <br>
                                                <div class="ml-4">    
                                                Тақырыпшалар саны: <b>
                                                {{
                                                    testClass.preparations_count
                                                }}</b>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="expandable-body">
                                            <td>
                                                <div class="ml-3">
                                                    <button
                                                        class="btn btn-sm btn-success"
                                                        @click.prevent="
                                                            openAddTestClassPreparationModal(
                                                                testClass
                                                            )
                                                        "
                                                        title="Қосу"
                                                    >
                                                        <i
                                                            class="fa fa-plus"
                                                        ></i>
                                                    </button>
                                                </div>
                                                <table
                                                    class="table table-hover"
                                                >
                                                    <tbody>
                                                        <table
                                                            class="table mt-2 mb-2 table-hover table-bordered table-striped dataTable dtr-inline"
                                                        >
                                                            <thead>
                                                                <tr role="row">
                                                                    <th>№</th>
                                                                    <th>
                                                                        Тақырыпшасы
                                                                    </th>
                                                                    <th>
                                                                        Әрекет
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr
                                                                    class="odd"
                                                                    v-for="(
                                                                        testClassPreparation,
                                                                        testClassPreparationIndex
                                                                    ) in testClass.preparations"
                                                                    :key="
                                                                        'testClassPreparation' +
                                                                        testClassPreparation.id
                                                                    "
                                                                >
                                                                    <td>
                                                                        {{
                                                                            testClassPreparationIndex +
                                                                            1
                                                                        }}
                                                                    </td>
                                                                    <td>
                                                                        {{
                                                                            testClassPreparation.title
                                                                        }}
                                                                    </td>
                                                                    <td>
                                                                        <div
                                                                            class="btn-group btn-group-sm"
                                                                        >
                                                                            <button
                                                                                v-if="
                                                                                    index !=
                                                                                    0
                                                                                "
                                                                                @click="
                                                                                    changePosition(
                                                                                        testClassPreparation.id,
                                                                                        'top'
                                                                                    )
                                                                                "
                                                                                class="btn btn-success"
                                                                                title="Изменить"
                                                                            >
                                                                                <i
                                                                                    class="fas fa-long-arrow-alt-up"
                                                                                ></i>
                                                                            </button>

                                                                            <button
                                                                                v-if="
                                                                                    index !==
                                                                                    testClass
                                                                                        .preparations
                                                                                        .length -
                                                                                        1
                                                                                "
                                                                                @click="
                                                                                    changePosition(
                                                                                        testClassPreparationIndex,
                                                                                        'top'
                                                                                    )
                                                                                "
                                                                                class="btn btn-primary"
                                                                                title="Сұрақтар"
                                                                            >
                                                                                <i
                                                                                    class="fas fa-long-arrow-alt-down"
                                                                                ></i>
                                                                            </button>

                                                                            <button
                                                                                @click.prevent="
                                                                                    deleteTestClassPreparation(
                                                                                        testClassPreparation.id
                                                                                    )
                                                                                "
                                                                                class="btn btn-danger"
                                                                                title="Жою"
                                                                            >
                                                                                <i
                                                                                    class="fas fa-trash"
                                                                                ></i>
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add-preparation-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{ testClassItem.name }} - Тақырыпша қосу
                        </h4>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table
                            class="table mt-2 mb-2 table-hover table-bordered table-striped dataTable dtr-inline"
                        >
                            <thead>
                                <tr>
                                    <th>Тақырыпша</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <template
                                    v-for="preparation in preparations"
                                    :key="'addPreparation' + preparation.id"
                                >
                                    <tr
                                        v-for="preparationItem in preparation.childs"
                                        :key="
                                            'addPreparationItem' +
                                            preparationItem.id
                                        "
                                    >
                                        <td>{{ preparationItem.title }}</td>
                                        <td>
                                            <input
                                                type="checkbox"
                                                name=""
                                                id=""
                                                style="
                                                    width: 20px;
                                                    height: 20px;
                                                "
                                                v-model="testClassItemPreparationIds"
                                            />
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button
                            type="button"
                            class="btn btn-default"
                            data-dismiss="modal"
                        >
                            Жабу
                        </button>
                        <button type="button"
                        @click.prevent="saveClassPreparations" 
                        class="btn btn-primary">
                            Сақтау
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../../../Components/Pagination.vue";

export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        Head,
    },
    props: ["preparations", "subject", "testClasses"],
    data() {
        return {
            filter: {
                name: route().params.name ?? null,
                description: route().params.description ?? null,
                questions_count: route().params.questions_count ?? null,
                language_id: route().params.language_id ?? null,
                is_pedagogy: route().params.is_pedagogy ?? null,
            },
            testClassItem: {},
            testClassItemPreparationIds: [],
        };
    },
    methods: {
        saveClassPreparations() {
            
            console.log('addClassPreparations')
        },
        openAddTestClassPreparationModal(testClass) {
            this.testClassItem = testClass
            this.testClassItemPreparationIds = testClass.preparations.map(item => item.id)
            $("#add-preparation-modal").modal("show");
        },
        deleteTestClassPreparation(id) {
            console.log("id", id);
        },
        addTestClassPreparation(class_id) {
            console.log("addTestClassPreparation");
        },
        changePosition(id, position = "top") {
            const fromIndex = this.option.questions.findIndex(
                (i) => i.id == id
            );
            const toIndex = position == "top" ? fromIndex - 1 : fromIndex + 1;
            const element = this.option.questions.splice(fromIndex, 1)[0];
            this.option.questions.splice(toIndex, 0, element);
        },
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
                    this.$inertia.delete(
                        route("admin.test.subjectPreparations.destroy", {
                            subject: this.subject.id,
                            preparation: id,
                        })
                    );
                }
            });
        },
        search() {
            const params = this.clearParams(this.filter);
            this.$inertia.get(
                route("admin.test.subjectPreparations.index", this.subject.id),
                params
            );
        },
    },
};
</script>
