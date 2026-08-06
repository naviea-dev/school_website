@php
    $gridKey = $gridKey ?? 'grid';
    $gridClass = $gridClass ?? '';
    $descLimit = 110;
    $vipPlaceholder = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyMDAgMjAwIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2UyZThmMCIvPjxjaXJjbGUgY3g9IjEwMCIgY3k9Ijc4IiByPSIzOCIgZmlsbD0iI2EwYWVjMCIvPjxwYXRoIGQ9Ik00MCAxOTBjMC00NCAyNy03MCA2MC03MHM2MCAyNiA2MCA3MCIgZmlsbD0iI2EwYWVjMCIvPjwvc3ZnPg==';
@endphp
<div class="vip-grid {{ $gridClass }}">
    @foreach($members as $vip)
    <div class="vip-card">

        <div class="vip-title">
            {{ $vip->position }}
        </div>

        <div class="vip-body">
            <img src="{{ $vip->image ?: $vipPlaceholder }}"
                onerror="this.onerror=null;this.src='{{ $vipPlaceholder }}';"
                alt="{{ $vip->name }}">

            <h5>{{ $vip->name }}</h5>
            <p class="designation">{{ $vip->designation }}</p>

            @php $plainDetails = trim(strip_tags($vip->details ?? '')); @endphp
            @if($plainDetails)
            <p class="vip-desc small text-muted mt-2">
                {{ \Illuminate\Support\Str::limit($plainDetails, $descLimit) }}
                @if(strlen($plainDetails) > $descLimit)
                <button type="button" class="see-more-link" data-bs-toggle="modal"
                    data-bs-target="#vipModal-{{ $gridKey }}-{{ $loop->index }}">আরও দেখুন</button>
                @endif
            </p>

            <div class="modal fade" id="vipModal-{{ $gridKey }}-{{ $loop->index }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $vip->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ $vip->image ?: $vipPlaceholder }}"
                                onerror="this.onerror=null;this.src='{{ $vipPlaceholder }}';"
                                alt="{{ $vip->name }}" class="img-fluid rounded mb-3" style="max-width: 200px;">
                            <p class="fw-bold mb-1">{{ $vip->designation }}</p>
                            <p style="white-space: pre-line;">{{ $plainDetails }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

    </div>
    @endforeach
</div>

@push('scripts')
<script>
document.querySelectorAll('.vip-card .modal').forEach(function (m) {
    document.body.appendChild(m);
});
</script>
@endpush
