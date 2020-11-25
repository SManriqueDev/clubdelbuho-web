<template>
    <div>
        <!-- Student Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-12">
            <!-- Avatar -->
            <div class="text-center mx-auto">
                <AvatarSvg />
                <span class="font-bold text-lg">Mi Avatar</span>
            </div>
            <div class="text-center mx-auto">
                <!-- Background -->
                <MobileSvg />
                <span class="text-lg font-bold">
                    Fondo personalizado
                </span>
            </div>
            <div class="text-center mx-auto">
                <WinnersSvg />

                <span class="text-lg font-bold">
                    Mis últimas recompensas
                </span>
            </div>
        </div>

        <!-- Resume Student -->

        <div class="grid grid-cols-2 gap-4 w-10/12 mx-auto">
            <StrengthsCard v-for="n in 4" :key="n" />
        </div>
    </div>
</template>

<script>
import StudentLayout from "@/shared/layouts/StudentLayout";
import StrengthsCard from "@/components/StrengthsCard";
import MobileSvg from "@/components/SVGs/MobileSvg";
import AvatarSvg from "@/components/SVGs/AvatarSvg";
import WinnersSvg from "@/components/SVGs/WinnersSvg";
export default {
    layout: StudentLayout,
    components: {
        StrengthsCard,
        AvatarSvg,
        WinnersSvg,
        MobileSvg
    }
};
</script>

<style></style>
