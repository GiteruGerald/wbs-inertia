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
        <div class="flex justify-between m-2 p-2">
          <div>
            <Link
              :href="route('bills.index')"
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
            <div class="grid grid-cols-2">
              <div>
                <Link
                  :href="route('bills.edit', bill.id)"
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
              <div>
                <button
                  class="text-red-600 ml-5 border-solid hover:border-dotted"
                  @click="destroyBill(bill.id)"
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
                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                    />
                  </svg>

                  Delete
                </button>
              </div>
            </div>
          </div>
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
                <hr />
                <!-- Reading Details -->
                <div v-if="!processed">
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
                                  placeholder="Previous"
                                  
                                />
                                <p
                                  class="ml-8 text-xs mt-2 text-red-600"
                                  v-if="
                                    form.errors[`units.${index}.current`]
                                  "
                                >
                                  {{
                                    form.errors[`units.${index}.current`]
                                  }}
                                </p>
                              </div>
                              <div class="flex-auto">
                                <input
                                  v-model="reading.present"
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
                                    form.errors[`units.${index}.present`]
                                  "
                                >
                                  {{ form.errors[`units.${index}.present`] }}
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
import { computed, onMounted, ref } from "vue";
import axios from "axios";
import useHelper from "../../composables/helper";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  bill: Object,
  apartment: Object,
  errors: Object,
});

const { unitsConsumed, chargeAmount } = useHelper();

let processed = ref();

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

const destroyBill = (id)=>{
  if(confirm("Are you sure you want to delete this bill?")){
    Inertia.delete(route('bills.destroy',id));
  }
}
onMounted(() => {
  if(props.bill.status === 1) {
    processed.value= true
  }else{

    getUnits();
  }
  // console.log(props.bill.status);
});
</script>
  