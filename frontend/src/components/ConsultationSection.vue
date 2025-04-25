<template>
  <!-- S: Consultation Section -->
  <section class="consultation-section mb-5">
    <div class="section-header mb-3">
      <h4 class="section-title text-muted">My Consultation</h4>
    </div>
    <div class="row">
      <!-- S: Link to Request Consultation -->
      <div class="col-md-4" v-if="!data.value">
        <div class="card card-default">
          <div class="card-header">
            <h5 class="mb-0">Consultation</h5>
          </div>
          <div class="card-body">
            <router-link to="/dashboard/consultation" href=""
              >+ Request consultation</router-link
            >
          </div>
        </div>
      </div>
      <!-- E: Link to Request Consultation -->

      <!-- S: Society Consultation Box (Pending) -->
      <div class="col-md-4" v-if="data.value">
        <div class="card card-default">
          <div class="card-header border-0">
            <h5 class="mb-0">Consultation</h5>
          </div>
          <div class="card-body p-0">
            <table class="table table-striped mb-0">
              <tr>
                <th>Status</th>
                <td>
                  <span
                    class="badge"
                    :class="{
                      'badge-info': data.value.status == 'pending',
                      'badge-primary': data.value.status == 'accepted',
                    }"
                    >{{ data.value.status }}</span
                  >
                </td>
              </tr>
              <tr>
                <th>Disease History</th>
                <td class="text-muted">
                  {{ data.value.disease_history || "-" }}
                </td>
              </tr>
              <tr>
                <th>Current Symptoms</th>
                <td class="text-muted">
                  {{ data.value.current_symptoms || "-" }}
                </td>
              </tr>
              <tr>
                <th>Doctor Name</th>
                <td class="text-muted">
                  {{ data.value?.doctor?.name || "-" }}
                </td>
              </tr>
              <tr>
                <th>Doctor Notes</th>
                <td class="text-muted">
                  {{ data.value?.doctor_notes || "-" }}
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- E: Society Consultation Box (Pending) -->
    </div>
  </section>
  <!-- E: Consultation Section -->
</template>

<script setup>
import { inject, onMounted, provide, reactive, ref } from "vue";
import api from "../api";
const accepted = inject("accepted");
const data = reactive({ value: null });
async function fetchData() {
  try {
    const response = await api.get("/consultations");
    data.value = response.data?.consultation;
    accepted.value = data.value.status == "accepted";
  } catch (error) {}
}

onMounted(fetchData);
</script>

<style lang="scss" scoped></style>
