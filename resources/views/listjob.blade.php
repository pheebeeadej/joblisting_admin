      @include('inc.head')
      <!-- Desktop sidebar -->
      @include('inc.aside')
      <!-- Mobile sidebar -->
      <!-- Backdrop -->
      <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
      ></div>
     
   
        <main class="h-full overflow-y-auto">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              List Of Jobs
            </h2>
            <!-- CTA -->
            <a
              class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
              href="addjob"
            >
              <div class="flex items-center">
                <svg
                  class="w-5 h-5 mr-2"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                  ></path>
                </svg>
                <span>Add Jobs To Allow User To Access Information</span>
              </div>
              <span>Add Jobs &RightArrow;</span>
            </a>
            <!-- Cards -->
         
            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Job Title</th>
                      <th class="px-4 py-3">Company Email</th>
                      <th class="px-4 py-3">Location</th>
                      <th class="px-4 py-3">Date</th>
                       <th class="px-4 py-3">Actions</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                  @if ($jobs)
                  @foreach ($jobs as $item)
                 
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-2 py-3">
                        <div class="flex items-left text-sm">
                          <div>
                            <p class="font-semibold">{{$item->jobname}}</p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{$item->company_email}}
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <span class="px-2 py-1 font-semibold leading-tight    dark:bg-green-700">
                        {{$item->location}}
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{$item->created_at}}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{-- <a href=""><span class="px-3 fas fa-eye" style="color:orange;"><i class=""></i></span></a>  --}}
                        <a href="editjob?k={{$item->id}}"><span class="px-3 fas fa-pen " style="color:green;"></span></a>
                       <a href="#" onclick="var conf = confirm('Are you sure want to permanently delete this post'); if(conf ==true){window.location ='deletejob?id={{$item->id}}'};"><span class="px-3 fas fa-trash-alt" style="color:red;"></span></a>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
              <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
              >
                <span class="flex items-center col-span-3">
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                      {{ $jobs->onEachSide(5)->links() }}
                    </ul>
                  </nav>
                </span>
              </div>
            </div>
            @include('inc.footer')