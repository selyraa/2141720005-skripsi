@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.add_llm_context') }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('llm-contexts.index') }}">
                                {{ __('app.llm_contexts') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ __('app.add_llm_context') }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end">
                        <a href="{{ route('llm-contexts.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i> {{ __('app.back') }}
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
                    <h3 class="card-title mb-4">{{ __('app.add_context_form') }}</h3>
                    
                    @if($errors->any())
                        <div class="bg-lighterror dark:bg-darkerror text-error px-4 py-3 rounded relative mb-4" role="alert">
                            <ul class="list-disc ml-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('llm-contexts.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div class="form-group">
                                <label for="title" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.title') }} <span class="text-red-500">*</span></label>
                                <input type="text" id="title" name="title" class="form-control w-full @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                @error('title')
                                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                                @enderror
                                <label for="context" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.context_template') }} <span class="text-red-500">*</span></label>
                                <textarea id="context" name="context" class="form-control w-full @error('context') is-invalid @enderror" rows="10" required>{{ old('context') }}</textarea>
                                @error('context')
                                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="card mb-4 border dark:border-gray-700">
                                <div class="card-header bg-gray-50 dark:bg-gray-800 py-3 px-4">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ __('app.available_placeholders') }}</h6>
                                </div>
                                <div class="card-body">
                                    <p class="mb-3 text-gray-600 dark:text-gray-400">{{ __('app.placeholders_desc') }}</p>
                                    
                                    <div class="overflow-x-auto">
                                        <table class="table-auto w-full text-left border-spacing-0 border-separate">
                                            <thead>
                                                <tr>
                                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.diet_prediction') }}</th>
                                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.placeholder') }}</th>
                                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.description') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($placeholders as $name => $placeholder)
                                                    <tr>
                                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ $name }}</td>
                                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                            <code class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">{{ $placeholder }}</code>
                                                        </td>
                                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ __("Will be replaced with the user's $name data") }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-secondary btn-sm" id="showExampleBtn">{{ __('app.show_example') }}</button>
                                        <div class="mt-3 p-4 bg-gray-50 dark:bg-gray-800 rounded" id="exampleContainer" style="display: none;">
                                            <h6 class="text-dark dark:text-white mb-2">{{ __('app.example') }}:</h6>
                                            <pre class="bg-gray-100 dark:bg-gray-700 p-3 rounded overflow-x-auto whitespace-pre-wrap">Berikan rekomendasi diet kepada pengguna dengan data:
- Tinggi badan: {tinggi_badan} cm
- Berat badan: {berat_badan} kg
- Lemak tubuh: {lemak_tubuh}%
- Lemak perut: {lemak_perut}
- Kebutuhan kalori: {kebutuhan_kalori}
- Program diet: {program_diet}
- Preferensi halal: {is_halal}

Berikan rekomendasi makanan dan jadwal makan yang tepat.</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('llm-contexts.index') }}" class="btn btn-secondary me-2">
                                <i class="ti ti-x me-1"></i> {{ __('app.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i> {{ __('app.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle example container - using vanilla JS for reliability
            document.getElementById('showExampleBtn').addEventListener('click', function() {
                var container = document.getElementById('exampleContainer');
                if (container.style.display === 'none') {
                    container.style.display = 'block';
                } else {
                    container.style.display = 'none';
                }
            });

            // Optional: Add placeholders to the textarea
            $('.placeholder-btn').click(function() {
                var placeholder = $(this).data('placeholder');
                var textarea = $('#context');
                var cursorPos = textarea.prop('selectionStart');
                var textBefore = textarea.val().substring(0, cursorPos);
                var textAfter = textarea.val().substring(cursorPos);
                textarea.val(textBefore + placeholder + textAfter);
            });
        });
    </script>
@endpush
