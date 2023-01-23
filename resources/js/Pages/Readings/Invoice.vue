<template>
  <Head title="Readings |" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Readings Show
      </h2>
    </template>

    <div class="py-12">
      <div class="flex items-center justify-center min-h-screen bg-gray-100 print-container" ref="receipt">
            <div class="bg-white shadow-lg">
                <div class="flex justify-between p-4">
                    <div>
                        <h1 class="text-3xl italic font-extrabold tracking-widest text-indigo-500">{{ apartment.name }}</h1>
                    </div>
                </div>
                <div class="w-full h-0.5 bg-indigo-500"></div>
                <div class="flex justify-between p-4">
                    <div>
                        <h6 class="font-bold">Bill Date : <span class="text-sm font-medium">  {{ formatDate(bill.bill_date) }}</span></h6>
                        <h6 class="font-bold">Issue Date : <span class="text-sm font-medium"> {{ formatDate(bill.issue_date) }}</span></h6>
                        <h6 class="font-bold">Due Date : <span class="text-sm font-medium"> {{ formatDate(bill.due_date) }}</span></h6>
                    </div>
                    <div class="w-40">
                    </div>
                    <div class="w-40">
                        <address class="text-sm">
                            <span class="font-bold"> Billed To : </span>
                            Unit {{ unit.unit_no }}
                        </address>

                    </div>
                    <div></div>
                </div>
                <div class="flex p-4">
                    <div class="border-b border-gray-200 shadow">
                        <table class="">
                            <thead class="justify-content-center bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Meter No
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Previous Reading
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Current Reading
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Units Consumed
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Rate
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ unit.meter_no }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            {{ reading.previous }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">
                                            {{ reading.current }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ unitsConsumed(reading.previous, reading.current) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                       {{bill.rate}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ chargeAmount(reading.current, reading.previous, bill.rate) }}
                                    </td>
                                </tr>
                                <tr class="text-white bg-gray-800">
                                    <th colspan="4"></th>
                                    <td class="text-sm font-bold"><b>Total</b></td>
                                    <td class="text-sm font-bold"><b>{{ chargeAmount(reading.current, reading.previous, bill.rate) }}</b></td>
                                </tr>
                                <!--end tr-->

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-between p-4">
                    <div>
                        <h3 class="text-xl">Terms And Condition :</h3>
                        <ul class="text-xs list-disc list-inside">
                            <li>To be paid within the indicated due date from receipt of invoice.</li>
                            <li>To be paid through the agent's details.</li>
                        </ul>
                    </div>
                </div>
                <div class="w-full h-0.5 bg-indigo-500"></div>

                <div class="p-4">
                    <div class="flex items-center justify-center">
                        Have a happy stay.
                    </div>
                    <div class="flex items-end justify-end space-x-3">
                        <button class="px-4 py-2 text-sm text-green-600 bg-green-100" @click="printComponent()">Print</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
  
  <script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { onMounted, ref } from "vue";
import useHelper from "../../composables/helper";

const { unitsConsumed, chargeAmount, formatDate } = useHelper();

const receipt= ref(null)

onMounted(()=>{

  console.log(receipt.value)
})
const props = defineProps({
  reading: Object,
  unit: Object,
  bill: Object,
  apartment: Object,
});

const storeAgreement = () => {
  processing.value = true;
  form.post("/agreements");
};

const printComponent = ()=>{
  window.print(receipt.value)
}
</script>
  
<style scoped>

@media print{
  body *{
    visibility: hidden;
  }
  .print-container, .print-container *{
    visibility: visible;
  }
  .print-container{
    position: absolute;
    left: 0px;
    top: 0px;
  }
}
</style>