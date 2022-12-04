<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Avatar') }}
        </h2>


    </header>

    <img style="max-height: 250px" src="{{asset('storage/'.$user->image)}}" alt="{{$user->name}}">

    <form method="post" action="{{ route('avatar_update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        <div>
            <x-input-label for="avatar" :value="__('Change Image')" />
            <x-text-input id="avatar" name="image" type="file" class="mt-1 block w-full" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
