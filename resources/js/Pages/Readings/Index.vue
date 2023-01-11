<template>
  <Head title="Readings" />

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
            <button
              class="
                px-4
                py-2
                bg-green-500
                hover:bg-green-600
                text-white
                rounded
              "
              @click="printComponent()"
            >
              Print
            </button>
          </div>
          <div>
            <select
              class="form-control"
              id=""
              v-model="sort"
              @change="sortValue"
            >
              <option value="">--Filter By Type--</option>
              <option value="Residential">Residential</option>
              <option value="Commercial">Commercial</option>
              <option value="Industrial">Industrial</option>
            </select>
          </div>
          <div>
            <Link
              href="/readings/create"
              class="
                px-4
                py-2
                bg-indigo-500
                hover:bg-indigo-600
                text-white
                rounded
              "
              >Add Reading</Link
            >
          </div>
        </div>
        <div class="flex flex-col" v-if="!readings.data">
          <p>No reading details added</p>
        </div>
        <div class="flex flex-col print-container" ref="printable" v-else>
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
                        py-3
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
                        py-3
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
                        py-3
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
                      Rate
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
                  <tr v-if="!readings.data">
                    <p>No details found</p>
                  </tr>
                  <tr v-for="reading in readings.data" :key="reading.id" v-else>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ reading.unit.unit_no }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ reading.unit.meter_no }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ reading.month }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ unitsConsumed(reading.previous, reading.current) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ reading.rate }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{
                        chargeAmount(
                          reading.current,
                          reading.previous,
                          reading.rate
                        )
                      }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap links">
                      <Link
                        :href="`/readings/${reading.id}`"
                        class="text-green-600 hover:text-indigo-900"
                        >Show</Link
                      >
                      /
                      <Link
                        :href="`/readings/${reading.id}/edit`"
                        class="text-indigo-600 hover:text-indigo-900"
                        >Edit</Link
                      >
                      /
                      <!-- TODO: Add alert prompt before delet -->

                      <Link
                        :href="`/readings/${reading.id}`"
                        method="delete"
                        as="button"
                        type="button"
                        class="text-red-600 hover:text-red-900"
                        >Delete</Link
                      >
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
import useHelper from "../../composables/helper";

const props = defineProps({
  readings: Object,
});

const printable = ref(null);
const sort = ref("");

const { unitsConsumed, chargeAmount, filterByApartment } = useHelper();

const printComponent = () => {
  window.print(printable.value);
};

const sortValue = async () => {
  await filterByApartment(sort.value);
};
</script>
    
<style scoped>
@media print {
  body * {
    visibility: hidden;
  }

  .links {
    visibility: hidden;
  }
  .print-container,
  .print-container * {
    visibility: visible;
  }
  .print-container {
    position: absolute;
    left: 0px;
    top: 0px;
  }
}
</style>