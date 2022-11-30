<div class="reviewListQuestion" style="font-size:20px">
    @if (count($options) > 0)
        @php
            $numal = 0;
            $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        @endphp
        @foreach ($options as $item)
            <p class="pb-2 {{ $item->iscorrect == 1 ? 'text-success' : 'text-danger' }}">
                <span>{{ $alphabet[$numal] }}.
                </span>
                {{ $item->value }}
                @if ($item->iscorrect == 1)
                    <i class="fas fa-check text-success"></i>
                @else
                    <i class="fas fa-times  text-danger"></i>
                @endif
            </p>
        @endforeach
    @else
        <p>no data found.</p>
    @endif

</div>
