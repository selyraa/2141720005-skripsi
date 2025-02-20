@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightinfo dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        Data Prediksi
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="flex items-center text-sm text-link dark:text-darklink leading-none" aria-current="page">
                            Prediksi
                        </li>
                    </ol>
                </div>
                <div class="col-span-3 -mb-10">
                    <div class="flex justify-center">
                        <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt=""
                            class="md:-mb-7 -mb-4 h-full w-full" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----Breadcrumb End---->
    @if(session('error'))
        <div class="bg-error/10 text-error p-4 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Form Prediksi Program Diet</h3>
                    
                    <form action="{{ route('predictions.predict') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="form-label">Umur</label>
                                <input type="number" name="age" class="form-control @error('age') border-error @enderror" 
                                    value="{{ old('age') }}" required step="1">
                                @error('age')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" name="height" class="form-control @error('height') border-error @enderror" 
                                    value="{{ old('height') }}" required step="0.1">
                                @error('height')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Berat Badan (kg)</label>
                                <input type="number" name="weight" class="form-control @error('weight') border-error @enderror" 
                                    value="{{ old('weight') }}" required step="0.1">
                                @error('weight')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Lemak Tubuh (%)</label>
                                <input type="number" name="bodyFat" class="form-control @error('bodyFat') border-error @enderror" 
                                    value="{{ old('bodyFat') }}" required step="0.1">
                                @error('bodyFat')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Lemak Perut (%)</label>
                                <input type="number" name="bellyFat" class="form-control @error('bellyFat') border-error @enderror" 
                                    value="{{ old('bellyFat') }}" required step="0.1">
                                @error('bellyFat')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Massa Otot (kg)</label>
                                <input type="number" name="muscleMass" class="form-control @error('muscleMass') border-error @enderror" 
                                    value="{{ old('muscleMass') }}" required step="0.1">
                                @error('muscleMass')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Kebutuhan Kalori (kkal)</label>
                                <input type="number" name="calorieNeeds" class="form-control @error('calorieNeeds') border-error @enderror" 
                                    value="{{ old('calorieNeeds') }}" required step="1">
                                @error('calorieNeeds')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Usia Sel</label>
                                <input type="number" name="cellAge" class="form-control @error('cellAge') border-error @enderror" 
                                    value="{{ old('cellAge') }}" required step="1">
                                @error('cellAge')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Kepadatan Tulang</label>
                                <input type="number" name="boneDensity" class="form-control @error('boneDensity') border-error @enderror" 
                                    value="{{ old('boneDensity') }}" required step="0.1">
                                @error('boneDensity')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Kadar Air (%)</label>
                                <input type="number" name="waterContent" class="form-control @error('waterContent') border-error @enderror" 
                                    value="{{ old('waterContent') }}" required step="0.1">
                                @error('waterContent')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @if(session('error'))
                            <div class="bg-error/10 text-error p-4 rounded-lg mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary">Prediksi Program</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
