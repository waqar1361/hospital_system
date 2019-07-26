<div class="page-header">
	<div class="page-block">
		<div class="row align-items-center">
			<div class="col-md-8">
				<div class="page-header-title">
					<h5 class="m-b-10">@yield('page-title')</h5>
					<p class="m-b-0">@yield('page-description')</p>
				</div>
			</div>
			<div class="col-md-4">
				<ul class="breadcrumb-title text-capitalize">
					<li class="breadcrumb-item" aria-current="page">
						<a href="/"><i class="fa fa-home"></i></a>
					</li>
					@php($seg_link = '')
					@for($i = 0; $i < count(Request::segments()); $i++)
                        <?php
                        $myLinks = Request::segments();
                        $last = count(Request::segments()) - 1;
                        $seg_link .= "/" . $myLinks[$i];
                        ?>
						
						@if($i == $last)
							<li class="breadcrumb-item active" aria-current="page">
								{{$myLinks[$i]}}
							</li>
						@else
							<li class="breadcrumb-item">
								<a href="{{$seg_link}}">{{$myLinks[$i]}}</a>
							</li>
						@endif
					
					@endfor
				
				</ul>
			
			</div>
		</div>
	</div>
</div>