<template>

    <head>
        <title>Админ панель | Сұрақты қосу</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Сұрақ қосу</h1>
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
                            <a :href="route('admin.test.questions.index')">
                                <i class="fas fa-dashboard"></i>
                                Сұрақтар тізімі
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Сұрақ қосу</li>
                    </ol>
                </div>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="odd even">
                                    <td><b>Пән</b><i class="red">*</i></td>
                                    <td>
                                        <select v-model="question.subject_id" class="form-control">
                                            <option value="" selected disabled>
                                                Пәнді таңдаңыз
                                            </option>
                                            <option v-for="(
                                                    subject, index
                                                ) in subjects" :value="subject.id" :key="'subject' + index">
                                                {{ subject.name }}
                                                {{
                                                    subject.description
                                                        ? "(" +
                                                          subject.description +
                                                          ")"
                                                        : ""
                                                }}
                                                ({{ subject.language.name }})
                                            </option>
                                        </select>
                                        <validation-error :field="'subject_id'" />
                                    </td>
                                </tr>
                                <tr class="odd even">
                                    <td><b>Тақырыпша</b></td>
                                    <td>
                                        <Multiselect v-model="preparationIds" track-by="title" mode="tags" :close-on-select="false" :searchable="true" :create-option="true" label="title" valueProp="id" :options="preparations" />
                                        <validation-error :field="'preparation_ids'" />
                                    </td>
                                </tr>
                                <tr class="odd even">
                                    <td><b>Сұрақ</b> <i class="red">*</i></td>
                                    <td id="question">
                                        <div v-if="input_type === 'ckeditor'">
                                            <ckeditor :editor="editor" v-model="question.text" :config="editorConfig" class="form-control"></ckeditor>
                                            <a class="d-block mt-2" href="https://latex.codecogs.com/eqneditor/editor.php" target="_blank">Latex формула</a>
                                        </div>
                                        <input v-else v-model="question.text" type="text" class="form-control" />
                                        <validation-error :field="'text'" />
                                    </td>
                                </tr>
                                <tr class="odd even">
                                    <td>Жауап нұсқаларын енгізіңіз:</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center mr-2">
                                                <input v-model="input_type" type="radio" class="select-answer" value="input" />
                                                <p class="ml-2">- input</p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <input v-model="input_type" type="radio" class="select-answer" value="ckeditor" />
                                                <p class="ml-2">- ckeditor</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-for="(answer, index) in question.answers" :key="'answer' + index" class="odd even">
                                    <td>
                                        <b>{{
                                                getAnswerOptionTextType(
                                                    index + 1
                                                )
                                            }})
                                        </b>
                                        <i class="red">*</i>
                                    </td>
                                    <td :id="'answer' + answer.number">
                                        <div class="d-flex align-items-center">
                                            <input v-model="correct_answer_number" class="select-answer" type="radio" name="Buttonradio25" :value="answer.number" />
                                            <button class="btn btn-danger btn-xs ml-2 mr-2 h-25" style="
                                                    margin-top: 5px;
                                                    width: 25px;
                                                    height: 25px;
                                                " type="button" @click.prevent="
                                                    deleteAnswer(answer.number)
                                                " title="Жою">
                                                <i class="fas fa-trash" />
                                            </button>
                                            <ckeditor :editor="editor" v-model="answer.text" :config="editorConfig" class="form-control" v-if="input_type === 'ckeditor'"></ckeditor>
                                            <input v-else v-model="answer.text" type="text" class="form-control" />
                                        </div>
                                        <validation-error :field="`answers.${index}.text`" />
                                    </td>
                                </tr>
                                <tr class="odd even">
                                    <td>
                                        <b>Белсенді/ Белсенді емес </b>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" v-model="question.is_active" class="custom-control-input" id="customSwitch1" />
                                            <label class="custom-control-label" for="customSwitch1">Белсенді/Белсенді емес</label>
                                        </div>
                                        <validation-error :field="'is_active'" />
                                    </td>
                                </tr>
                                <tr class="odd even">
                                    <td>
                                        <button class="btn btn-danger" type="button" @click.prevent="clear">
                                            <i class="fa fa-trash" /> Тазалау
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-success" type="submit">
                                            Сақтау
                                        </button>
                                        <button class="btn btn-primary ml-2" @click.prevent="addAnswer" type="button">
                                            Жауап қосу
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
    import AdminLayout from "../../../../Layouts/AdminLayout.vue";
    import {
        Link,
        Head
    } from "@inertiajs/inertia-vue3";
    import Pagination from "../../../../Components/Pagination.vue";
    import ValidationError from "../../../../Components/ValidationError.vue";
    import Multiselect from "@vueform/multiselect";
    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
    import UploadAdapter from '../../../../Shared/uploadAdapter.vue';

    export default {
        components: {
            AdminLayout,
            Link,
            Pagination,
            ValidationError,
            Head,
            Multiselect,
        },
        props: ["subjects"],
        data() {
            return {
                question: {
                    text: null,
                    subject_id: null,
                    answers: [{
                            number: 1,
                            text: null,
                        },
                        {
                            number: 2,
                            text: null,
                        },
                        {
                            number: 3,
                            text: null,
                        },
                        {
                            number: 4,
                            text: null,
                        },
                        {
                            number: 5,
                            text: null,
                        },
                    ],
                    is_active: false,
                },
                editor: ClassicEditor,
                input_type: "input",
                correct_answer_number: null,
                editorConfig: {
                    extraPlugins: [this.uploader],
                },
                preparationIds: [],

            };
        },
        methods: {
            uploader(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    return new UploadAdapter(loader);
                };
            },
            deleteAnswer(number) {
                if (this.correct_answer_number == number) {
                    this.correct_answer_number = null;
                }

                this.question.answers = this.question.answers.filter(
                    (item) => item.number != number
                );
                this.correct_answer_number = null;
            },
            getAnswerOptionTextType(val) {
                switch (val) {
                    case 1:
                        return "A ";
                    case 2:
                        return "B ";
                    case 3:
                        return "C ";
                    case 4:
                        return "D ";
                    case 5:
                        return "E ";
                    case 6:
                        return "F ";
                    case 7:
                        return "G ";
                    case 8:
                        return "H ";
                    case 9:
                        return "J ";
                }
            },
            addAnswer() {
                let answer = {
                    number: this.question.answers.length + 1,
                    text: null,
                    is_correct: false,
                };
                this.question.answers.push(answer);
                this.correct_answer_number = null;
            },
            submit() {
                if (!this.question.subject_id) {
                    return this.warningMessage("Пән тандалмады");
                }
                this.question.correct_answer_number = this.correct_answer_number;
                if (!this.question.correct_answer_number) {
                    return this.warningMessage("Дұрыс жауап белгіленбеді");
                }
                if(this.preparationIds.length == 0)
                    this.question.preparation_ids = null
                else this.question.preparation_ids = this.preparationIds
                if (!this.question.preparation_ids) {
                    return this.warningMessage("Тақырыпша тандалмады");
                }
                this.$inertia.post(
                    route("admin.test.questions.store"),
                    this.question, {
                        onError: () => console.log("An error has occurred"),
                        onSuccess: () =>
                            console.log("The new contact has been saved"),
                    }
                );
            },
            warningMessage(text){
                return Swal.fire({
                    title: text,
                    icon: "warning",
                    showCancelButton: false,
                });
            }
        },

        computed: {
            preparations() {
                if (!this.question.subject_id) {
                    return []
                }
                let subject = this.subjects
                    .filter((item) => item.id == this.question.subject_id)
                    .shift();
                return subject.preparation_childs ?? [];
            },
        },
    };

</script>
<style scoped>
    .mr-10 {
        margin-right: 10px;
    }

    p {
        margin-bottom: 0 !important;
    }

    .h-25 {
        height: 25px;
    }

</style>
<style src="@vueform/multiselect/themes/default.css"></style>
