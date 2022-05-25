<template>
    <head>
        <title>Админ панель | Сұрақты өзгерту</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Сұрақ өзгерту №{{ question.id }}</h1>
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
                        <li class="breadcrumb-item active">
                            Сұрақ өзгерту №{{ question.id }}
                        </li>
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
                                        <select
                                            v-model="question.subject_id"
                                            class="form-control"
                                        >
                                            <option value="" selected disabled>
                                                Пәнді таңдаңыз
                                            </option>
                                            <option
                                                v-for="(
                                                    subject, index
                                                ) in subjects"
                                                :value="subject.id"
                                                :key="'subject' + index"
                                            >
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
                                        <validation-error
                                            :field="'subject_id'"
                                        />
                                    </td>
                                </tr>
                                <tr class="odd even">
                                    <td><b>Сұрақ</b> <i class="red">*</i></td>
                                    <td id="question">
                                        <ckeditor
                                            :editor="editor"
                                            v-model="question.text"
                                            :config="editorConfig"
                                            class="form-control"
                                            v-if="input_type === 'ckeditor'"
                                        ></ckeditor>
                                        <input
                                            v-else
                                            v-model="question.text"
                                            type="text"
                                            class="form-control"
                                        />
                                        <validation-error :field="'text'" />
                                    </td>
                                </tr>
                                <tr class="odd even">
                                    <td>Жауап нұсқаларын енгізіңіз:</td>
                                    <td>
                                        <div class="d-flex align-items-center">
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
                                                <p class="ml-2">- ckeditor</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr
                                    v-for="(answer, index) in answers"
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
                                                v-model="correct_answer_number"
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
                                                    deleteAnswer(answer.number)
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
                                                v-if="input_type === 'ckeditor'"
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
                                                >Белсенді/Белсенді емес</label
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
                                            <i class="fa fa-trash" /> Тазалау
                                        </button>
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-success"
                                            type="submit"
                                        >
                                            Сақтау
                                        </button>
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
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../../Components/Pagination.vue";
import ValidationError from "../../../../Components/ValidationError.vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        ValidationError,
        Head,
    },
    props: ["subjects", "question"],
    
    data() {
        return {
            editor: ClassicEditor,
            input_type: "input",
            correct_answer_number: null,
            editorConfig: {
                // The configuration of the editor.
            },
            answers: this.$page.props.question.answers,
        };
    },
    methods: {
        deleteAnswer(number) {
            if (this.correct_answer_number == number) {
                this.correct_answer_number = null;
            }

            this.answers = this.answers.filter((item) => item.number != number);
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
                number: this.answers.length + 1,
                text: "",
                is_correct: false,
            };
            this.answers.push(answer);
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
                subject_id: this.question.subject_id,
                answers: this.answers,
                correct_answer_number: this.correct_answer_number,
                is_active: this.question.is_active,
            };
            this.$inertia.put(
                route("admin.test.questions.update", this.question.id),
                data,
                {
                    onError: () => console.log("An error has occurred"),
                    onSuccess: () =>
                        console.log("The new queston has been saved"),
                }
            );
        },
    },
    mounted() {
        if(!this.correct_answer_number) {

        this.answers = this.clone(this.question.answers);
        let correct_answer = this.question.answers
            .filter((item) => item.is_correct)
            .shift();
        if (correct_answer && correct_answer.number) {
            this.correct_answer_number = correct_answer.number;
        }
        }
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
