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
              :href="route('readings.index')"
              class="text-indigo-600 hover:text-indigo-900"
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
                  d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5"
                />
              </svg>
              Back
            </Link>
          </div>
          <div></div>
          <div>
              <div>
                <Link
                  :href="route('readings.edit', reading.id)"
                  class="text-yellow-600 hover:text-yellow-900 border-solid hover:border-dotted"
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
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                    />
                  </svg>

                  Edit
                </Link>
            </div>
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
                    {{ bill.month }}
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
                    {{ bill.rate }}
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
                        bill.rate
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
    width:100%;
    top: 0px;
  }
}
</style>