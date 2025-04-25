<template>
  <!-- S: List Vaccination Section -->
  <section class="consultation-section mb-5">
    <div class="section-header mb-3">
      <h4 class="section-title text-muted">My Vaccinations</h4>
    </div>
    <div class="section-body">
      <div class="row mb-4">
        <!-- S: First Vaccination info -->
        <div class="col-md-12" v-if="!accepted">
          <div class="alert alert-warning">
            Your consultation must be approved by doctor to get the vaccine.
          </div>
        </div>
        <!-- E: First Vaccination info -->
        <!-- S: Link to Register First Vaccination -->
        <div class="col-md-4" v-if="!data.value?.first && accepted">
          <div class="card card-default">
            <div class="card-header border-0">
              <h5 class="mb-0">First Vaccination</h5>
            </div>
            <div class="card-body">
              <router-link to="/dashboard/vaccination" href=""
                >+ Register vaccination</router-link
              >
            </div>
          </div>
        </div>
        <!-- E: Link to Register First Vaccination -->

        <!-- S: First Vaccination Box (Registered) -->
        <div class="col-md-4" v-if="data.value?.first && accepted">
          <div class="card card-default">
            <div class="card-header border-0">
              <h5 class="mb-0">First Vaccination</h5>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped mb-0">
                <tr>
                  <th>Status</th>
                  <td class="text-muted">
                    <span
                      class="badge"
                      :class="{
                        'badge-info': data.value.first.status == 'registered',
                        'badge-primary':
                          data.value.first.status == 'vaccinated',
                      }"
                      >{{ data.value.first.status || "" }}</span
                    >
                  </td>
                </tr>
                <tr>
                  <th>Date</th>
                  <td class="text-muted">
                    {{ data.value.first.vaccination_date || "-" }}
                  </td>
                </tr>
                <tr>
                  <th>Spot</th>
                  <td class="text-muted">
                    {{ data.value.first.spot?.name || "-" }}
                  </td>
                </tr>
                <tr>
                  <th>Vaccine</th>
                  <td class="text-muted">
                    {{ data.value.first.vaccine?.name || "-" }}
                  </td>
                </tr>
                <tr>
                  <th>Vaccinator</th>
                  <td class="text-muted">
                    {{ data.value.first.vaccinator?.name || "-" }}
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <!-- S: First Vaccination Box (Registered) -->
        <!--  -->
        <!--  -->
        <!--  -->
        <!--  -->
        <!-- S: Link to Register Second Vaccination -->
        <div class="col-md-4" v-if="!data.value?.second && accepted">
          <div class="card card-default">
            <div class="card-header border-0">
              <h5 class="mb-0">Second Vaccination</h5>
            </div>
            <div class="card-body">
              <router-link to="/dashboard/vaccination" href=""
                >+ Register vaccination</router-link
              >
            </div>
          </div>
        </div>
        <!-- E: Link to Register Second Vaccination -->

        <!-- S: Second Vaccination Box (Registered) -->
        <div class="col-md-4" v-if="data.value?.second && accepted">
          <div class="card card-default">
            <div class="card-header border-0">
              <h5 class="mb-0">Second Vaccination</h5>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped mb-0">
                <tr>
                  <th>Status</th>
                  <td class="text-muted">
                    <span
                      class="badge"
                      :class="{
                        'badge-info': data.value.second.status == 'registered',
                        'badge-primary':
                          data.value.second.status == 'vaccinated',
                      }"
                      >{{ data.value.second.status || "" }}</span
                    >
                  </td>
                </tr>
                <tr>
                  <th>Date</th>
                  <td class="text-muted">
                    {{ data.value.second.vaccination_date || "-" }}
                  </td>
                </tr>
                <tr>
                  <th>Spot</th>
                  <td class="text-muted">
                    {{ data.value.second.spot?.name || "-" }}
                  </td>
                </tr>
                <tr>
                  <th>Vaccine</th>
                  <td class="text-muted">
                    {{ data.value.second.vaccine?.name || "-" }}
                  </td>
                </tr>
                <tr>
                  <th>Vaccinator</th>
                  <td class="text-muted">
                    {{ data.value.second.vaccinator?.name || "-" }}
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <!-- S: Second Vaccination Box (Done) -->
      </div>
    </div>
  </section>
  <!-- E: List Vaccination Section -->
</template>

<script setup>
import { inject, onMounted, reactive, watch } from "vue";
import api from "../api";
const accepted = inject("accepted");
watch(accepted, (newVal) => {
  console.log(newVal);
});
const data = reactive({ value: null });
async function fetchData() {
  try {
    const response = await api.get("/vaccinations");
    data.value = response.data?.vaccinations;
    console.log(data.value);
  } catch (error) {}
}

onMounted(fetchData);
</script>
