<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
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
              <h3 class="text-2xl font-semibold">Total Apartmemts</h3>
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
              <h3 class="text-2xl font-semibold">Total Units</h3>
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
                row-span-2
                animate-fade-in-down
                order-3
                lg:order-1
                bg-white
                shadow-md
                p-4
              "
            >
              <h3 class="text-2xl font-semibold">Latest Reading</h3>
              <div>
                <h3 class="font-bold text-xl mb-3">
                  {{ latestReading.previous }}
                </h3>
                <div class="flex justify-between text-sm mb-1">
                  <div>Create Date:</div>
                  <div>{{ latestReading.created_at }}</div>
                </div>
              </div>
              <div
                v-if="!latestReading"
                class="text-gray-600 text-center py-16"
              >
                Your don't have readings yet
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
                <h3 class="text-2xl font-semibold">New Bills</h3>

                <Link
                  href="/bills"
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
                <a
                  href="#"
                  v-for="bill in latestBills"
                  :key="bill.id"
                  class="block p-2 hover:bg-gray-100/90"
                >
                  <div class="font-semibold">
                    {{ bill.month }}
                  </div>
                </a>
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
  latestReading: Object,
  latestBills: Object,
});
</script>