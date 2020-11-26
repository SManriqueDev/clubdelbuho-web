<template>
    <div>
        <t-modal
            :showing="showModal"
            @close="showModal = false"
            :showClose="true"
            :backgroundClose="true"
        >
            <text-input
                v-model="newClassroom.name"
                class="pr-6 pb-8 w-full"
                label="Nombre"
            />
            <button class="btn-indigo" @click="storeClassroom">
                Crear Aula
            </button>
        </t-modal>

        <!-- Toolbar -->
        <div class="mb-6 flex justify-between items-center">
            <search-filter
                v-model="form.search"
                class="w-full max-w-md mr-4"
                @reset="reset"
            >
                <label class="block text-gray-700">Eliminados:</label>
                <select v-model="form.trashed" class="mt-1 w-full form-select">
                    <option :value="null" />
                    <option value="with">Con eliminados</option>
                    <option value="only">Solo Eliminados</option>
                </select>
            </search-filter>
            <button class="btn-indigo" @click="showModal = true">
                Crear Aula
            </button>
        </div>

        <!-- Exercises Table -->
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">ID</th>
                    <th class="px-6 pt-6 pb-4">Nombre</th>
                </tr>
                <tr
                    v-for="classroom in classrooms.data"
                    :key="classroom.id"
                    class="hover:bg-gray-100 focus-within:bg-gray-100"
                >
                    <td class="border-t">
                        <inertia-link
                            class="px-6 py-4 flex items-center focus:text-indigo-500"
                            :href="route('admin.exercises.edit', classroom.id)"
                        >
                            {{ classroom.id }}
                            <icon
                                name="trash"
                                v-if="classroom.deleted_at"
                                class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2"
                            />
                        </inertia-link>
                    </td>
                    <td class="border-t">
                        <inertia-link
                            class="px-6 py-4 flex items-center focus:text-indigo-500"
                            :href="route('admin.exercises.edit', classroom.id)"
                        >
                            {{ exercise.name }}
                        </inertia-link>
                    </td>

                    <td class="border-t w-px">
                        <inertia-link
                            class="px-4 flex items-center"
                            :href="route('admin.exercises.edit', classroom.id)"
                            tabindex="-1"
                        >
                            <icon
                                name="cheveron-right"
                                class="block w-6 h-6 fill-gray-400"
                            />
                        </inertia-link>
                    </td>
                </tr>
                <tr v-if="classrooms.data.length === 0">
                    <td class="border-t px-6 py-4" colspan="4">
                        No hay aulas.
                    </td>
                </tr>
            </table>
        </div>
        <pagination :links="classrooms.links" />
    </div>
</template>

<script>
import Icon from "@/shared/Icon";
import Layout from "@/shared/Layout";
import mapValues from "lodash/mapValues";
import Pagination from "@/shared/Pagination";
import pickBy from "lodash/pickBy";
import SearchFilter from "@/shared/SearchFilter";
import throttle from "lodash/throttle";

export default {
    layout: Layout,
    components: {
        Icon,
        Pagination,
        SearchFilter
    },
    data() {
        return {
            showModal: false,
            newClassroom: {
                name: null
            },
            form: {
                search: this.filters.search,
                trashed: this.filters.trashed
            }
        };
    },
    watch: {
        form: {
            handler: throttle(function() {
                let query = pickBy(this.form);
                this.$inertia.replace(
                    this.route(
                        "admin.exercises",
                        Object.keys(query).length
                            ? query
                            : { remember: "forget" }
                    )
                );
            }, 150),
            deep: true
        }
    },
    methods: {
        storeClassroom() {
            this.$inertia.post(this.route("admin.classrooms.store"), this.newClassroom, {
                onStart: () => (this.sending = true),
                onFinish: () => (this.sending = false)
            });
        },
        reset() {
            this.form = mapValues(this.form, () => null);
        }
    },
    props: {
        classrooms: Object,
        roles: Array,
        filters: Object
    }
};
</script>

<style></style>
