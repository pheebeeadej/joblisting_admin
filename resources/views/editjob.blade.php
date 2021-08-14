<!-- Desktop sidebar -->
@include('inc.head')
<!-- Desktop sidebar -->
@include('inc.aside')
<!-- Mobile sidebar -->
      <div class="flex flex-col flex-1">
        <main class="h-full pb-16 overflow-y-auto">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Edit Job Details.
            </h2>
            <!-- CTA -->
            <a
              class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
              href="listjob"
            >
              <div class="flex items-center">
                <svg
                  class="w-5 h-5 mr-2"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                 <span> &LeftArrow;</span>
                </svg>
                <span>Go Back</span>
              </div>
              <span></span>
            </a>

            <!-- General elements -->
          	@if (Session::get('fail'))
              <div class="alert alert-danger" style="color: red">{{Session::get('fail')}}</div>
            @endif
            @if (Session::get('success'))
              <div class="alert alert-info" style="color: blue">{{Session::get('success')}}</div>
            @endif
            <form enctype="multipart/form-data" method="POST" action="{{url('editjob')}}" onsubmit="document.getElementById('submit').disabled = true; document.getElementById('submit').innerHTML = 'Processing####'; ">
              @csrf
                <div
                  class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
                >
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Job Title</span>
                    <input type="text" name="jobname" value="{{$jobs->jobname}}" required
                      class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      placeholder="Job Role"
                    />
                    <small style="color: red;">@error('jobname') {{$message}} @enderror</small>
                  </label>
                  
                  <div class="" style="margin-top: 30px;">
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Company Email</span>
                    <input type="email" name="company_email" value="{{$jobs->company_email}}" required
                      class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      placeholder="mail@email.com"
                    />
                    <small style="color: red;">@error('company_email') {{$message}} @enderror</small>
                  </label>
                </div>

                <div class="" style="margin-top: 30px;">
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Location</span>
                    <input type="text" name="location" value="{{$jobs->location}}" required
                      class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      placeholder="Abuja,Nigeria"
                    />
                    <small style="color: red;">@error('location') {{$message}} @enderror</small>
                  </label>
                </div>
                <div class="" style="margin-top: 30px;">
                  <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Job Description</span>
                    <textarea name="job_description" required
                      class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                      rows="5"
                      placeholder="Enter some long form content about job."
                    >{{$jobs->job_description}}</textarea>
                    <small style="color: red;">@error('job_description') {{$message}} @enderror</small>
                  </label>
                </div>
                <button type="submit" id="submit"
                  class="px-5 py-3  font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-top: 30px;"
                > Update Info</button>
            </div>
            </form>
           
        @include('inc.footer')