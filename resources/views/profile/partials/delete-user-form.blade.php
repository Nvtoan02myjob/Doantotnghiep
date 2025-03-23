<section class="space-y-6">
    <header>
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Xóa tài khoản') }}
        </h3>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Sau khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu của tài khoản đó sẽ bị xóa vĩnh viễn. Trước khi xóa tài khoản, vui lòng tải xuống bất kỳ dữ liệu hoặc thông tin nào mà bạn muốn giữ lại.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn btn-danger button_profile"
    >{{ __('Xóa tài khoản') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h4 class="text-lg font-medium text-danger dark:text-gray-100 mt-4">
                {{ __('Bạn có chắc chắn muốn xóa tài khoản của mình không?') }}
            </h4>

            <p class="mt-1 text-sm text-danger dark:text-gray-400">
                {{ __('Sau khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu của tài khoản đó sẽ bị xóa vĩnh viễn. Vui lòng nhập mật khẩu của bạn để xác nhận bạn muốn xóa vĩnh viễn tài khoản của mình.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('mật khẩu') }}" class="sr-only label_profile" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 input_profile"
                    placeholder="{{ __('mật khẩu') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end mt-2">
                <x-secondary-button x-on:click="$dispatch('close')" class="btn button_profile">
                    {{ __('Hủy') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 btn btn-danger button_profile">
                    {{ __('Xóa tài khoản') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
