
@if(Auth::user()->hasRole(1))
@include('includes/components/left_sidebars/admin')
@elseif(Auth::user()->hasRole(2))
@include('includes/components/left_sidebars/tourOperator')
@elseif(Auth::user()->hasRole(3))
@include('includes/components/left_sidebars/tourist')
@else

@endif
