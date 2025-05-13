
@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded-md mb-4">
        {{ session('success') }}
    </div>
@endif