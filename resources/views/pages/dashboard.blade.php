<x-app-layout>
    <div class="py-12" x-data="{ openForm: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 lg:p-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">Jobs</h1>
                            <p class="mt-2 text-sm text-gray-700">A list of all your jobs.</p>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <x-secondary-button @click="openForm = !openForm">
                                Add Job
                            </x-secondary-button>
                        </div>
                    </div>
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-6">
                                                    Company Name</th>
                                                <th scope="col"
                                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                    Position</th>
                                                <th scope="col"
                                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                    Work Setting</th>
                                                <th scope="col"
                                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                    Job Type</th>
                                                <th scope="col"
                                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                    Pay Rate</th>
                                                <th scope="col"
                                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                    Pay Time</th>
                                                <th scope="col" class="relative py-3 pl-3 pr-4 sm:pr-6">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                    <a href="{{ route('shift') }}">WCAY</a>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    DSS</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    Onsite</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    Full-Time</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    $13</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    Bi-Weekly</td>
                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                    <a href="#"
                                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="openForm" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="openForm = false" x-show="openForm"
                    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                <div x-cloak x-show="openForm" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">Create Job</h1>

                        <button @click="openForm = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>

                    <p class="mt-2 text-sm text-gray-500 ">
                        Add your teammate to your team and start work to get things done
                    </p>

                    <form class="mt-8 space-y-8">
                        <div class="grid grid-cols-2 gap-x-4">
                            <div
                                class="relative rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">
                                <label for="company_name"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900">Company
                                    Name</label>
                                <input type="text" name="company_name" id="company_name"
                                    class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                    placeholder="Apple">
                            </div>

                            <div
                                class="relative rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">
                                <label for="position"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900">
                                    Position</label>
                                <input type="text" name="position" id="position"
                                    class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                    placeholder="Software Developer">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-x-4">
                            <div class="relative">
                                <label for="work_setting"
                                    class="absolute -top-1 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">
                                    Work Setting</label>
                                <select id="work_setting" name="work_setting"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    <option></option>
                                    <option>On-Site</option>
                                    <option>Remote</option>
                                    <option>Hybrid</option>
                                </select>
                            </div>

                            <div class="relative">
                                <label for="job_type"
                                    class="absolute -top-1 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">
                                    Job Type</label>
                                <select id="job_type" name="job_type"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    <option></option>
                                    <option>Part-Time</option>
                                    <option selected>Full-Time</option>
                                    <option>Contract</option>
                                    <option>Internship</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-x-4">
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <label for="pay_rate"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900">
                                    Pay Rate
                                </label>

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="text" name="price" id="price"
                                    class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="0.00" aria-describedby="price-currency" />
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-gray-500 sm:text-sm" id="price-currency">/ HR</span>
                                </div>
                            </div>

                            <div class="relative">
                                <label for="pay_time"
                                    class="absolute -top-1 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">
                                    Job Type</label>
                                <select id="pay_time" name="pay_time"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    <option>Bi-Weekly</option>
                                    <option selected>Monthly</option>
                                </select>
                            </div>
                        </div>


                        <div class="flex justify-end mt-6">
                            <x-primary-button>Add</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
