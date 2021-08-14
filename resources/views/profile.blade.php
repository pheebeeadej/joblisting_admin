<!-- Desktop sidebar -->
@include('inc.head')
<!-- Desktop sidebar -->
@include('inc.aside')
        <main class="h-full pb-16 overflow-y-auto">
          <!-- Remove everything INSIDE this div to a really blank page -->
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Profile
            </h2>


            <div
              class="container max-w-2xl px-4 py-3 mx-auto mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
             
            @if (Session::get('fail'))
            <div class="alert alert-danger" style="color: red">{{Session::get('fail')}}</div>
            @endif
            @if (Session::get('success'))
              <div class="alert alert-info" style="color: blue">{{Session::get('success')}}</div>
              <script>
                $(function(){
                  setTimeout(function(){
                    window.location = "logout";
                  }, 3000);
                });
              </script>
            @endif
            @csrf
               <div class="w-full">
                <form>
                  <h1
                  class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
                > {{ $wallets->email }} </h1>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">{{ $wallets->username }}</span>
              </label>
              <hr><br>
              <!-- You should use a button here, as the anchor is only used for the example  -->
              <a href="#" onclick="document.getElementById('changepass_form').style.display ='';" class="mt-5" style="color: crimson" >Change password </a>
              </form>
            </div>

            </div>
          </div>
         
          <div class="container px-6 mx-auto grid" style="display: none;" id="changepass_form">
           
            <div
              class="container max-w-2xl px-4 py-3 mx-auto mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
             
               <div class="w-full">
                <form action="{{url('change_pass')}}" method="POST" onsubmit="document.getElementById('sudmit').innerHTML ='Processing...';">
                  @csrf
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              > Change password </h1>

              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Old Password</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="***************" required="" type="password" name="old_password" id="old_password"
                />
                <small style="color: red;">@error('old_password') {{$message}} @enderror</small>
              </label>

              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">New Password</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="***************" required="" type="password" name="new_password" id="new_password"
                />
                <small style="color: red;">@error('new_password') {{$message}} @enderror</small>
              </label>

              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Confirm New Password</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="***************" required="" type="password" name="confirm_password" id="confirm_password"
                />
                <small style="color: red;">@error('confirm_password') {{$message}} @enderror</small>
              </label>

              <!-- You should use a button here, as the anchor is only used for the example  -->
              <button type="submit" id="sudmit"
                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                href="./login.html"
              >Update password</button>
              </form>
            </div>
            
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
