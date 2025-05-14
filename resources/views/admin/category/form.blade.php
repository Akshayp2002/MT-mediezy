@extends('layouts.app')

@section('admin-content')
    <div class="container mx-auto p-8 flex">
        <div class="max-w-md w-full mx-auto">
            <h1 class="text-4xl text-center mb-12 font-thin">
                {{ isset($category) ? 'Edit Category' : 'Create Category' }}
            </h1>

            <x-alert-messages />

            <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                <div class="p-8">
                    <form id="categoryForm">
                        <div class="mb-5">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-600">Category Name</label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $category->name ?? '') }}" required
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <button class="w-full p-3 mt-4 bg-indigo-600 text-white rounded shadow">
                            {{ isset($category) ? 'Update Category' : 'Create Category' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#categoryForm').on('submit', function(e) {
            e.preventDefault();

            const isEdit = {{ isset($category) ? 'true' : 'false' }};
            const categoryId = {{ $category->id ?? 'null' }};
            const url = isEdit ? `/category/${categoryId}` : `{{ route('category.store') }}`;

            // Prepare data
            let data = {
                _token: '{{ csrf_token() }}',
                name: $('#name').val()
            };

            if (isEdit) {
                data._method = 'PUT';
            }

            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                success: function(response) {
                    Swal.fire('Success', response.message, 'success').then(() => {
                        window.location.href = '/category';
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors   = xhr.responseJSON.errors;
                        const firstKey = Object.keys(errors)[0];
                        Swal.fire('Validation Error', errors[firstKey][0], 'error');
                    } else {
                        Swal.fire('Error', 'An unexpected error occurred.', 'error');
                    }
                }
            });
        });
    </script>
@endsection
