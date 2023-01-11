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
          <!-- TODO: Add Go to Edit Link -->

          <!-- TODO: Addd Delete Button -->
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
                    <dt class="text-sm font-medium text-gray-500">
                      No of Units
                    </dt>
                    <dd
                      class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                    >
                      {{ unitsCount }}
                    </dd>
                  </div>
                </div>
                <hr />
              </div>
              <div class="overflow-hidden mt-3 bg-white shadow sm:rounded">
                <form @submit.prevent="saveUnits()">
                  <fieldset class="ml-4">
                    <legend>
                      <div class="flex">
                        <span class="text-sm font-medium text-gray-700"
                          >Add Units</span
                        >
                        <button
                          @click="addUnit()"
                          class="
                            ml-3
                            bg-green-400
                            hover:bg-green-600
                            text-sm
                            rounded
                          "
                          type="button"
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
                              d="M12 4.5v15m7.5-7.5h-15"
                            />
                            Add
                          </svg>
                        </button>
                      </div>
                    </legend>
                    <div class="mt-1 mr-3">
                      <div
                        class="mb-2"
                        v-for="(unit, index) in form.units"
                        :key="index"
                      >
                        <div class="flex space-x-2 items-center mt-3">
                          <button
                            @click="removeUnit(index)"
                            class="text-red-300 hover:text-red-500"
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
                          </button>

                          <div class="flex-auto">
                            <input
                              v-model="unit.unit_no"
                              type="text"
                              class="
                                w-full
                                focus:ring-yellow-500 focus:border-yellow-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                              "
                              :aria-label="`Unit {index+1}`"
                              placeholder="Unit No"
                            />
                          </div>
                          <div class="flex-auto">
                            <input
                              v-model="unit.meter_no"
                              type="number"
                              class="
                                w-full
                                focus:ring-yellow-500 focus:border-yellow-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                              "
                              :aria-label="`Meter {index+1} No`"
                              placeholder="Meter No"
                            />
                          </div>
                        </div>
                        <p
                          class="ml-8 text-xs mt-2 text-red-600"
                          v-if="form.errors[`units.${index}.unit_no`]"
                        >
                          {{ form.errors[`units.${index}.unit_no`] }}
                        </p>
                        <p
                          class="ml-8 text-xs mt-2 text-red-600"
                          v-if="form.errors[`units.${index}.meter_no`]"
                        >
                          {{ form.errors[`units.${index}.meter_no`] }}
                        </p>
                      </div>
                    </div>
                  </fieldset>

                  <div class="flex justify-end" v-if="showSaveBtn">
                    <button
                      type="submit"
                      class="
                        h-10
                        mb-4
                        mr-4
                        flex-end
                        bg-yellow-500
                        sm:rounded
                        inline-flex
                        items-center
                        justify-center
                        px-4
                        border border-transparent
                        shadow-sm
                        text-sm
                        font-semibold
                      "
                    >
                      Save Units
                    </button>
                  </div>
                </form>
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
                            <div class="flex">
                              <Link
                                :href="route('units.show', unit.id)"
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
                              <button
                                class="text-red-600 ml-5"
                                @click="destroyUnit(unit.id)"
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
import { Inertia } from "@inertiajs/inertia";
// import route from "vendor/tightenco/ziggy/src/js";

const props = defineProps({
  apartment: Object,
  units: Object,
  unitsCount: Object,
  errors: Object,
});

const form = useForm({
  units: [],
});
let showSaveBtn = ref(false);

const addUnit = () => {
  form.units.push({
    unit_no: "",
    meter_no: null,
    apartment_id: props.apartment.id,
  });
  showSaveBtn.value = true;
};

const removeUnit = (index) => {
  form.units.splice(index, 1);

  // FIXME - click on first tab submits form
  //  while (index == 0) {
  //   showSaveBtn.value = true;
  // }
};

const saveUnits = () => {
  form.post("/units", {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  });
};

const destroyUnit = (id) => {
  if (confirm("Are you sure you want to delete this unit?")) {
    Inertia.delete(route("units.destroy", id));
  }
};
</script>
  