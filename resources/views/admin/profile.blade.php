@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'My Profile')
@section('page_title', 'Profile')

@section('content')
    <section class='flex flex-row justify-between items-start gap-x-6 w-full pt-4'>
    <section class='flex flex-row justify-between items-start gap-x-6 w-full pt-4'>

        <!-- Basic information -->
        <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="w-[71.5%] rounded-md p-6 flex flex-col gap-y-5 bg-white">
            <form class="flex flex-col gap-y-5" method="POST" action="{{ route('profile.update') }}">

                @csrf
                @method('PUT')

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
                        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"  placeholder="Enter First Name" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="middle_name" class="text-md text-gray-400">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}" placeholder="Enter Middle Name" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="last_name" class="text-md text-gray-400">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="Enter Last Name" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>
                </div>

                <!-- Username and Password -->
                <div class="flex flex-row justify-between items-center gap-x-4">
                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="username" value="{{ old('username', $user->username) }}" class="text-md text-gray-400">Username</label>
                        <input type="text" name="username" placeholder="Enter Username" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="password" class="text-md text-gray-400">Password</label>
                        <input type="password" name="password"  placeholder="Leave blank to keep current" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="re-type_password" class="text-md text-gray-400">Re-Type Password</label>
                        <input type="password" name="password_confirmation" placeholder="Please confirm password" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>
                </div>

                <!-- Contacts and Gender -->
                <div class="flex flex-row justify-between items-center gap-x-4">
                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="gender" class="text-md text-gray-400">Gender</label>
                        <select name="gender" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black">
                            <option disabled selected value="" class="text-sm text-gray-400">Select Gender</option>
                            {{-- <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option> --}}
                            <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>

                        </select>
                    </div>

                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="phone" class="text-md text-gray-400">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter Phone Number" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>
 
                    <div class="w-full flex flex-col justify-start items-start">
                        <label for="email" class="text-md text-gray-400">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"  placeholder="Enter Email" class="w-full py-2 border-b border-gray-300 focus:outline-none focus:border-black text-sm" />
                    </div>
                </div>

                <!-- about me  -->
                <div class="pt-5">
                    <h1 class="text-lg font-medium">About Me</h1>
                    <span class="text-xs font-medium pt-2">Tell About You</span>
                    <div class="w-full pt-2">
                        {{-- <textarea name="about_me" rows="6" cols="30" placeholder="Tell me about yourself....!!">{{ old('about', $user->about) }} class="border border-gray-400 rounded-md focus:outline-none w-full p-2"></textarea> --}}
                        <textarea name="message" rows="6" cols="30" placeholder="Tell me about yourself....!!" class="border border-gray-400 rounded-md focus:outline-none w-full p-2">{{ old('about', $user->about_me) }}</textarea>
                    </div>
                </div>

            </form>
        </div>

        <!-- Your existing profile card (completely unchanged) -->
        <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);"
            class="fixed top-28 mt-1.5 right-6 w-1/5 pt-10 px-6 bg-white overflow-y-auto rounded-l-md z-50 mr-6">

        <!-- Fixed profile card -->
        <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);"
            class="fixed top-28 mt-1.5 right-6 w-1/5 pt-10 px-6 bg-white overflow-y-auto rounded-l-md z-50 mr-6">

            <div class="w-full flex justify-center items-center">
    <form action="{{ route('profile.picture') }}" method="POST" enctype="multipart/form-data" class="relative">
        @csrf
        @method('PUT') <!-- Use PUT method for updates -->
        
        <!-- Display the current profile photo -->
        <img src="{{ auth()->user()->photo ? Storage::url(auth()->user()->photo) : $photo }}" 
             alt="Profile picture"
             class="rounded-full w-32 h-32 object-cover ring-8 ring-gray-400" />
        
        <!-- File input hidden by default -->
        <input type="file" name="photo" id="photo" class="hidden" onchange="this.form.submit()">
        
        <!-- Edit pen icon that triggers the file input -->
        <label for="photo" class="absolute bottom-0 right-0 bg-gray-400 rounded-full p-2 cursor-pointer hover:bg-gray-500 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
        </label>
    </form>
</div>

<!-- Display success/error messages -->
@if(session('success'))
    <div class="mt-4 text-center text-green-600">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mt-4 text-center text-red-600">
        {{ session('error') }}
    </div>
@endif


            <div class="w-full flex flex-col justify-start items-center gap-y-1 pt-6">
                <span class="text-md font-medium">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</span>
                <span class="text-sm bg-gray-400 px-2 py-0.5 rounded">{{ $user->role ?? 'Shop Admin' }}</span>
            </div>

            <!-- Divider -->
            <div class="border border-gray-300 w-full mt-4"></div>

            <!-- Contact information -->
            <div class="flex flex-col justify-start items-start gap-y-4 mt-4">
                <div class="flex flex-row justify-start items-center gap-x-4 w-full">
                    <i class="fas fa-phone ring-1 ring-gray-400 p-2 rounded-full text-gray-600"></i>
                    <span class="text-sm text-gray-700">{{ $user->phone ?? 'Not provided' }}</span>
                </div>
                <div class="flex flex-row justify-start items-center gap-x-4 w-full">
                    <i class="fas fa-envelope ring-1 ring-gray-400 p-2 rounded-full text-gray-600"></i>
                    <span class="text-sm text-gray-700">{{ $user->email }}</span>
                </div>
            </div>

            <!-- About me section -->
            <div class="flex flex-col justify-start items-start gap-y-2 py-8">
                <span class="text-xl font-medium text-gray-800">About Me</span>
                <span class="text-sm text-gray-600 text-justify">
                    {{ $user->about_me ?? 'Dedicated shop administrator focused on smooth operations and excellent customer service.' }}
                </span>
            </div>
        </div>

        <!-- NEW MODAL ADDED BELOW (everything above remains exactly the same) -->
        <div id="photoModal" class="fixed inset-0 z-50 hidden">
            <!-- Blurred overlay background -->
            <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
            
            <!-- Centered modal content -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md p-4">
                <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center p-4 border-b">
                        <h3 class="text-lg font-semibold">Change Profile Photo</h3>
                        <button onclick="document.getElementById('photoModal').classList.add('hidden')" 
                            class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="p-6">
                        <form id="uploadForm" action="/upload-photo" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex justify-center mb-4">
                                <img id="imagePreview" src="{{ $photo }}" 
                                    class="rounded-full w-32 h-32 object-cover border-4 border-gray-200">
                            </div>
                            <input type="file" id="photoInput" name="photo" accept="image/*" class="hidden" onchange="previewImage(this)">
                            <button type="button" onclick="document.getElementById('photoInput').click()" 
                                class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-2">
                                Select Photo
                            </button>
                            <button type="submit" 
                                class="w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
                                Upload Photo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Image preview function
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

@endsection