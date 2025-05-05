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

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex justify-between items-center">
                        <span>{{ __('app.user_data') }}</span>
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full text-left border-spacing-0 border-separate">
                            <thead>
                                <tr class="text-left">
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.number') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.name') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.email') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.role') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.phone_number') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.gender') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $user)
                                    <tr>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ $index + $users->firstItem() }}</td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ $user->name }}</td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ $user->email }}</td>
                                        <td class="px-4 py-3 border-b">
                                            @if($user->role)
                                                @if($user->role->name == 'ahli gizi')
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-primary-800 bg-lightprimary dark:bg-darkprimary rounded-full">
                                                        {{ $user->role->name }}
                                                    </span>
                                                @elseif($user->role->name == 'asisten ahli gizi')
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-info-800 bg-lightinfo dark:bg-darkinfo rounded-full">
                                                        {{ $user->role->name }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-secondary-800 bg-lightsecondary dark:bg-darksecondary rounded-full">
                                                        {{ $user->role->name }}
                                                    </span>
                                                @endif
                                            @else
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 dark:bg-gray-800 rounded-full">
                                                    {{ __('app.no_role') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ $user->phone_number ?? '-' }}</td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            @if($user->gender == 'male')
                                                <span class="inline-flex items-center">
                                                    <i class="ti ti-gender-male text-blue-500 mr-1"></i> {{ __('app.male') }}
                                                </span>
                                            @elseif($user->gender == 'female')
                                                <span class="inline-flex items-center">
                                                    <i class="ti ti-gender-female text-pink-500 mr-1"></i> {{ __('app.female') }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                                   class="p-2 bg-lightprimary dark:bg-darkprimary rounded-full hover:bg-primary hover:text-white transition-all" 
                                                   title="{{ __('app.edit') }}">
                                                    <i class="ti ti-edit text-primary hover:text-white"></i>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" id="delete-form-{{ $user->id }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class="p-2 bg-lighterror dark:bg-darkerror rounded-full hover:bg-error hover:text-white transition-all" 
                                                            title="{{ __('app.delete') }}"
                                                            onclick="openConfirmationModal('delete', '{{ __('app.delete_user') }}', '{{ __('app.confirm_delete', ['item' => $user->name]) }}', '{{ __('app.yes_delete') }}', 'document.getElementById(\'delete-form-{{ $user->id }}\').submit()')">
                                                        <i class="ti ti-trash text-error hover:text-white"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-3 border-b text-center text-gray-500 dark:text-gray-400">{{ __('app.no_users_found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @include('components.pagination', ['paginator' => $users, 'perPage' => $perPage, 'perPageOptions' => $perPageOptions])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/components/confirmation-modal.js') }}"></script>
@endpush