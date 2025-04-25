<template>
  <!-- S: Header -->
  <header class="jumbotron">
    <div class="container">
      <h1 class="display-4">Dashboard</h1>
    </div>
  </header>
  <!-- E: Header -->

  <div class="container">
    <ConsultationSection />
    <VaccineSection />
  </div>
</template>

<script setup>
import { provide, reactive, ref } from "vue";
import api from "../api";
import ConsultationSection from "../components/ConsultationSection.vue";
import VaccineSection from "../components/VaccineSection.vue";
const accepted = ref(false);
provide("accepted", accepted);
</script>

<style lang="scss" scoped></style>
