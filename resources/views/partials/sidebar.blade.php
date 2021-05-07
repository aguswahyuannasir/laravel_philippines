<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <em class="nav-icon icon-speedometer"></em> {{ __('Dashboard') }}
                </a>
            </li>

            @if(Gate::check('number-1') || Gate::check('number-2'))

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <em class="nav-icon icon-puzzle"></em> Question</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'number_1') ? 'active' : '' }}" href="{{ route('question.number_1.index') }}">
                        <em class="nav-icon icon-puzzle"></em> Number 1 </a>
                    </li>
          
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'number_2') ? 'active' : '' }}" href="{{ route('question.number_2.index') }}">
                            <em class="nav-icon icon-puzzle"></em>Number 2</a>
                    </li>
                </ul>
            </li>
            @endif

        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>