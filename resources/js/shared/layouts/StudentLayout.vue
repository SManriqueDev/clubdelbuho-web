<template>
  <div class="student-layout">
    <StudentNavbar></StudentNavbar>
    <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto" scroll-region>
      <flash-messages />
      <slot />
    </div>
  </div>
</template>

<script>
import StudentNavbar from "@/components/Student/StudentNavbar";
import FlashMessages from "@/shared/FlashMessages";
export default {
  components: {
    StudentNavbar,
    FlashMessages,
  },
};
</script>

<style>
</style>
