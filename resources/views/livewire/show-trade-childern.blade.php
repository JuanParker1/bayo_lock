<style>
    .inline-block {
        display: flex;
        justify-content: center;
        gap: 30px;
    }

    .collective-children.header {
        width: 20%;
        border-top: 1px solid;
        text-align: center;
        margin-bottom: 15px;
    }

    .collective-children.footer {
        width: 20%;
        border-bottom: 1px solid;
        text-align: center;
        margin-bottom: 45px;
    }

    .collective-children.body {
        width: 20%;
        text-align: center;
        margin-bottom: 5px;
    }

    .header {
        font-size: large;
    }
</style>
<div>
    <div class="inline-block">
        <div class="collective-children header">
            Order date
        </div>
        <div class="collective-children header">
            Amount
        </div>
        <div class="collective-children header">
            Price
        </div>
        <div class="collective-children header">
            Action
        </div>
    </div>

    <!-- table body -->
{{--    @foreach($collective as $element)--}}
{{--        <div class="inline-block">--}}
{{--            <div class="collective-children body">--}}
{{--                {!! date('d M. Y' ,strtotime($element["order-day"])) !!}--}}
{{--            </div>--}}
{{--            <div class="collective-children body">--}}
{{--                {!! $element["total-currency"] !!}--}}
{{--            </div>--}}
{{--            <div class="collective-children body">--}}
{{--                {!! $element['currency-single-price'] * $element["total-currency"] !!}--}}
{{--                <small>{!! $element['currency-single-price'] !!}</small>--}}
{{--            </div>--}}
{{--            <div class="collective-children body">--}}
{{--                Action--}}
{{--            </div>--}}
{{--        </div>--}}
{{--@endforeach--}}

<!-- table footer -->
    <div class="inline-block">
        <div class="collective-children footer"></div>
        <div class="collective-children footer"></div>
        <div class="collective-children footer"></div>
        <div class="collective-children footer"></div>
    </div>
</div>
