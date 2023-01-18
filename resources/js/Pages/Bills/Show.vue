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
                                for="reading"
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
                            v-for="(reading, index) in form.units"
                            :key="index"
                          >
                            <div class="flex space-x-2 items-center mt-3">
                              <div class="flex-auto">
                                <input
                                  v-model="reading.unit_no"
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
                                  v-model="reading.meter_no"
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
                                  v-model="reading.previous"
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
                                  v-if="
                                    form.errors[`readings.${index}.previous`]
                                  "
                                >
                                  {{
                                    form.errors[`readings.${index}.previous`]
                                  }}
                                </p>
                              </div>
                              <div class="flex-auto">
                                <input
                                  v-model="reading.current"
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
                                  v-if="
                                    form.errors[`readings.${index}.current`]
                                  "
                                >
                                  {{ form.errors[`readings.${index}.current`] }}
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

              <div class="overflow-hidden bg-white mt-5 shadow sm:rounded-lg">
                <div>
                  <div class="px-4 py-5 sm:px-6">
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      Readings Recorded for
                      <b>{{ bill.month }}: {{ apartment.name }}</b>
                    </p>
                    <p class="mt-1 text-xs text-gray-500">
                      Rate: <b>{{ bill.rate }}</b>
                    </p>
                  </div>
                </div>
                <div class="border-t px-5 border-gray-200">
                  <dl>
                    <table
                      class="min-w-full py-3 px-4 divide-y divide-gray-200"
                    >
                      <thead class="bg-gray-50">
                        <tr>
                          <th
                            scope="col"
                            class="
                              px-6
                              py-3
                              text-left text-xs
                              font-medium
                              text-gray-500
                              uppercase
                              tracking-wider
                            "
                          >
                            Unit
                          </th>
                          <th
                            scope="col"
                            class="
                              px-6
                              py-3
                              text-left text-xs
                              font-medium
                              text-gray-500
                              uppercase
                              tracking-wider
                            "
                          >
                            Previous
                          </th>
                          <th
                            scope="col"
                            class="
                              px-6
                              py-3
                              text-left text-xs
                              font-medium
                              text-gray-500
                              uppercase
                              tracking-wider
                            "
                          >
                            Current
                          </th>
                          <th
                            scope="col"
                            class="
                              px-6
                              py-3
                              text-left text-xs
                              font-medium
                              text-gray-500
                              uppercase
                              tracking-wider
                            "
                          >
                            Units Consumed
                          </th>
                          <th
                            scope="col"
                            class="
                              px-6
                              py-3
                              text-left text-xs
                              font-medium
                              text-gray-500
                              uppercase
                              tracking-wider
                            "
                          >
                            Amount
                          </th>
                          <th
                            scope="col"
                            class="
                              flex
                              space-x-4
                              px-6
                              py-3
                              text-left text-xs
                              font-medium
                              text-gray-500
                              uppercase
                              tracking-wider
                            "
                          ></th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="reading in readings" :key="reading.id">
                          <td class="px-6 py-4 whitespace-nowrap">
                            {{ reading.unit.unit_no }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            {{ reading.previous }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            {{ reading.current }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            {{
                              unitsConsumed(reading.previous, reading.current)
                            }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            {{
                              chargeAmount(
                                reading.current,
                                reading.previous,
                                bill.rate
                              )
                            }}
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </dl>
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
import { onMounted, ref } from "vue";
import axios from "axios";
import useHelper from "../../composables/helper";

const props = defineProps({
  bill: Object,
  apartment: Object,
  errors: Object,
});

const { unitsConsumed, chargeAmount } = useHelper();

// FIXME: Pass in Unit and Bill Id  from here

const form = useForm({
  units: [],
  bill_id: props.bill.id,
});

const readings = ref([]);

const saveReadings = () => {
  form.post("/readings");
};

const getUnits = async () => {
  await axios.get(`/apartments/${props.apartment.id}/units`).then((res) => {
    form.units = res.data;
  });
};

const getReadings = async () => {
  await axios.get(`/bills/${props.bill.id}/readings`).then((res) => {
    readings.value = res.data;
  });
};
onMounted(() => {
  getUnits();
  getReadings();
});
</script>
  