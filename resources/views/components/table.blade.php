@props(['header' => ''])

<div class="table-responsive">
    <table class="table-rounded table-striped gy-5 gs-5 table border bg-white">
        <thead>
            <tr class="fw-semibold fs-6 border-bottom border-gray-200 text-gray-800">
                {{ $header }}
            </tr>
        </thead>
        <tbody class="fs-6">
            {{ $slot }}
        </tbody>
    </table>
</div>
