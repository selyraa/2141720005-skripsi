@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.manage_diet_programs') }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ __('app.manage_diet_programs') }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end">
                        <a href="{{ route('diet-programs.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> {{ __('app.add_diet_program') }}
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
                                    <th class="px-6 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.number') }}</th>
                                    <th class="px-6 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.program_name') }}</th>
                                    <th class="px-6 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.description') }}</th>
                                    <th class="px-6 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dietPrograms as $index => $program)
                                    <tr>
                                        <td class="px-6 py-4 border-b">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 border-b">{{ $program->name }}</td>
                                        <td class="px-6 py-4 border-b">{{ Str::limit($program->description, 50) ?: __('app.no_description') }}</td>
                                        <td class="px-6 py-4 border-b">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('diet-programs.show', $program->id) }}" 
                                                    class="p-2 bg-lightinfo dark:bg-darkinfo rounded-full hover:bg-info hover:text-white transition-all" 
                                                    title="{{ __('app.view') }}">
                                                    <i class="ti ti-eye text-info hover:text-white"></i>
                                                </a>
                                                <a href="{{ route('diet-programs.edit', $program->id) }}" 
                                                    class="p-2 bg-lightprimary dark:bg-darkprimary rounded-full hover:bg-primary hover:text-white transition-all" 
                                                    title="{{ __('app.edit') }}">
                                                    <i class="ti ti-edit text-primary hover:text-white"></i>
                                                </a>
                                                <form action="{{ route('diet-programs.destroy', $program->id) }}" method="POST" class="inline" 
                                                    id="delete-form-{{ $program->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                        class="p-2 bg-lighterror dark:bg-darkerror rounded-full hover:bg-error hover:text-white transition-all" 
                                                        title="{{ __('app.delete') }}" 
                                                        onclick="openConfirmationModal('delete', '{{ __('app.delete_diet_program') }}', '{{ __('app.confirm_delete', ['item' => $program->name]) }}', '{{ __('app.yes_delete') }}', 'document.getElementById(\'delete-form-{{ $program->id }}\').submit()')">
                                                        <i class="ti ti-trash text-error hover:text-white"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 border-b text-center text-gray-500 dark:text-gray-400">{{ __('app.no_diet_programs_found') }}</td>
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