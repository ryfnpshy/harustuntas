<x-layouts.admin>

<form action="/admin/user/edit/{{ $user->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        @if (session('success'))
    <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-800">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-800">
        <ul class="list-disc ps-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="space-y-12 sm:space-y-16">
        <div>
            <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="username" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Username</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600 sm:max-w-md">
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="janesmith">
                        </div>
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Password</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600 sm:max-w-md">
                            <input type="password" name="password" id="password" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="********">
                        </div>
                    </div>
                </div>
                
                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
    <label for="is_admin" class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5">Is Admin</label>
    <div class="mt-2 sm:col-span-2 sm:mt-0">
        <div class="flex items-center gap-2 sm:max-w-md">
            <input type="hidden" name="is_admin" value="0" />
            <input type="checkbox" name="is_admin" id="is_admin" value="1"
                @checked($user->is_admin)
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
            <label for="is_admin" class="text-sm text-gray-700">Yes</label>
        </div>
    </div>
</div>


                <div class="sm:grid sm:grid-cols-3 sm:items-center sm:gap-4 sm:py-6">
    <label for="avatar" class="block text-sm/6 font-medium text-gray-900">Photo</label>
    <div class="mt-2 sm:col-span-2 sm:mt-0">
        <div class="flex items-center gap-x-3">
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="User Avatar" class="size-12 rounded-full object-cover">
            @else
                <svg class="size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                </svg>
            @endif
            <input type="file" name="avatar" id="avatar" class="block w-full text-sm text-gray-900 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-gray-100 file:text-sm file:font-semibold file:text-gray-700 hover:file:bg-gray-200" />
        </div>
    </div>
</div>


            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="/admin/user" class="text-sm font-semibold text-gray-900">Cancel</a>
        <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Save</button>
    </div>
</form>

</x-layouts.admin>
