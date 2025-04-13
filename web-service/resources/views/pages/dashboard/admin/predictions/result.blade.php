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
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight"
                                href="{{ route('predictions.index') }}" class="text-primary hover:text-primary">Tambah
                                Prediksi Program</a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight"
                            aria-current="page">
                            Hasil Prediksi Program
                        </li>
                    </ol>
                </div>
                <!-- Rest of the existing code remains the same -->
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Program Diet yang Direkomendasikan</h3>

                    @if (session('result'))
                        <div class="bg-success/10 text-success p-4 rounded-lg mb-4">
                            <h4 class="text-xl font-semibold mb-2">Program Diet yang Direkomendasikan:
                                {{ session('result.prediction') }}</h4>

                            <div class="mt-4">
                                <h5 class="font-medium mb-2">Probabilitas per Program:</h5>
                                <ul class="list-disc list-inside">
                                    @php
                                        $probabilities = collect(session('result.probabilities'))->sortByDesc(function (
                                            $value,
                                            $key,
                                        ) {
                                            return $value;
                                        });
                                    @endphp

                                    @foreach ($probabilities as $program => $probability)
                                        <li>{{ $program }}: {{ number_format($probability * 100, 1) }}%</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <a href="{{ route('predictions.index') }}" class="btn btn-primary">
                                Prediksi Lagi
                            </a>
                        </div>
                    @else
                        <div class="text-error">
                            Terjadi kesalahan dalam memproses prediksi.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
