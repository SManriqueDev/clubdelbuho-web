<template>
  <div>
    <header>
      <div class="locale-changer absolute">
        <select v-model="$i18n.locale">
          <option v-for="(lang, i) in langs" :key="`Lang${i}`" :value="lang">
            {{ lang }}
          </option>
        </select>
      </div>
    </header>
    <slot></slot>
    <footer class="py-2 px-2">
      Mundo Lector - {{ $t("footer.developed-by") }} Alen Software &copy;
      {{ new Date().getFullYear() }}
    </footer>
  </div>
</template>
<script>
export default {
  name: "locale-changer",
  data() {
    return { langs: ["es", "en"] };
  },
};
</script>
