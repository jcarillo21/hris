                @foreach (['danger', 'warning', 'success', 'info'] as $mode)
                   @if(Session::has($mode))
                     <div class="kode-alert alert alert-{{ $mode }}">
						<a href="#" class="closed">&times;</a>
                       <p>{{ Session::get($mode) }}</p>
                     </div>
                   @endif
                @endforeach
			