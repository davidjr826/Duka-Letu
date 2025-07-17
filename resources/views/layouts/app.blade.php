<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Font Awesome CDN -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <title>Duka Letu Dashboard</title>
  @vite('resources/css/app.css')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 text-gray-800">
<div x-data="{ collapsed: false }">
  <!-- Sidebar -->
  <aside 
    :class="collapsed ? 'w-20 items-center text-center' : 'w-64 items-start text-left'" 
    class="fixed top-1.5 bottom-3 left-2 flex flex-col bg-white border-2 border-gray-400 shadow-lg transition-all duration-300 ease-in-out z-40 rounded-3xl overflow-hidden"
  >

    <!-- Fixed Brand Section -->
    <div 
      class="sticky top-0 z-30 bg-white w-full py-6"
      :class="collapsed ? 'flex justify-center items-center' : 'flex justify-between items-center px-4'"
    >
      <span x-show="!collapsed" class="text-xl font-bold">DUKA LETU</span>
      <button @click="collapsed = !collapsed" :class="collapsed ? 'p-2' : ''">
        <i class="fa-solid fa-bars text-xl text-gray-700 cursor-pointer"></i>
      </button>
    </div>

    <!-- Scrollable Sidebar Content -->
    <div class="flex-1 overflow-y-auto space-y-4">
        <!-- Profile Accordion -->
        <div x-data="{ open: false }" class="w-full px-2">
          <button
              @click="open = !open"
              class="w-full flex items-center gap-x-4.5 p-2 hover:bg-gray-100 rounded transition"
              :class="collapsed ? 'flex-col space-y-2 justify-center' : 'justify-between'"
          >
              <!-- Image + Name wrapper -->
              <div class="flex items-center">
                  <img src="/images/login.jpg" class="rounded-full w-10 h-10 object-cover" alt="User" />

                  <div x-show="!collapsed" class="ml-3.5">
                      <span class="text-md font-medium text-gray-800">
                          {{ $user->first_name }} {{ $user->last_name }}
                      </span>
                  </div>
              </div>

              <!-- Arrow icon -->
              <svg
                  x-show="!collapsed"
                  :class="open ? 'rotate-180' : ''"
                  class="w-4 h-4 text-gray-500 transition-transform"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  viewBox="0 0 24 24"
              >
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg>
          </button>


            <!-- Profile Sub-links -->
            <div x-show="open" class="border-t mt-1 space-y-1 w-full">
            <a href="#profile" class="flex items-center px-4 py-2 text-sm hover:bg-gray-50 w-full">
                <div class="w-6 h-6 rounded-full bg-gray-200 text-gray-800 font-semibold flex items-center justify-center text-xs">P</div>
                <span x-show="!collapsed" class="ml-3">My Profile</span>
            </a>
            <a href="#settings" class="flex items-center px-4 py-2 text-sm hover:bg-gray-50 w-full">
                <div class="w-6 h-6 rounded-full bg-gray-200 text-gray-800 font-semibold flex items-center justify-center text-xs">S</div>
                <span x-show="!collapsed" class="ml-3">Settings</span>
            </a>
            <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center px-4 py-2 text-sm hover:bg-gray-50 w-full">
                <div class="w-6 h-6 rounded-full bg-gray-200 text-gray-800 font-semibold flex items-center justify-center text-xs">L</div>
                <span x-show="!collapsed" class="ml-3">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </div>
        </div>

        <div class="border-t mx-2 w-11/12"></div>

        <!-- Scrollable Navigation Section -->
        <div class="flex-1 overflow-y-auto w-full pt-4 space-y-2">
            <nav class="flex flex-col w-full px-2">

                <a href="{{ route('dashboard') }}" class="flex items-center hover:bg-gray-100 p-3 rounded transition w-full" :class="collapsed ? 'justify-center' : 'gap-3'">
                    <span>
                      <img src='/images/dashboard.png' alt='dashboard' class='w-7 h-7' />
                    </span>
                    <span x-show="!collapsed">Dashboard</span>
                </a>

                <a href="{{ route('products') }}" class="flex items-center hover:bg-gray-100 p-3 rounded transition w-full" :class="collapsed ? 'justify-center' : 'gap-3'">
                    <span>
                      <img src='/images/products.png' alt='products' class='w-7 h-7' />
                    </span>
                    <span x-show="!collapsed">Products</span>
                </a>

                <a href="{{ route('sales') }}" class="flex items-center hover:bg-gray-100 p-3 rounded transition w-full" :class="collapsed ? 'justify-center' : 'gap-3'">
                    <span>
                      <img src='/images/sales.png' alt='sales' class='w-7 h-7' />
                    </span>
                    <span x-show="!collapsed">Sales</span>
                </a>

                <a href="{{ route('inventory') }}" class="flex items-center hover:bg-gray-100 p-3 rounded transition w-full" :class="collapsed ? 'justify-center' : 'gap-3'">
                    <!-- <i class="fa-solid fa-cart-flatbed text-2xl text-gray-700"></i> -->
                    <span>
                        <img src='/images/inventory.png' alt='inventory' class='w-8 h-8' />
                    </span>
                    <span x-show="!collapsed">Inventory</span>
                </a>

                <!-- Reports Accordion -->
                <div x-data="{ open: false }" class="w-full">
                    <button
                        @click="open = !open"
                        class="w-full flex items-center hover:bg-gray-100 p-3 rounded transition cursor-pointer"
                        :class="collapsed ? 'justify-center flex-col space-y-1' : 'gap-3'"
                    >
                        <!-- <i class="fa-solid fa-laptop-file text-2xl text-gray-700"></i> -->
                        <span>
                            <img src='/images/report.png' alt='report' class='w-7 h-7' />
                        </span>
                        <div x-show="!collapsed" class="flex items-center justify-between w-full">
                        <span>Reports</span>
                        <svg :class="open ? 'rotate-180' : ''" class="ml-auto w-4 h-4 text-gray-500 transition-transform"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                        </div>
                    </button>
                    <div x-show="open" class="mt-1 space-y-1 w-full">
                        <a href="{{ route('sales_report') }}" class="flex items-center px-4 py-2 hover:bg-gray-50 w-full pt-3">
                          <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-xs">S</div>
                          <span x-show="!collapsed" class="ml-3 text-sm">Sales Report</span>
                        </a>
                        <a href="{{ route('inventory_report') }}" class="flex items-center px-4 py-2 hover:bg-gray-50 w-full">
                          <div class="w-6 h-6 rounded-full bg-green-100 text-green-700 font-bold flex items-center justify-center text-xs">I</div>
                          <span x-show="!collapsed" class="ml-3 text-sm">Inventory Report</span>
                        </a>
                    </div>
                </div>

        <!-- Loans Accordion (Same logic as above) -->
        <div x-data="{ open: false }" class="w-full">
            <button
            @click="open = !open"
            class="w-full flex items-center hover:bg-gray-100 p-3 rounded transition cursor-pointer"
            :class="collapsed ? 'justify-center flex-col space-y-1' : 'gap-3'">
                <!-- <i class="fa-solid fa-comments-dollar text-2xl text-gray-700"></i> -->
                <span>
                    <img src='/images/loans.png' alt='loans' class='w-7 h-7' />
                </span>
                <div x-show="!collapsed" class="flex items-center justify-between w-full">
                    <span>Loans</span>
                    <svg :class="open ? 'rotate-180' : ''" class="ml-auto w-4 h-4 text-gray-500 transition-transform"
                   fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
          </button>
          <div x-show="open" class="mt-1 space-y-1 w-full">
            <a href="{{ route('student_loan') }}" class="flex items-center px-4 py-2 hover:bg-gray-50 w-full pt-3">
              <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-xs">U</div>
              <span x-show="!collapsed" class="ml-3 text-sm">Student Loan</span>
            </a>
            <a href="{{ route('staff_loan') }}" class="flex items-center px-4 py-2 hover:bg-gray-50 w-full">
              <div class="w-6 h-6 rounded-full bg-green-100 text-green-700 font-bold flex items-center justify-center text-xs">A</div>
              <span x-show="!collapsed" class="ml-3 text-sm">Staff Loan</span>
            </a>
          </div>
        </div>
        </nav>
    </div>
  </aside>

  <!-- Main Content -->
  <div :class="collapsed ? 'ml-20' : 'ml-64'" class="flex-1 flex flex-col transition-all duration-300">
    <!-- Topbar -->
    <header x-data="{ scrolled: false }"
            x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
            :class="[
                collapsed 
                  ? (scrolled ? 'ml-[1.625rem] mr-[1.625rem] w-[calc(100%-2.5rem-1.625rem*2)]' : 'w-[calc(100%-5rem)]')
                  : (scrolled ? 'ml-[1.625rem] mr-[1.625rem] w-[calc(100%-16rem-1.625rem*2)]' : 'w-[calc(100%-16rem)]'),
                scrolled 
                  ? 'bg-white/20 backdrop-blur-md shadow-md rounded-lg' 
                  : 'bg-white'
            ]"
            class="fixed top-0 z-30 px-6 py-5 flex justify-between items-center transition-all duration-300"
    >
      <!-- Topbar Section -->
      <div class="flex items-center space-x-3">
        <h1 class="text-xl font-bold text-gray-800">@yield('page_title')</h1>
      </div>

      <div class="flex items-center space-x-6">
        <input type="text" placeholder="Search here" class="border rounded-md focus:outline-none px-3 py-2 w-64" />
        <div class="flex items-center gap-4 text-lg">
          <i class="fa-solid fa-user text-gray-600 cursor-pointer"></i>
          <i class="fa-solid fa-gear text-gray-600 cursor-pointer"></i>
          <i class="fa-solid fa-bell text-gray-600 cursor-pointer"></i>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <main class="px-6 pt-24 pb-12 space-y-6 bg-gray-50">
      @yield('content')
    </main>
  </div>
</div>
</body>
</html>
