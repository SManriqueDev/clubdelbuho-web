<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link
        class="text-indigo-400 hover:text-indigo-600"
        :href="route('admin.exercises')"
        >{{ $t("entities.exercises") }}</inertia-link
      >
      <span class="text-indigo-400 font-medium">/</span> Create multiple
      selection
    </h1>
    <text-input
      placeholder="Question"
      label="Question"
      v-model="exercise.question"
      class="mb-3"
    />
    <textarea-input
      placeholder="Content"
      label="Content"
      v-model="exercise.content"
      class="mb-6"
    />

    <div class="mb-3 text-xl font-bold">Answers</div>

    <div
      class="flex flex-row"
      :key="index"
      v-for="(answer, index) in exercise.answers"
    >
      <feather-icon class="mr-3" icon="SquareIcon"></feather-icon>
      <text-input
        label="Answer"
        placeholder="Answer"
        v-model="answer.answer"
        class="w-full"
      />
    </div>
  </div>
</template>

<script>
import Layout from "@/Shared/Layout";
import TextInput from "../../../../Shared/TextInput.vue";
export default {
  components: { TextInput },
  layout: Layout,
  props: {
    errors: {
      type: Object,
    },
    type: {
      type: String,
    },
  },
  data: () => ({
    exercise: {
      question: "",
      content: "",
      answers: [
        {
          satisfactory: false,
          answer: "",
        },
      ],
    },
  }),
};
</script>

<style>
</style>
