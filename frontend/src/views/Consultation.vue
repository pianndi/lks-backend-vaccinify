<template>
  <!-- S: Header -->
  <header class="jumbotron">
    <div class="container">
      <h1 class="display-4">Request Consultation</h1>
    </div>
  </header>
  <!-- E: Header -->

  <div class="container">
    <form action="" @submit.prevent="handleSubmit">
      <div class="row mb-4">
        <div class="col-md-6">
          <span class="text-danger">{{ gagal }}</span>
          <div class="form-group">
            <div class="d-flex align-items-center mb-3">
              <label for="disease-history" class="mr-3 mb-0"
                >Do you have disease history ?</label
              >
              <select class="form-control-sm" v-model="disease_history">
                <option value="yes">Yes, I have</option>
                <option value="no">No</option>
              </select>
            </div>
            <textarea
              v-if="disease_history == 'yes'"
              v-model="form.disease_history"
              id="disease-history"
              class="form-control"
              cols="30"
              rows="10"
              placeholder="Describe your disease history"
            ></textarea>
          </div>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-6">
          <div class="form-group">
            <div class="d-flex align-items-center mb-3">
              <label for="current-symptoms" class="mr-3 mb-0"
                >Do you have symptoms now ?</label
              >
              <select class="form-control-sm" v-model="symptoms">
                <option value="yes">Yes, I have</option>
                <option value="no">No</option>
              </select>
            </div>
            <textarea
              v-if="symptoms == 'yes'"
              id="current-symptoms"
              class="form-control"
              cols="30"
              rows="10"
              v-model="form.current_symptoms"
              placeholder="Describe your current symptoms"
            ></textarea>
          </div>
        </div>
      </div>

      <button class="btn btn-primary">Send Request</button>
    </form>
  </div>
</template>

<script setup>
import { useRouter } from "vue-router";
import { reactive, ref } from "vue";
import api from "../api";
const form = reactive({});
const disease_history = ref("no");
const symptoms = ref("no");

const router = useRouter();
const gagal = ref("");
async function handleSubmit() {
  try {
    const response = await api.post("/consultations", form);
    alert(response.data?.message);
    router.push("/dashboard");
  } catch (error) {
    console.log(error);
    gagal.value = error.response.data?.message;
  }
}
</script>

<style lang="scss" scoped></style>
