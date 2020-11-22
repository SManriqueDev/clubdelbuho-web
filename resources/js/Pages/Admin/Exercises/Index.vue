<template>
  <div>
    <!-- Exercises Type Modal -->
    <t-modal
      :showing="showModal"
      @close="showModal = false"
      :showClose="true"
      :backgroundClose="true"
    >
      <div class="text-lg font-black mb-6">Seleccione un tipo de ejercicio</div>
      <div class="grid grid-cols-2 lg:grid-cols-3 gap-3">
        <div
          class="rounded-lg border flex text-center items-center justify-center w-full h-32 font-bold border-gray-400 cursor-pointer hover:bg-gray-300"
        >
          Selección múltiple
        </div>
        <div
          class="rounded-lg border flex items-center justify-center text-center w-full h-32 font-bold border-gray-400 cursor-pointer hover:bg-gray-300"
        >
          Crucigrama
        </div>
        <div
          class="rounded-lg border flex items-center justify-center text-center w-full h-32 font-bold border-gray-400 cursor-pointer hover:bg-gray-300"
        >
          Verdadero/Falso
        </div>
        <div
          class="rounded-lg border flex items-center justify-center text-center w-full h-32 font-bold border-gray-400 cursor-pointer hover:bg-gray-300"
        >
          Sopa de letras
        </div>
        <div
          class="rounded-lg border flex items-center justify-center text-center w-full h-32 font-bold border-gray-400 cursor-pointer hover:bg-gray-300"
        >
          Anagramas
        </div>
        <div
          class="rounded-lg border flex items-center justify-center text-center w-full h-32 font-bold border-gray-400 cursor-pointer hover:bg-gray-300"
        >
          Selección multiple
        </div>
        <div
          class="rounded-lg border flex items-center justify-center text-center w-full h-32 font-bold border-gray-400 cursor-pointer hover:bg-gray-300"
        >
          Sinónimos
        </div>
        <div
          class="rounded-lg border flex items-center justify-center text-center w-full h-32 font-bold border-gray-400 cursor-pointer hover:bg-gray-300"
        >
          Relación columnas
        </div>
        <div
          class="rounded-lg border flex items-center justify-center text-center w-full h-32 font-bold border-gray-400 cursor-pointer hover:bg-gray-300"
        >
          Completar con letras o palabras
        </div>
      </div>
    </t-modal>

    <!-- Toolbar -->
    <div class="mb-6 flex justify-between items-center">
      <search-filter
        v-model="form.search"
        class="w-full max-w-md mr-4"
        @reset="reset"
      >
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="mt-1 w-full form-select">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
      <button class="btn-indigo" @click="showModal = true">
        <span>{{ $t("actions.create") }}</span>
        <span class="hidden md:inline">{{ $t("entities.exercise") }}</span>
      </button>
    </div>

    <!-- Exercises Table -->
    <div class="bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">ID</th>
          <th class="px-6 pt-6 pb-4">{{ $t("exercises.name") }}</th>
        </tr>
        <tr
          v-for="exercise in exercises.data"
          :key="exercise.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100"
        >
          <td class="border-t">
            <inertia-link
              class="px-6 py-4 flex items-center focus:text-indigo-500"
              :href="route('admin.exercises.edit', exercise.id)"
            >
              {{ exercise.id }}
              <icon
                name="trash"
                v-if="exercise.deleted_at"
                class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2"
              />
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link
              class="px-6 py-4 flex items-center focus:text-indigo-500"
              :href="route('admin.exercises.edit', exercise.id)"
            >
              {{ exercise.name }}
            </inertia-link>
          </td>

          <td class="border-t w-px">
            <inertia-link
              class="px-4 flex items-center"
              :href="route('admin.exercises.edit', exercise.id)"
              tabindex="-1"
            >
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </inertia-link>
          </td>
        </tr>
        <tr v-if="exercises.data.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No exercises found.</td>
        </tr>
      </table>
    </div>
    <pagination :links="exercises.links" />
  </div>
</template>

<script>
import Icon from "@/Shared/Icon";
import Layout from "@/Shared/Layout";
import mapValues from "lodash/mapValues";
import Pagination from "@/Shared/Pagination";
import pickBy from "lodash/pickBy";
import SearchFilter from "@/Shared/SearchFilter";
import throttle from "lodash/throttle";

export default {
  layout: Layout,
  components: {
    Icon,
    Pagination,
    SearchFilter,
  },
  data() {
    return {
      showModal: false,
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    };
  },
  watch: {
    form: {
      handler: throttle(function () {
        let query = pickBy(this.form);
        this.$inertia.replace(
          this.route(
            "admin.exercises",
            Object.keys(query).length ? query : { remember: "forget" }
          )
        );
      }, 150),
      deep: true,
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null);
    },
  },
  props: {
    exercises: Object,
    filters: Object,
  },
};
</script>

<style>
</style>
