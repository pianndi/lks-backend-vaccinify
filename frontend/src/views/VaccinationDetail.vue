<template>
  <!-- S: Header -->
  <header class="jumbotron">
    <div class="container d-flex justify-content-between align-items-center">
      <div>
        <h1 class="display-4">{{ data.value?.spot?.name }}</h1>
        <span class="text-muted">{{ data.value?.spot?.address }}</span>
      </div>
      <button @click="handleSubmit" class="btn btn-primary">
        Register vaccination
      </button>
    </div>
  </header>
  <!-- E: Header -->

  <div class="container">
    <div class="row mb-3">
      <div class="col-md-3">
        <div class="form-group">
          <label for="vaccination-date">Select vaccination date</label>
          <input
            type="date"
            class="form-control"
            id="vaccination-date"
            v-model="date"
            @change="fetchData"
          />
        </div>
      </div>
    </div>

    <div class="row mb-5">
      <!-- S: Session 1 -->
      <div class="col-md-4" v-for="i in 3" :key="i">
        <div class="card card-default">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h4>Session {{ i + 10 }}</h4>
              <span class="text-muted"
                >{{ (9 + (i - 1) * 3).toString().padStart(2, "0") }}:00 -
                {{ (11 + (i - 1) * 3).toString().padStart(2, "0") }}:00</span
              >
            </div>
            <div>
              <div class="row">
                <div
                  class="col-4 mb-4"
                  v-for="j in (data.value?.spot?.capacity || 0) / 3"
                  :key="j"
                >
                  <div
                    class="slot"
                    :class="{
                      filled: j + (i - 1) * 3 <= data.value?.vaccinations_count,
                    }"
                  >
                    #{{ j + (i - 1) * 3 }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- E: Session 1 -->
    </div>
  </div>
</template>

<script setup>
import { useRoute } from "vue-router";
import api from "../api";
import { onMounted, reactive, ref } from "vue";
const sekarang = new Date();
const date = ref(
  `${sekarang.getFullYear()}-${sekarang
    .getMonth()
    .toString()
    .padStart(2, "0")}-${sekarang.getDate()}`
);
const route = useRoute();

const id = route.params.id;
const data = reactive({ value: null });
async function fetchData() {
  try {
    const response = await api.get("/spots/" + id, {
      query: {
        date,
      },
    });
    data.value = response.data;
  } catch (error) {}
}
async function handleSubmit() {
  try {
    const response = await api.post("/vaccinations", {
      date: date.value,
      spot_id: id,
    });
    alert(response.data?.message);
    fetchData();
  } catch (error) {
    alert(error.response.data?.message);
  }
}
onMounted(fetchData);
</script>

<style lang="scss" scoped></style>
