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
                    <span class="text-indigo-400 font-medium">/</span> Nuevo
                    Ejercicio Verdadero - Falso
                </h1>
            </div>
            <div class="flex-shrink">
                <button class="btn-indigo" @click="submit">
                    Guardar Ejercicio
                </button>
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
            <div class="mb-6 text-xl font-bold">Seleccione una respuesta correcta</div>
            <select v-model="exercise.answer">
                <option :value="true">Verdadero</option>
                <option :value="false">Falso</option>
            </select>
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
            answers: true
        }
    }),
    methods: {
        submit() {
            this.$inertia.post(
                this.route("admin.exercises.store"),
                this.exercise,
                {
                    onStart: () => (this.sending = true),
                    onFinish: () => (this.sending = false)
                }
            );
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
