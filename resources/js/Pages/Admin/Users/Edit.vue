<template>
  <head>
        <title>Админ панель | Қолданушы өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Қолданушы № {{ user.id}}</h1>
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
                            Қолданушы № {{ user.id}}
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
                            <label for="">Аты-жөні</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="user.full_name"
                                name="full_name"
                                placeholder="Аты-жөні"
                            />
                            <validation-error :field="'full_name'" />
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                v-model="user.email"
                                name="email"
                                placeholder="Email"
                            />
                            <validation-error :field="'email'" />
                        </div>

                        <div class="form-group">
                            <label for="">Телефон</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="user.phone"
                                name="phone"
                                placeholder="Телефон"
                            />

                            <validation-error :field="'phone'" />
                        </div>

                        <div class="form-group">
                            <label for="">Туған күні</label>
                            <input
                                type="date"
                                class="form-control"
                                v-model="user.birthday"
                                name="birthday"
                                placeholder="Туған күні"
                            />
                            <validation-error :field="'birthday'" />
                        </div>

                        <div class="form-group">
                            <label for="">Жынысы</label>
                            <select
                                v-model="user.sex"
                                class="form-control"
                                name="sex"
                            >
                                <option :value="null" selected>
                                    Жынысын таңдаңыз
                                </option>
                                <option value="1">Ер</option>
                                <option value="2">Әйел</option>
                            </select>
                            <validation-error :field="'sex'" />
                        </div>
                        <div class="form-group">
                            <label for="">Жұмыс орны</label>
                            <textarea
                                name="place_work"
                                class="form-control"
                                v-model="user.place_work"
                                cols="30"
                                rows="3"
                                placeholder="Жұмыс орны"
                            >
                            </textarea>
                            <validation-error :field="'place_work'" />
                        </div>
                        <div class="form-group">
                            <label for="">Құпия сөз</label>
                            <input
                                type="password"
                                v-model="user.password"
                                class="form-control"
                                name="password"
                                placeholder="Құпия сөз"
                            />
                            <validation-error :field="'password'" />
                        </div>
                        <div class="form-group">
                            <label for="">Рөл</label>
                            <select
                                class="form-control"
                                v-model="user.role_id"
                                name="role_id"
                            >
                                <option :value="null" disabled selected>
                                    Рөлді таңдаңыз
                                </option>
                                <option
                                    :value="role.id"
                                    v-for="role in roles"
                                    :key="'r' + role.id"
                                >
                                    {{ role.name.kk }}
                                </option>
                            </select>
                            <validation-error :field="'role_id'" />
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox"
                                v-model="user.is_email_verified"
                                    class="custom-control-input"
                                    id="customSwitch1"
                                />
                                <label class="custom-control-label"
                                    for="customSwitch1"
                                    >Email расталған</label
                                >
                            </div>
                            <validation-error :field="'is_email_verified'" />

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-1">
                            Сақтау
                        </button>
                        <button type="button" class="btn btn-danger" @click.prevent="back()">
                            Артқа
                        </button>
                    </div>
                </form>
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
        Head
    },
    props: ["user", "roles"],
    data() {
        return {
            //         form: useForm({
            //   full_name: null,
            //   email: null,
            //   password: false,
            // })
        };
    },
    methods: {
        submit() {
            this.$inertia.put(
                route("admin.users.update", this.user.id),
                this.user,
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
