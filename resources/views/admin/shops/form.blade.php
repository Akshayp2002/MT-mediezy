@extends('layouts.app')

@section('admin-content')
    <div class="container mx-auto p-8 flex">
        <div class="max-w-md w-full mx-auto">
            <h1 class="text-4xl text-center mb-12 font-thin">
                {{ isset($shop) ? 'Edit Category' : 'Create Category' }}
            </h1>
            <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                <div class="p-8">
                    <form id="shopForm">
                        <div class="mb-5">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-600">Shop Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $shop->name ?? '') }}"
                                required
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>
                        <div class="mb-5">
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-600">Shop Address</label>
                            <input type="text" name="address" id="address"
                                value="{{ old('name', $shop->address ?? '') }}" required
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Shop Email</label>
                            <input type="text" name="email" id="email"
                                value="{{ old('email', $shop->owner->email ?? '') }}"
                                @if (isset($shop)) readonly @endif
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none 
                                    {{ isset($shop) ? 'text-gray-500 cursor-not-allowed' : '' }}">
                        </div>

                        <button class="w-full p-3 mt-4 bg-indigo-600 text-white rounded shadow">
                            {{ isset($shop) ? 'Update Shop' : 'Create Shop' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#shopForm').on('submit', function(e) {
            e.preventDefault();

            const isEdit = {{ isset($shop) ? 'true' : 'false' }};
            const shopId = {{ $shop->id ?? 'null' }};
            const url = isEdit ? `/shops/${shopId}` : `{{ route('shops.store') }}`;

            const data = {
                _token: '{{ csrf_token() }}',
                name: $('#name').val(),
                email: $('#email').val(),
                address: $('#address').val()
            };

            if (isEdit) {
                data._method = 'PUT';
            }

            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                success: function(response) {
                    if (response.error) {
                        Swal.fire('Error', response.error, 'error');
                    } else {
                        Swal.fire('Success', response.message, 'success');
                        if (!isEdit) {
                            $('#shopForm')[0].reset();
                        }
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        const errorMessage = Object.values(errors).flat().join('\n');
                        Swal.fire('Validation Error', errorMessage, 'error');
                    } else if (xhr.status === 409) {
                        Swal.fire('Error', xhr.responseJSON.error, 'error');
                    } else if (xhr.status === 403) {
                        Swal.fire('Forbidden', 'You are not authorized.', 'error');
                    } else {
                        Swal.fire('Error', 'An unexpected error occurred.', 'error');
                    }
                }
            });
        });
    </script>
@endsection
