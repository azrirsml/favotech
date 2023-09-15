<div {{ $attributes->merge(['class' => 'card card-flush shadow-sm']) }}>
    @isset($title)
        <div class="card-header">
            <h3 class="card-title"> {{ $title }}</h3>
            @isset($button)
                <div class="card-toolbar">
                    <a class="btn btn-sm btn-light" {{ $button->attributes }}>
                        {{ $button }}
                    </a>
                </div>
            @endisset
        </div>
    @endisset

    <div class="card-body py-5">
        {{ $slot }}
    </div>
</div>

<div class="my-5"></div>
