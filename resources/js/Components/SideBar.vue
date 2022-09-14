<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a :href="route('index')" class="brand-link ml-3">
            <!-- <img
                :src="route('index') + '/images/logo.png'"
                :alt="$page.props.app_name + ' Logo'"
                class="brand-image img-circle elevation-3"
                style="opacity: 0.8"
            /> -->
            <span class="brand-text font-weight-light">{{
                $page.props.app_name
            }}</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <svg class="svg-icon" style="
                            width: 2em;
                            height: 2em;
                            vertical-align: middle;
                            fill: #c2c7d0;
                            overflow: hidden;
                        " viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M843.282963 870.115556c-8.438519-140.515556-104.296296-257.422222-233.908148-297.14963C687.881481 536.272593 742.4 456.533333 742.4 364.088889c0-127.241481-103.158519-230.4-230.4-230.4S281.6 236.847407 281.6 364.088889c0 92.444444 54.518519 172.183704 133.12 208.877037-129.611852 39.727407-225.46963 156.634074-233.908148 297.14963-0.663704 10.903704 7.964444 20.195556 18.962963 20.195556l0 0c9.955556 0 18.299259-7.774815 18.962963-17.73037C227.745185 718.506667 355.65037 596.385185 512 596.385185s284.254815 122.121481 293.357037 276.195556c0.568889 9.955556 8.912593 17.73037 18.962963 17.73037C835.318519 890.311111 843.946667 881.019259 843.282963 870.115556zM319.525926 364.088889c0-106.287407 86.186667-192.474074 192.474074-192.474074s192.474074 86.186667 192.474074 192.474074c0 106.287407-86.186667 192.474074-192.474074 192.474074S319.525926 470.376296 319.525926 364.088889z" />
                    </svg>
                    <!-- <img
                        :src="route('index') + '/images/user2-160x160.jpg'"
                        class="img-circle elevation-2"
                        alt="User Image"
                    /> -->
                </div>
                <div class="info">
                    <Link :href="route('admin.users.index')" class="d-block">
                    <!--                       {{$page.props.user.full_name}}-->
                    Әкімшілік панелі
                    </Link>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <template v-for="(menu_item, index) in menu_items" :key="'menu_item' + index">
                        <li class="nav-item" v-if="menu_item.childs_items" :class="{
                                'menu-open':
                                    menu_item.menu_active.includes(
                                        currentRoute
                                    ),
                            }">
                            <a href="#" class="nav-link" :class="{
                                    active: menu_item.menu_active.includes(
                                        currentRoute
                                    ),
                                }">
                                <i class="nav-icon fas fa-solid" :class="[menu_item.font]"></i>
                                <p>
                                    {{ menu_item.name }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ml-2" v-for="(
                                        childs_item, child_index
                                    ) in menu_item.childs_items" :key="'child' + child_index">
                                    <Link :href="route(childs_item.route_name)" class="nav-link" :class="{
                                            active: childs_item.menu_active.includes(
                                                currentRoute
                                            ),
                                        }">
                                    <i class="nav-icon fas" :class="childs_item.font"></i>
                                    <p>{{ childs_item.name }}</p>
                                    </Link>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item" v-else>
                            <Link :href="route(menu_item.route_name)" class="nav-link" :class="{
                                    active: menu_item.menu_active.includes(
                                        currentRoute
                                    ),
                                }">
                            <i class="nav-icon fas" :class="menu_item.font"></i>
                            <p>{{ menu_item.name }}</p>
                            </Link>
                        </li>
                    </template>

                    <li class="nav-item">
                        <a class="nav-link" :href="route('logout')">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Шығу</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>
