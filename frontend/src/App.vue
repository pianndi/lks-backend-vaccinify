<script setup>
import { provide, reactive } from "vue";
import { getUser } from "./auth";
import { useRouter } from "vue-router";
import api from "./api";

const user = reactive({ value: getUser() });
console.log(user);
provide("user", user);
const router = useRouter();
async function logout() {
  await api.post("/auth/logout");
  user.value = null;
  localStorage.removeItem("user");
  localStorage.removeItem("token");
  alert("Logout success");
  router.replace({ name: "login" });
}
</script>

<template>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
    <div class="container">
      <a class="navbar-brand" href="#">Vaccination Platform</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" v-if="user.value">
            <span class="nav-link" to="/">{{ user.value.name }}</span>
          </li>
          <li class="nav-item" v-if="user.value">
            <span @click="logout" class="nav-link">Logout</span>
          </li>
          <li class="nav-item" v-if="!user.value">
            <router-link class="nav-link" to="/">Login</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    <router-view></router-view>
  </main>
  <!-- S: Footer -->
  <footer>
    <div class="container">
      <div class="text-center py-4 text-muted">
        Copyright &copy; 2021 - Web Tech ID
      </div>
    </div>
  </footer>
  <!-- E: Footer -->
</template>

<style scoped></style>
