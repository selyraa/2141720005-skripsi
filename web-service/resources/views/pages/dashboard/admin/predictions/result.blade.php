@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        Hasil Prediksi Program Diet
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="#">
                                Home
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            Hasil Prediksi Program
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Hasil Prediksi Program Diet</h3>
                    
                    @if(session('result'))
                        <div class="mb-6">
                            <div class="bg-success/10 text-success p-4 rounded-lg mb-4">
                                <h4 class="font-semibold text-lg">Program Diet yang Direkomendasikan: {{ session('result')['prediction'] }}</h4>
                            </div>

                            <div class="mb-6">
                                <h5 class="font-semibold text-lg mb-3">Probabilitas per Program:</h5>
                                <div class="space-y-3">
                                    @foreach(session('result')['probabilities'] as $program => $probability)
                                        <div class="flex items-center">
                                            <span class="w-1/3">{{ $program }}</span>
                                            <div class="w-2/3 flex items-center">
                                                <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                                                    <div class="bg-primary h-4 rounded-full" style="width: {{ $probability * 100 }}%"></div>
                                                </div>
                                                <span class="ml-3">{{ number_format($probability * 100, 1) }}%</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 mb-6">
                                <h5 class="font-semibold text-lg mb-4">Data Registrasi Program Diet</h5>
                                
                                <form action="{{ route('predictions.saveResult') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="prediction" value="{{ session('result')['prediction'] }}">
                                    
                                    <div class="space-y-4">
                                        <!-- User Selection Field -->
                                        <div class="mb-4">
                                            <label for="user_id" class="block text-sm font-medium mb-2">Pilih Pelanggan:</label>
                                            <select name="user_id" id="user_id" class="form-select w-full" required>
                                                <option value="">-- Pilih Pelanggan --</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col space-y-3">
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="decision" value="agree" class="form-radio" checked>
                                                <span class="ml-2">Ya, saya setuju dengan program diet yang direkomendasikan</span>
                                            </label>
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="decision" value="change" class="form-radio">
                                                <span class="ml-2">Tidak, saya ingin mengubah program diet</span>
                                            </label>
                                        </div>
                                        
                                        <div id="alternativeProgramContainer" class="hidden mt-4 border-t pt-4">
                                            <label class="block text-sm font-medium mb-2">Pilih Program Diet Alternatif:</label>
                                            <select name="alternative_program" class="form-select w-full">
                                                @foreach(session('result')['probabilities'] as $program => $probability)
                                                    @if($program != session('result')['prediction'])
                                                        <option value="{{ $program }}">{{ $program }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="mt-6 flex justify-between">
                                            <a href="{{ route('predictions.index') }}" class="btn btn-secondary">
                                                <i class="ti ti-arrow-left mr-1"></i> Edit Data Prediksi
                                            </a>
                                            <button type="submit" class="btn btn-primary">Simpan & Lanjutkan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="bg-warning/10 text-warning p-4 rounded-lg mb-4">
                            Tidak ada hasil prediksi yang tersedia. Silahkan lakukan prediksi terlebih dahulu.
                            <div class="mt-4">
                                <a href="{{ route('predictions.index') }}" class="btn btn-secondary">Kembali ke Form Prediksi</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const decisionRadios = document.querySelectorAll('input[name="decision"]');
            const alternativeProgramContainer = document.getElementById('alternativeProgramContainer');
            
            decisionRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'change') {
                        alternativeProgramContainer.classList.remove('hidden');
                    } else {
                        alternativeProgramContainer.classList.add('hidden');
                    }
                });
            });
        });
    </script>
    @endpush
@endsection
