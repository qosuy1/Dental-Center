<x-admin.layout>


    <div class="main-content-wrap">

        <x-admin.page-heading title="الصفحة الرئيسية" />

        <div class="wg-box">
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Users -->
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold">Users</h2>
                    <p class="text-3xl mt-2">{{ $usersCount }}</p>
                </div>

                <!-- Roles -->
                <div class="bg-purple-100 border-l-4 border-purple-500 text-purple-700 p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold">Roles</h2>
                    <p class="text-3xl mt-2">{{ $rolesCount }}</p>
                </div>

                <!-- Blogs -->
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold">Blogs</h2>
                    <p class="text-3xl mt-2">{{ $blogsCount }}</p>
                </div>

                <!-- Doctors -->
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold">Doctors</h2>
                    <p class="text-3xl mt-2">{{ $doctorsCount }}</p>
                </div>

                <!-- Departments -->
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold">Departments</h2>
                    <p class="text-3xl mt-2">{{ $departmentsCount }}</p>
                </div>

                <!-- Special Cases -->
                <div class="bg-indigo-100 border-l-4 border-indigo-500 text-indigo-700 p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold">Special Cases</h2>
                    <p class="text-3xl mt-2">{{ $specialCasesCount }}</p>
                </div>

            </div>

        </div>
    </div>


</x-admin.layout>
