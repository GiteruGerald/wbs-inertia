<template>
  <Head title="Bills Details" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Bills Details Edit
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex m-2 p-2">
          <Link
            :href="route('bills.index')"
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
              <form @submit.prevent="updateBill">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                  <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                    <div>
                      <label
                        for="month"
                        class="block text-sm font-medium text-gray-700"
                        >Month</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <select
                            class="
                              block
                              w-2
                              flex-1
                              rounded-none rounded-r-md
                              border-gray-300
                              focus:border-indigo-500 focus:ring-indigo-500
                              sm:text-sm
                            "
                            v-model="form.month"
                          >
                            <option hidden>Select Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                          </select>
                        <!-- Display error msg -->
                        <div
                          v-if="errors.month"
                          v-text="errors.month"
                          class="text-red-800 text-sm mt-2"
                        ></div>
                      </div>
                    </div>
                    <!-- Apartment  -->
                    <div>
                      <label
                        for="location"
                        class="block text-sm font-medium text-gray-700"
                        >Apartment</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <select
                          class="
                            block
                            w-0.25
                            flex-1
                            rounded-none rounded-r-md
                            border-gray-300
                            focus:border-indigo-500 focus:ring-indigo-500
                            sm:text-sm
                          "
                          v-model="form.apartment_id"
                        >
                          <option
                            v-for="apartment in apartments.data"
                            :value="apartment.id"
                            :key="apartment.id"
                          >
                            {{ apartment.name }}
                          </option>
                        </select>
                        <!-- Display error msg -->
                        <div
                          v-if="errors.apartment_id"
                          v-text="errors.apartment_id"
                          class="text-red-800 text-sm mt-2"
                        ></div>
                      </div>
                    </div>
                    <!-- Type -->
                    <div>
                      <div class="flex space-x-2 items-center mt-3">
                        <div class="flex-auto">
                          <label
                            for="bill"
                            class="block text-sm font-medium text-gray-700"
                            >Bill Date</label
                          >
                          <input
                            v-model="form.bill_date"
                            type="date"
                            class="
                              w-full
                              focus:ring-yellow-500 focus:border-yellow-500
                              block
                              w-full
                              sm:text-sm
                              border-gray-300
                            "
                            placeholder="Bill Date"
                          />
                          <div
                          v-if="errors.bill_date"
                          v-text="errors.bill_date"
                          class="text-red-800 text-sm mt-2"
                        ></div>
                        </div>
                        <div class="flex-auto">
                          <label
                            for="issue"
                            class="block text-sm font-medium text-gray-700"
                            >Issue Date</label
                          >
                          <input
                            v-model="form.issue_date"
                            type="date"
                            class="
                              w-full
                              focus:ring-yellow-500 focus:border-yellow-500
                              block
                              w-full
                              sm:text-sm
                              border-gray-300
                            "
                            placeholder="Issue Date"
                          />
                          <div
                          v-if="errors.issue_date"
                          v-text="errors.issue_date"
                          class="text-red-800 text-sm mt-2"
                        ></div>
                        </div>
                        <div class="flex-auto">
                          <label
                            for="due date"
                            class="block text-sm font-medium text-gray-700"
                            >Due Date</label
                          >
                          <input
                            v-model="form.due_date"
                            type="date"
                            class="
                              w-full
                              focus:ring-yellow-500 focus:border-yellow-500
                              block
                              w-full
                              sm:text-sm
                              border-gray-300
                            "
                            placeholder="Due Date"
                          />
                          <div
                          v-if="errors.due_date"
                          v-text="errors.due_date"
                          class="text-red-800 text-sm mt-2"
                        ></div>
                        </div>
                      </div>
                    </div>
                    <!-- Rate -->
                    <div>
                      <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Rate</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          v-model="form.rate"
                          type="number"
                          id="rate"
                          class="
                            block
                            w-full
                            flex-1
                            rounded-none rounded-r-md
                            border-gray-300
                            focus:border-indigo-500 focus:ring-indigo-500
                            sm:text-sm
                          "
                          placeholder="Rate/Unit"
                        />
                        <!-- Display error msg -->
                        <div
                          v-if="errors.rate"
                          v-text="errors.rate"
                          class="text-red-800 text-sm mt-2"
                        ></div>
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
                      :disabled="processing"
                    >
                      Save
                    </button>
                  </div>
                </div>
              </form>
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
import { ref } from "@vue/reactivity";

let processing = ref(false);

const props = defineProps({
  bill: Object,
  apartments: Object,
  errors: Object,
});

const form = useForm({
  apartment_id: props.bill.apartment_id,
  month: props.bill.month,
  bill_date: props.bill.bill_date,
  issue_date: props.bill.issue_date,
  due_date: props.bill.due_date,
  rate: props.bill.rate,
});

const updateBill = () => {
  Inertia.post(`/bills/${props.bill.id}`, {
    _method: "put",

    apartment_id: form.apartment_id,
    month: form.month,
    bill_date: form.bill_date,
    issue_date: form.issue_date,
    due_date: form.due_date,
    rate: form.rate,
  });
};
</script>
  