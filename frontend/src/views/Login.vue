<template>
  <!-- S: Header -->
  <header class="jumbotron">
    <div class="container text-center">
      <h1 class="display-4">Vaccination Platform</h1>
    </div>
  </header>
  <!-- E: Header -->

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <span class="text-danger">{{ gagal }}</span>
        <form class="card card-default" @submit.prevent="handleSubmit">
          <div class="card-header">
            <h4 class="mb-0">Login</h4>
          </div>
          <div class="card-body">
            <div class="form-group row align-items-center">
              <div class="col-4 text-right">ID Card Number</div>
              <div class="col-8">
                <input
                  type="text"
                  v-model="form.id_card_number"
                  class="form-control"
                />
              </div>
            </div>
            <div class="form-group row align-items-center">
              <div class="col-4 text-right">Password</div>
              <div class="col-8">
                <input
                  type="password"
                  class="form-control"
                  v-model="form.password"
                />
              </div>
            </div>
            <div class="form-group row align-items-center mt-4">
              <div class="col-4"></div>
              <div class="col-8">
                <button class="btn btn-primary">Login</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { inject, reactive, ref } from "vue";
import api from "../api";
import { useRouter } from "vue-router";
const form = reactive({});
const router = useRouter();
const user = inject("user");
const gagal = ref("");
async function handleSubmit() {
  try {
    const response = await api.post("/auth/login", form);
    localStorage.setItem("token", response.data?.token);
    localStorage.setItem("user", JSON.stringify(response.data));
    user.value = response.data;
    router.replace("/dashboard");
  } catch (error) {
    gagal.value = error.response.data?.message;
  }
}
</script>

<style lang="scss" scoped></style>
