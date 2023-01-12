<template>
  <Head title="Readings" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Add New Reading
      </h2>
    </template>
    <!-- TODO: Add MultiStep Form With Month Button -->
    <!-- TODO: Make dependent dropdown based on unit (https://www.tutsmake.com/how-to-make-dependent-dropdown-with-vue-js-and-laravel-8/)-->
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex m-2 p-2">
          <Link
            :href="route('readings.index')"
            class="
              px-4
              py-2
              bg-indigo-500
              hover:bg-indigo-600
              text-white
              rounded
            "
            >Back</Link
          >
        </div>
        <div class="flex">
          <div class="container px-5 mx-auto flex">
            <div
              class="
                bg-white
                rounded-lg
                p-8
                flex flex-col
                md:ml-auto
                w-full
                mt-10
                md:mt-0
                relative
                z-10
                shadow-md
              "
            >
              <div class="shadow sm:overflow-hidden sm:rounded-md">
                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                  <!-- Apartment  -->
                  <div>
                    <label
                      for="unit"
                      class="block text-sm font-medium text-gray-700"
                    >
                      Select Apartment</label
                    >
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <select
                        class="
                          block
                          w-0.25
                          flex-1
                          p-2
                          rounded-none rounded-r-md
                          border-gray-300
                          focus:border-indigo-500 focus:ring-indigo-500
                          sm:text-sm
                        "
                        v-model="selectedApt"
                        @change="getUnits()"
                      >
                        <option value="0">Select Country</option>
                        <option
                          v-for="apartment in apartments.data"
                          :value="apartment.id"
                          :key="apartment.id"
                        >
                          {{ apartment.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <hr />
                  <!-- Bill Details -->
                  <h4 class="font-semibold text-xl text-gray-800 leading-tight">
                    Add Bill Details
                  </h4>
                  <div class="mt-1 mr-3">
                    <fieldset>
                      <div class="flex space-x-2 items-center mt-3">
                        <div class="flex-auto">
                          <label
                            for="month"
                            class="block text-sm font-medium text-gray-700"
                            >Month</label
                          >
                          <input
                            v-model="month"
                            type="text"
                            class="
                              w-full
                              focus:ring-yellow-500 focus:border-yellow-500
                              block
                              w-full
                              sm:text-sm
                              border-gray-300
                            "
                            placeholder="Month"
                          />
                        </div>
                        <div class="flex-auto">
                          <label
                            for="bill"
                            class="block text-sm font-medium text-gray-700"
                            >Bill Date</label
                          >
                          <input
                            v-model="bill_date"
                            type="date"
                            class="
                              w-full
                              focus:ring-yellow-500 focus:border-yellow-500
                              block
                              w-full
                              sm:text-sm
                              border-gray-300
                            "
                            placeholder="Bill Date"
                          />
                        </div>
                        <div class="flex-auto">
                          <label
                            for="issue"
                            class="block text-sm font-medium text-gray-700"
                            >Issue Date</label
                          >
                          <input
                            v-model="issue_date"
                            type="date"
                            class="
                              w-full
                              focus:ring-yellow-500 focus:border-yellow-500
                              block
                              w-full
                              sm:text-sm
                              border-gray-300
                            "
                            placeholder="Issue Date"
                          />
                        </div>
                        <div class="flex-auto">
                          <label
                            for="due date"
                            class="block text-sm font-medium text-gray-700"
                            >Due Date</label
                          >
                          <input
                            v-model="due_date"
                            type="date"
                            class="
                              w-full
                              focus:ring-yellow-500 focus:border-yellow-500
                              block
                              w-full
                              sm:text-sm
                              border-gray-300
                            "
                            placeholder="Due Date"
                          />
                        </div>
                        <div class="flex-auto">
                          <label
                            for="rate"
                            class="block text-sm font-medium text-gray-700"
                            >Rate</label
                          >
                          <input
                            v-model="rate"
                            type="number"
                            class="
                              w-full
                              focus:ring-yellow-500 focus:border-yellow-500
                              block
                              w-full
                              sm:text-sm
                              border-gray-300
                            "
                            placeholder="Rate/Unit"
                          />
                        </div>
                      </div>
                    </fieldset>
                  </div>
                  <hr />
                  <h4 class="font-semibold text-xl text-gray-800 leading-tight">
                    Add Reading Details - {{}}
                  </h4>
                  <form @submit.prevent="storeReading">
                    <div class="mt-1 mr-3">
                      <div class="flex space-x-2 items-center mt-3">
                        <div class="flex-auto">
                          <label
                            for="unit"
                            class="block text-sm font-medium text-gray-700"
                            >Unit No</label
                          >
                        </div>
                        <div class="flex-auto">
                          <label
                            for="unit"
                            class="block text-sm font-medium text-gray-700"
                            >Meter No</label
                          >
                        </div>
                        <div class="flex-auto">
                          <label
                            for="unit"
                            class="block text-sm font-medium text-gray-700"
                            >Previous</label
                          >
                        </div>
                        <div class="flex-auto">
                          <label
                            for="unit"
                            class="block text-sm font-medium text-gray-700"
                            >Current</label
                          >
                        </div>
                      </div>
                      <div
                        class="mb-2"
                        v-for="(unit, index) in units"
                        :key="index"
                      >
                        <div class="flex space-x-2 items-center mt-3">
                          <div class="flex-auto">
                            <input
                              v-model="unit.unit_no"
                              type="text"
                              class="
                                w-full
                                focus:ring-yellow-500 focus:border-yellow-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                              "
                              :aria-label="`Unit {index+1}`"
                              placeholder="Unit No"
                              disabled
                            />
                          </div>
                          <div class="flex-auto">
                            <input
                              v-model="unit.meter_no"
                              type="number"
                              class="
                                w-full
                                focus:ring-yellow-500 focus:border-yellow-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                              "
                              :aria-label="`Meter {index+1} No`"
                              placeholder="Meter No"
                              disabled
                            />
                          </div>
                          <div class="flex-auto">
                            <input
                              v-model="unit.readings"
                              type="text"
                              class="
                                w-full
                                focus:ring-yellow-500 focus:border-yellow-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                              "
                              :aria-label="`Meter {index+1} No`"
                              placeholder="Previous"
                              disabled
                            />
                          </div>
                          <div class="flex-auto">
                            <input
                              type="text"
                              class="
                                w-full
                                focus:ring-yellow-500 focus:border-yellow-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                              "
                              :aria-label="`Meter {index+1} No`"
                              placeholder="Current"
                            />
                          </div>
                        </div>
                        <p
                          class="ml-8 text-xs mt-2 text-red-600"
                          v-if="form.errors[`units.${index}.unit_no`]"
                        >
                          {{ form.errors[`units.${index}.unit_no`] }}
                        </p>
                        <p
                          class="ml-8 text-xs mt-2 text-red-600"
                          v-if="form.errors[`units.${index}.meter_no`]"
                        >
                          {{ form.errors[`units.${index}.meter_no`] }}
                        </p>
                      </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                      <button
                        type="submit"
                        class="
                          inline-flex
                          justify-center
                          rounded-md
                          border border-transparent
                          bg-indigo-600
                          py-2
                          px-4
                          text-sm
                          font-medium
                          text-white
                          shadow-sm
                          hover:bg-indigo-700
                          focus:outline-none
                          focus:ring-2
                          focus:ring-indigo-500
                          focus:ring-offset-2
                        "
                        :disabled="processing"
                      >
                        Save Month Readings
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div></div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
    <script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
import axios from "axios";
let processing = ref(false);

const props = defineProps({
  apartments: Object,
  units: Object,
  errors: Object,
});

const storeReading = () => {
  // processing.value = true;

  form.post("/readings");
};

const form = useForm({
  unit_id: null,
  month: null,
  previous: null,
  current: null,
  rate: null,
});

const apts = ref([]);
const selectedApt = ref(1);
const units = ref([]);

const getUnits = () => {
  axios.get(`/apartments/${selectedApt.value}/units`).then((response) => {
    units.value = response.data;
  });
};

onMounted(() => {
  getUnits();
});
</script>
    