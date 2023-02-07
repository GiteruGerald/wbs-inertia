<template>
  <Head title="Bills" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-black-800 leading-tight">
        Bill Show
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between m-2 p-2">
          <div>
            <Link
              :href="route('bills.index')"
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
          <div></div>
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
        </div>
        <div class="flex print-container">
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
              <div
                class="overflow-hidden bg-white mt-5 shadow sm:rounded-lg border-2 border-black"
                v-for="(reading, index) in readings"
                :key="reading.id"
              >
                <div>
                  <div class="grid grid-cols-3 gap-3">
                    <div class="border-solid pl-2 py-3 sm:px-6">
                      <h3 class="text-lg font-medium leading-6 text-black-900">
                        Bill Month: <b>{{ bill.month }}</b>
                      </h3>
                      <p class="mt-1 max-w-2xl text-sm text-black-500">
                        <b>{{ apartment.name }} </b> | Unit:
                        <b>{{ reading.unit.unit_no }}</b>
                      </p>
                    </div>
                    <div></div>
                    <div>
                      <div class="px-4 sm:px-6">
                        <p class="mt-1 text-xs text-black-500">
                          Rate: <b>{{ bill.rate }}</b>
                        </p>
                        <p
                          class="
                            mt-1
                            font-weight:500
                            text-left
                            max-w-2xl
                            text-xs text-black-500
                          "
                        >
                          Bill Date : <b> {{ formatDate(bill.bill_date) }}</b>
                        </p>
                        <p
                          class="
                            mt-1
                            font-weight:500
                            text-left
                            max-w-2xl
                            text-xs text-black-500
                          "
                        >
                          Issue Date
                          <b> : {{ formatDate(bill.issue_date) }}</b>
                        </p>
                        <p
                          class="
                            mt-1
                            font-weight:500
                            text-left
                            max-w-2xl
                            text-xs text-black-500
                          "
                        >
                          Due Date : <b class="bg-red-100 rounded"> {{ formatDate(bill.due_date) }}</b>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="border-t px-5 border-black-200">
                  <dl>
                    <table
                      class="min-w-full py-3 px-4 divide-y divide-black-200"
                    >
                      <thead class="bg-black-50">
                        <tr>
                          <th
                            scope="col"
                            class="
                              px-6
                              py-3
                              text-left text-xs
                              font-bold
                              font-weight: 800
                              text-black-500
                              uppercase
                              tracking-wider
                            "
                          >
                            Meter No
                          </th>
                          <th
                            scope="col"
                            class="
                              px-6
                              py-3
                              text-left text-xs
                              font-bold
                              font-weight: 800
                              text-black-500
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
                              font-bold
                              font-weight: 800
                              text-black-500
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
                              font-bold
                              font-weight: 800
                              text-black-500
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
                              font-bold
                              font-weight: 800
                              text-black-500
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
                              font-bold
                              font-weight: 800
                              text-black-500
                              uppercase
                              tracking-wider
                            "
                          ></th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-x divide-black-200">
                        <tr>
                          <td class="px-6 py-4 font-bold font-weight:900 whitespace-nowrap">
                            {{ reading.unit.meter_no }}
                          </td>
                          <td class="px-6 py-4 font-bold font-weight:900 whitespace-nowrap">
                            {{ reading.previous }}
                          </td>
                          <td class="px-6 py-4 font-bold font-weight:900 whitespace-nowrap">
                            {{ reading.current }}
                          </td>
                          <td class="px-6 py-4 font-bold font-weight:900 whitespace-nowrap">
                            {{
                              unitsConsumed(reading.previous, reading.current)
                            }}
                          </td>
                          <td class="px-6 py-4 font-bold font-weight:900 whitespace-nowrap">
                            {{
                              chargeAmount(
                                reading.current,
                                reading.previous,
                                bill.rate
                              )
                            }}
                          </td>
                        </tr>
                        <div class="pagebreak"></div>
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
  readings: Object,
  errors: Object,
});
const printable = ref(null);
const printComponent = () => {
  window.print(printable.value);
};
const { unitsConsumed, chargeAmount, formatDate } = useHelper();
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