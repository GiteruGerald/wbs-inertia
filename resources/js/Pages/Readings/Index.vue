<template>
  <Head title="Readings" {{ bill.month }} />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Readings Index
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between m-2 p-2">
          <div>
            <p>All Water reading details</p>
          </div>
          <div></div>
          <div class="inline-flex">
            <button class="text-indigo-600 ml-5" @click="printComponent()">
              Print
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"
                />
              </svg>
            </button>
          </div>
        </div>
        <!-- TODO: Add search button by Bill/Apartment -->
        <div class="flex flex-col" v-if="!readings.data">
          <p>No reading details added</p>
        </div>
        <div class="flex flex-col print-container" v-else>
          <div
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <div
              class="
                shadow
                overflow-hidden
                border-b border-gray-200
                sm:rounded-lg
              "
            >
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-2
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Unit No
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-2
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Meter_No
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-2
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Month
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-2
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      UnitsCons.
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-2
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Rate
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-2
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
                        py-2
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
                  <tr v-if="!readings.data">
                    <p>No details found</p>
                  </tr>
                  <tr v-for="reading in readings.data" :key="reading.id" v-else>
                    <td class="px-6 py-3 whitespace-nowrap">
                      {{ reading.unit.unit_no }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap">
                      {{ reading.unit.meter_no }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap">
                      {{ reading.bill.month }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap">
                      {{ unitsConsumed(reading.previous, reading.current) }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap">
                      {{ reading.bill.rate }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap">
                      {{
                        chargeAmount(
                          reading.current,
                          reading.previous,
                          reading.bill.rate
                        )
                      }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap links">
                      <div class="flex">
                        <Link
                          :href="route('readings.show', reading.id)"
                          class="text-yellow-600 hover:text-indigo-900"
                          ><svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"
                            />
                          </svg>
                        </Link>

                        <Link
                          :href="route('readings.edit', reading.id)"
                          class="text-green-600 hover:text-indigo-900 ml-5"
                          ><svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                            />
                          </svg>
                        </Link>

                        <button
                          class="text-red-600 ml-5"
                          @click="destroyReading(reading.id)"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12"
                            />
                          </svg>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
    
    <script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import useHelper from "../../composables/helper";

const props = defineProps({
  readings: Object,
});

const { unitsConsumed, chargeAmount } = useHelper();

const destroyReading = (id) => {
  if (confirm("Are you sure you want to delete this reading?")) {
    Inertia.delete(route("readings.destroy", id));
  }
};

const printComponent = () => {
  window.print();
};

</script>
    
<style scoped>
@media print {
  body * {
    visibility: hidden;
  }
  .print-container,
  .print-container * {
    visibility: visible;
  }
  .print-container {
    position: absolute;
    left: 0px;
    width: 100%;
    top: 0px;
  }
  .pagebreak {
    clear: both;
    page-break-after: always;
  }
}
</style>