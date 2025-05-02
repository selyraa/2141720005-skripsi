@extends('pages.dashboard.admin.layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        Kelola Pengguna
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                Home
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            Kelola Pengguna
                        </li>
                    </ol>
                </div>
                <div class="col-span-3 flex justify-end">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i>Tambah Pengguna Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
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

        <div class="card">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap rounded-lg overflow-hidden">
                        <thead class="bg-gray-50 dark:bg-dark-surface border-b">
                            <tr class="text-left">
                                <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Nama</th>
                                <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Email</th>
                                <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Peran</th>
                                <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Nomor Telepon</th>
                                <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Jenis Kelamin</th>
                                <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border dark:divide-darkborder">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/40 transition-all">
                                    <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @if($user->role)
                                            @if($user->role->name == 'ahli gizi')
                                                <span class="px-3 py-1 text-xs rounded-full bg-lightprimary dark:bg-darkprimary text-primary">
                                                    {{ $user->role->name }}
                                                </span>
                                            @elseif($user->role->name == 'asisten ahli gizi')
                                                <span class="px-3 py-1 text-xs rounded-full bg-lightinfo dark:bg-darkinfo text-info">
                                                    {{ $user->role->name }}
                                                </span>
                                            @else
                                                <span class="px-3 py-1 text-xs rounded-full bg-lightsecondary dark:bg-darksecondary text-secondary">
                                                    {{ $user->role->name }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="px-3 py-1 text-xs rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                                                No Role
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $user->phone_number ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-dark dark:text-white">
                                        @if($user->gender == 'male')
                                            <span class="inline-flex items-center">
                                                <i class="ti ti-gender-male text-blue-500 mr-1"></i> Laki-laki
                                            </span>
                                        @elseif($user->gender == 'female')
                                            <span class="inline-flex items-center">
                                                <i class="ti ti-gender-female text-pink-500 mr-1"></i> Perempuan
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" 
                                               class="p-2 bg-lightprimary dark:bg-darkprimary rounded-full hover:bg-primary hover:text-white transition-all" 
                                               title="Edit">
                                                <i class="ti ti-edit text-primary hover:text-white"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" id="delete-form-{{ $user->id }}" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" 
                                                        class="p-2 bg-lighterror dark:bg-darkerror rounded-full hover:bg-error hover:text-white transition-all" 
                                                        title="Hapus"
                                                        onclick="openConfirmationModal('delete', 'Hapus Pengguna', 'Apakah Anda yakin ingin menghapus pengguna {{ $user->name }}?', 'Ya, Hapus', 'document.getElementById(\'delete-form-{{ $user->id }}\').submit()')">
                                                    <i class="ti ti-trash text-error hover:text-white"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/components/confirmation-modal.js') }}"></script>
@endpush