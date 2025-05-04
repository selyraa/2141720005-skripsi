<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('app.diet_program_report') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .filter-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #666;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-completed {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .status-cancelled {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        .status-changed {
            background-color: #ffedd5;
            color: #9a3412;
        }
        .progress-bar-container {
            width: 100%;
            background-color: #e5e7eb;
            border-radius: 9999px;
            height: 10px;
        }
        .progress-bar {
            height: 10px;
            border-radius: 9999px;
            background-color: #4f46e5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ __('app.diet_program_report') }}</h1>
        <div class="subtitle">{{ __('app.app_name') }}</div>
    </div>

    <div class="filter-info">
        <strong>{{ __('app.period') }}:</strong> 
        {{ \Carbon\Carbon::parse($startDate)->format('F Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('F Y') }}
        @if($program)
            <br><strong>{{ __('app.diet_program') }}:</strong> {{ $program->name }}
        @else
            <br><strong>{{ __('app.diet_program') }}:</strong> {{ __('app.all_programs') }}
        @endif
        <br><strong>{{ __('app.generated_at') }}:</strong> {{ now()->format('d F Y H:i:s') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>{{ __('app.number') }}</th>
                <th>{{ __('app.customer') }}</th>
                <th>{{ __('app.diet_program') }}</th>
                <th>{{ __('app.enrollment_date') }}</th>
                <th>{{ __('app.duration') }}</th>
                <th>{{ __('app.status') }}</th>
                <th>{{ __('app.progress') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enrollments as $index => $enrollment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        {{ $enrollment->user->name ?? 'N/A' }}
                        <div style="font-size: 11px; color: #666;">{{ $enrollment->user->email ?? 'N/A' }}</div>
                    </td>
                    <td>{{ $enrollment->dietProgram->name ?? 'N/A' }}</td>
                    <td>{{ $enrollment->created_at ? $enrollment->created_at->format('d M Y') : 'N/A' }}</td>
                    <td>
                        {{ \App\Http\Controllers\Admin\ReportController::calculateDuration($enrollment->created_at) }} {{ __('app.days') }}
                    </td>
                    <td>
                        @if($enrollment->status == 'active')
                            <span class="status-badge status-active">{{ __('app.active') }}</span>
                        @elseif($enrollment->status == 'completed')
                            <span class="status-badge status-completed">{{ __('app.completed') }}</span>
                        @elseif($enrollment->status == 'cancelled')
                            <span class="status-badge status-cancelled">{{ __('app.cancelled') }}</span>
                        @elseif($enrollment->status == 'changed')
                            <span class="status-badge status-changed">{{ __('app.changed') }}</span>
                        @else
                            {{ $enrollment->status }}
                        @endif
                    </td>
                    <td>
                        @php
                            $progress = \App\Http\Controllers\Admin\ReportController::calculateProgress(
                                $enrollment->created_at, 
                                $enrollment->dietProgram ? $enrollment->dietProgram->duration : 0
                            );
                        @endphp
                        
                        <div class="progress-bar-container">
                            <div class="progress-bar" style="width: {{ $progress }}%"></div>
                        </div>
                        <div style="font-size: 11px; margin-top: 4px;">{{ $progress }}%</div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">{{ __('app.no_enrollments_found') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>{{ __('app.copyright') }} &copy; {{ date('Y') }} {{ __('app.app_name') }}. {{ __('app.all_rights_reserved') }}.</p>
    </div>
</body>
</html>