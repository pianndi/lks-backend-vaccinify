<template>
  <!-- S: Header -->
  <header class="jumbotron">
    <div class="container">
      <h1 class="display-4">First Vaccination</h1>
    </div>
  </header>
  <!-- E: Header -->

  <div class="container mb-5">
    <div class="section-header mb-4">
      <h4 class="section-title text-muted font-weight-normal">
        List Vaccination Spots in {{ user.value.regional.district }}
      </h4>
    </div>

    <div class="section-body">
      <article class="spot" v-for="spot in data.value" :key="spot">
        <router-link class="row" :to="'/dashboard/vaccination/' + spot.id">
          <div class="col-5">
            <h5 :to="'/dashboard/vaccination/' + spot.id" class="text-primary">
              {{ spot.name }}
            </h5>
            <span class="text-muted">{{ spot.address }}</span>
          </div>
          <div class="col-4">
            <h5>Available vaccines</h5>
            <span class="text-muted">
              <span
                v-for="(item, key) in spot.available_vaccines"
                :key="key"
                v-show="item"
              >
                {{ key }},
              </span>
            </span>
          </div>
          <div class="col-3">
            <h5>Serve</h5>
            <span class="text-muted">
              {{
                spot.serve === 2
                  ? "Only second vaccination"
                  : spot.serve === 3
                  ? "Both vaccination"
                  : "Only first vaccination"
              }}
            </span>
          </div>
        </router-link>
      </article>
    </div>
  </div>
</template>

<script setup>
import { inject, onMounted, reactive } from "vue";
import api from "../api";
const user = inject("user");
const data = reactive({ value: null });
async function fetchData() {
  try {
    const response = await api.get("/spots");
    data.value = response.data?.spots;
  } catch (error) {}
}

onMounted(fetchData);
</script>

<style lang="scss" scoped></style>
