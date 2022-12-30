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
                  <div>
                    <div class="px-4 py-5 sm:px-6">
                      <p
                        class="mt-1 max-w-2xl text-sm text-gray-500"
                      >
                        Tenant details.
                      </p>
                    </div>
                  </div>
  
                  <!-- Agreement Details -->
                  <div>
                    <div class="px-4 py-5 sm:px-6">
                      <p
                        class="mt-1 max-w-2xl text-sm text-gray-500"
                      >
                        Reading details.
                      </p>
                    </div>
                    <div class="border-t border-gray-200">
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
                            Agreement details not found
                          </dt>
  
                       
                        </div>
                      </dl>
                    </div>
  
                    <div class="border-t border-gray-200">
                      <dl>
                        <div
                          class="
                            bg-white
                            px-4
                            py-5
                            sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                          "
                        >
                          <dt class="text-sm font-medium text-gray-500">Rent</dt>
                          <dd
                            class="
                              mt-1
                              text-sm text-gray-900
                              sm:col-span-2 sm:mt-0
                            "
                          >
                            <!-- {{ agreement.rent }} -->
                          </dd>
                          <dt class="text-sm font-medium text-gray-500">
                            Service Charge
                          </dt>
                          <dd
                            class="
                              mt-1
                              text-sm text-gray-900
                              sm:col-span-2 sm:mt-0
                            "
                          >
                            <!-- {{ agreement.service_charge }} -->
                          </dd>
                          <dt class="text-sm font-medium text-gray-500">
                            Repairs & Maintenance Charge
                          </dt>
                          
                          <dd
                            class="
                              mt-1
                              text- text-gray-900
                              sm:col-span-2 sm:mt-0
                            "
                          >
                            <!-- {{ agreement.repair_charge }} -->
                          </dd>
                          <dt class="text-md font-medium text-black-500">
                            Total Billings
                          </dt>
                          <dd
                            class="
                              mt-1
                              text-md text-black-900
                              sm:col-span-2 sm:mt-0
                            "
                          >
                            <!-- {{ agreement.rent + agreement.service_charge + agreement.repair_charge }} -->
                          </dd>
                        </div>
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
  
  const props = defineProps({
    unit: Object,
    apartment: Object,

  });
  

  const storeAgreement = () => {
    processing.value = true;
    form.post("/agreements");
  };
  </script>
  