<template>
    <div>
        <div class="flex">
            <div class="flex-auto">
                <h1 class="mb-8 font-bold text-3xl">
                    <inertia-link
                        class="text-indigo-400 hover:text-indigo-600"
                        :href="route('admin.exercises')"
                    >{{ $t("entities.exercises") }}</inertia-link
                    >
                    <span class="text-indigo-400 font-medium">/</span> Nuevo Ejercicio
                    Selección Múltiple
                </h1>
            </div>
            <div class="flex-shrink">
                <button class="btn-indigo" @click="submit">Guardar Ejercicio</button>
            </div>
        </div>

        <div class="bg-white rounded shadow p-8">
            <text-input
                placeholder="Pregunta"
                label="Pregunta"
                v-model="exercise.question"
                class="mb-3"
            />
            <textarea-input
                placeholder="Content"
                label="Content"
                v-model="exercise.content"
                class="mb-6"
            />
            <div class="mb-6 text-xl font-bold">Respuestas</div>
            <div
                class="flex flex-row m-5"
                :key="index"
                v-for="(answer, index) in exercise.answers"
            >
                <div class="flex flex-col items-center align-center mr-6">
                    <div>
                        Correcta?
                    </div>
                    <div class="flex justify-center p-5">
                        <input style="transform: scale(1.3)" type="checkbox" />
                    </div>
                </div>
                <text-input
                    label="Respuesta"
                    placeholder="Respuesta"
                    v-model="answer.answer"
                    class="w-full"
                />
            </div>
            <button class="btn-indigo" @click="addAnswer">Agregar Respuesta</button>
        </div>
    </div>
</template>

<script>
import Layout from "@/shared/Layout";
import TextInput from "../../../../shared/TextInput.vue";
export default {
    components: { TextInput },
    layout: Layout,
    props: {
        errors: {
            type: Object
        },
        type: {
            type: String
        }
    },
    data: () => ({
        exercise: {
            question: "",
            content: "",
            answers: [
                {
                    satisfactory: false,
                    answer: ""
                }
            ]
        }
    }),
    methods: {
        submit() {
            this.$inertia.post(this.route("admin.exercises.store"), this.exercise, {
                onStart: () => (this.sending = true),
                onFinish: () => (this.sending = false)
            });
        },
        addAnswer() {
            this.exercise.answers.push({
                satisfactory: false,
                answer: ""
            });
        }
    }
};
</script>

<style></style>
