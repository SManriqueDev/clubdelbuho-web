<template>
  <div>
    <slot></slot>
    <footer class="py-2 px-2">
      Mundo Lector - Desarrollado por Alen Software &copy;
      {{ new Date().getFullYear() }}
    </footer>
  </div>
</template>
