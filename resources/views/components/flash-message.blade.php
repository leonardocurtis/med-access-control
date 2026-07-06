@if (session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition.opacity.duration.500ms
        x-init="setTimeout(() => show = false, 3000)"
        class="mb-4 flex items-center gap-3 rounded-lg border border-emerald-300 bg-emerald-50 px-4 py-3 text-emerald-800 shadow-sm"
    >
        <x-phosphor-check-circle class="h-6 w-6 flex-shrink-0" />

        <span class="text-sm font-medium">
            {{ session('success') }}
        </span>
    </div>
@endif

@if (session('error'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition.opacity.duration.500ms
        x-init="setTimeout(() => show = false, 5000)"
        class="mb-4 flex items-center gap-3 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-red-800 shadow-sm"
    >
        <x-phosphor-warning-circle class="h-6 w-6 flex-shrink-0" />

        <span class="text-sm font-medium">
            {{ session('error') }}
        </span>
    </div>
@endif

@if ($errors->any())
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition.opacity.duration.500ms
        class="mb-4 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-red-800 shadow-sm"
    >
        <div class="flex items-start gap-3">
            <x-phosphor-warning-circle class="h-6 w-6 flex-shrink-0 mt-0.5" />

            <div>
                <p class="font-semibold">
                    Corrija os seguintes erros:
                </p>

                <ul class="mt-2 list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif