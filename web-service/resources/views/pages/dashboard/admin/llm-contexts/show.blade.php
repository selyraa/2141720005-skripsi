@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.llm_context_details') }}
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
                            {{ __('app.context_details') }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('llm-contexts.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i> {{ __('app.back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Context Details -->
        <div class="col-span-12 lg:col-span-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center justify-between">
                        <div>
                            <i class="ti ti-info-circle text-xl mr-2"></i> {{ __('app.context_details') }}
                        </div>
                        <div>
                            <a href="{{ route('llm-contexts.edit', $llmContext->id) }}" class="btn btn-primary btn-sm">
                                <i class="ti ti-edit me-1"></i> {{ __('app.edit') }}
                            </a>
                        </div>
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.title') }}</div>
                            <div class="text-dark dark:text-white">{{ $llmContext->title }}</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.created_at') }}</div>
                            <div class="text-dark dark:text-white">{{ $llmContext->created_at->format('d M Y, H:i') }}</div>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.context_template') }}</div>
                            <div class="text-dark dark:text-white mt-2">
                                <pre class="bg-gray-100 dark:bg-gray-700 p-3 rounded overflow-x-auto whitespace-pre-wrap">{{ $llmContext->context }}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Usage Information -->
        <div class="col-span-12 lg:col-span-7">
            <div class="card mb-6">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-search-2 text-xl mr-2"></i> {{ __('app.placeholder_detection') }}
                    </h3>
                    
                    @php
                        $placeholders = [
                            'User data' => ['pattern' => '{user_data}', 'found' => false],
                            'Tinggi badan' => ['pattern' => '{tinggi_badan}', 'found' => false],
                            'Berat badan' => ['pattern' => '{berat_badan}', 'found' => false],
                            'Lemak tubuh' => ['pattern' => '{lemak_tubuh}', 'found' => false],
                            'Lemak perut' => ['pattern' => '{lemak_perut}', 'found' => false],
                            'Massa otot' => ['pattern' => '{massa_otot}', 'found' => false],
                            'Kebutuhan kalori' => ['pattern' => '{kebutuhan_kalori}', 'found' => false],
                            'Usia sel' => ['pattern' => '{usia_sel}', 'found' => false],
                            'Kepadatan tulang' => ['pattern' => '{kepadatan_tulang}', 'found' => false],
                            'Kadar air' => ['pattern' => '{kadar_air}', 'found' => false],
                            'Program diet' => ['pattern' => '{program_diet}', 'found' => false],
                            'Is_halal' => ['pattern' => '{is_halal}', 'found' => false],
                            'Negara' => ['pattern' => '{negara}', 'found' => false],
                        ];
                        
                        foreach ($placeholders as $name => &$placeholder) {
                            $placeholder['found'] = strpos($llmContext->context, $placeholder['pattern']) !== false;
                        }
                        
                        $foundCount = count(array_filter($placeholders, function($p) { return $p['found']; }));
                    @endphp
                    
                    <div>
                        <p class="mb-3 text-gray-500 dark:text-gray-400">{{ __('app.detected_placeholders') }}:</p>
                        
                        @if ($foundCount > 0)
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full text-left border-spacing-0 border-separate">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.placeholder') }}</th>
                                            <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200 w-1/4">{{ __('app.status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($placeholders as $name => $placeholder)
                                            @if ($placeholder['found'])
                                                <tr>
                                                    <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                        {{ $name }} (<code class="bg-gray-100 dark:bg-gray-700 px-1 py-0.5 rounded text-sm">{{ $placeholder['pattern'] }}</code>)
                                                    </td>
                                                    <td class="px-4 py-3 border-b">
                                                        <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 rounded-full bg-lightsuccess dark:bg-darksuccess text-success">
                                                            {{ __('app.found') }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-4 bg-lightwarn dark:bg-darkwarn text-warn rounded">
                                {{ __('app.no_placeholders_found') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-file-usage text-xl mr-2"></i> {{ __('app.used_in') }}
                    </h3>
                    
                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded">
                        @if ($llmContext->dietRecommendations->count() > 0)
                            <p class="text-gray-700 dark:text-gray-300">{{ __('app.context_used_by', ['count' => $llmContext->dietRecommendations->count()]) }}</p>
                        @else
                            <p class="text-gray-700 dark:text-gray-300">{{ __('app.context_not_used') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection