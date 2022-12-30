<template>
  <Head title="Units" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Unit Show
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex m-2 p-2">
          <Link
            href="/units"
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
              <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <!-- Apartment Details -->
                <div>
                  <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                      Unit: {{ unit.unit_no }}
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      Unit details.
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
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Type</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    {{ unit.type }}
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
                  <dt class="text-sm font-medium text-gray-500">Meter No</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    {{ unit.meter_no }}
                  </dd>
                </div>

                <!-- Reading Details -->
                <div>
                  <div class="px-4 py-5 sm:px-6">
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      Reading details.
                    </p>
                  </div>
                  <div  v-if="!readings" class="border-t border-gray-200">
                    <dl>
                      <div
                        class="
                          bg-white
                          px-4
                          py-5
                          sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                        "
                      >
                        <dt class="text-sm font-medium text-gray-500">
                          Water Reading details not found
                        </dt>
                      </div>
                    </dl>
                    </div>
                  <div v-else class="border-t border-gray-200">
                    <dl>
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
                          <tr v-for="reading in readings" :key="reading.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                              {{ reading.month }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              {{
                                unitsConsumed(reading.previous, reading.current)
                              }}
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
                            <td class="px-6 py-4 whitespace-nowrap">
                              <Link
                                :href="`/readings/${reading.id}`"
                                class="text-green-600 hover:text-indigo-900"
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
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </dl>
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
import { HomeIcon } from "@heroicons/vue/20/solid";
import { ref } from "vue";
import useHelper from "../../composables/helper";

const { unitsConsumed, chargeAmount } = useHelper();

const props = defineProps({
  unit: Object,
  readings: Object,
  apartment: Object,
});

const storeAgreement = () => {
  processing.value = true;
  form.post("/agreements");
};
</script>
  