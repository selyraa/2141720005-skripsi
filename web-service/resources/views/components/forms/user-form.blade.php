@props([
    'action', 
    'defaultRole' => null,
    'hideRoleSelection' => false,
    'buttonText' => 'Simpan'
])

<form action="{{ $action }}" method="POST" class="space-y-5">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="form-group">
            <label for="name" class="form-label block mb-2 font-medium text-dark dark:text-white">Nama</label>
            <input type="text" class="form-control w-full" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        
        <div class="form-group">
            <label for="email" class="form-label block mb-2 font-medium text-dark dark:text-white">Email</label>
            <input type="email" class="form-control w-full" id="email" name="email" value="{{ old('email') }}" required>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="form-group">
            <label for="password" class="form-label block mb-2 font-medium text-dark dark:text-white">Password</label>
            <input type="password" class="form-control w-full" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label for="password_confirmation" class="form-label block mb-2 font-medium text-dark dark:text-white">Konfirmasi Password</label>
            <input type="password" class="form-control w-full" id="password_confirmation" name="password_confirmation" required>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @if (!$hideRoleSelection)
        <div class="form-group">
            <label for="role_id" class="form-label block mb-2 font-medium text-dark dark:text-white">Role</label>
            <select class="form-select w-full" id="role_id" name="role_id" required>
                <option value="">Pilih Role</option>
                @foreach(\App\Models\Role::orderBy('name')->get() as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $defaultRole) == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @else
            <input type="hidden" name="role_id" value="{{ $defaultRole }}">
        @endif
        
        <div class="form-group">
            <label for="phone_number" class="form-label block mb-2 font-medium text-dark dark:text-white">Nomor Telepon</label>
            <input type="text" class="form-control w-full" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="form-group">
            <label for="gender" class="form-label block mb-2 font-medium text-dark dark:text-white">Jenis Kelamin</label>
            <select class="form-select w-full" id="gender" name="gender">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="birth_date" class="form-label block mb-2 font-medium text-dark dark:text-white">Tanggal Lahir</label>
            <input type="date" class="form-control w-full" id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
        </div>
    </div>

    <div class="flex justify-end mt-6">
        {{ $slot }}
        <button type="submit" class="btn btn-primary">
            <i class="ti ti-user-plus me-1"></i>{{ $buttonText }}
        </button>
    </div>
</form>