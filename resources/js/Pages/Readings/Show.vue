<template>
  <Head title="Readings |" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Readings Show
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between m-2 p-2">
          <div>
            <Link
              href="/readings"
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
          <!-- TODO: Addd Delete Button -->

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
              <div class="overflow-hidden bg-white shadow sm:rounded-lg" ref="receipt">
                <!-- Reading Details -->
                <div>
                  <div>
                    <div class="px-4 py-5 sm:px-6">
                      <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Unit: {{ unit.unit_no }} | {{ apartment.name }}
                      </h3>
                      <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Unit details.
                      </p>
                    </div>
                  </div>
                </div>
                <hr />
                <div
                  class="
                    bg-gray-50
                    px-4
                    py-5
                    sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                  "
                >
                  <dt class="text-sm font-medium text-gray-500">Meter No</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    {{ unit.meter_no }}
                  </dd>
                </div>
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Month</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    {{ reading.month }}
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
                  <dt class="text-sm font-medium text-gray-500">
                    Previous Reading
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    {{ reading.previous }}
                  </dd>
                </div>
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">
                    Current Reading
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    {{ reading.current }}
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
                  <dt class="text-sm font-medium text-gray-500">
                    Units Consumed
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    {{ unitsConsumed(reading.previous, reading.current) }}
                  </dd>
                </div>
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">
                    Rate Per Unit
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    {{ reading.rate }}
                  </dd>
                </div>
                <hr />
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-black-500">
                    Amount Charged
                  </dt>
                  <dd class="mt-1 text-sm text-black-900 sm:col-span-2 sm:mt-0">
                    {{
                      chargeAmount(
                        reading.current,
                        reading.previous,
                        reading.rate
                      )
                    }}
                  </dd>
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
import { Inertia } from "@inertiajs/inertia";
import { HomeIcon } from "@heroicons/vue/20/solid";
import { onMounted, ref } from "vue";
import useHelper from "../../composables/helper";

const { unitsConsumed, chargeAmount } = useHelper();

const receipt= ref(null)

onMounted(()=>{

  console.log(receipt.value)
})
const props = defineProps({
  reading: Object,
  unit: Object,
  apartment: Object,
});

const storeAgreement = () => {
  processing.value = true;
  form.post("/agreements");
};

const printComponent = ()=>{
  
  window.print(receipt.value)
  // Inertia.post("https://invoice-generator.com",{
  //   date:new Date
  // }) 
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
    width:100%;
    top: 0px;
  }
}
</style>