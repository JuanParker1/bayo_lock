<div class="case margin-bottom-25">
    <div class="case-body margin-bottom-25 padding-25">

        <a class="case-anchor" href="/contract/{!! $contract->id !!}">
            <div>
                <h2>{!! $header !!}</h2>
            </div>

            <div>
                <span>{!! $price !!}</span>
            </div>
        </a>

    </div>

    {{--  open show  --}}
    <div class="case-line-up">
        <div class="middle-line"></div>
    </div>

    <div class="case-footer text-center margin-top-25 padding-25">

        <div class="case-footer-item extend">
            <a class="case-anchor flex" href="/contract/{!! $investor->id !!}/extend/{!! $contract->id !!}">
                <div class="one">
                    <i class="bi bi-plus"></i>
                </div>
                <div class="two text-left">extend</div>
            </a>
        </div>

        <div class="case-footer-item delete">
            <a class="case-anchor flex" href="/contract/{!! $contract->id !!}/delete">
                <div class="one">
                    <i class="bi bi-trash3"></i>
                </div>
                <div class="two text-left">delete</div>
            </a>
        </div>
    </div>
</div>
<div class="close-up"></div>
