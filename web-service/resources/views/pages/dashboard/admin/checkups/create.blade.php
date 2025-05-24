@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-4 sm:mb-6">
        <div class="card-body py-4 sm:py-5 md:py-3">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="w-full sm:w-auto">
                    <h4 class="font-semibold text-lg sm:text-xl text-dark dark:text-white mb-2 sm:mb-3">
                        Tambah Data Checkup
                    </h4>
                    <ol class="flex flex-wrap sm:flex-nowrap items-center text-xs sm:text-sm" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                Home
                            </a>
                            <i class="ti ti-slash leading-tight font-medium mx-1 sm:mx-2"></i>
                        </li>
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('checkups.index') }}">
                                Data Checkup Pelanggan
                            </a>
                            <i class="ti ti-slash leading-tight font-medium mx-1 sm:mx-2"></i>
                        </li>
                        <li class="inline-flex items-center font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            Tambah Data Checkup
                        </li>
                    </ol>
                </div>
                <div class="w-full sm:w-auto mt-2 sm:mt-0">
                    <div class="flex justify-start sm:justify-end">
                        <a href="{{ route('checkups.index') }}" class="btn btn-xs sm:btn-sm md:btn-md btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4 sm:gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-3 sm:mb-4 text-base sm:text-lg">Form Tambah Data Checkup</h3>
                    
                    @if ($errors->any())
                        <div class="bg-lighterror dark:bg-darkerror text-error px-3 sm:px-4 py-2 sm:py-3 rounded relative mb-3 sm:mb-4" role="alert">
                            <ul class="list-disc pl-4 sm:pl-5 text-xs sm:text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-3 sm:px-4 py-2 sm:py-3" onclick="this.parentElement.style.display='none'">
                                <i class="ti ti-x text-xs sm:text-sm"></i>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('checkups.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4 sm:mb-6">
                            <label for="program_enrollment_id" class="block text-xs sm:text-sm font-medium mb-1 sm:mb-2 text-dark dark:text-white">
                                Program Enrollment <span class="text-error">*</span>
                            </label>
                            <select id="program_enrollment_id" name="program_enrollment_id" class="form-select w-full text-xs sm:text-sm @error('program_enrollment_id') border-error @enderror" required>
                                <option value="">-- Pilih Program Enrollment --</option>
                                @foreach($enrollments as $enrollment)
                                    <option value="{{ $enrollment->id }}" {{ old('program_enrollment_id') == $enrollment->id ? 'selected' : '' }}>
                                        {{ $enrollment->user->name }} ({{ $enrollment->dietProgram->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('program_enrollment_id')
                                <div class="text-error text-xs sm:text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4 sm:mb-6">
                            <label for="checkup_date" class="block text-xs sm:text-sm font-medium mb-1 sm:mb-2 text-dark dark:text-white">
                                Tanggal Checkup <span class="text-error">*</span>
                            </label>
                            <input type="date" id="checkup_date" name="checkup_date" 
                                   value="{{ old('checkup_date', date('Y-m-d')) }}" 
                                   class="form-control w-full text-xs sm:text-sm @error('checkup_date') border-error @enderror" required>
                            @error('checkup_date')
                                <div class="text-error text-xs sm:text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div class="mb-3 sm:mb-4">
                                <label for="height" class="block text-xs sm:text-sm font-medium mb-1 sm:mb-2 text-dark dark:text-white">
                                    Tinggi Badan (cm) <span class="text-error">*</span>
                                </label>
                                <input type="number" id="height" name="height" min="100" max="250" step="0.1"
                                       value="{{ old('height') }}" class="form-control w-full text-xs sm:text-sm @error('height') border-error @enderror" required>
                                @error('height')
                                    <div class="text-error text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 sm:mb-4">
                                <label for="weight" class="block text-xs sm:text-sm font-medium mb-1 sm:mb-2 text-dark dark:text-white">
                                    Berat Badan (kg) <span class="text-error">*</span>
                                </label>
                                <input type="number" id="weight" name="weight" min="30" max="200" step="0.1"
                                       value="{{ old('weight') }}" class="form-control w-full text-xs sm:text-sm @error('weight') border-error @enderror" required>
                                @error('weight')
                                    <div class="text-error text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 sm:mb-4">
                                <label for="body_fat" class="block text-xs sm:text-sm font-medium mb-1 sm:mb-2 text-dark dark:text-white">
                                    Lemak Tubuh (%) <span class="text-error">*</span>
                                </label>
                                <input type="number" id="body_fat" name="body_fat" min="0" max="100" step="0.1"
                                       value="{{ old('body_fat') }}" class="form-control w-full text-xs sm:text-sm @error('body_fat') border-error @enderror" required>
                                @error('body_fat')
                                    <div class="text-error text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 sm:mb-4">
                                <label for="belly_fat" class="block text-xs sm:text-sm font-medium mb-1 sm:mb-2 text-dark dark:text-white">
                                    Lemak Perut (%) <span class="text-error">*</span>
                                </label>
                                <input type="number" id="belly_fat" name="belly_fat" min="0" max="100" step="0.1"
                                       value="{{ old('belly_fat') }}" class="form-control w-full text-xs sm:text-sm @error('belly_fat') border-error @enderror" required>
                                @error('belly_fat')
                                    <div class="text-error text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 sm:mb-4">
                                <label for="muscle_mass" class="block text-xs sm:text-sm font-medium mb-1 sm:mb-2 text-dark dark:text-white">
                                    Massa Otot (kg) <span class="text-error">*</span>
                                </label>
                                <input type="number" id="muscle_mass" name="muscle_mass" min="0" max="100" step="0.1"
                                       value="{{ old('muscle_mass') }}" class="form-control w-full text-xs sm:text-sm @error('muscle_mass') border-error @enderror" required>
                                @error('muscle_mass')
                                    <div class="text-error text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 sm:mb-4">
                                <label for="bone_density" class="block text-xs sm:text-sm font-medium mb-1 sm:mb-2 text-dark dark:text-white">
                                    Kepadatan Tulang <span class="text-error">*</span>
                                </label>
                                <input type="number" id="bone_density" name="bone_density" min="0" max="100" step="0.1"
                                       value="{{ old('bone_density') }}" class="form-control w-full text-xs sm:text-sm @error('bone_density') border-error @enderror" required>
                                @error('bone_density')
                                    <div class="text-error text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 sm:mb-4">
                                <label for="water_content" class="block text-xs sm:text-sm font-medium mb-1 sm:mb-2 text-dark dark:text-white">
                                    Kadar Air (%) <span class="text-error">*</span>
                                </label>
                                <input type="number" id="water_content" name="water_content" min="0" max="100" step="0.1"
                                       value="{{ old('water_content') }}" class="form-control w-full text-xs sm:text-sm @error('water_content') border-error @enderror" required>
                                @error('water_content')
                                    <div class="text-error text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 sm:mb-4">
                                <label for="calories_needs" class="block text-xs sm:text-sm font-medium mb-1 sm:mb-2 text-dark dark:text-white">
                                    Kebutuhan Kalori (kkal) <span class="text-error">*</span>
                                </label>
                                <input type="number" id="calories_needs" name="calories_needs" min="500" max="5000" step="1"
                                       value="{{ old('calories_needs') }}" class="form-control w-full text-xs sm:text-sm @error('calories_needs') border-error @enderror" required>
                                @error('calories_needs')
                                    <div class="text-error text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 sm:mb-4">
                                <label for="cell_age" class="block text-xs sm:text-sm font-medium mb-1 sm:mb-2 text-dark dark:text-white">
                                    Usia Sel (tahun) <span class="text-error">*</span>
                                </label>
                                <input type="number" id="cell_age" name="cell_age" min="1" max="120" step="1"
                                       value="{{ old('cell_age') }}" class="form-control w-full text-xs sm:text-sm @error('cell_age') border-error @enderror" required>
                                @error('cell_age')
                                    <div class="text-error text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="flex justify-end mt-4 sm:mt-6">
                            <button type="submit" class="btn btn-xs sm:btn-sm md:btn-md btn-primary">
                                <i class="ti ti-device-floppy me-1"></i> Simpan Data Checkup
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection