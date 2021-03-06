@extends('layouts.student')

@section('student_side_menu')
	@include('partials.student_side_menu')
@endsection
@section('content')
@if(is_desktop())
	<div class="box padding-sm">
		<h6>
      @if(Request::get('from') == "admin")
		  	1:1문의 &nbsp;&nbsp;
		  @else
		  	강사와 대화 
		  @endif</h6>
		<a class="btn btn-lg btn-warning" href="{{ route('dashboard.message.index', ['from' => Request::get('from')]) }}" >@lang('button.cancel')</a>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<h4>{{$message->user->username}}</h4>
				{!! $message->message !!}
				<hr>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				
				<label>@lang('label.replies')</label>
				@forelse($message->replies as $reply)
					<div class="testimonials-div">
              			<b>
                          	{{$reply->admin->name}}
              			</b><br>
                        <small><small>
                        	{{date_formater('date_time_format', $reply->created_at)}}
                        </small></small>
                      
                          <p>
                          	{!! $reply->message !!}
                          </p>
                    </div>
                    <hr>
                @empty
                	<h4 class="text-center"> @lang('label.no_reply_yet')</h4>
                	<br>
                @endforelse
				{{-- <form action="{{ route('dashboard.message.reply') }}" method="post">
						<label>@lang('label.reply')</label>
						{{csrf_field()}}
						<input type="hidden" name="message_id" value="{{$message->id}}">
						<textarea id="my-editor" name="message"></textarea>
						<br>
						<button class="btn btn-primary" type="submit"> @lang('button.submit')</button>
				</form> --}}
			</div>
		</div>
	</div>
@else
  <h6 class="mobile-title">@if(Request::get('from') == "admin")
		  	1:1문의 &nbsp;&nbsp;
		  @else
		  	강사와 대화 
		  @endif</h6>
  <div class="container">
    <a class="btn btn-sm btn-warning" href="{{ route('dashboard.message.index', ['from' => Request::get('from')]) }}" >@lang('button.cancel')</a>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<h4>{{$message->admin->name}}</h4>
				{!! $message->message !!}
				<hr>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				
				<label>@lang('label.replies')</label>
				@forelse($message->replies as $reply)
					<div class="testimonials-div">
						<b>
										{{$reply->admin->name}}
						</b><br>
								<small><small>
									{{date_formater('date_time_format', $reply->created_at)}}
								</small></small>
							
									<p>
										{!! $reply->message !!}
									</p>
						</div>
						<hr>
				@empty
					<h4 class="text-center"> @lang('label.no_reply_yet')</h4>
					<br>
				@endforelse
		
			</div>
		</div>
  </div>
@endif
@endsection

@section('scripts')
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ asset('js/tinymce-lang/ko_kr.js')}}"></script>
    
    <script>
      var lfm = function(options, cb) {
          var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
          window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
          window.SetUrl = cb;
      }

      var editor_config = {
   
        height : "480",
        selector: "textarea#my-editor",
        menubar: false,
        branding:false,
        themes: "modern",
        forced_root_block : false,
        language : 'ko_KR',
        plugins: [
          "advlist autolink lists link charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime nonbreaking save table contextmenu directionality",
          "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = '/media?field_name=' + field_name;
          
          if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
          } else {
            cmsURL = cmsURL + "&type=Files";
          }

          tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Media Manager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
          });
        }
      };

    tinymce.init(editor_config);

</script>
@endsection