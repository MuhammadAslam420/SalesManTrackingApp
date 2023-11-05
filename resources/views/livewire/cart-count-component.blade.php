<li class="breadcrumb-item">
    <a href="{{route('salesman.cart')}}">
        @if(Cart::instance('cart')->count() > 0 )
        Cart <span class="badge bg-success">{{Cart::instance('cart')->count()}}</span>
        @else
        Cart <span class="badge bg-primary">0</span>
        @endif
     </a>
</li>
