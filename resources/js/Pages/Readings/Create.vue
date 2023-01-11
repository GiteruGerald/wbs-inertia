<template>
    <Head title="Readings" />
  
    <BreezeAuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Add New Reading
        </h2>
      </template>
          <!-- TODO: Add MultiStep Form With Month Button -->
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
                <form @submit.prevent="storeReading">
                  <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                      <!-- Unit  -->
                      <div>
                        <label
                          for="unit"
                          class="block text-sm font-medium text-gray-700"
                          >Unit</label
                        >
                        <div class="mt-1 flex rounded-md shadow-sm">
                          <select
                            class="
                              block
                              w-0.25
                              flex-1
                              rounded-none rounded-r-md
                              border-gray-300
                              focus:border-indigo-500 focus:ring-indigo-500
                              sm:text-sm
                            "
                            v-model="form.unit_id"
                          >
                            <option
                              v-for="unit in units.data"
                              :value="unit.id"
                              :key="unit.id"
                            >
                              {{ unit.unit_no }}
                            </option>
                          </select>
                          <!-- Display error msg -->
                          <div
                            v-if="errors.unit_id"
                            v-text="errors.unit_id"
                            class="text-red-800 text-sm mt-2"
                          ></div>
                        </div>
                      </div>
                      <!-- Month -->
                      <div>
                        <label
                          for="month"
                          class="block text-sm font-medium text-gray-700"
                          >Month</label
                        >
                        <div class="mt-1 flex rounded-md shadow-sm">
                          <select
                            class="
                              block
                              w-full
                              flex-1
                              rounded-none rounded-r-md
                              border-gray-300
                              focus:border-indigo-500 focus:ring-indigo-500
                              sm:text-sm
                            "
                            v-model="form.month"
                          >
                            <option hidden>Select Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                          </select>
                          <!-- Display error msg -->
                          <div
                            v-if="errors.month"
                            v-text="errors.month"
                            class="text-red-800 text-sm mt-2"
                          ></div>
                        </div>
                      </div>
                      <!-- Previous -->
                      <div>
                        <label
                          for="previous"
                          class="block text-sm font-medium text-gray-700"
                          >Previous Reading</label
                        >
                        <div class="mt-1 flex rounded-md shadow-sm">
                          <input
                            v-model="form.previous"
                            type="number"
                            id="previous"
                            class="
                              block
                              w-full
                              flex-1
                              rounded-none rounded-r-md
                              border-gray-300
                              focus:border-indigo-500 focus:ring-indigo-500
                              sm:text-sm
                            "
                            placeholder="previous"
                          />
                          <!-- Display error msg -->
                          <div
                            v-if="errors.previous"
                            v-text="errors.previous"
                            class="text-red-800 text-sm mt-2"
                          ></div>
                        </div>
                      </div>
                      <!-- Current -->
                      <div>
                        <label
                          for="current"
                          class="block text-sm font-medium text-gray-700"
                          >Current Reading</label
                        >
                        <div class="mt-1 flex rounded-md shadow-sm">
                          <input
                            v-model="form.current"
                            type="number"
                            id="current"
                            class="
                              block
                              w-full
                              flex-1
                              rounded-none rounded-r-md
                              border-gray-300
                              focus:border-indigo-500 focus:ring-indigo-500
                              sm:text-sm
                            "
                            placeholder="current"
                          />
                          <!-- Display error msg -->
                          <div
                            v-if="errors.current"
                            v-text="errors.current"
                            class="text-red-800 text-sm mt-2"
                          ></div>
                        </div>
                      </div>
                      <!-- Rate -->
                      <div>
                        <label
                          for="rate"
                          class="block text-sm font-medium text-gray-700"
                          >Rate per unit</label
                        >
                        <div class="mt-1 flex rounded-md shadow-sm">
                          <input
                            v-model="form.rate"
                            type="number"
                            id="rate"
                            class="
                              block
                              w-full
                              flex-1
                              rounded-none rounded-r-md
                              border-gray-300
                              focus:border-indigo-500 focus:ring-indigo-500
                              sm:text-sm
                            "
                            placeholder="Rate"
                          />
                          <!-- Display error msg -->
                          <div
                            v-if="errors.rate"
                            v-text="errors.rate"
                            class="text-red-800 text-sm mt-2"
                          ></div>
                        </div>
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
                        Save
                      </button>
                    </div>
                  </div>
                </form>
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
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
  import { ref } from "@vue/reactivity";
  
  let processing = ref(false);
  
  const props = defineProps({
    units: Object,
    errors: Object,
  });
  
  const form = useForm({
    unit_id: null,
    month: null,
    previous: null,
    current: null,
    rate: null,
  });
  
  const storeReading = () => {
    // processing.value = true;
  
    form.post("/readings");
  };
  </script>
    