<template>
  <Head title="Apartments" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Apartment Show
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex m-2 p-2">
          <Link
            href="/apartments"
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
                      {{ apartment.name }}
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      Apartment details.
                    </p>
                  </div>
                  <div
                    class="
                      bg-gray-50
                      px-4
                      py-5
                      sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                    "
                  >
                    <dt class="text-sm font-medium text-gray-500">Location</dt>
                    <dd
                      class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                    >
                      {{ apartment.location }}
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
                    <dt class="text-sm font-medium text-gray-500">Units</dt>
                    <dd
                      class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                    >
                      {{ unitsCount }}
                    </dd>
                  </div>
                </div>
                <hr />
              </div>
              <!-- TODO -  Add Create button for -->
              <div class="overflow-hidden mt-3 bg-white shadow sm:rounded">
                <button
                  class="
                    m-4
                    p-4
                    bg-green-400
                    hover:bg-green-600
                    text-sm
                    rounded
                  "
                  type="button"
                >
                  Add Units
                </button>
              </div>

              <div class="overflow-hidden mt-3 bg-white shadow sm:rounded">
                <div>
                  <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                      Units
                    </h3>
                  </div>
                </div>
                <div v-if="!units" class="border-t border-gray-200">
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
                        Please add available units
                      </dt>
                    </div>
                  </dl>
                </div>
                <!-- FIXME - Check these v-if/v-else statements -->
                <div v-else class="border-t border-gray-200">
                    <dl>
                      <table class="min-w-full py-3 px-4 divide-y divide-gray-200">
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
                              Meter No
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
                          <tr v-for="unit in units" :key="unit.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                              {{ unit.unit_no }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              {{ unit.meter_no }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <Link
                              :href="route('units.show', unit.id )"
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

const props = defineProps({
  apartment: Object,
  units: Object,
  unitsCount: Object,
});

const storeAgreement = () => {
  processing.value = true;
  form.post("/agreements");
};
</script>
  