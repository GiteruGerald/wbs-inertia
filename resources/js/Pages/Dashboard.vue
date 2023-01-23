<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard - Water Bills Management System
      </h2>
    </template>
    <!-- TODO: Add a dashboard -->
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div
            class="
              grid grid-cols-1
              md:grid-cols-2
              lg:grid-cols-3
              gap-5
              text-gray-700
            "
          >
            <div
              class="
                bg-white
                shadow-md
                p-3
                text-center
                flex flex-col
                animate-fade-in-down
                order-1
                lg:order-2
              "
              style="animation-delay: 0.1s"
            >
              <h3 class="text-2xl font-semibold">Total Apartments</h3>
              
              <div class="flex">
                
                <div
                  class="
                    text-8xl
                    pb-4
                    font-semibold
                    flex-1 flex
                    items-center
                    justify-center
                  "
                >
                  {{ totalApartments }}
                </div>
              </div>
            </div>
            <div
              class="
                bg-white
                shadow-md
                p-3
                text-center
                flex flex-col
                order-2
                lg:order-4
                animate-fade-in-down
              "
              style="animation-delay: 0.2s"
            >
              <h3 class="text-2xl font-semibold">Total Units Recorded</h3>
              <div
                class="
                  text-8xl
                  pb-4
                  font-semibold
                  flex-1 flex
                  items-center
                  justify-center
                "
              >
                {{ totalUnits }}
              </div>
            </div>
            <div
              class="
                bg-white
                shadow-md
                p-3
                row-span-2
                order-4
                lg:order-3
                animate-fade-in-down
              "
              style="animation-delay: 0.3s"
            >
              <div class="flex justify-between items-center mb-3 px-2">
                <h3 class="text-2xl font-semibold">Latest Bills</h3>

                <Link
                  :href="route('bills.index')"
                  class="
                    px-4
                    py-2
                    bg-gray-200
                    hover:bg-gray-400
                    text-white
                    rounded
                  "
                  >View All</Link
                >
              </div>

              <div v-if="latestBills">
                <div class="flex justify-content:space-between">

                </div>
                  <div class="font-semibold block p-2 hover:bg-gray-100/90"  v-for="bill in latestBills"
                  :key="bill.id">
                    {{ bill.month }} | {{ bill.apartment.name }}
                    <Link :href="route('bills.show', bill.id)">
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
                          d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                        />
                      </svg>
                    </Link>
                  </div>
              </div>
              <div v-else class="text-gray-600 text-center py-16">
                Your don't have bills yet
              </div>
              
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
import { onMounted } from "@vue/runtime-core";

const props = defineProps({
  totalApartments: Number,
  totalUnits: Number,
  latestBills: Object,
});
</script>