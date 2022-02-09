<html>
<head>
    @livewireStyles
</head>
<body>
    @foreach($histories as $history)
        <livewire:history :element="$history">
    @endforeach
</body>
@livewireScripts
</html>
