<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">
                <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->full_name }}</h3>
                  <div class="bg-white shadow-md rounded my-6 p-5">
                        <form method="POST" action="{{ route('admin.profile.update')}}" enctype="multipart/form-data">
                          @csrf
                          @method('put')
                          <div class="flex flex-col space-y-2">
                            <label for="full_name" class="text-gray-700 select-none font-medium">Full Name</label>
                            <input id="full_name" type="text" name="full_name" value="{{ old('full_name', $employee->full_name) }}"
                              placeholder="Enter name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            />
                          </div>

                          <div class="flex flex-col space-y-2">
                            <label for="email" class="text-gray-700 select-none font-medium">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $employee->email) }}"
                              placeholder="Enter email" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            />
                          </div>

                          <div class="flex text-gray-500 mt-5">
                            <div class="bg-white rounded-lg">
                              <div x-data="imageData()">
                                <div x-show="previewUrl == '' && imgurl == ''">
                                  <p class="text-center uppercase text-bold">
                                    <label for="thumbnailprev" class="cursor-pointer">
                                      Upload a file
                                    </label>
                                    <input type="file" name="profile" id="thumbnailprev"
                                        class="hidden thumbnailprev" @change="updatePreview()">
                                  </p>
                                </div>

                                <div x-show="previewUrl !== ''" class="relative w-24 h-24">
                                  <img :src="previewUrl" alt="Profile Image" class="shadow-lg rounded-full max-w-full h-auto align-middle border-none h-full w-full object-cover">
                                  <div class="ml-5">
                                    <button type="button" class="" @click="clearPreview()">Change</button>
                                  </div>
                                </div>

                                <div x-show="imgurl !== '' && previewUrl === ''" class="relative w-24 h-24">
                                  <img :src="imgurl" alt="Profile Image" class="shadow-lg rounded-full max-w-full h-auto align-middle border-none h-full w-full object-cover">
                                  <div class="ml-5">
                                    <button type="button" class="" @click="clearPreview()">Change</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="text-center mt-16 mb-16">
                            <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">Update</button>
                          </div>
                        </form>
                  </div>
            </div>
        </main>
    </div>
</x-app-layout>

<script>
    function imageData() {
        var files = document.getElementById("thumbnailprev").files;
        var url = files.length === 0 ? '/images/' + {!! json_encode($employee->profile) !!} : '';

        return {
          previewUrl: "",
          imgurl: url,
          updatePreview() {
            var reader = new FileReader();
            reader.onload = e => {
              this.previewUrl = e.target.result;
            };
            reader.readAsDataURL(files[0]);
          },
          clearPreview() {
            document.getElementById("thumbnailprev").value = null;
            this.previewUrl = "";
            this.imgurl = "";
          }
        };
    }
</script>
