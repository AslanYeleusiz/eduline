<template>
    <head>
        <title>Админ панель | Нұсқалар</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0">
                        {{ subject.name }}
                        <br />
                        Нұсқалар тізімі
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
                            {{ subject.name }} - Нұсқалар
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template #header>
            <div class="buttons">
                <button
                    type="button"
                    class="btn btn-default btn-success"
                    data-toggle="modal"
                    data-target="#modal-question-create"
                >
                    <i class="fa fa-plus"></i> Қосу
                </button>
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
                                        <th>Аты</th>
                                        <th>Белсенді/Белсенді емес</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input
                                                v-model="filter.text"
                                                class="form-control"
                                                placeholder="Сұрақ"
                                            />
                                        </td>
                                        <td>
                                            <select
                                                v-model="filter.is_active"
                                                class="form-control"
                                                placeholder="Белсенді/Белсенді емес"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option value="true">Иә</option>
                                                <option value="false">
                                                    Жоқ
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-danger"
                                                @click.prevent="clearFilter()"
                                            >
                                                <i class="fa fa-trash"></i>
                                                Фильтрді тазалау
                                            </button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(
                                            optionQuestion, index
                                        ) in option.questions"
                                        :key="
                                            'optionQuestion' + optionQuestion.id
                                        "
                                        v-show="isShow(optionQuestion)"
                                    >
                                        <td>
                                            {{ index + 1 }}
                                        </td>
                                        <td v-html="optionQuestion.text"></td>
                                        <td>
                                            {{
                                                optionQuestion.is_active
                                                    ? "Иә"
                                                    : "Жоқ"
                                            }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                v-if="index != 0"
                                                @click="changePosition(optionQuestion.id, 'top')"
                                                    class="btn btn-success"
                                                    title="Изменить"
                                                >
                                                    <i
                                                        class="fas fa-long-arrow-alt-up"
                                                    ></i>
                                                </button>

                                                <button
                                                
                                                v-if="index !== (option.questions.length - 1)"
                                                    @click="changePosition(optionQuestion.id, 'top')"
                                                    class="btn btn-primary"
                                                    title="Сұрақтар"
                                                >
                                                    <i class="fas fa-long-arrow-alt-down" ></i>
                                                </button>

                                                <button
                                                    @click.prevent="
                                                        deleteQuestion(
                                                            optionQuestion.pivot
                                                                .id
                                                        )
                                                    "
                                                    class="btn btn-danger"
                                                    title="Жою"
                                                >
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                             <div class="buttons">
                                <button
                                    class="btn btn-success"
                                    @click="savePosition()"
                                >
                                    Сақтау
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5>{{ subject.name }} - пәнінің сұрақтары</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table
                                class="table table-hover table-bordered table-striped dataTable dtr-inline"
                            >
                                <thead>
                                    <tr role="row">
                                        <th>№</th>
                                        <th>Аты</th>
                                        <th>Белсенді/Белсенді емес</th>
                                        <th>Әрекет</th>
                                    </tr>
                                    <tr class="filters">
                                        <td></td>
                                        <td>
                                            <input
                                                v-model="filterQuestions.text"
                                                class="form-control"
                                                placeholder="Сұрақ"
                                            />
                                        </td>
                                        <td>
                                            <select
                                                v-model="
                                                    filterQuestions.is_active
                                                "
                                                class="form-control"
                                                placeholder="Белсенді/Белсенді емес"
                                            >
                                                <option :value="null">
                                                    Барлығы
                                                </option>
                                                <option value="true">Иә</option>
                                                <option value="false">
                                                    Жоқ
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <button
                                                @click="clearFilterQuestions()"
                                                class="btn btn-danger"
                                            >
                                                <i class="fa fa-trash"></i>
                                                Фильтрді тазалау
                                            </button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd"
                                        v-for="(optionItem, index) in questions"
                                        :key="'optionItem' + optionItem.id"
                                        v-show="isShowQuestion(optionItem)"
                                    >
                                        <td>
                                            {{ index + 1 }}
                                        </td>

                                        <td v-html="optionItem.text"></td>
                                        <td>
                                            {{
                                                optionItem.is_active
                                                    ? "Иә"
                                                    : "Жоқ"
                                            }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <input
                                                    type="checkbox"
                                                    :value="optionItem.id"
                                                    style="
                                                        width: 20px;
                                                        height: 20px;
                                                    "
                                                    v-model="selected_questions"
                                                />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="buttons">
                                <button
                                    class="btn btn-success"
                                    @click="addQuestions()"
                                >
                                    Сақтау
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-question-create">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Сұрақ қосу</h4>
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
                        <form @submit.prevent="submit">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="odd even">
                                        <td>
                                            <b>Сұрақ</b> <i class="red">*</i>
                                        </td>
                                        <td id="question">
                                            <ckeditor
                                                :editor="editor"
                                                v-model="question.text"
                                                :config="editorConfig"
                                                class="form-control"
                                                v-if="input_type === 'ckeditor'"
                                            ></ckeditor>
                                            <textarea
                                                v-else
                                                v-model="question.text"
                                                class="form-control"
                                                cols="10"
                                                rows="5"
                                            ></textarea>
                                            <validation-error :field="'text'" />
                                        </td>
                                    </tr>
                                    <tr class="odd even">
                                        <td>Жауап нұсқаларын енгізіңіз:</td>
                                        <td>
                                            <div
                                                class="d-flex align-items-center"
                                            >
                                                <div
                                                    class="d-flex align-items-center mr-2"
                                                >
                                                    <input
                                                        v-model="input_type"
                                                        type="radio"
                                                        class="select-answer"
                                                        value="input"
                                                    />
                                                    <p class="ml-2">- input</p>
                                                </div>
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <input
                                                        v-model="input_type"
                                                        type="radio"
                                                        class="select-answer"
                                                        value="ckeditor"
                                                    />
                                                    <p class="ml-2">
                                                        - ckeditor
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr
                                        v-for="(
                                            answer, index
                                        ) in question.answers"
                                        :key="'answer' + index"
                                        class="odd even"
                                    >
                                        <td>
                                            <b
                                                >{{
                                                    getAnswerOptionTextType(
                                                        index + 1
                                                    )
                                                }})
                                            </b>
                                            <i class="red">*</i>
                                        </td>
                                        <td :id="'answer' + answer.number">
                                            <div
                                                class="d-flex justify-content-between align-items-center"
                                            >
                                                <input
                                                    v-model="
                                                        correct_answer_number
                                                    "
                                                    class="select-answer"
                                                    type="radio"
                                                    name="Buttonradio25"
                                                    :value="answer.number"
                                                />
                                                <button
                                                    class="btn btn-danger btn-xs ml-2 mr-2 h-25"
                                                    style="
                                                        margin-top: 5px;
                                                        width: 25px;
                                                        height: 25px;
                                                    "
                                                    type="button"
                                                    @click.prevent="
                                                        deleteAnswer(
                                                            answer.number
                                                        )
                                                    "
                                                    title="Жою"
                                                >
                                                    <i class="fas fa-trash" />
                                                </button>
                                                <ckeditor
                                                    :editor="editor"
                                                    v-model="answer.text"
                                                    :config="editorConfig"
                                                    class="form-control"
                                                    v-if="
                                                        input_type ===
                                                        'ckeditor'
                                                    "
                                                ></ckeditor>
                                                <input
                                                    v-else
                                                    v-model="answer.text"
                                                    type="text"
                                                    class="form-control"
                                                />
                                            </div>
                                            <validation-error
                                                :field="`answers.${index}.text`"
                                            />
                                        </td>
                                    </tr>
                                    <tr class="odd even">
                                        <td>
                                            <b>Белсенді/ Белсенді емес </b>
                                        </td>
                                        <td>
                                            <div
                                                class="custom-control custom-switch"
                                            >
                                                <input
                                                    type="checkbox"
                                                    v-model="question.is_active"
                                                    class="custom-control-input"
                                                    id="customSwitch1"
                                                />
                                                <label
                                                    class="custom-control-label"
                                                    for="customSwitch1"
                                                    >Белсенді/Белсенді
                                                    емес</label
                                                >
                                            </div>
                                            <validation-error
                                                :field="'is_active'"
                                            />
                                        </td>
                                    </tr>
                                    <tr class="odd even">
                                        <td>
                                            <button
                                                class="btn btn-danger"
                                                type="button"
                                                @click.prevent="clear"
                                            >
                                                <i class="fa fa-trash" />
                                                Тазалау
                                            </button>
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-primary ml-2"
                                                @click.prevent="addAnswer"
                                                type="button"
                                            >
                                                Жауап қосу
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button
                            type="button"
                            class="btn btn-default"
                            data-dismiss="modal"
                        >
                            Жабу
                        </button>
                        <button
                            class="btn btn-success ml-2"
                            type="button"
                            @click.prevent="submit"
                        >
                            <i class="fa fa-plus"></i>
                            Қосу
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
import ValidationError from "../../../../../Components/ValidationError.vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        Head,
        ValidationError,
    },
    props: ["questions", "subject", "option", "option_question_ids"],
    data() {
        return {
            filter: {
                text: "",
                is_active: null,
            },
            filterQuestions: {
                text: "",
                is_active: null,
            },
            question: {
                text: null,
                answers: [
                    {
                        number: 1,
                        text: "",
                        is_correct: false,
                    },
                    {
                        number: 2,
                        text: "",
                        is_correct: false,
                    },
                    {
                        number: 3,
                        text: "",
                        is_correct: false,
                    },
                    {
                        number: 4,
                        text: "",
                        is_correct: false,
                    },
                    {
                        number: 5,
                        text: "",
                        is_correct: false,
                    },
                ],
                is_active: false,
            },
            editor: ClassicEditor,
            input_type: "input",
            correct_answer_number: null,
            editorConfig: {
                // The configuration of the editor.
            },
            selected_questions: this.option_question_ids,
        };
    },
    methods: {
        savePosition() {
            
        },
        changePosition(id, position = 'top') {
                    
        const fromIndex = this.option.questions.findIndex(i => i.id == id); 
        // 👉️ 0
        // if(fromIndex > 0 && fromIndex < this.option.questions.length) {
        //     return null
        // }
        const toIndex = position == 'top' ? fromIndex - 1 : fromIndex  + 1;

        const element = this.option.questions.splice(fromIndex, 1)[0];
        console.log(element)
        // console.log(element); // ['css']

        this.option.questions.splice(toIndex, 0, element);

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
                text: "",
                is_correct: false,
            };
            this.question.answers.push(answer);
            this.correct_answer_number = null;
        },
        submit() {
            this.question.correct_answer_number = this.correct_answer_number;
            if (!this.question.correct_answer_number) {
                return Swal.fire({
                    title: "Дұрыс жауап белгіленбеді",
                    icon: "warning",
                    showCancelButton: false,
                });
            }
            let data = {
                text: this.question.text,
                subject_id: this.subject.id,
                answers: this.question.answers,
                correct_answer_number: this.correct_answer_number,
                is_active: this.question.is_active,
            };
            this.$inertia.post(
                route("admin.test.subjectOptionQuestions.create", {
                    subject: this.subject.id,
                    option: this.option.id,
                }),
                data,
                {
                    onError: () => {},
                    onSuccess: () => {
                        $(".modal").modal("hide");
                        this.question = {
                            text: null,
                            answers: [
                                {
                                    number: 1,
                                    text: "",
                                    is_correct: false,
                                },
                                {
                                    number: 2,
                                    text: "",
                                    is_correct: false,
                                },
                                {
                                    number: 3,
                                    text: "",
                                    is_correct: false,
                                },
                                {
                                    number: 4,
                                    text: "",
                                    is_correct: false,
                                },
                                {
                                    number: 5,
                                    text: "",
                                    is_correct: false,
                                },
                            ],
                            is_active: false,
                        };
                    },
                }
            );
        },
        deleteQuestion(id) {
            console.log("id", id);
            this.$inertia.delete(
                route("admin.test.subjectOptionQuestions.delete", {
                    subject: this.subject.id,
                    option: this.option.id,
                    question: id,
                })
            );
        },

        clearFilter() {
            this.filter = {
                text: "",
                is_active: null,
            };
        },
        clearFilterQuestions() {
            this.filterQuestions = {
                text: "",
                is_active: null,
            };
        },
        addQuestions() {
            let data = {
                question_ids: this.selected_questions,
            };
            this.$inertia.post(
                route("admin.test.subjectOptionQuestions.save", {
                    subject: this.subject.id,
                    option: this.option.id,
                }),
                data
            );
        },
        isShow(questionItem) {
            if (this.filter.is_active == null) {
                return (
                    questionItem.text
                        .toLowerCase()
                        .indexOf(this.filter.text.toLowerCase()) > -1
                );
            } else {
                return (
                    questionItem.text
                        .toLowerCase()
                        .indexOf(this.filter.text.toLowerCase()) > -1 &&
                    questionItem.is_active == (this.filter.is_active == "true")
                );
            }
        },
        isShowQuestion(optionItem) {
            console.log(this.filterQuestions.is_active == null);
            if (this.filterQuestions.is_active == null) {
                console.log(
                    "sss",
                    optionItem.text
                        .toLowerCase()
                        .indexOf(this.filterQuestions.text.toLowerCase()) > -1,
                    this.filterQuestions.text,
                    "---",
                    optionItem.text
                );
                return (
                    optionItem.text
                        .toLowerCase()
                        .indexOf(this.filterQuestions.text.toLowerCase()) > -1
                );
            } else {
                return (
                    optionItem.text
                        .toLowerCase()
                        .indexOf(this.filterQuestions.text.toLowerCase()) >
                        -1 &&
                    optionItem.is_active ==
                        (this.filterQuestions.is_active == "true")
                );
            }
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
                        route("admin.test.subjectOptions.destroy", {
                            subject: this.subject.id,
                            option: id,
                        })
                    );
                }
            });
        },
    },
    created() {
        console.log("$", $("#modal-default"));
    },
};
</script>
