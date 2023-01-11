<template>
  <Head title="Units" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Units Index
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between m-2 p-2">
          <div>
            <input
              type="text"
              v-model="search"
              class="
                block
                w-full
                flex-1
                rounded-none rounded-r-md
                border-gray-300
                focus:border-indigo-500 focus:ring-indigo-500
                sm:text-sm
              "
              placeholder="Search Unit\Apartment Name"
            />
          </div>
          <div></div>
          <div>
            <Link
              href="/units/create"
              class="
                px-4
                py-2
                bg-indigo-500
                hover:bg-indigo-600
                text-white
                rounded
              "
              >Create Unit</Link
            >
          </div>
        </div>
        <div class="flex flex-col">
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
                      Unit NO
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
                      Apartment
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
                      Type
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
                  <tr v-for="unit in units.data" :key="unit.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ unit.unit_no }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ unit.apartment.name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ unit.type }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <Link
                        :href="`/units/${unit.id}`"
                        class="text-green-600 hover:text-indigo-900"
                        >Show</Link
                      >
                      /
                      <Link
                        :href="`/units/${unit.id}/edit`"
                        class="text-indigo-600 hover:text-indigo-900"
                        >Edit</Link
                      >
                      /
                      <!-- TODO: Add alert prompt before delete -->

                      <Link
                        :href="`/units/${unit.id}`"
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
import useHelper from "../../composables/helper";

import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  units: Object,
});
const sort = ref("");
const search = ref("");

watch(search, (value) => {
  Inertia.get(
    "/units",
    {
      search: value,
    },
    {
      preserveState: true,
      replace: true,
    }
  );
});
</script>
  