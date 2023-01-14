<template>
  <Head title="Bills" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Bill Show
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex m-2 p-2">
          <Link
            href="/bills"
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
          <!-- TODO: Add Go to Edit Link -->
          <!-- TODO: Add Delete Button -->
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
              <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <!-- Apartment Details -->
                <div>
                  <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                      Bill Month: {{ bill.month }}
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      Bill details.
                    </p>
                  </div>
                </div>
                <hr />

                <!-- Water Reading Details -->
                <div
                  class="
                    bg-gray-50
                    px-4
                    py-5
                    sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                  "
                >
                  <dt class="text-sm font-medium text-gray-500">Apartment</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    {{ apartment.name }}
                  </dd>
                </div>
                <div
                  class="
                    bg-gray-50
                    px-4
                    py-5
                    sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                  "
                >
                  <dt class="text-sm font-medium text-gray-500">Bill Date</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    {{ bill.bill_date }}
                  </dd>
                </div>
                <div
                  class="
                    bg-gray-50
                    px-4
                    py-5
                    sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                  "
                >
                  <dt class="text-sm font-medium text-gray-500">Issue Date</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    {{ bill.issue_date }}
                  </dd>
                </div>
                <div
                  class="
                    bg-gray-50
                    px-4
                    py-5
                    sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                  "
                >
                  <dt class="text-sm font-medium text-gray-500">Due Date</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    {{ bill.due_date }}
                  </dd>
                </div>
                <hr />
                <!-- Reading Details -->
                <div>
                  <div class="px-4 py-5 sm:px-6">
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      Add Reading details for {{ bill.month }}
                    </p>
                    <form @submit.prevent="saveReadings()">
                      <div>
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
                            v-for="(unit, index) in form.units"
                            :key="index"
                          >
                            <div class="flex space-x-2 items-center mt-3">
                              <div class="flex-auto">
                                <input
                                  v-model="unit.unit_no"
                                  type="text"
                                  class="
                                    w-full
                                    focus:ring-yellow-500
                                    focus:border-yellow-500
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
                                    focus:ring-yellow-500
                                    focus:border-yellow-500
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
                                  v-model="unit.previous"
                                  type="number"
                                  class="
                                    w-full
                                    focus:ring-yellow-500
                                    focus:border-yellow-500
                                    block
                                    w-full
                                    sm:text-sm
                                    border-gray-300
                                  "
                                  :aria-label="`Meter {index+1} No`"
                                  placeholder="Previous"
                                />
                                <p
                                  class="ml-8 text-xs mt-2 text-red-600"
                                  v-if="form.errors[`units.${index}.previous`]"
                                >
                                  {{ form.errors[`units.${index}.previous`] }}
                                </p>
                              </div>
                              <div class="flex-auto">
                                <input
                                v-model="unit.current"
                                  type="number"
                                  class="
                                    w-full
                                    focus:ring-yellow-500
                                    focus:border-yellow-500
                                    block
                                    w-full
                                    sm:text-sm
                                    border-gray-300
                                  "
                                  :aria-label="`Meter {index+1} No`"
                                  placeholder="Current"
                                />
                                <p
                                  class="ml-8 text-xs mt-2 text-red-600"
                                  v-if="form.errors[`units.${index}.current`]"
                                >
                                  {{ form.errors[`units.${index}.current`] }}
                                </p>
                              </div>
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
                          >
                            Save Month Readings
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- TODO: Add Create Reading Link -->
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
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { HomeIcon } from "@heroicons/vue/20/solid";
import { onMounted, ref } from "vue";
import axios from "axios";

const props = defineProps({
  bill: Object,
  apartment: Object,
  errors:Object
});


// FIXME: Pick up from here

const form = useForm({
  units: [],
});

// const units = ref([]);

const saveReadings = () => {
  form.post("/readings");
};

const getUnits = async () => {
  await axios.get(`/apartments/${props.apartment.id}/units`).then((res) => {
    form.units = res.data;
  });
};

onMounted(() => {
  getUnits();
});
</script>
  