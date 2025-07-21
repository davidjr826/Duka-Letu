@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'My Profile')
@section('page_title', 'Profile')

@section('content')
    <section class='flex flex-row justify-between items-start gap-x-6 w-full pt-4'>

        <!-- Basic information -->
        <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="w-[71.5%] rounded-md p-6 flex flex-col gap-y-5 bg-white">
            <form class="flex flex-col gap-y-5">

                <!-- save and cancel buttons -->
                <div class="flex flex-row justify-between items-center">
                    <div>
                        <span class="text-lg font-medium">Edit Profile</span>
                    </div>
                    <div class="flex flex-row justify-between items-cente gap-x-4">
                        <button class="text-md font-medium w-fit py-2 px-3 rounded-md bg-gray-100 text-gray-400">Cancel</button>
                        <button class="text-md font-medium w-fit py-2 px-3 rounded-md bg-black text-white">Save Changes</button>
                    </div>
                </div>

                <!-- Names -->
                <div class="flex flex-row justify-between items-center gap-x-4 pt-5">
                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="first_name" class="text-md text-gray-400">First Name</label>
                        <input type="text" name="first_name" placeholder="Enter First Name" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="middle_name" class="text-md text-gray-400">Middle Name</label>
                        <input type="text" name="middle_name" placeholder="Enter Middle Name" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="last_name" class="text-md text-gray-400">Last Name</label>
                        <input type="text" name="last_name" placeholder="Enter Last Name" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>
                </div>

                <!-- Username and Password -->
                <div class="flex flex-row justify-between items-center gap-x-4">
                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="username" class="text-md text-gray-400">Username</label>
                        <input type="text" name="username" placeholder="Enter Username" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="password" class="text-md text-gray-400">Password</label>
                        <input type="password" name="password" placeholder="***********" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="re-type_password" class="text-md text-gray-400">Re-Type Password</label>
                        <input type="password" name="re-type_password" placeholder="**********" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>
                </div>

                <!-- Contacts and Gender -->
                <div class="flex flex-row justify-between items-center gap-x-4">
                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="gender" class="text-md text-gray-400">Gender</label>
                        <select name="gender" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black">
                            <option disabled selected value="" class="text-sm text-gray-400">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="phone" class="text-md text-gray-400">Phone</label>
                        <input type="text" name="phone" placeholder="Enter Phone Number" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="email" class="text-md text-gray-400">Email</label>
                        <input type="email" name="email" placeholder="Enter Email" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>
                </div>

                <!-- Dates and Role -->
                <div class="flex flex-row justify-between items-center gap-x-4">
                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="birth_date" class="text-md text-gray-400">Birth Date</label>
                        <input type="date" name="birth_date" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="joining_date" class="text-md text-gray-400">Joining Date</label>
                        <input type="date" name="joining_date" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="role" class="text-md text-gray-400">Role</label>
                        <input type="text" name="role" placeholder="Admin" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" disabled />
                    </div>
                </div>

                <!-- about me  -->
                <div class="pt-5">
                    <h1 class="text-lg font-medium">About Me</h1>
                    <span class="text-xs font-medium pt-2">Tell About You</span>
                    <div class="w-full pt-2">
                        <textarea name="message" rows="6" cols="30" placeholder="Tell me about yourself....!!" class="border border-gray-400 rounded-md focus:outline-none w-full p-2"></textarea>
                    </div>
                </div>

            </form>
        </div>

        <!-- Fixed profile card -->
        <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);"
            class="fixed top-28 mt-1.5 right-6 w-1/5 pt-10 px-6 bg-white overflow-y-auto rounded-l-md z-50 mr-6">

            <div class="w-full flex justify-center items-center">
                <img src="/images/login.jpg" alt="my profile picture"
                    class="rounded-full w-32 h-32 object-cover ring-8 ring-gray-400" />
            </div>

            <div class="w-full flex flex-col justify-start items-center gap-y-1 pt-6">
                <span class="text-md font-medium">Agnella Aviator</span>
                <span class="text-sm bg-gray-400 px-2 py-0.5">Shop Admin</span>
            </div>

            <div class="border border-gray-300 w-full mt-4"></div>

            <!-- contacts -->
            <div class="flex flex-col justify-start items-start gap-y-4 mt-4">
                <div class="flex flex-row justify-between items-center gap-x-8">
                    <i class="fas fa-phone ring-1 ring-gray-400 p-2 rounded-full"></i>
                    <span class="text-sm">+255724569079</span>
                </div>
                <div class="flex flex-row justify-between items-center gap-x-8">
                    <i class="fas fa-envelope ring-1 ring-gray-400 p-2 rounded-full"></i>
                    <span class="text-sm">agnellaaviator@gmail.com</span>
                </div>
            </div>

            <!-- about me -->
            <div class="flex flex-col justify-start items-start gap-y-2 py-8">
                <span class="text-xl font-medium">About Me</span>
                <span class="text-sm text-justify">
                    Dedicated shop administrator with a passion for smooth store operations, inventory accuracy, and excellent customer service. Focused on keeping everything organized and running efficiently.
                </span>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@endsection