<script>
    import {
        Link
    } from "@inertiajs/inertia-vue3";

    export default {
        components: {
            Link,
        },
        methods: {
            logout() {
                this.$inertia.get(route("logout"));
            },
        },
        data() {
            return {
                menu_items: [{
                        name: "Рөлдер",
                        font: "fa-cogs",
                        route_name: "admin.roles.index",
                        menu_active: ["admin.roles"],
                    },
                    {
                        name: "Қолданушылар",
                        font: "fa-users",
                        route_name: "admin.users.index",
                        menu_active: ["admin.users"],
                    },
                    {
                        name: "Жазылымдар",
                        font: "fa-rocket",
                        route_name: "admin.subscriptions.index",
                        menu_active: ["admin.subscriptions"],
                    },

                    {
                        name: "Промо код",
                        font: "fa-barcode",
                        route_name: "admin.promoCodes.index",
                        menu_active: ["admin.promoCodes"],
                    },

                    {
                        name: "Жинақ материалдар",
                        font: "fa-book",
                        route_name: "admin.materialJournals.index",
                        menu_active: ["admin.materialJournals"],
                    },
                    {
                        name: "Материалдар",
                        font: "fa-list",
                        menu_active: [
                            "admin.materials",
                            "admin.deletedMaterials",
                            "admin.editedMaterials",
                            "admin.materialClasses",
                            "admin.materialDirections",
                            "admin.materialSubjects",
                        ],
                        route_name: "",
                        childs_items: [{
                                name: "Материалдар",
                                font: "fa-file",
                                route_name: "admin.materials.index",
                                menu_active: ["admin.materials"],
                            },
                            {
                                name: "Жойылған материалдар",
                                font: "fa-file",
                                route_name: "admin.deletedMaterials.index",
                                menu_active: ["admin.deletedMaterials"],
                            },
                            {
                                name: "Өзгертілген материалдар",
                                font: "fa-file",
                                route_name: "admin.editedMaterials.index",
                                menu_active: ["admin.editedMaterials"],
                            },

                            {
                                name: "Материалдар Сыныбы",
                                font: "fa-file",
                                route_name: "admin.materialClasses.index",
                                menu_active: ["admin.materialClasses"],
                            },
                            {
                                name: "Материалдар Бағыты",
                                font: "fa-file",
                                route_name: "admin.materialDirections.index",
                                menu_active: ["admin.materialDirections"],
                            },
                            {
                                name: "Материалдар Пәні",
                                font: "fa-file",
                                route_name: "admin.materialSubjects.index",
                                menu_active: ["admin.materialSubjects"],
                            },
                        ],
                    },
                    {
                        name: "Жиі қойылатын сұрақтар",
                        font: "fa-question",
                        route_name: "admin.faqs.index",
                        menu_active: ["admin.faqs"],
                    },
                    {
                        name: "Жаңалықтар",
                        font: "fa-newspaper",
                        menu_active: ["admin.newsTypes", "admin.news", "admin.slider"],
                        route_name: "",
                        childs_items: [{
                                name: "Жаңалықтар",
                                font: "fa-newspaper",
                                route_name: "admin.news.index",
                                menu_active: ["admin.news"],
                            },
                            {
                                name: "Жаңалықтар бағыттары",
                                font: "fa-newspaper",
                                route_name: "admin.newsTypes.index",
                                menu_active: ["admin.newsTypes"],
                            },
                            {
                                name: "Слайдер",
                                font: "fa-newspaper",
                                route_name: "admin.slider.index",
                                menu_active: ["admin.slider"],
                            },
                        ],
                    },
                    {
                        name: "Жеке кеңес",
                        font: "fa-comment-medical",
                        menu_active: [
                            "admin.personalAdvice",
                            "admin.personalAdviceOrders",
                        ],
                        route_name: "",
                        childs_items: [{
                                name: "Жеке кеңес",
                                font: "fa-comment-medical",
                                route_name: "admin.personalAdvice.index",
                                menu_active: ["admin.personalAdvice"],
                            },
                            {
                                name: "Жеке кеңес тапсырыстар",
                                font: "fa-comment-medical",
                                route_name: "admin.personalAdviceOrders.index",
                                menu_active: ["admin.personalAdviceOrders"],
                            },
                        ],
                    },
                    {
                        name: "Тест",
                        font: "fa-newspaper",
                        menu_active: [
                            "admin.test.languages",
                            "admin.test.subjects",
                            "admin.test.subjectOptions",
                            "admin.test.subjectOptionQuestions",
                            "admin.test.subjectPreparations",
                            "admin.test.directions",
                            "admin.test.questions",
                            "admin.test.classes",
                            "admin.test.questionAppeals",
                            "admin.test.optionQuestionAppeals",
                            "admin.test.preparationPreparations",
                            "admin.test.trainers"
                        ],
                        route_name: "",
                        childs_items: [{
                                name: "Пән",
                                font: "fa-list",
                                route_name: "admin.test.subjects.index",
                                menu_active: [
                                    "admin.test.subjects",
                                    "admin.test.subjectOptions",
                                    "admin.test.subjectPreparations",
                                    "admin.test.subjectOptionQuestions",
                                    "admin.test.subjectPreparations",
                                ],
                            },
                            {
                                name: "Сынып",
                                font: "fa-list",
                                route_name: "admin.test.classes.index",
                                menu_active: ["admin.test.classes"],
                            },
                            {
                                name: "Тіл",
                                font: "fa-globe",
                                route_name: "admin.test.languages.index",
                                menu_active: ["admin.test.languages"],
                            },
                            {
                                name: "Бағыт",
                                font: "fa-atlas",
                                route_name: "admin.test.directions.index",
                                menu_active: ["admin.test.directions"],
                            },
                            {
                                name: "Сұрақтар",
                                font: "fa-newspaper",
                                route_name: "admin.test.questions.index",
                                menu_active: ["admin.test.questions"],
                            },
                            {
                                name: "Тест апеляция",
                                font: "fa-newspaper",
                                route_name: "admin.test.questionAppeals.index",
                                menu_active: ["admin.test.questionAppeals"],
                            },
                            {
                                name: "Тест нұсқа б/ша апеляция",
                                font: "fa-newspaper",
                                route_name: "admin.test.optionQuestionAppeals.index",
                                menu_active: ["admin.test.optionQuestionAppeals"],
                            },
                            {
                                name: "Дайындық апеляция",
                                font: "fa-newspaper",
                                route_name: "admin.test.preparationAppeals.index",
                                menu_active: ["admin.test.preparationAppeals"],
                            },
                            {
                                name: "Тренермен дайындық",
                                font: "fa-newspaper",
                                route_name: "admin.test.trainers.index",
                                menu_active: ["admin.test.trainers"],
                            },
                        ],
                    },
                ],
            };
        },
        computed: {
            currentRoute() {
                let currentRoute = route().current().split(".");
                currentRoute.pop();
                return currentRoute.join(".");
            },
        },
    };

</script>
