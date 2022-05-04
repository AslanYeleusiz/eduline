<template>
    <head>
        <title>Админ панель |{{ user.full_name }} жазылымдары</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ user.full_name }} жазылымдары</h1>
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
                            <a :href="route('admin.users.index')">
                                <i class="fas fa-dashboard"></i>
                                Қолданушылар тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ user.full_name }} жазылымдары
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <Link
                    class="btn btn-danger"
                    :href="route('admin.users.subscriptions', user.id)"
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
                                        <th>Жазылым</th>
                                        <th>Жазылым ұзақтығы</th>
                                        <th>Жазылған уақыты</th>
                                        <th>Белсенді</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input
                                                v-model="filter.name"
                                                class="form-control"
                                                placeholder="Аты"
                                                type="text"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            <input
                                                type="date"
                                                v-model="filter.from_date"
                                                class="form-control"
                                                placeholder="От"
                                                @keyup.enter="search"
                                            />
                                            <input
                                                type="date"
                                                v-model="filter.to_date"
                                                class="form-control mt-2"
                                                placeholder="До"
                                                @keyup.enter="search"
                                            />
                                        </td>
                                        <td>
                                            От
                                            <input
                                                type="date"
                                                v-model="filter.created_at"
                                                class="form-control"
                                                placeholder="Жазылған уақыты"
                                                @keyup.enter="search"
                                            />
                                        </td>

                                        <td>
                                            <select
                                                placeholder="Белсенді"
                                                v-model="filter.is_active"
                                                @change="search"
                                                class="form-control"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option value="false">
                                                    Белсенді есем
                                                </option>
                                                <option value="true">
                                                    Белсенді
                                                </option>
                                            </select>
                                        </td>

                                        <td>
                                            <button
                                                class="btn btn-success d-flex align-items-center"
                                                @click.prevent="search()"
                                            >
                                                <i class="fa fa-search"></i>
                                                Іздеу
                                            </button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(
                                            userSubscription, index
                                        ) in userSubscriptions.data"
                                        :key="
                                            'userSubscriptions' +
                                            userSubscription.id
                                        "
                                    >
                                        <td>
                                            {{
                                                userSubscriptions.from
                                                    ? userSubscriptions.from +
                                                      index
                                                    : index + 1
                                            }}
                                        </td>
                                        <td>
                                            
                                            <Link :href="route('admin.subscriptions.edit',userSubscription.subscription
                                                    .id )">
                                            {{
                                                userSubscription.subscription
                                                    .name
                                            }}
                                             </Link>
                                            <hr />
                                            <b>Бағасы: </b
                                            >{{
                                                userSubscription.subscription
                                                    .price
                                            }}
                                            тг.
                                        </td>
                                        <td>
                                            {{ userSubscription.from_date }} -
                                            {{ userSubscription.to_date }}
                                        </td>
                                        <td>
                                            {{
                                                userSubscription.created_at
                                                    ? new Date(
                                                          userSubscription.created_at
                                                      ).toLocaleDateString()
                                                    : "Анықталмады"
                                            }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge"
                                                :class="[
                                                    userSubscription.is_active
                                                        ? 'bg-success'
                                                        : 'bg-danger',
                                                ]"
                                            >
                                                {{
                                                    userSubscription.is_active
                                                        ? "Белсенді"
                                                        : "Белсенді емес"
                                                }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                    @click.prevent="
                                                        deleteData(
                                                            userSubscription.id
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
                    <Pagination :links="userSubscriptions.links" />
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Жазылымға тіркеу</h3>
                 
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Жазылымдар тізімі</label>
                                <select
                                    class="form-control"
                                    v-model='user_new_subscription_id'
                                >
                                    <option :value="null" disabled selected
                                    >
                                        Таңдаңыз
                                    </option>
                                    <option :value="subscription.id" v-for="subscription in subscriptions" :key="'ss' + subscription.id">
                                        {{ subscription.name }} - {{ subscription.price }}тг.
                                    </option>
                                    </select>
                            </div>
                                  <button class="btn btn-success" @click.prevent="createSubscription()">
                                Тіркеу
                            </button>
                        </div>
                    </div>
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
    props: ["userSubscriptions", "user", 'subscriptions'],
    data() {
        return {
            filter: {
                name: route().params.name ? route().params.name : null,
                from_date: route().params.from_date
                    ? route().params.from_date
                    : null,
                to_date: route().params.to_date ? route().params.to_date : null,
                created_at: route().params.created_at
                    ? route().params.created_at
                    : null,
                is_active: route().params.is_active
                    ? route().params.is_active
                    : null,
            },
            user_new_subscription_id: null,
        };
    },
    methods: {
        createSubscription(){

            if(!this.user_new_subscription_id) {
                return Swal.fire({
                            icon: 'warning',
                            title: 'Ескерту',
                            text: 'Жазылым таңдалмады',
                            })
            }
            this.$inertia.post( route( 'admin.users.subscriptions.store', {user:this.user.id, subscription: this.user_new_subscription_id } ),    {
                    onError: () => console.log("An error has occurred"),
                    onSuccess: () =>
                        console.log("The new contact has been saved"),
                } )
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
                        route("admin.users.subscriptions.delete", {
                            user: this.user.id,
                            subscription: id,
                        })
                    );
                }
            });
        },
        search() {
            const params = this.clearParams(this.filter);
            console.log("aparams", params);
            this.$inertia.get(
                route("admin.users.subscriptions", this.user.id),
                params
            );
        },
    },
};
</script>
