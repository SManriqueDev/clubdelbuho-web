<template>
    <div>
        <div class="mb-3">
            <inertia-link
                class="flex items-center group py-3"
                v-for="(item, i) in items()"
                :key="i"
                :href="item.route"
            >
                <feather-icon
                    icon="HomeIcon"
                    class="w-4 h-4 mr-2"
                    :svgClasses="
                        isUrl('admin/exercises')
                            ? 'fill-white'
                            : 'fill-indigo-400 group-hover:fill-white'
                    "
                />
                <div
                    :class="
                        isUrl('admin/exercises')
                            ? 'text-white'
                            : 'text-indigo-300 group-hover:text-white'
                    "
                >
                    {{ item.name }}
                </div>
            </inertia-link>
        </div>
    </div>
</template>

<script>
import Icon from "@/shared/Icon";

export default {
    components: {
        Icon
    },
    props: {
        url: String
    },
    methods: {
        items() {
            return [
                {
                    name: "Ejercicios",
                    route: this.route("admin.exercises")
                },
                {
                    name: "Códigos de Aula",
                    route: this.route("admin.classroomkeys.index")
                },
                {
                    name: "Aulas",
                    route: this.route("admin.classrooms.index")
                }
            ];
        },
        isUrl(...urls) {
            if (urls[0] === "") {
                return this.url === "";
            }

            return urls.filter(url => this.url.startsWith(url)).length;
        }
    }
};
</script>
