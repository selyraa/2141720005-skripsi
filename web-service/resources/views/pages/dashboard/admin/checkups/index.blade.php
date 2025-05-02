@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        Data Checkup Pelanggan
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                Home
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            Data Checkup Pelanggan
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end">
                        <a href="{{ route('checkups.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> Tambah Checkup
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex justify-between items-center">
                        <span>Data Checkup Pelanggan</span>
                        <span class="text-sm text-gray-500 font-normal">*Menampilkan data checkup terbaru untuk setiap program enrollment</span>
                    </h3>
                    
                    @if(session('success'))
                        <div class="bg-lightsuccess dark:bg-darksuccess text-success px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                                <i class="ti ti-x"></i>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-lighterror dark:bg-darkerror text-error px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                                <i class="ti ti-x"></i>
                            </button>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="table-auto w-full text-left border-spacing-0 border-separate">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">No</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Nama Pelanggan</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Umur</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Tinggi (cm)</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Berat (kg)</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Program Diet</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Tanggal Checkup</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($checkups as $index => $checkup)
                                    <tr>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            @if($checkup->programEnrollment && $checkup->programEnrollment->user)
                                                {{ $checkup->programEnrollment->user->name }}
                                                <div class="text-xs text-gray-400">{{ $checkup->programEnrollment->user->email }}</div>
                                            @else
                                                <span class="text-red-500">Data Tidak Tersedia</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $checkup->cell_age }} <span class="text-xs text-gray-500">tahun</span>
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $checkup->height }} <span class="text-xs text-gray-500">cm</span>
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $checkup->weight }} <span class="text-xs text-gray-500">kg</span>
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            @if($checkup->programEnrollment && $checkup->programEnrollment->dietProgram)
                                                {{ $checkup->programEnrollment->dietProgram->name }}
                                            @else
                                                <span class="text-red-500">Data Tidak Tersedia</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $checkup->checkup_date ? $checkup->checkup_date->format('d M Y') : 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            <div class="flex gap-2">
                                                <a href="{{ route('checkups.show', $checkup->id) }}" 
                                                    class="p-2 bg-lightblue dark:bg-dark rounded-full hover:bg-blue hover:text-white transition-all" 
                                                    title="Lihat">
                                                    <i class="ti ti-eye text-blue hover:text-white"></i>
                                                </a>
                                                <a href="{{ route('checkups.edit', $checkup->id) }}"
                                                    class="p-2 bg-lightprimary dark:bg-darkprimary rounded-full hover:bg-primary hover:text-white transition-all" 
                                                    title="Edit">
                                                     <i class="ti ti-edit text-primary hover:text-white"></i>
                                                </a>
                                                <form action="{{ route('checkups.destroy', $checkup->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Apakah Anda yakin ingin menghapus data checkup ini?')">
                                                        <i class="ti ti-trash"></i> Hapus
                                                    </button> --}}
                                                    <button type="button" 
                                                        class="p-2 bg-lighterror dark:bg-darkerror rounded-full hover:bg-error hover:text-white transition-all" 
                                                        title="Hapus"
                                                        onclick="openConfirmationModal('delete', 'Hapus Data Checkup', 'Apakah Anda yakin ingin menghapus data checkup untuk {{ $checkup->programEnrollment->user->name ?? 'pengguna ini' }}?', 'Ya, Hapus', 'document.getElementById(\'delete-form-{{ $checkup->programEnrollment->user->name }}\').submit()')">
                                                    <i class="ti ti-trash text-error hover:text-white"></i>
                                                </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-3 border-b text-center text-gray-500 dark:text-gray-400">Tidak ada data checkup yang ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/components/confirmation-modal.js') }}"></script>
@endpush