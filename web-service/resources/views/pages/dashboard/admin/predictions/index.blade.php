@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        Prediksi Program Diet
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="#">
                                Home
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            Tambah Prediksi Program
                        </li>
                    </ol>
                </div>
                <!-- Rest of the existing code remains the same -->
            </div>
        </div>
    </div>
    <!----Breadcrumb End---->
    @if(session('error'))
        <div class="bg-error/10 text-error p-4 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    @if(session('info'))
        <div class="bg-info/10 text-info p-4 rounded-lg mb-4">
            {{ session('info') }}
        </div>
    @endif

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Form Prediksi Program Diet</h3>

                    <form action="{{ route('predictions.predict') }}" method="POST" id="prediction-form">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="form-label">Umur</label>
                                <input type="number" name="age" class="form-control @error('age') border-error @enderror"
                                    value="{{ $predictionData['age'] ?? old('age') }}" required step="1">
                                @error('age')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" name="height" class="form-control @error('height') border-error @enderror"
                                    value="{{ $predictionData['height'] ?? old('height') }}" required step="0.1">
                                @error('height')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Berat Badan (kg)</label>
                                <input type="number" name="weight" class="form-control @error('weight') border-error @enderror"
                                    value="{{ $predictionData['weight'] ?? old('weight') }}" required step="0.1">
                                @error('weight')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Lemak Tubuh (%)</label>
                                <input type="number" name="bodyFat" class="form-control @error('bodyFat') border-error @enderror"
                                    value="{{ $predictionData['bodyFat'] ?? old('bodyFat') }}" required step="0.1">
                                @error('bodyFat')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Lemak Perut (%)</label>
                                <input type="number" name="bellyFat" class="form-control @error('bellyFat') border-error @enderror"
                                    value="{{ $predictionData['bellyFat'] ?? old('bellyFat') }}" required step="0.1">
                                @error('bellyFat')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Massa Otot (kg)</label>
                                <input type="number" name="muscleMass" class="form-control @error('muscleMass') border-error @enderror"
                                    value="{{ $predictionData['muscleMass'] ?? old('muscleMass') }}" required step="0.1">
                                @error('muscleMass')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Kebutuhan Kalori (kkal)</label>
                                <input type="number" name="calorieNeeds" class="form-control @error('calorieNeeds') border-error @enderror"
                                    value="{{ $predictionData['calorieNeeds'] ?? old('calorieNeeds') }}" required step="1">
                                @error('calorieNeeds')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Usia Sel</label>
                                <input type="number" name="cellAge" class="form-control @error('cellAge') border-error @enderror"
                                    value="{{ $predictionData['cellAge'] ?? old('cellAge') }}" required step="1">
                                @error('cellAge')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Kepadatan Tulang</label>
                                <input type="number" name="boneDensity" class="form-control @error('boneDensity') border-error @enderror"
                                    value="{{ $predictionData['boneDensity'] ?? old('boneDensity') }}" required step="0.1">
                                @error('boneDensity')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Kadar Air (%)</label>
                                <input type="number" name="waterContent" class="form-control @error('waterContent') border-error @enderror"
                                    value="{{ $predictionData['waterContent'] ?? old('waterContent') }}" required step="0.1">
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

                        @if(session('info'))
                            <div class="bg-info/10 text-info p-4 rounded-lg mb-4">
                                {{ session('info') }}
                            </div>
                        @endif

                        <div class="flex justify-end mt-4 space-x-3">
                            <button type="button" id="reset-form" class="btn btn-secondary hidden">
                                <i class="ti ti-refresh me-1"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-chart-bar me-1"></i>Prediksi Program
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resetButton = document.getElementById('reset-form');
            const form = document.getElementById('prediction-form');
            
            const toggleResetButtonVisibility = () => {
                const inputs = form.querySelectorAll('input[type="number"]');
                let hasValue = false;

                inputs.forEach(input => {
                    if (input.value.trim() !== '') {
                        hasValue = true;
                    }
                });

                resetButton.classList.toggle('hidden', !hasValue);
            };

            form.addEventListener('input', toggleResetButtonVisibility);

            resetButton.addEventListener('click', function() {
                const inputs = form.querySelectorAll('input[type="number"]');
                
                inputs.forEach(input => {
                    input.value = '';
                });
                
                const feedbackDiv = document.createElement('div');
                feedbackDiv.className = 'bg-success/10 text-success p-4 rounded-lg mb-4 mt-4';
                feedbackDiv.textContent = 'Form telah direset. Silahkan isi data baru.';
                
                const buttonsContainer = form.querySelector('.flex.justify-end');
                form.insertBefore(feedbackDiv, buttonsContainer);
                
                setTimeout(() => {
                    feedbackDiv.remove();
                }, 3000);

                toggleResetButtonVisibility();
            });

            toggleResetButtonVisibility();
        });
    </script>
    @endpush
@endsection
