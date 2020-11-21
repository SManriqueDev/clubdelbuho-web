<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Dashboard</h1>
    <div class="mb-8 flex">
      <inertia-link class="btn-indigo" href="/500">500 error</inertia-link>
      <inertia-link class="btn-indigo ml-1" href="/404">404 error</inertia-link>
    </div>
  </div>
</template>

<script>
import Layout from "@/Shared/Layout";

export default {
  metaInfo: { title: "Dashboard" },
  layout: Layout,
};
</script>
