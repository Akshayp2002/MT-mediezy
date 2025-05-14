@extends('layouts.app')

@section('admin-content')
    <div class="container mx-auto p-8 flex">
        <div class="max-w-md w-full mx-auto">
            <h1 class="text-4xl text-center mb-12 font-thin">
                {{ isset($shop) ? 'Edit Shop' : 'Create Shop' }}
            </h1>
            <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                <div class="p-8">
                    <form id="shopForm">
                        @csrf
                        @if (isset($shop))
                            @method('PUT')
                        @endif
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
                                @if (isset($shop)) disabled @endif
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
    @push('scripts')
        <script>
            $('#shopForm').on('submit', function(e) {
                e.preventDefault();
                const form = document.getElementById('shopForm');
                const formData = new FormData(form);
                const isEdit = form.querySelector('input[name="_method"]')?.value === 'PUT';
                const actionUrl = isEdit ?
                    "{{ route('shops.update', $shop->id ?? 0) }}" :
                    "{{ route('shops.store') }}";

                $.ajax({
                    url: actionUrl,
                    method: isEdit ? 'POST' : 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire('Success', response.message, 'success').then(() => {
                            window.location.href = '/shops';
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            const firstKey = Object.keys(errors)[0];
                            Swal.fire('Validation Error', errors[firstKey][0], 'error');
                        } else {
                            Swal.fire('Error', 'An unexpected error occurred.', 'error');
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
