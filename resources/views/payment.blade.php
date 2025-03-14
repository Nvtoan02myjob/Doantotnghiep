<div>
    {{ $order}}
</div>
<div>
    @foreach($cart as $item)  
        <li>{{ $item }}</li>
    @endforeach 
</div>
